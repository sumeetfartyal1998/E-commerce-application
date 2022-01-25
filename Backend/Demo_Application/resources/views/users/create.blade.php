@extends('layouts.app')

@section('content')
@include('includes.header')
@include('includes.sidebar')
    
    <main class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>ADD USER</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Advanced Form</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <section class="content">
            <form class="container-fluid" method="post" action="{{ route('user.store')}}">
                @csrf()

                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Enter user details</h3>

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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="fname" class="form-control @error('fname') is-invalid @enderror">
                                    @if($errors->has('fname'))
                                        <span style="color: red;" >
                                            <strong>{{ $errors->first('fname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="lname" class="form-control @error('lname') is-invalid @enderror">
                                    @if($errors->has('lname'))
                                        <span style="color: red;" >
                                            <strong>{{ $errors->first('lname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Email id</label>
                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror">
                                    @if($errors->has('email'))
                                        <span style="color: red;" >
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="">Role</label>
                                    <select name="role" id="" class="form-control">
                                        <option value="" disabled>--SELECT AN OPTION--</option>
                                        @foreach($role as $r)
                                        <option value="{{$r->role_name}}" <?php if($r->role_name=='Customer'){ echo 'selected';}?>>{{$r->role_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="pass" class="form-control @error('pass') is-invalid @enderror">
                                    @if($errors->has('pass'))
                                        <span style="color: red;" >
                                            <strong>{{ $errors->first('pass') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="cpass" class="form-control @error('cpass') is-invalid @enderror">
                                    @if($errors->has('cpass'))
                                        <span style="color: red;" >
                                            <strong>{{ $errors->first('cpass') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <div class="custom-control custom-radio ml-3">
                                        <input class="custom-control-input" type="radio" id="customRadio2" name="status" value="1" checked>
                                        <label for="customRadio2" class="custom-control-label">Active</label>
                                    </div>
                                    <div class="custom-control custom-radio ml-3">
                                        <input class="custom-control-input" type="radio" id="customRadio1" name="status" value="0">
                                        <label for="customRadio1" class="custom-control-label">Inactive</label>
                                    </div>
                                </div>                            
                                <!-- /.form-group -->
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