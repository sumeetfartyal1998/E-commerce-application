<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\Product;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
            'products'=>'required',
            'payment_mode'=>'required',
            'order_status'=>'required'
        );
        $errMsg=array(
            'user_id.required'=>'User id is required.',
            'address_id.required'=>'Address id is required.',
            'total_amount.required'=>'Total amount is required.',
            'products.required'=>'Product is required.',
            'payment_mode.required'=>'Payment mode is required.',
        );
        $validator=Validator::make($req->all(),$rules,$errMsg);
        if($validator->fails()){
            return response()->json($validator->errors());
        }else{
            $order=new Order();
            $order->user_id=$req->user_id;
            $order->address_id=$req->address_id;
            $order->coupon_id=$req->coupon_id;
            $order->payment_mode=$req->payment_mode;
            $order->total_amount=$req->total_amount;
            $order->order_status=$req->order_status;
            if($order->save()){
                $order=Order::latest()->first();
                $order_id=$order->id;
                $allOrders="";
                // $req->products;
                for($i=0;$i<count($req->products);$i++){
                    $orderedProduct=new OrderedProduct();
                    $orderedProduct->order_id=$order_id;
                    $orderedProduct->product_id=$req->products[$i]['product']['id'];
                    $orderedProduct->quantity=$req->products[$i]['quantity'];
                    $orderedProduct->save();
                    $product=Product::find($req->products[$i]['product']['id'])->first();
                    $allOrders.=$product->title.","." ";
                }
                $allOrders=rtrim($allOrders,", ");
                $user=User::find($req->user_id);
                $userEmail=$user->email;
                $data=['allOrders'=>$allOrders];
                $user['to']=$userEmail;
                Mail::send('mail.orderPlaced',$data,function($message) use ($user){
                    $message->to($user['to']);
                    $message->subject('Order Confirmation');
                });

                $settings=Settings::find(1);
                $orderPlaced=$settings->orderPlaced;
                if($orderPlaced){
                    $data2=['allOrders'=>$allOrders,'userEmail'=>$userEmail];
                    $admin['to']='sammyfartyal1106@gmail.com';
                    Mail::send('mail.orderPlaced',$data2,function($message) use ($admin){
                        $message->to($admin['to']);
                        $message->subject('Order Confirmation');
                    });
                }
                return response()->json(["result"=>"Ordered Successfully"]);
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
