@extends('layouts.app')
@section('content')
@include('includes.header')
@include('includes.sidebar')
    <main class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>EDIT PRODUCT DETAILS</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Product</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <section class="content">
            <form class="container-fluid" method="post" action="{{route('products.update',$product->id)}}">
                @method('PATCH') 
                @csrf()

                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Enter product details</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label>Title <span style="color: red;">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{$product->title}}">
                            @if($errors->has('title'))
                            <span style="color: red;" >
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label>Description <span style="color: red;">*</span></label>
                            <textarea name="desc" class="form-control @error('desc') is-invalid @enderror">{{$product->desc}}</textarea>
                            @if($errors->has('desc'))
                            <span style="color: red;" >
                                <strong>{{ $errors->first('desc') }}</strong>
                            </span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label>Price <span style="color: red;">*</span></label>
                            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" value="₹ {{$product->price}}">
                            @if($errors->has('price'))
                            <span style="color: red;" >
                                <strong>{{ $errors->first('price') }}</strong>
                            </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </section>
    </main>
@include('includes.footer')
@include('includes.foot')
@endsection