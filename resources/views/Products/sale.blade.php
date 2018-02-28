@extends('admin.layouts.app')
@section('title') Sale Page @stop
@section('content')
    <div id="wrapper">
        <!-- Navigation -->
        @include('admin.layouts.navbar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-share-alt"></i> Sale</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">San Barcode or Enter Item to sale</div>
                        <div class="panel-body">
                            <form id="mySale" method="post" action="{{route('addToCart')}}">
                                <div class="form-group">
                                    <input type="search" autofocus list="sale_list" name="sale_item" id="sale_item" class="form-control" placeholder="San Barcode or Enter Item to sale">
                                    <datalist id="sale_list">
                                        @foreach($pds as $pd)
                                            <option value="{{$pd->name}}"></option>
                                            @endforeach
                                    </datalist>
                                </div>
                                {{csrf_field()}}
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Show Sale Cart</div>
                        <div class="panel-body">

                                <table class="table">
                                    <tr>
                                        <td>Product Name</td>
                                        <td>Price</td>
                                        <td>Qty</td>
                                        <td>Amount</td>
                                    </tr>
                                    @if(Session::has('cart'))
                                    @foreach($carts as $cart)
                                    <tr>
                                        <td>{{$cart['item']['name']}}</td>
                                        <td>{{$cart['item']['sale_price']}}</td>
                                        <td><a href="{{route('decreaseCart',['id'=>$cart['item']['id']])}}" class="fa fa-backward"></a> {{$cart['qty']}} <a href="{{route('increaseCart',['id'=>$cart['item']['id']])}}" class="fa fa-forward"></a> </td>
                                        <td>{{$cart['price']}}</td>
                                        <td><a href="{{route('removeItem',['id'=>$cart['item']['id']])}}" class="text-danger"><i class="fa fa-trash"></i> </a> </td>
                                    </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3">Total Amount</td>
                                            <td>{{$totalAmount}}</td>
                                        </tr>
                                        <tr>
                                            <td>Payment Total</td>
                                            <td>@if(Session::has('pay')){{Session::get('pay')}} @endif</td>
                                        </tr>
                                        <tr>
                                            <td>Amount Due</td>
                                            <td>@if(Session::has('pay')){{Session::get('pay')-$totalAmount}} @endif</td>
                                        </tr>
                                </table>
                                <div class="row">
                                    <div class="col-md-6">
                                        <form method="post" action="{{route('payment')}}">
                                            <div class="form-group">
                                                <label for="amount_tandered" class="control-label">Tendered Amount</label>
                                                <input type="text" name="amount_tendered" value="@if(Session::has('cart')){{$totalAmount}} @endif" class="form-control">
                                                <button type="submit" class="btn btn-primary btn-block btn-sm">Payment</button>
                                            </div>
                                            {{csrf_field()}}
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                       @if(Session::has('cart'))
                                           @if(Session::has('pay'))
                                                <form method="post" action="{{route('checkout')}}" target="_blank">
                                                    <div class=" form-group">
                                                        <label for="customerName" class="control-label">Customer Name</label>
                                                        <input type="text" name="customer" class="form-control">
                                                        <button type="submit" class="btn btn-primary btn-block">Checkout</button>
                                                    </div>

                                                    {{csrf_field()}}
                                                </form>
                                               @endif
                                           @endif
                                    </div>
                                </div>
                            <a href="{{route('sale')}}" class="btn btn-primary btn-block">New Sale</a>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
    <div class="row">
        <div class="alert alert-danger">{{Session('err')}}</div>
    </div>

@endsection


