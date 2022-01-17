<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderedProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class APICheckoutController extends Controller
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
        $rules=array(
            'user_id'=>'required',
            'address_id'=>'required',
            'total_amount'=>'required',
            'product'=>'required'
        );
        $errMsg=array(
            'user_id.required'=>'User id is required.',
            'address_id.required'=>'Address id is required.',
            'total_amount.required'=>'Total amount is required.',
            'product.required'=>'Product is required.',
        );
        $validator=Validator::make($req->all(),$rules,$errMsg);
        if($validator->fails()){
            return response()->json($validator->errors());
        }else{
            $order=new Order();
            $order->user_id=$req->user_id;
            $order->address_id=$req->address_id;
            $order->coupon_id=$req->coupon_id;
            $order->total_amount;
            if($order->save()){
                foreach($req->product as $product){
                    $orderedProduct=new OrderedProduct();
                    
                }
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
        //
    }
}
