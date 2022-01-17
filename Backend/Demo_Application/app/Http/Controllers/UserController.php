<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showRoles(){
        $role=Role::all();
        return view('adduser')->with('role',$role);
    }
    public function addUser(Request $req){
        $validateData=$req->validate([
            'fname'=>'required',
            'lname'=>'required',
            'email'=>'required|regex:/^(([\-\w]+)\.?)+@(([\-\w]+)\.?)+\.[a-zA-Z]{2,4}$/',
            'pass'=>'required|min:8|max:12|regex:/^[a-zA-Z0-9_]*$/',
            'cpass'=>'required|same:pass'
        ],[
            'fname.required'=>'Enter your first name',
            'lname.required'=>'Enter your last name',
            'email.required'=>'Enter your email id',
            'email.regex'=>'Enter a valid Email id',
            'pass.required'=>'Enter a password',
            'pass.min'=>'Password length must be atleast 8 characters',
            'pass.max'=>'Password length must be atmost 12 characters',
            'pass.regex'=>'Password must contain alphanumeric characters',
            'cpass.required'=>'Enter a password',
            'cpass.same'=>"Both passwords must match"
        ]);
        if($validateData){
            $user=new User();
            $user->fname=$req->fname;
            $user->lname=$req->lname;
            $user->email=$req->email;
            $user->password=Hash::make($req->pass);
            $user->role=$req->role;
            $user->status=$req->status;
            $user->save();
        }
        return back()->with('success','User details added successfully');
    }
}
