<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function add(Request $request){
        $this->validate($request, [
            'lname' => 'required|max:255',
            'mname' => 'required|max:255',
            'fname' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'password' => 'required|confirmed|',
            'email' => 'required|email',
            'contact_number' => 'required|',
            'address' => 'required|',
            'valid_id' => 'image',
            
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
            'user_types_id' => 2,
            'verified' => "Verified",
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'valid_id' => $filename,
        ]);
        return redirect()->route('staff')->with('status','Front Desk Added Succesfully');
    }


    public function verify(Request $request){
        $user = User::find($request->id);
        $user->verified = "Verified";
        $user->save();

        if($request->user ==="customer"){
            return redirect()->route('customer')->with('status','Customer Verified');
        }
        elseif($request->user ==="staff"){
            return redirect()->route('staff')->with('status','Front Desk Verified');
        }
        
    }
    public function unverify(Request $request){
        $user = User::find($request->id);
        $user->verified = "Unverified";
        $user->save();
        if($request->user ==="customer"){
            return redirect()->route('customer')->with('status','Customer Unverified');
        }
        elseif($request->user ==="staff"){
            return redirect()->route('staff')->with('status','Front Desk Unverified');
        }
    }
    
    public function update(Request $request){
        $this->validate($request, [
            'lname' => 'required|max:255',
            'mname' => 'required|max:255',
            'fname' => 'required|max:255',
            'email' => 'required|email',
            'contact_number' => 'required|',
            'address' => 'required|',
            'valid_id' => 'image',
        ]); 

        $user = User::find($request->id);
        $filename = "";
        if($request->file('valid_id')){
            $file = $request->file('valid_id');
            $filename = $request->username .'.png';
            $file->move('uploads/profile',$filename);
            $filename = 'uploads/profile/'.$filename;
        }
        else{
            $filename = $user->valid_id;
        }
        $user->lname = $request->lname;
        $user->mname = $request->mname;
        $user->fname = $request->fname;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->contact_number = $request->contact_number;
        $user->valid_id = $filename;
        $user->save();

        return redirect()->route('home');
    }

    public function changepass(Request $request){
        $this->validate($request, [
            'old' => 'required|',
            'password' => 'required|confirmed|',
        ]);
        $user = User::find($request->id);
        if(Hash::check($request->old, $user->password)){
            $user->password = Hash::make($request->password);
            $user->save();
            return Redirect::back()->withErrors(['success' => 'Password Change Successfully']);
        }
        else{
            return Redirect::back()->withErrors(['msg' => 'Password Not Match']);
        }
    }
}
