<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons=Coupon::all();
        return view('coupon.index')->with('coupons',$coupons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coupon.create');
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
            'code'=>'required',
            'discount'=>'required|numeric',
            'minPrice'=>'required|numeric',
        ],[
            'code.required'=>'Coupon Code is required',
            'discount.required'=>'Discount value is required',
            'discount.numeric'=>'Enter a valid discount value',
            'minPrice.required'=>'Minimum product price is required',
            'minPrice.numeric'=>'Enter a valid price'
        ]);
        if($validateData){
            $coupon=new Coupon();
            $coupon->coupon_code=$req->code;
            $coupon->discount=$req->discount;
            $coupon->min_product_price=$req->minPrice;
            if($coupon->save()){
                return back()->with('success','New coupon created successfully');
            }
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
        $coupon=Coupon::find($id);
        if($coupon->delete()){
            return back()->with('success','Coupon deleted successfully');
        }
    }
}
