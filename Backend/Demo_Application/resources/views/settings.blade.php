@extends('layouts.app')

@section('content')
@include('includes.header')
@include('includes.sidebar')
    
    <main class="content-wrapper" id="resultarea">
        <form class="content" method="post" action="{{route('settings.update',1)}}">
            @method('PATCH')
            @csrf()
            @if(Session::has('success'))
                <div class="alert alert-success mt-2">{{Session::get('success')}}</div>
            @endif
            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-cog"></i><b> Settings</b></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group">
                        <input class="" type="checkbox" id="flexSwitchCheckChecked" <?php if($settings->userRegistered){echo "checked";}?> name="userRegistered">
                        <label for="">Get notification when user registers</label>
                    </div>
                    <div class="form-group">
                        <input class="" type="checkbox" id="flexSwitchCheckChecked" <?php if($settings->orderPlaced){echo "checked";}?> name="orderPlaced">
                        <label for="">Get notification when customer order's a product</label>
                    </div>
                    <div class="form-group">
                        <input class="" type="checkbox" id="flexSwitchCheckChecked" <?php if($settings->contactUs){echo "checked";}?> name="contactUs">
                        <label for="">Get notification when customer submits the contact us page</label>
                    </div>
                    <button type="submit" class="btn btn-success">Save Changes</button>

                </div>
                <!-- /.card-body -->
            </div>
        </form>
    </main>

    
    @include('includes.footer')
    @include('includes.foot')
    

@endsection