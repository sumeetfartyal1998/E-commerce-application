@extends('layouts.app')
@section('content')
@include('includes.header')
@include('includes.sidebar')

<main class="content-wrapper" id="resultarea">
    <div class="content">
        @if(Session::has('success'))
            <div class="alert alert-success mt-2">{{Session::get('success')}}</div>
        @endif
    <div class="card mt-2">
            <div class="card-header">
            <h3 class="card-title">Categories</h3>
            <div class="card-tools">
                <ul class="pagination pagination-sm float-right">
                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Category name</th>
                        <th>Description</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @php 
                    $n=1
                    @endphp
                    @foreach($category as $c)
                    <tr>
                        <td>{{$n}}</td>
                        <td>{{$c->title}}</td>
                        <td>{{$c->desc}}</td>
                        <td class="row"><a href="{{route('category.show',$c->id)}}" class="btn btn-light">View</a>
                        <a href="{{route('category.edit',$c->id)}}" class="btn btn-info">Edit</a>
                        <form action="{{ route('category.destroy', $c->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')" >Delete</button>
                        </form>
                    </tr>
                    @php 
                    $n++
                    @endphp
                    @endforeach
                </tbody>
            </table>
            
            </div>
            <!-- /.card-body -->
            
        </div>
        <div class="d-flex justify-content-center">
        <a href="{{route('category.create')}}" class="btn btn-success">Add New Category</a>
        </div>
    </div>
</main>

@include('includes.footer')
@include('includes.foot')
@endsection