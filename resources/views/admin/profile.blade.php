@extends('admin.layouts.app')
@section('title') Dashboard Page @stop
@section('content')
    <div id="wrapper">
        <!-- Navigation -->
        @include('admin.layouts.navbar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-user"></i> User Profile</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                @yield('section')
                <div class="text-center">
                    <img src="{{route('userImage',['file_name'=>$user->name])}}" class="img-thumbnail" style="height: 200px">
                </div>
            </div>
            <div class="row">
                <div class="text-center col-md-4 col-md-offset-4">
                    <div class="form-group @if($errors->has('user_image')) has-error @endif">
                        @if($errors->has('user_image'))<span class="help-block">{{$errors->first('user_image')}}</span> @endif
                        <label for="user_image" class="control-label">Select User Image</label>
                    <form method="post" action="{{route('imageUpload')}}" enctype="multipart/form-data">
                        <input type="file" name="user_image" id="user_image" class="form-control">
                        <button type="submit" class="btn-primary btn-block">Upload</button>
                        {{csrf_field()}}
                    </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <ul class="list-group">
                    <li class="list-group-item"><i class="fa fa-user"></i> User Name : {{$user->name}}</li>
                    <li class="list-group-item"><i class="fa fa-user"></i> User Role : @if(Auth::User()->hasRole('Admin'))Admin @else Employee @endif </li>
                    <li class="list-group-item"><i class="fa fa-clock-o">Created Date : {{date('d-m-Y h:i A',strtotime('created_at'))}}</i> </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
