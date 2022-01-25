@extends('layouts.app')
@section('content')
@include('includes.header')
@include('includes.sidebar')
    <main class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>EDIT USER</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add Banner</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <section class="content">
            <form class="container-fluid" method="post" action="{{route('user.update',$user->id)}}">
                @method('PATCH') 
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
                        <div class="">
                            <div class="">
                                <div class="form-group">
                                    <label>First name</label>
                                    <input type="text" name="fname" class="form-control @error('fname') is-invalid @enderror" value="{{$user->fname}}">
                                    @if($errors->has('fname'))
                                        <span style="color: red;" >
                                            <strong>{{ $errors->first('fname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>Last name</label>
                                    <input type="text" name="lname" class="form-control @error('lname') is-invalid @enderror" value="{{$user->lname}}">
                                    @if($errors->has('lname'))
                                        <span style="color: red;" >
                                            <strong>{{ $errors->first('lname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                

                                <div class="form-group">
                                    <label for="">Role</label>
                                    <select name="role" id="" class="form-control">
                                        <option value="" disabled>--SELECT AN OPTION--</option>
                                        @foreach($role as $r)
                                        <option value="{{$r->role_name}}" <?php if($r->role_name==$user->role){ echo 'selected';}?>>{{$r->role_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                               

                                <div class="form-group">
                                    <label>Status</label>
                                    <div class="custom-control custom-radio ml-3">
                                        <input class="custom-control-input" type="radio" id="customRadio2" name="status" value="1" <?php if($user->status==1){echo "checked";} ?>>
                                        <label for="customRadio2" class="custom-control-label">Active</label>
                                    </div>
                                    <div class="custom-control custom-radio ml-3">
                                        <input class="custom-control-input" type="radio" id="customRadio1" name="status" value="0" <?php if($user->status==0){echo "checked";} ?>>
                                        <label for="customRadio1" class="custom-control-label">Inactive</label>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- /.col -->
                            
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