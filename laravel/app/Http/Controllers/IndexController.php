<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BoardList;
use App\BoardContent;
use App\ChatRoom;

class IndexController extends Controller
{
    public function intro(Request $request){
        $boardList = new BoardList();
        $boardContent = new BoardContent();
        $chatRoom = new ChatRoom();
        $chatList = $chatRoom->orderBy('r_no','desc')->get();
        $board = $boardList->get();
        $content = [];
        
        for($i = 0; $i<$boardList->count(); $i++){
            $content[$i] = $boardContent->where("board_no", $boardList->get()[$i]->board_no)->orderBy('b_no','desc')->limit(5)->get();
        }
        return view('intro.index',[
            'boardList'=>$board,
            'content'=>$content,
            'chatList'=>$chatList
        ]);
    }
    public function index(Request $request){
        return view('index');
    }
}
