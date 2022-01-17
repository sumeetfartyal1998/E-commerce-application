<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class APIWishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $wishlist=new Wishlist();
        $wishlist->user_id=$req->user_id;
        $wishlist->product_id=$req->product_id;
        if($wishlist->save()){
            return response()->json(['success'=>"Product added to wishlist"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wishlist=User::find($id)->getWishlist->all();
        $wishlistProducts=[];
        foreach($wishlist as $w){
            $product=Product::where('id',$w->product_id)->get();
            array_unshift($wishlistProducts,$product[0]);
        }
        return response()->json($wishlistProducts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wishlist=Wishlist::where('product_id',$id);
        if($wishlist->delete()){
            return response()->json(['success'=>"Product removed from wishlist successfully"]);
        }
    }
}
