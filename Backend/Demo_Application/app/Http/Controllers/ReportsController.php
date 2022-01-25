<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function reports(){
        $orders=Order::all();
        $orderedProducts=OrderedProduct::all();
        $users=User::all();
        $ordersPending=0;
        $ordersDelivered=0;
        $ordersOutForDelivery=0;
        $ordersDispatched=0;
        $totalOrders=0;
        $totalAmount=0;
        $totalOrderedProducts=0;
        $totalUsers=0;
        foreach($orders as $order){
            if($order->order_status=='PENDING'){
                $ordersPending+=1;
            }
            if($order->order_status=='DELIVERED'){
                $ordersDelivered+=1;
            }
            if($order->order_status=='OUT FOR DELIVERY'){
                $ordersOutForDelivery+=1;
            }
            if($order->order_status=='DISPATCHED'){
                $ordersDispatched+=1;
            }
            $totalOrders+=1;
            $totalAmount+=$order->total_amount;
        }
        foreach($orderedProducts as $orderedProduct){
            $totalOrderedProducts+=1;
        }
        foreach($users as $user){
            $totalUsers+=1;
        }
        return view('/reports',compact('ordersPending','ordersDelivered','ordersOutForDelivery','ordersDispatched','totalOrders','totalAmount','totalOrderedProducts','totalUsers'));
    }
}
