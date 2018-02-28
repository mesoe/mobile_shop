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
                <form method="post" action="{{route('postEditProduct')}}">
                    <input type="hidden" name="id" value="{{$pd->id}}">
                    <div class="form-group @if($errors->has('name')) has-error @endif">
                        @if($errors->has('name'))<span class="help-block">{{$errors->first('name')}}</span> @endif
                        <label for="name" class="control-label">Product Name</label>
                        <input type="text" value="{{$pd->name}}" name="name" class="form-control">
                    </div>
                    <div class="form-group @if($errors->has('buy_price')) has-error @endif">
                        @if($errors->has('buy_price'))<span class="help-block">{{$errors->first('name')}}</span> @endif
                        <label for="buy_price" class="control-label">Buy Price</label>
                        <input type="text" value="{{$pd->buy_price}}" name="buy_price" class="form-control">
                    </div>
                    <div class="form-group @if($errors->has('sale_price')) has-error @endif">
                        @if($errors->has('sale_price'))<span class="help-block">{{$errors->first('sale_price')}}</span> @endif
                        <label for="sale_price" class="control-label">Sale Price</label>
                        <input type="text" value="sale_price" name="sale_price" class="form-control">
                    </div>
                    <div class="form-group @if($errors->has('qty')) has-error @endif">
                        @if($errors->has('qty'))<span class="help-block">{{$errors->first('qty')}}</span> @endif
                        <label for="qty" class="control-label">Qty</label>
                        <input type="text" value="{{$pd->qty}}" name="qty" class="form-control">
                    </div>
                    <div class="form-group @if($errors->has('cat_id')) has-error @endif">
                        @if($errors->has('cat_id'))<span class="help-block">{{$errors->first('cat_id')}}</span> @endif
                        <lable for="cat_id" class="control-label">Category Name</lable>
                        <select name="cat_id" class="form-control">
                            <option value="">Select Category Name</option>
                            @foreach($cats as $cat)
                                <option value="{{$cat->id}}" @if($pd->cat_id==$cat->id) selected @endif>{{$cat->cat_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary form-control">Save Change</button>
                    </div>
                    {{csrf_field()}}
                </form>
            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@endsection
