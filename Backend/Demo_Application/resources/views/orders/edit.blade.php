@extends('layouts.app')
@section('content')
@include('includes.header')
@include('includes.sidebar')
    <main class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>EDIT ORDER STATUS</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Update Status</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <section class="content">
            <form class="container-fluid" method="post" action="{{route('orders.update',$order->id)}}">
                @method('PATCH') 
                @csrf()

                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Enter Order details</h3>

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
                            <select name="status" class="form-control">
                                <option value="" disabled>Select Status</option>
                                <option value="PENDING" <?php if($order->order_status=='PENDING'){echo 'selected';}?> >PENDING</option>
                                <option value="DISPATCHED" <?php if($order->order_status=='DISPATCHED'){echo 'selected';}?> >DISPATCHED</option>
                                <option value="OUT FOR DELIVERY" <?php if($order->order_status=='OUT FOR DELIVERY'){echo 'selected';}?> >OUT FOR DELIVERY</option>
                                <option value="DELIVERED" <?php if($order->order_status=='DELIVERED'){echo 'selected';}?> >DELIVERED</option>
                            </select>
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit" name="sub">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
@include('includes.footer')
@include('includes.foot')
@endsection