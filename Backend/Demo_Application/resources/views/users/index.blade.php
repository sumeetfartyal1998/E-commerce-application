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
            <h3 class="card-title">Users</h3>
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
                
            <table class="table" id="example1">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Email id</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th colspan="2" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                    $n=1
                    @endphp
                    @foreach($users as $user)
                    <tr>
                        <td>{{$n}}</td>
                        <td>{{$user->fname}}</td>
                        <td>{{$user->lname}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role}}</td>
                        <td>{{$user->status}}</td>
                        <td >
                        <a href="{{route('user.edit',$user->id)}}" class="btn btn-info">Edit</a></td>
                        <td>
                        <form action="{{ route('user.destroy', $user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')" >Delete</button>
                        </form>
                        </td>
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
        <a href="{{route('user.create')}}" class="btn btn-success">Add User</a>
        </div>
    </div>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
     $(function () {
            $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
</script>
@include('includes.footer')
@include('includes.foot')


@endsection