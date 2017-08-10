var http = require("http").createServer(function(){});
http.listen(8081);

var connection = 0;
var User = (function(user_id, user_name){
    this.id     = user_id;
    this.name   = user_name;
})
var Room = (function(r_name){
    this.roomName       = r_name;
    this.roomMembers    = new Array();
})
var room = [];
var io = require("socket.io").listen(http);
io.sockets.on('connection', function(socket){
    console.log("누군가 접속했습니다.");
    console.log("현재 접속자수 : ["+ ++connection +"] ( 시간 : "  + getTimeStamp() + " )"); 
    
    // 채팅방 입장
    socket.on("joinRoom", function(data){
        socket.join(data.r_no);
        console.log(data);
        
        if(room[data.r_no] == undefined){
            room[data.r_no] = new Room(data.r_name);
            room[data.r_no].roomMembers.push({user_name:data.user_name,socketID:socket.id});
        }else{
            room[data.r_no].roomMembers.push({user_name:data.user_name,socketID:socket.id});
        }
        console.log(room);
        
        
        
        var memberCount = room[data.r_no].roomMembers.length;
        console.log(data.user_name + "님이 " + data.r_no + "번["+data.r_name+"] 방에 입장했습니다.");
        socket.broadcast.in(data.r_no).emit("newMember", {
            "memberCount":memberCount,
            "r_no":data.r_no,
            "user_name":data.user_name,
            "user_id":data.user_id,
            "message":data.user_name+"님이 입장하셨습니다."
        });
        io.sockets.emit("updateMember", {
            "memberCount":memberCount,
            "r_no":data.r_no,
            "member":room[data.r_no].roomMembers,
        });
    });
    
    // 채팅방 퇴장
    socket.on("leaveRoom", function(data){
        socket.leave(data.r_no);
        room[data.r_no].roomMembers.splice(room[data.r_no].roomMembers.indexOf(data.user_name), 1);
        console.log(room);
        var memberCount = room[data.r_no].roomMembers.length;
        console.log(data.user_name + "님이 " + data.r_no + "번["+data.r_name+"] 방에서 퇴장했습니다.");
        socket.broadcast.in(data.r_no).emit("leaveMember", {
            "memberCount":memberCount,
            "r_no":data.r_no,
            "user_name":data.user_name,
            "user_id":data.user_id,
            "message":data.user_name+"님이 퇴장하셨습니다.",
        });
        io.sockets.emit("updateMember", {
            "memberCount":memberCount,
            "r_no":data.r_no,
            "member":room[data.r_no].roomMembers,
        });
    });
    
    // 메시지 전송
    socket.on("sendMsg", function(data){
        console.log("("+data.r_name+"["+data.r_no+"])" + data.user_name +"["+data.user_id+"]" + " : " + data.message);
        data.time = getTimeStamp().substr(11,5);
        console.log(getTimeStamp());
        socket.emit("sentMsg", data);
        socket.broadcast.in(data.r_no).emit("receiveMsg", data);
    })
    
    socket.on("disconnect", function(data){
        
        console.log("LOG START------------------------------------");
        for(var i in room){
            for(var j=0; j<room[i].roomMembers.length;++j){
                if(room[i].roomMembers[j].socketID == socket.id){
                    room[i].roomMembers.splice(room[i].roomMembers.indexOf(j), 1);
                    var r_no = i;
                }
            }
        }
        var memberCount;
        var roomMembers;
        if(room[r_no] == undefined) memberCount = 0;
        else memberCount = room[r_no].roomMembers.length;
        
        if(room[r_no] == undefined) roomMembers = [];
        else roomMembers = room[r_no].roomMembers;
        io.sockets.emit("updateMember", {
            "memberCount":memberCount,
            "r_no":i,
            "member":roomMembers,
        });
        console.log("누군가 접속을 해제했습니다.");
        console.log("현재 접속자수 : ["+ --connection +"] ( 시간 : "  + getTimeStamp() + " )"); 
    })
    
});
setInterval(function(){console.log("현재 접속자수 : ["+ connection +"] ( 시간 : "  + getTimeStamp() + " )");}, 10000); 
function getTimeStamp() {
    var d = new Date();
    
    var s =
    leadingZeros(d.getFullYear(), 4) + '-' +
    leadingZeros(d.getMonth() + 1, 2) + '-' +
    leadingZeros(d.getDate(), 2) + ' ' +
    
    leadingZeros(d.getHours(), 2) + ':' +
    leadingZeros(d.getMinutes(), 2) + ':' +
    leadingZeros(d.getSeconds(), 2);
    
    return s;
}
function leadingZeros(n, digits) {
    var zero = '';
    n = n.toString();
    
    if (n.length < digits) {
    for (i = 0; i < digits - n.length; i++)
        zero += '0';
    }
return zero + n;
}