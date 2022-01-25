@extends('layouts.app')

@section('content')
@include('includes.header')
@include('includes.sidebar')
    
    <main class="content-wrapper" id="resultarea">
        <form class="content">
            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-poll"></i> <b> &nbsp;Sales Reports</b></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- <h3>Sales Report :</h3> -->
                    <div class="row  mt-3">

                        <div class="col-lg-3 col-6">
                            <!-- small card -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{$ordersPending}}</h3>

                                    <p>Pending Orders </p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <!-- small card -->
                            <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{$ordersDispatched}}</h3>

                                <p>Dispatched</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-truck-loading"></i>
                            </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <!-- small card -->
                            <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$ordersOutForDelivery}}</h3>

                                <p>Out For Delivery</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-6">
                            <!-- small card -->
                            <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{$ordersDelivered}}</h3>

                                <p>Delivered</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <!-- small card -->
                            <div class="info-box bg-gradient-success">
                                <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Total Products Ordered</span>
                    
                                    <span class="progress-description">
                                    {{$totalOrderedProducts}} products has been ordered
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <!-- small card -->
                            <div class="info-box bg-gradient-primary">
                                <span class="info-box-icon"><i class="fas fa-wallet"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Total Amount Earned</span>
                    
                                    <span class="progress-description">
                                    ₹ {{$totalAmount}}
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users"></i><b> &nbsp;Registered Users</b></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row  mt-3">
                        <div class="col-lg-3 col-6">
                        <!-- small card -->
                            <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{$totalUsers}}</h3>

                                <p>User Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </form>
    </main>

    
    @include('includes.footer')
    @include('includes.foot')
    

@endsection