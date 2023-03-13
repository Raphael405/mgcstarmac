<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register(){
        
        return view('auth.register');
    }
    public function login(){
        return view('auth.login');
    }

    public function reloadCaptcha(){
        return response()->json(['captcha'=>captcha_img('math')]);
    }

    public function reg(Request $request){
        $this->validate($request, [
            'lname' => 'required|max:255',
            'mname' => 'required|max:255',
            'fname' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'password' => 'required|confirmed|',
            'email' => 'required|email',
            'contact_number' => 'required|',
            'address' => 'required|',
            'captcha' => 'required|captcha',
        ]); 
        $filename = "";
        if($request->file('valid_id')){
            $file = $request->file('valid_id');
            $filename = $request->username .'.png';
            $file->move('uploads/profile',$filename);
            $filename = 'uploads/profile/'.$filename;
        }
        else{
            $filename = "uploads/user.png";
        }

        User::create([
            'username' =>$request->username,
            'password' =>Hash::make($request->password),
            'user_types_id' => 3,
            'verified' => "Verified",
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'valid_id' => $filename,
        ]);
        if (auth()->attempt($request->only('username','password'), $request->remember)){
            return redirect()->route('home');
        }
        return redirect()->route('home');
    }

    public function log(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            'captcha' => 'required|captcha',
        ]);
        if( Session::get('time') != 0 && date(date('Y-m-d H:i:s',strtotime(Session::get('time') . ' + 5 minutes'))) < date('Y-m-d H:i:s') ){
            Session::put('attempt',0);
            Session::put('time',0);
        }
        if(Session::get('attempt') == 3){
            return back()->with('status','Currently Locked');
        }
        
        if (!auth()->attempt($request->only('username','password'), $request->remember)){
            Session::put('attempt', Session::get('attempt') + 1);

            if(Session::get('attempt') == 3){
                Session::put('time', date('Y-m-d H:i:s'));
            }
            return back()->with('status','Invalid Login Details');
        }
        else{
            Session::put('attempt',0);
            Session::put('time',0);
            return redirect()->route('home');
        }
        
    }
    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }
}
