<?php

namespace App\Http\Controllers\Board;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BoardList;
use App\BoardContent;

class BoardController extends Controller
{
    // 게시판 추가
    public function createBoard(Request $request){
        $boardList = new BoardList();
        $board_name = $request->board_name;
        if($boardList->where('board_name',$board_name)->get()->count() >= 1){
            return redirect()->secure('/');
        }
        $boardList->board_name = $board_name;
        $boardList->page_no = 0;
        
        if($boardList->save()){
            return redirect()->secure('/');
        }else{
            return redirect()->secure('/');
        }
    }
    
    // 글 등록
    public function postAction(Request $request){
        $data = [];
        $result = "failed";
        $boardContent = new BoardContent();
        
        $b_title = $request->b_title;
        $b_writer = $request->b_writer;
        $b_content = htmlspecialchars($request->b_content);
        $boardContent->b_title = $b_title;
        $boardContent->b_writer = $b_writer;
        $boardContent->b_content = $b_content;
        $boardContent->board_no = $request->board_no;
        if($request->session()->has('user')){
            $boardContent->b_owner = $request->session()->get('user')->user_id;
        }else{
            $result = "failed";
        }
        
        $boardContent->b_fileURL = "X";
        
        if($boardContent->save()){
            $data = $boardContent->where('b_no',$boardContent->id)->get()[0];
            
        }else{
            return "failed";
        }
        
        
        return $data;
    }
    
    // 더보기
    public function postMore(Request $request){
        $boardContent = new boardContent();
        $data = [];
        $board_no = $request->board_no;
        $last_post = $request->last_post;
        $board = $boardContent->where("board_no",$board_no)->where("b_no","<",$last_post)->orderBy("b_no","desc")->limit(5)->get();
        if($board->count() == 0){
            $board->put('result','failed');
        }
        return $board;
        
    }
}
