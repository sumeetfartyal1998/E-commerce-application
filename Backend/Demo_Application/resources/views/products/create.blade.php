@extends('layouts.app')
@section('content')
@include('includes.header')
@include('includes.sidebar')
    <main class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>ADD PRODUCT</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Forms</a></li>
                            <li class="breadcrumb-item active">Add Product</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <section class="content">
            <form class="container-fluid" method="post" action="{{route('products.store')}}" enctype="multipart/form-data">
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
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Title <span style="color: red;">*</span></label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror">
                                    @if($errors->has('title'))
                                    <span style="color: red;" >
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label>Description <span style="color: red;">(optional)</span></label>
                                    <textarea name="desc" class="form-control @error('desc') is-invalid @enderror"></textarea>
                                    @if($errors->has('desc'))
                                    <span style="color: red;" >
                                        <strong>{{ $errors->first('desc') }}</strong>
                                    </span>
                                    @endif
                                </div>
                               
                                <div class="form-group">
                                    <label>Price <span style="color: red;">*</span></label>
                                    <input type="text" name="price" class="form-control @error('price') is-invalid @enderror">
                                    @if($errors->has('price'))
                                    <span style="color: red;" >
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="" >Select Category <span style="color: red;">*</span></label>
                                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" id="category">
                                        <option value="" disabled selected><b>--Select a category--</b></option>
                                        @foreach($categories as $cat)
                                        <option value="{{$cat->id}}">{{$cat->title}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('category_id'))
                                    <span style="color: red;" >
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="">Select sub category <span style="color: red;">*</span></label>
                                    <select name="sub_category_id" class="form-control" id="subCategory">
                                        <option value="" disabled selected>Select the category first</option>
                                    </select>
                                    @if($errors->has('sub_category_id'))
                                    <span style="color: red;" >
                                        <strong>{{ $errors->first('sub_category_id') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Upload Product Main image<span style="color: red;">*</span></label>
                                    <input type="file" class="form-control-file" name="main_image" id="exampleFormControlFile1">
                                    @if($errors->has('main_image'))
                                    <span style="color: red;" >
                                        <strong>{{ $errors->first('main_image') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Upload Product images <span style="color: red;">*</span></label>
                                    <input type="file" class="form-control-file" name="image[]" id="exampleFormControlFile1" multiple>
                                    @if($errors->has('image'))
                                    <span style="color: red;" >
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif
                                    @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                    @endforeach
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
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
<script>
    $(document).ready(function(){
        $("#category").on("change",function(){
            var catId=$(this).val()
            $.ajax({
                url:'/getSubCategories',
                type:'post',
                data:{_token:'{{csrf_token()}}',catId:catId},
                success:function(result){
                    if(result!="Error"){
                        $('#subCategory').html(result)
                    }else{
                        alert('No sub category found for this particular category! You need to add a sub category first.')
                    }
                }
            })
        })
    })
</script>
@endsection