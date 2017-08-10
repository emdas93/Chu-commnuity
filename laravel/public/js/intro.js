$(function(){
    // Ajax Setting
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    fadeEvent();
    
    // Tab Activation
    $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      if($(e.target).attr('href') == "#aboutMe"){
          console.log("AA");
      }
      e.relatedTarget;
    })
    
    
    // GUEST BOOK CLICK
    // 작성
    $('.guestBookWriteBtn').click(function(){
        console.log(getSession("user"));
        var board = $(this).parent().parent().parent().parent().parent().parent();
        var board_no = board.attr('data-id');
        var b_title = board.find("#b_title").val();
        var b_content = board.find('#b_content').val();
        var b_writer = board.find('#b_writer').val();
        if(b_writer == ""){
            return (function(){
                alert("작성자 이름을 작성해주세요");
                board.find("#b_writer").focus();
            })();
        }
        
        // AJAX Connection #1
        $.ajax({
            url:"https://emdas-emdas93.c9users.io/board/postAction",
            method:"post",
            data:{
                "b_title" : b_title,
                "b_writer" : b_writer,
                "b_content" : b_content,
                "board_no" : board_no,
            },
            dataType:"json",
            success:function(data){
                renderPost(data, board, "write");
                board.find("#b_title").val("");
                board.find('#b_content').val("");
                
            },
            error:function(){
                // alert("글쓰기에 실패하였습니다.");
                console.log("싪");
            }
        });// AJAX Connection #1
    });
    
    // more
    $(".more").click(function(e){
        var target = $(this).parent().parent().parent().parent().parent();
        var board_no = target.attr('data-id');
        var last_post = target.find("div .content-set").last().attr("data-id");
        var last_postElement = target.find("div .content-set").last();
        console.log(last_post);
        $.ajax({
            url:"https://emdas-emdas93.c9users.io/board/postMore",
            method:"post",
            data:{
                "board_no":board_no,
                "last_post":last_post,
            },
            dataType:"json",
            success:function(data){
                if(data.result == "failed"){
                        alert("더이상 불러올 게시글이 없습니다.");
                }else{
                    for(var i = 0; i<data.length;++i){
                        renderPost(data[i], target, "load");
                    }
                }
                
                
            },
            error:function(){},
        });
        
    });
    
    
    
});

var init = (function(){
    var fadeSet = $(".fadeSet");
    var fadeItem = $(".fadeSet *");
    var fadeMargin = fadeItem.height()+20;
    fadeSet.css({
        "position":"relative",
        "padding-bottom":fadeMargin+"px",
    });
    fadeItem.css({
        "position":"absolute",
        "top":0,
        "right":0,
        "bottom":0,
        "left":0,
    });
});

var fadeEvent = (function(){
    init();
    var fadeSet = $(".fadeSet *");
    var fadeText = $(".fadeText");
    var cnt = fadeSet.length;
    var i=0;
    fadeText.css({"font-size":"2.5em",})
    fadeSet.hide();
    $(fadeSet[i]).fadeIn(3000).fadeOut(1500);
    i++;
    setInterval(function(){
        if(i >= cnt) i = 0;
        $(fadeSet[i]).fadeIn(3000).fadeOut(1500);
        i++;
    },3000);
});

var renderPost = (function(data, board, position){
    var content_set = $("<div></div>");
    content_set.addClass("col-md-12 content-set");
    content_set.attr("data-id",data.b_no);
    var content_title = $("<div></div>");
    content_title.addClass('content-title');
    
    $("<h3></h3>").text("[" +data.b_no + "] " + data.b_title).appendTo(content_title);
    $("<p></p>").addClass("text-right").text("작성자 : " + data.b_writer).appendTo(content_title);
    content_title.appendTo(content_set);
    
    var content = $("<div></div>");
    content.addClass("content");
    $("<p></p>").text(data.b_content).appendTo(content);
    content.appendTo(content_set);
    
    var content_menu = $("<div></div>");
    content_menu.addClass("content-menu text-right");
    $("<a></a>").addClass("btn btn-info").text("수정").attr({
        "id":"modify",
        "href":"#!"
    }).appendTo(content_menu);
    $("<a></a>").addClass("btn btn-danger").text("삭제").attr({
        "id":"delete",
        "href":"#!"
    }).appendTo(content_menu);
    content_menu.appendTo(content_set);
    
    if(position == "write"){
        board.find(".devide").after(content_set);
    }
    else if(position == "load"){
        board.find("div .content-set").last().after(content_set);
    }
    

});

var getSession = (function(sessionName){
    var sessionValue;
    $.ajax({
        url:"https://emdas-emdas93.c9users.io/func/getSession",
        method:"post",
        data:{"sessionName":sessionName},
        dataType:"json",
        success:function(data){
            sessionValue = data;
        },
    });
    return sessionValue;
});



