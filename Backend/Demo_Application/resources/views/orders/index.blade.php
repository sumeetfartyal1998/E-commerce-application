@extends('layouts.app')
@section('content')
@include('includes.header')
@include('includes.sidebar')

<main class="content-wrapper" id="resultarea">
    <div class="content">
        @if(Session::has('success'))
            <div class="alert alert-success mt-2">{{Session::get('success')}}</div>
        @endif
        <div class="card mt-2">
            <div class="card-header">
            <h3 class="card-title">Orders</h3>
            <div class="card-tools">
                <ul class="pagination pagination-sm float-right">
                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Coupon</th>
                        <th>Total Amount</th>
                        <th>Payment Mode</th>
                        <th>Ordered Products</th>
                        <th>Order Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                    $n=1
                    @endphp
                    @foreach($orders as $order)
                    <tr>
                        <td>{{$n}}</td>
                        @foreach($users as $user)
                        @if($user->id==$order->user_id)
                        <td>{{$user->fname}} {{$user->lname}}</td>
                        <td>{{$user->email}}</td>
                        @endif
                        @endforeach
                       
                        @foreach($coupons as $coupon)
                        @if($coupon->id==$order->coupon_id)
                        <td>{{$coupon->coupon_code}}</td>
                        @else
                        <td><i class="fas fa-minus"></i></td>
                        @endif
                        @endforeach

                        <td>₹{{$order->total_amount}}</td>
                        <td>{{$order->payment_mode}}</td>
                        <td>
                            <a href="{{route('orders.show',$order->id)}}"><button class="btn btn-light">Details</button></a>
                        </td>
                        <td>{{$order->order_status}}</td>
                        <td>
                            <a href="{{route('orders.edit',$order->id)}}" class="btn btn-danger">Update</a>
                        </td>
                    </tr>
                    @php 
                    $n++
                    @endphp
                    @endforeach
                </tbody>
            </table>
            
            </div>
            <!-- /.card-body -->
            
        </div>
        <div class="d-flex justify-content-center">
        <!-- <a href="{{route('category.create')}}" class="btn btn-success">Add New Category</a> -->
        </div>
    </div>
</main>

@include('includes.footer')
@include('includes.foot')
@endsection