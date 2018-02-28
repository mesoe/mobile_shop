@extends('admin.layouts.app')
@section('title') New Employee Page @stop
@section('content')
    <div id="wrapper">
        <!-- Navigation -->
        @include('admin.layouts.navbar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-plus-circle"></i>New Employee </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
               <div class="col-md-6">
                   <form class="form-horizontal" role="form" method="POST" action="{{route('register')}}">
                       <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                           <div class="col-md-12">
                               <label for="name" class="control-label">Username</label>

                               <input id="name" type="text" class="form-control" name="name"
                                      value="{{ old('name') }}" required autofocus>

                               @if ($errors->has('name'))
                                   <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                               @endif
                           </div>
                       </div>

                       <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                           <div class="col-md-12">
                               <label for="password" class="control-label">Password</label>

                               <input id="password" type="password" class="form-control" name="password" required>

                               @if ($errors->has('password'))
                                   <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                               @endif
                           </div>
                       </div>

                       <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                           <div class="col-md-12">
                               <label for="confirm_password" class="control-label">Password Again</label>

                               <input id="confirm_password" type="password" class="form-control" name="confirm_password" required>

                               @if ($errors->has('confirm_password'))
                                   <span class="help-block">
                                        <strong>{{ $errors->first('confirm_password') }}</strong>
                                    </span>
                               @endif
                           </div>
                       </div>

                       <div class="form-group{{ $errors->has('user_role') ? ' has-error' : '' }}">
                           <div class="col-md-12">
                               <label for="user_role" class="control-label">User Role</label>
                               <select name="user_role" class="form-control">
                                   <option value="">Select User Role</option>
                                   @foreach($roles as $role)
                                       <option>{{$role->name}}</option>
                                   @endforeach
                               </select>
                               @if ($errors->has('user_role'))
                                   <span class="help-block">
                                        <strong>{{ $errors->first('user_role') }}</strong>
                                    </span>
                               @endif
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="col-md-12 text-center">
                               <button type="submit" class="btn btn-primary btn-success btn-block">
                                   Register
                               </button>

                           </div>
                       </div>
                       {{csrf_field()}}
                   </form>

               </div>
            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@endsection


