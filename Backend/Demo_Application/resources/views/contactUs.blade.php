@extends('layouts.app')

@section('content')
@include('includes.header')
@include('includes.sidebar')

<main class="content-wrapper">
    <div class="content">
        <div class="card mt-2">
            <div class="card-header">
            <h3 class="card-title">Simple Full Width Table</h3>

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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact No</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                    $n=1
                    @endphp
                    @foreach($data as $d)
                    <tr>
                        <td>{{$n}}</td>
                        <td>{{$d->name}}</td>
                        <td>{{$d->email}}</td>
                        <td>{{$d->contact}}</td>
                        <td><a href="/userMessage/{{$d->id}}" class="btn btn-info">View</a></td>
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
    </div>
</main>

@include('includes.footer')
@include('includes.foot')
@endsection