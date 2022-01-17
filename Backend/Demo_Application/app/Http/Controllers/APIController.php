<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class APIController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api',['except'=>['login','register']]);
    }

    public function register(Request $req){
        $rules=array(
            'fname'=>'required',
            'lname'=>'required',
            'email'=>'required|regex:/^(([\-\w]+)\.?)+@(([\-\w]+)\.?)+\.[a-zA-Z]{2,4}$/',
            'pass'=>'required|min:8|max:12|regex:/^[a-zA-Z0-9_]*$/',
            'cpass'=>'required|same:pass'
        );
        $errMsg=array(
            'fname.required'=>'First name is required',
            'lname.required'=>'Last name is required',
            'email.required'=>'Email id is required',
            'email.regex'=>'Invalid Email id',
            'pass.required'=>'Password is required',
            'pass.regex'=>'Your password must contain both alphabets and numbers',
            'pass.min'=>'Password should be of minimum 8 letters',
            'pass.max'=>'Password should be of maximum 12 letters',
            'cpass.required'=>'Confirm your password by re entering it',  
            'cpass.same'=>'Both passwords must match'        
        );
        $validator=Validator::make($req->all(),$rules,$errMsg);
        if($validator->fails()){
            return response()->json($validator->errors());
        }else{
            $user=new User();
            $user->fname=$req->fname;
            $user->lname=$req->lname;
            $user->email=$req->email;
            $user->password=Hash::make($req->pass);
            $user->role="Customer";
            $user->status=1;
            if($user->save()){
                return response()->json(["result"=>"Registered Successfully"]);
            }
        }
    }
    public function login(Request $req){
        $rules=array(
            'email'=>'required|regex:/^(([\-\w]+)\.?)+@(([\-\w]+)\.?)+\.[a-zA-Z]{2,4}$/',
            'password'=>'required|min:8|max:12|regex:/^[a-zA-Z0-9_]*$/',
        );
        $errMsg=array(
            'email.required'=>'Email id is required',
            'email.regex'=>'Invalid Email id',
            'password.required'=>'Password is required',
            'password.regex'=>'Your password must contain both alphabets and numbers',
            'password.min'=>'Password should be of minimum 8 letters',
            'password.max'=>'Pasword should be of maximum 12 letters',        
        );
        $validator=Validator::make($req->all(),$rules,$errMsg);
        if($validator->fails()){
            return response()->json($validator->errors());
        }else{
            if(!$token=auth()->guard('api')->attempt($validator->validated())){
                return response()->json(['error'=>'Unauthorized'],401);
            }
            return $this->respondWithToken($token);
        }
    }

    public function respondWithToken($token){
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>auth()->guard('api')->factory()->getTTL()*60
        ]);
    }

    public function profile(){
        return response()->json(auth()->guard('api')->user());
    }

    public function refresh(){
        return $this->responseWithToken(auth()->refresh());
    }

    public function changePassword(Request $req){
        $rules=array(
            'oldPass'=>'required',
            'newPass'=>'required|min:8|max:12|regex:/^[a-zA-Z0-9_]*$/',
            'cpass'=>'required|same:newPass'
        );
        $errMsg=array(
            'oldPass.required'=>'Password is required',
            'newPass.required'=>'Password is required',
            'newPass.regex'=>'Your password must contain both alphabets and numbers',
            'newPass.min'=>'Your new password should be of minimum 8 letters',
            'newPass.max'=>'Your new password should be of maximum 12 letters',
            'cpass.required'=>'Confirm your password by re entering it',  
            'cpass.same'=>'Both passwords must match'        
        );
        $validator=Validator::make($req->all(),$rules,$errMsg);
        if($validator->fails()){
            return response()->json($validator->errors());
        }else{
            $userData=User::where('email',$req->email)->get();
            if(!Hash::check($req->oldPass,$userData[0]->password)){
                return response()->json(["error"=>"Invalid old password"]);
            }else{
                $newPass=Hash::make($req->newPass);
                $userData[0]->password=$newPass;
                if($userData[0]->save()){
                    return response()->json(["result"=>"Password has been updated successfully"]);
                }
            }
        }
    }

    public function contactUs(Request $req){
        $rules=array(
            'name'=>'required',
            'email'=>'required|regex:/^(([\-\w]+)\.?)+@(([\-\w]+)\.?)+\.[a-zA-Z]{2,4}$/',
            'contact'=>'required',
            'message'=>'required'
        );
        $validator=Validator::make($req->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors());
        }else{
            $data=new ContactUs();
            $data->name=$req->name;
            $data->email=$req->email;
            $data->contact=$req->contact;
            $data->message=$req->message;
            if($data->save()){
                return response()->json(["result"=>"Your feedback has been submitted. We will contact you as soon as possible"]);
            }
        }
    }
}
