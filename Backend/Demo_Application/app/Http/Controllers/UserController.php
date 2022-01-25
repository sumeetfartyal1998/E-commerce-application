<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\Role;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('users.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role=Role::all();
        return view('users.create')->with('role',$role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role=Role::all();
        $user=User::find($id);
        return view('users.edit')->with(['user'=>$user,'role'=>$role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $validateData=$req->validate([
            'fname'=>'required',
            'lname'=>'required',
        ],[
            'fname.required'=>'Enter your first name',
            'lname.required'=>'Enter your last name',
        ]);
        if($validateData){
            $user=User::find($id);
            $user->fname=$req->fname;
            $user->lname=$req->lname;
            $user->role=$req->role;
            $user->status=$req->status;
            $user->save();
        }
        return back()->with('success','User details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        $orders=Order::where('user_id',$id)->get();
        foreach($orders as $order){
            $orderedProducts=OrderedProduct::where('order_id',$order->id)->get();
            foreach($orderedProducts as $orderedProduct){
                $orderedProduct->delete();
            }
            $order->delete();
        }
        $addresses=Address::where('user_id',$id)->get();
        foreach($addresses as $address){
            $address->delete();
        }
        $wishlists=Wishlist::where('user_id',$id)->get();
        foreach($wishlists as $wishlist){
            $wishlist->delete();
        }
        if($user->delete()){
            return back()->with('success','User deleted successfully');
        }
    }
}
