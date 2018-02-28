@extends('admin.layouts.app')
@section('title') Dashboard Page @stop
@section('content')
    <div id="wrapper">
        <!-- Navigation -->
        @include('admin.layouts.navbar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-dashboard"></i> Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">

            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@endsection
