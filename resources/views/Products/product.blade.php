@extends('admin.layouts.app')
@section('title') Product Page @stop
@section('content')
    <div id="wrapper">
        <!-- Navigation -->
        @include('admin.layouts.navbar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-google-wallet"></i> Products</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <form method="post" action="{{route('getBarcode')}}" target="-_blank">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-bath"></i> Generate Barcode </button>
                    <table class="table" id="myTable">

                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Generate Barcode</td>
                        <td>Name</td>
                        <td>Buy Price</td>
                        <td>Sale Price</td>
                        <td>Qty</td>
                        <td>Barcode</td>
                        <td>Category Name</td>
                        <td>Edit Product</td>
                        <td>Delete Product</td>
                    </tr>
                    </thead>
                    @foreach($pds as $pd)
                        <tr>
                            <td>{{$pd->id}}</td>
                            <td><input type="checkbox" name="getBarcode[]" value="{{$pd->id}}"> </td>
                            <td>{{$pd->name}}</td>
                            <td>{{$pd->buy_price}}</td>
                            <td>{{$pd->sale_price}}</td>
                            <td>{{$pd->qty}}</td>
                            <td>{{$pd->barcode}}</td>
                            <td>{{$pd->cat->cat_name}}</td>
                            <td><a href="{{route('editProduct',['id'=>$pd->id])}}"><i class="fa fa-edit"></i> </a> </td>
                            <td><a href="#" idd="{{$pd->id}}" id="btnDeleteProduct" class="text-danger"><i class="fa fa-trash"></i> </a> </td>

                        </tr>
                        @endforeach
                </table>
                    {{csrf_field()}}
                </form>
            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@endsection
