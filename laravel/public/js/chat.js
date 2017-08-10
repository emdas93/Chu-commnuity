var tempUser = 0;
$(document).ready(function(){
    // joinRoom
    $(".joinRoomBtn").on('click', function(event){
        var r_no        = $(this).attr("data-id");
        var r_name      = $(this).text();
        var user_id     = $("meta[name='user_id']").attr("content");
        var user_name   = $("meta[name='user_name']").attr("content");
        if(!user_id || !user_name){
            user_name = prompt("닉네임을 입력해주세요");
            user_id = "user" + ++tempUser;
            $("<meta></meta>[name='user_id']").attr({
                "name":"user_id",
                "content":user_id,
            }).appendTo("head");
            $("<meta></meta>").attr({
                "name":"user_name",
                "content":user_name
            }).appendTo("head");
            if(!user_id || !user_name) return 0;
        }
        if($(".chatBox[data-id='"+r_no+"']").length >=1){
            return 0;
        }
        renderRoom(r_no, r_name);
        
        socket.emit('joinRoom', {
            "r_no" : r_no,
            "user_name" : user_name,
            "user_id" : user_id,
            "r_name" : r_name,
        });
    });
    
});


var renderRoom = (function(r_no, r_name){
    // 채팅방 넘버
    var chatBox             = $("<div></div>").addClass("panel panel-primary chatBox").attr("data-id",r_no);
    var chatBox_header      = $("<div></div>").addClass("panel-heading chatBox-header");
    var chatBox_body        = $("<div></div>").addClass("panel-body chatBox-body");
    var chatBox_footer      = $("<div></div>").addClass("panel-footer chatBox-footer");
    var user_id             = $("meta[name='user_id']").attr("content");
    var user_name           = $("meta[name='user_name']").attr("content");
    var messageBox          = $("<div></div>").addClass("messageBox");
    var loadMoreBtn         = $("<a></a>").addClass("loadMoreBtn btn btn-primary btn-block").attr("href","#!").text("지난채팅 불러오기");
    var form_group          = $("<div></div>").addClass("form-group");
    var input               = $("<input></input>").attr("type","text").addClass("form-control chat-message");
    var sendMeassageBtn     = $("<button></button>").addClass("btn btn-success btn-block sendMeassageBtn").text("보내기");
    var memberBox           = $("<div></div>").addClass("panel panel-danger memberBox");
    var memberBox_header    = $("<div></div>").addClass("panel-heading memberBox-heading");
    var memberBox_body      = $("<div></div>").addClass("panel-body memberBox-body");
    var leaveBtn            = $("<a></a>").attr("href","#leaveRoom").addClass("pull-right");
    messageBox.appendTo(chatBox_body);
    loadMoreBtn.appendTo(messageBox);
    chatBox_header.appendTo(chatBox);
    chatBox_body.appendTo(chatBox);
    chatBox_footer.appendTo(chatBox);
    // 채팅방 제목
    $("<span></span>").addClass("panel-title room-title").text(r_name).appendTo(chatBox_header); 
    input.appendTo(form_group);
    sendMeassageBtn.appendTo(form_group);
    form_group.appendTo(chatBox_footer);
    memberBox_header.appendTo(memberBox);
    memberBox_body.appendTo(memberBox);
    $("<span></span>").addClass("panel-title").text("참여자목록").appendTo(memberBox_header);
    $("<span></span>").addClass("badge memberCount").text(0).appendTo(memberBox_header);
    memberBox.appendTo(chatBox_body);
    
    $("<i></i>").addClass("glyphicon glyphicon-remove").appendTo(leaveBtn);
    leaveBtn.appendTo(chatBox_header);
    
    chatBox.appendTo(".chat").show("fast").draggable();
    
    $.ajax({
        url:"https://emdas-emdas93.c9users.io/chat/getLogs",
        method:"post",
        data:{
            r_no:r_no,
            loadCount:100,
        },
        dataType:"json",
        success:function(data){
            var where;
            var target = $(".chatBox[data-id="+r_no+"]");
            for(var i = 0; i<data.length;++i){
                if(data[i].c_user_name == user_name) where="text-right";
                else where="text-left";
                
                var time = data[i].created_at.substr(11,5);
                var messageSet = $("<div></div>").addClass("messageSet "+where).attr("data-id",data[i].c_no);
                $("<h3></h3>").addClass("user-name text-primary").text(data[i].c_user_name).appendTo(messageSet);
                $("<h4></h4>").addClass("user-message text-muted").text(data[i].c_comment).appendTo(messageSet);
                $("<h6></h6>").addClass("msg-time text-primary").text(time).appendTo(messageSet);
                messageSet.appendTo(target.find(".messageBox"));
                target.find(".chatBox-body").scrollTop(target.find(".messageBox").height());
            }
        }
    });
    
    
    // Send Message
    sendMeassageBtn.on('click', function(){
        var target = $(this).parent().parent().parent();
        var r_no = target.attr("data-id");
        var message = target.find(".chat-message").val();
        var r_name = target.find(".room-title").text();
        if(message == "") return 0;
        socket.emit("sendMsg", {
            user_name:user_name,
            user_id:user_id,
            r_no:r_no,
            message:message,
            r_name:r_name,
        });
        target.find(".chat-message").val("");
    });
    
    // Send Message Enter
    input.on('keyup', function(event){
        if(event.keyCode == 13){
            var target = $(this).parent().parent().parent();
            var r_name = target.find(".room-title").text();
            var r_no = target.attr("data-id");
            var message = $(this).val();
            if(message == "") return 0;
            socket.emit("sendMsg", {
                user_name:user_name,
                user_id:user_id,
                r_no:r_no,
                message:message,
                r_name:r_name,
            });
            target.find(".chat-message").val("");
        }
    })
    
    // leaveRoom
    leaveBtn.on('click', function(){
        var target = $(this).parent().parent();
        var r_no = target.attr("data-id");
        var r_name = target.find(".room-title").text();
        target.hide("fast").remove();
        
        socket.emit('leaveRoom', {
            "r_no" : r_no,
            "user_name" : user_name,
            "user_id" : user_id,
            "r_name" : r_name
        });
    });
    
    // Message More
    $(".loadMoreBtn").on("click", function(){
        // var currentScroll = $(this).scrollTop();
        // var boxHeight = $(this).find(".messageBox").height()-440;
        // var currentLocation = (currentScroll/boxHeight)*100;
        // var location = Math.round(currentLocation);
        var user_id     = $("meta[name='user_id']").attr("content");
        var user_name   = $("meta[name='user_name']").attr("content");
        var firstDataNo = $(this).parent().parent().parent().find(".messageBox").find(".messageSet").first().attr("data-id");
        var toTarget = $(this).parent().parent().parent().find(".messageBox").find(".messageSet[data-id='"+firstDataNo+"']");
        var r_no = $(this).parent().parent().parent().attr("data-id");
        console.log(r_no);
        $.ajax({
            url:"https://emdas-emdas93.c9users.io/chat/getLogsMore",
            method:"post",
            data:{
                r_no:r_no,
                loadCount:5,
                c_no:firstDataNo
            },
            dataType:"json",
            success:function(data){
                if(data == "NoData"){
                    return 0;
                }
                var target = $(".chatBox[data-id='"+r_no+"']");
                for(var i = 0; i<data.length;++i){
                    if(data[i].c_user_name == user_name) where="text-right";
                    else where="text-left";
                    
                    var boxTarget = target.find(".messageSet").first();
                    
                    var time = data[i].created_at.substr(11,5);
                    var messageSet = $("<div></div>").addClass("messageSet "+where).attr("data-id",data[i].c_no);
                    $("<h3></h3>").addClass("user-name text-primary").text(data[i].c_user_name).appendTo(messageSet);
                    $("<h4></h4>").addClass("user-message text-muted").text(data[i].c_comment).appendTo(messageSet);
                    $("<h6></h6>").addClass("msg-time text-primary").text(time).appendTo(messageSet);
                    boxTarget.before(messageSet);
                    console.log("sdf");
                    // target.find(".chatBox-body").scrollTop(target.find(".messageBox").height());

                }
            }
        })
        
    });
    
    
    
});

socket.on("newMember", function(data){
    renderMsg(data, "center");
});

socket.on("leaveMember", function(data){
    renderMsg(data, "center");
});

socket.on("receiveMsg", function(data){
    renderMsg(data, "left");
});

socket.on("sentMsg", function(data){
    renderMsg(data, "right");
});

socket.on("updateMember", function(data){
    var target = $(".chatBox[data-id="+data.r_no+"]");
    var subTarget = $(".joinRoomBtn[data-id="+data.r_no+"]");
    target.find(".memberCount").text(data.memberCount);
    subTarget.find(".memberCount").text(data.memberCount);
    var div = $("<div></div>");
    for(var i = 0; i<data.member.length; ++i){
        $("<p></p>").text(data.member[i].user_name).addClass("btn btn-primary btn-block").appendTo(div);
    }
    target.find(".memberBox-body").html(div);
});

var renderMsg = (function(data, where){
    if(where == "left") where = "text-left";
    if(where == "right") where = "text-right";
    if(where == "center") where = "text-center";
    var target = $(".chatBox[data-id="+data.r_no+"]");
    var messageSet = $("<div></div>").addClass("messageSet "+where);
    $("<h3></h3>").addClass("user-name text-primary").text(data.user_name).appendTo(messageSet);
    $("<h4></h4>").addClass("user-message text-muted").text(data.message).appendTo(messageSet);
    $("<h6></h6>").addClass("msg-time text-primary").text(data.time).appendTo(messageSet);
    messageSet.appendTo(target.find(".messageBox"));
    target.find(".chatBox-body").scrollTop(target.find(".messageBox").height());
    
    $.ajax({
        url:"https://emdas-emdas93.c9users.io/chat/chatSave",
        method:"post",
        data:{
            c_user_name : data.user_name,
            c_comment : data.message,
            c_roomNo : data.r_no,
            c_user_id : data.user_id,
        },
        dataType:"json",
        
    });
});
