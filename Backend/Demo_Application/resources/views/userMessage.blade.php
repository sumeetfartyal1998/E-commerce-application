@extends('layouts.app')
@section('content')
@include('includes.header')
@include('includes.sidebar')
    <main class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>MESSAGE FROM USER</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">User Messages</a></li>
                            <li class="breadcrumb-item active">Message</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="form-group">
            <textarea disabled rows="6" class="form-control">{{$contactUs->message}}</textarea>
            </div>
            <hr>
            @if(Session::has('success'))
                <div class="alert alert-success mt-3">{{Session::get('success')}}</div>
            @endif
            <div  class="row mt-3">
            
                <div class="col-1">
                    <button class="btn btn-success replyBtn">Reply</button>
                </div>
                <form method="post" class="col-11" id="textbox" action="{{route('sendMessage')}}">
                    @csrf()
                    <input type="hidden" value="{{$contactUs->email}}" name="email">
                    <textarea class="form-control" id="" rows="6" name="message"></textarea>
                    <button type="submit" name="sub" class="btn btn-danger">Send</button>
                </div>
            </div>
        </section>
    </main>
@include('includes.footer')
@include('includes.foot')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#textbox").hide()
        $(".replyBtn").click(function(){
            $("#textbox").show()
        })
    })
</script>
@endsection