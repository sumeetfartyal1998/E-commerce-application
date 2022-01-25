@extends('layouts.app')

@section('content')
@include('includes.header')
@include('includes.sidebar')
    <style>
        .w-5{
            display: none;
        }
    </style>
    <main class="content-wrapper" id="resultarea">
        <div class="content">
            @if(Session::has('success'))
                <div class="alert alert-success mt-2">{{Session::get('success')}}</div>
            @endif
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
                                <th class="col-3">Product Image</th>
                                <th class="col-2">Product Name</th>
                                <th class="col-3">Description</th>
                                <th class="">Price</th>
                                <th class="col-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $n=1
                            @endphp
                            @foreach($products as $product)
                            <tr>
                                <td>{{$n}}</td>
                                <td>
                                    <img src="{{asset('uploads/ProductImages/'.$product['product_main_image'])}}" alt="" width="40%">
                                    <a href="{{asset('/changeImage/'.$product['id'])}}" class="btn btn-light">Change</a>
                                </td>
                                <td>{{$product['title']}}</td>
                                <td>{{$product['desc']}}</td>
                                <td>₹{{$product['price']}}</td>
                                <td>
                                    <a href="{{route('products.edit',$product['id'])}}" class="btn btn-danger">Edit</a>
                                    <form action="{{route('products.destroy',$product['id'])}}" method="post" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-success">Delete</button>
                                    </form>
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
        </div>
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                {{$products->links()}}
            </ul>
        </div>
    </main>

    
    @include('includes.footer')
    @include('includes.foot')
    

@endsection