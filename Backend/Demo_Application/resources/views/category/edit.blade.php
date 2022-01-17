@extends('layouts.app')
@section('content')
@include('includes.header')
@include('includes.sidebar')
    <main class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>EDIT CATEGORY</h1>
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
            <form class="container-fluid" method="post" action="{{route('category.update',$category->id)}}">
                @method('PATCH') 
                @csrf()

                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Enter category details</h3>

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
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" value="{{$category->title}}">
                                </div>
                                @if($errors->has('title'))
                                    <div class="alert alert-danger">{{$errors->first('title')}}</div>
                                @endif
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="desc" class="form-control">{{$category->desc}}</textarea>
                                </div>
                                @if($errors->has('desc'))
                                    <div class="alert alert-danger">{{$errors->first('desc')}}</div>
                                @endif
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