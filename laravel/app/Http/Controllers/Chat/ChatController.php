<?php

namespace App\Http\Controllers\Chat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ChatRoom;
use App\ChatLog;

class ChatController extends Controller
{
    public function createRoom(Request $request){
        $chatRoom = new ChatRoom();
        $r_name = $request->r_name;
        $r_owner = $request->r_owner;
        
        $chatRoom->r_name = $r_name;
        $chatRoom->r_owner = $r_owner;
        
        if($chatRoom->save()){
            $result = $chatRoom->where("r_name", $r_name)->get()[0];
        }
        
        return $result;
    }
    
    public function chatSave(Request $request){
        $chatLog = new ChatLog();
        $chatLog->c_user_name = $request->c_user_name;
        $chatLog->c_comment = $request->c_comment;
        $chatLog->c_roomNo = $request->c_roomNo;
        $chatLog->c_user_id = $request->c_user_id;
        
        $chatLog->save();
    }
    
    public function getLogs(Request $request){
        $chatLog = new ChatLog();
        $lastCount = $chatLog->where("c_roomNo",$request->r_no)->count();
        $logs = $chatLog->
                where("c_roomNo",$request->r_no)->
                orderBy("c_no","asc")->
                limit(50)->offset($lastCount-50)->
                get();
        
        return $logs;
    }
    
    public function getLogsMore(Request $request){
        $chatLog = new ChatLog();
        $logs = $chatLog->where("c_roomNo",$request->r_no)->
                          where("c_no","<",$request->c_no)->
                          orderBy("c_no","desc")->
                          limit($request->loadCount)->
                          get();
        if($logs->count() == 0){
            return "NoData";
        }
        return $logs;
    }
}
