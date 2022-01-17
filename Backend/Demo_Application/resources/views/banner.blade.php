@extends('layouts.app')

@section('content')
@include('includes.header')
@include('includes.sidebar')
    
    <main class="content-wrapper" id="resultarea">
        <div class="content">
            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Bordered Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th class="col-2">Title</th>
                                <th class="col-3">Description</th>
                                <th class="col-5">Image</th>
                                <th class="col-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $n=1
                            @endphp
                            @foreach($banner as $b)
                            <tr>
                                <td>{{$n}}</td>
                                <td>{{$b['title']}}</td>
                                <td>{{$b['desc']}}</td>
                                <td><img src="{{asset('uploads/banner/'.$b['img'])}}" alt="" width="30%"></td>
                                <td><a href="/editbanner/{{$b['id']}}" class="btn btn-info">Edit</a>
                                <a href="javascript:void(0)" aid="{{$b['id']}}" class="btn btn-danger delbtn">Delete</a></td>
                            </tr>
                            @php
                            $n++
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
      
    <section>
        @include('includes.footer')
        @include('includes.foot')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $(".delbtn").click(function(){
                    if(confirm('Are you sure you want to delete this banner?')){
                        var id = $(this).attr("aid");
                        $.ajax({
                            url:"{{url('delbanner')}}",
                            type:'delete',
                            data:{_token:'{{csrf_token()}}',id:id},
                            success:function(response){
                                $("#resultarea").load(document.URL +' #resultarea')
                                console.log(response)
                            }
                        })
                    }
                })
            })
        </script>
    </section>

@endsection