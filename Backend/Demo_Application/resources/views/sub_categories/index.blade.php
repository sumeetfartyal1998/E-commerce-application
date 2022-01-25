@extends('layouts.app')
@section('content')
@include('includes.header')
@include('includes.sidebar')

<main class="content-wrapper">
    <div class="content">
        @if(Session::has('success'))
            <div class="alert alert-success mt-2">{{Session::get('success')}}</div>
        @endif
        <div class="card mt-2">
            <div class="card-header">
            <h3 class="card-title">Sub Categories</h3>
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
                        <th>Sub category name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                    $n=1
                    @endphp
                    
                    @foreach($subcategories as $s)
                    <tr>
                        <td>{{$n}}</td>
                        <td>{{$s->title}}</td>
                        <td>
                            @if($s->desc=='')
                            -
                            @else
                            {{$s->desc}}
                            @endif
                        </td>
                        <td class="row"><a class="btn btn-light">View</a>
                        <a href="{{route('sub_categories.edit',$s->id)}}" class="btn btn-info">Edit</a>
                        <form action="{{ route('sub_categories.destroy', $s->id)}}" method="post">
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
            <a href="{{route('sub_categories.create')}}" class="btn btn-success">Add New Sub Category</a>
        </div>
    </div>
</main>

@include('includes.footer')
@include('includes.foot')
@endsection