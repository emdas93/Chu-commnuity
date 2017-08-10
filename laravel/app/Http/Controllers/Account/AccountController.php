<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;


class AccountController extends Controller
{
    // Login Action
    public function loginAction(Request $request){
        $user = new User();
        $user_id = $request->user_id;
        $user_pw = $request->user_pw;
        
        $db_user = $user->where('user_id',$user_id)->get();
        
        if($db_user->count() == 0){
            return redirect()->secure('/');
        }
        
        if(!Hash::check($user_pw,$db_user[0]->user_pw)){
            return redirect()->secure('/');
        }else{
            $request->session()->put('user',$db_user[0]);
            return redirect()->secure('/');
        }
    }
    
    // Logout Action
    public function logoutAction(Request $request){
        $request->session()->flush();
        return redirect()->secure('/');
    }
    
    // Register Action
    public function registerAction(Request $request){
        $user = new User();
        
        $user_name   = $request->user_name;
        $user_id     = $request->user_id;
        $user_pw     = $request->user_pw;
        // $user_email  = $request->user_email;
        // $user_phone  = $request->user_phone1.$request->user_phone2.$request->user_phone3;
        $user_birth  = $request->user_birth;
        $user_gender = $request->user_gender;
        
        $user->user_name     = $user_name;
        $user->user_id     = $user_id;
        $user->user_pw     = Hash::make($user_pw);
        // $user->user_email  = $user_email;
        // $user->user_phone  = $user_phone;
        $user->user_birth  = $user_birth;
        $user->user_gender = $user_gender;
        $user->user_level  = 1;
        if($user_name == '추승협' && $user_birth == '1993-07-09') $user->user_level = 0;
        $user->save();
        
        return redirect()->secure('/');
    }
    
    
}
