@extends('admin.layouts.app')
@section('title') Category Page @stop
@section('content')
    <div id="wrapper">
        <!-- Navigation -->
        @include('admin.layouts.navbar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-list"></i> Categories</h1>
                    <div class="pull-right">
                        <a href="#" data-toggle="modal" data-target="#myCat" class="fa fa-plus-circle">New Category</a>
                    </div>
                    <table class="table">
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Delete</td>
                        </tr>
                        @foreach($cats as $cat)
                            <tr>
                                <td>{{$cat->id}}</td>
                                <td>{{$cat->cat_name}}</td>
                                <td><a href="{{route('delCategory',['id'=>$cat->id])}}" class="text-danger"><i class="fa fa-trash"></i> </a> </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="row">
                @yield('section')
            </div>

        </div>
    </div>

    <!-- New Category Modal -->
    <div class="modal fade" id="myCat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div id="showInfo"></div>
            <form>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">New Category</h4>
                </div>
                <input type="hidden" id="_token" value="{{csrf_token()}}">
                <div class="modal-body">
                    <label for="cat_name" class="control-label">New Category</label>
                    <div class="form-group">
                        <input type="text" name="cat_name" id="cat_name" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="btnNewCategory" class="btn btn-primary">Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>


@endsection
