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
            <h3 class="card-title">Categories</h3>
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
                        <th>Coupon code</th>
                        <th>Discount</th>
                        <th>Minimum product price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                    $n=1
                    @endphp
                    @foreach($coupons as $coupon)
                    <tr>
                        <td>{{$n}}</td>
                        <td>{{$coupon->coupon_code}}</td>
                        <td>{{$coupon->discount}}</td>
                        <td>{{$coupon->min_product_price}}</td>
                        <td>
                        <form action="{{ route('coupons.destroy', $coupon->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this coupon ?')" >Delete</button>
                        </form></td>
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
        <a href="{{route('coupons.create')}}" class="btn btn-success">Add New Coupon</a>
        </div>
    </div>
</main>

@include('includes.footer')
@include('includes.foot')
@endsection