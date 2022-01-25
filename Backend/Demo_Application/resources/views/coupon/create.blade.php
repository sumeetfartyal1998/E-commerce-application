@extends('layouts.app')

@section('content')
@include('includes.header')
@include('includes.sidebar')
    
    <main class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>ADD COUPON</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Forms</a></li>
                            <li class="breadcrumb-item active">Add Coupon</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <section class="content">
            <form class="container-fluid" method="post" action="{{ route('coupons.store')}}">
                @csrf()

                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Enter coupon details</h3>

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
                        <div >
                            <div class="form-group">
                                <label>Coupon Code <span style="color: red;">*</span></label>
                                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror">
                                @if($errors->has('code'))
                                    <span style="color: red;" >
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Discount <span style="color: red;">*</span></label>
                                <input type="text" name="discount" class="form-control @error('discount') is-invalid @enderror">
                                @if($errors->has('discount'))
                                    <span style="color: red;" >
                                        <strong>{{ $errors->first('discount') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Minimum product price <span style="color: red;">*</span></label>
                                <input type="text" name="minPrice" class="form-control @error('minPrice') is-invalid @enderror">
                                @if($errors->has('minPrice'))
                                    <span style="color: red;" >
                                        <strong>{{ $errors->first('minPrice') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div>
                            <button class="btn btn-primary" type="submit" name="sub">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
      
@include('includes.footer')
@include('includes.foot')
@endsection