@extends('layouts.app')
@section('content')
@include('includes.header')
@include('includes.sidebar')
    <main class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Contact Info</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Contact Info</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <section class="content">
            <form class="container-fluid" method="post" enctype="multipart/form-data">
                @csrf()

                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Enter your contact details and address</h3>

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
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Title of your website</label>
                                    <input type="text" name="title" class="form-control" value="{{$contactInfo['website_title']}}">
                                </div>
                                <div class="form-group">
                                    <label for="">Flat, Area, Colony, Street</label>
                                    <textarea type="text" name="area" class="form-control">{{$contactInfo['area']}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Country</label>
                                    <input type="text" name="country" class="form-control" value="{{$contactInfo['country']}}">
                                </div>
                                <div class="form-group">
                                    <label for="">State</label>
                                    <input type="text" name="state" class="form-control" value="{{$contactInfo['state']}}">
                                </div>
                                <button class="btn btn-primary" type="submit" name="sub">Submit</button>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">City</label>
                                    <input type="text" name="city" class="form-control" value="{{$contactInfo['city']}}">
                                </div>
                                <div class="form-group">
                                    <label for="">Pin Code</label>
                                    <input type="text" name="pincode" class="form-control" value="{{$contactInfo['pincode']}}">
                                </div>
                                <div class="form-group">
                                    <label for="">Mobile:</label>
                                    <input type="text" name="mobile" class="form-control" value="{{$contactInfo['mobile']}}">
                                </div>
                                <div class="form-group">
                                    <label for="">Email:</label>
                                    <input type="text" name="email" class="form-control" value="{{$contactInfo['email']}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
@include('includes.footer')
@include('includes.foot')
@endsection