@extends('layouts.app')
@section('content')
@include('includes.header')
@include('includes.sidebar')
    <main class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>EDIT SUB CATEGORY</h1>
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
            <form class="container-fluid" method="post" action="{{route('sub_categories.update',$subcategory->id)}}">
                @method('PATCH') 
                @csrf()

                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Enter sub category details</h3>

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
                                    <label>Title <span style="color: red;">*</span></label>
                                    <input type="text" name="title" class="form-control" value="{{$subcategory->title}}">
                                    @if($errors->has('title'))
                                    <span style="color: red;" >
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Category name <span style="color: red;">*</span></label>
                                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                        <option value="" disabled >Select Category</option>
                                        @foreach($categories as $cat)
                                        <option value="{{$cat->id}}" <?php if($cat->id==$subcategory->id){echo 'selected';}?>>{{$cat->title}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('category_id'))
                                    <span style="color: red;" >
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Description <span style="color: red;">(optional)</span></label>
                                    <textarea name="desc" class="form-control">{{$subcategory->desc}}</textarea>
                                    @if($errors->has('desc'))
                                    <span style="color: red;" >
                                        <strong>{{ $errors->first('desc') }}</strong>
                                    </span>
                                    @endif
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