@extends('admin.layouts.app')
@section('title') Error Page @stop
@section('content')
    <div id="wrapper">
        <!-- Navigation -->
        @include('admin.layouts.navbar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Error</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                @yield('section')
                <div class="alert alert-danger">You don't have permission</div>
            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@endsection
