@extends('layouts.app')

@section('content')
@include('includes.header')
@include('includes.sidebar')
    
    <main class="content-wrapper" id="resultarea">
        <div class="content">
            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Ordered Products</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th class="col-6">Product Image</th>
                                <th class="col-3">Product Name</th>
                                <th class="2">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $n=1
                            @endphp
                            @foreach($products as $product)
                            <tr>
                                <td>{{$n}}</td>
                                <td><img src="{{asset('uploads/ProductImages/'.$product['product_main_image'])}}" alt="" width="20%"></td>
                                <td>{{$product['title']}}</td>
                                @foreach($orderedProducts as $prod)
                                @if($prod['product_id']==$product['id'])
                                <td>{{$prod['quantity']}}</td>
                                @endif
                                @endforeach
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
        </div>
        <div class="content">
            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Delivery Address Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Full Name</th>
                                <th>Mobile</th>
                                <th>Building</th>
                                <th>Area</th>
                                <th>Landmark</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Pincode</th>
                                <th>Address Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $n=1
                            @endphp
                            <tr>
                                <td>{{$n}}</td>
                                <td>{{$address['fullname']}}</td>
                                <td>{{$address['mobile']}}</td>
                                <td>{{$address['building']}}</td>
                                <td>
                                    @if($address['area']!="")
                                    {{$address['area']}}
                                    @else
                                    <i class="fas fa-minus"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($address['landmark']!="")
                                    {{$address['landmark']}}
                                    @else
                                    <i class="fas fa-minus"></i>
                                    @endif
                                </td>
                                <td>{{$address['state']}}</td>
                                <td>{{$address['city']}}</td>
                                <td>{{$address['pincode']}}</td>
                                <td>{{$address['address_type']}}</td>
                            </tr>
                            @php
                            $n++
                            @endphp
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        
    </main>
    @include('includes.footer')
        @include('includes.foot')
    

@endsection