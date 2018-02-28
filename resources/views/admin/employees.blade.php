@extends('admin.layouts.app')
@section('title') Employees Page @stop
@section('content')
    <div id="wrapper">
        <!-- Navigation -->
        @include('admin.layouts.navbar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-users"></i> Employees</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                    <tr>
                        <td>User ID</td>
                        <td>User Name</td>
                        <td>User Role</td>
                        <td>Created Date</td>
                        <td>Edit</td>
                        <td>Delete</td>
                        <td>Change Password</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>@if($user->hasRole('Admin')) Admin @else Employee @endif</td>
                        <td>{{$user->created_at}}</td>
                        <td><a href="#" data-toggle="modal" data-target="#e{{$user->id}}"><i class="fa fa-edit"></i> </a> </td>
                        <!-- Edit User Role -->
                        <div class="modal fade" id="e{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <form method="post" action="{{route('updateUserRole')}}">
                                <div class="modal-content">
                                    <input type="hidden" name="id" id="id" value="{{$user->id}}">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Edit User Role | {{$user->name}} (@if($user->hasRole('Admin')))Admin @else Employee @endif</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <lable for="name" class="control-label">User Name</lable>
                                            <input type="text" name="name" disabled value="{{$user->name}}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_role" class="control-label"></label>
                                                <select name="user_role" class="form-control">
                                                    @foreach($roles as $role)
                                                        <option>{{$role->name}}</option>
                                                        @endforeach
                                                </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                                    {{csrf_field()}}
                                </form>
                            </div>
                        </div>


                        <td><a href="#" data-toggle="modal" data-target="#d{{$user->id}}" class="text-danger"><i class="fa fa-trash"></i> </a> </td>
                        <!-- Remove User Modal -->
                        <div class="modal fade" id="d{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <form method="post" action="{{route('removeUser')}}">
                                    <input type="hidden" id="id" name="id" value="{{$user->id}}">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Delete User Account</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-warning"><i class="fa fa-warning"></i> Are u sure want to delete user account <strong> {{$user->name}}</strong> </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-primary">Yes</button>
                                    </div>
                                </div>
                                    {{csrf_field()}}
                                </form>
                            </div>
                        </div>

                        <td><a href="#" data-toggle="modal" data-target="#p{{$user->id}}" class="fa fa-lock"></a> </td>
                        <div class="modal fade" id="p{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Are you sure you want to change password <strong>{{$user->name}}</strong></h4>
                                    </div>
                                    <form method="post" action="{{route('changePassword')}}">
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="{{$user->id}}">
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control" placeholder="New Password">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="confirm_password" class="form-control" placeholder="New Password Again">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </div>
                                        {{csrf_field()}}
                                    </form>
                                </div>
                            </div>
                        </div>


                    </tr>
                    </tbody>
                        @endforeach
                </table>
            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@endsection
