<?php

namespace App\Http\Controllers\Func;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FuncController extends Controller
{
    public function getSession(Request $request){
        $sessionName = $request->sessionName;
        
        return $request->session()->get($sessionName);
    }
}
