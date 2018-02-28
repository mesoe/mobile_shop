@extends('admin.layouts.app')
@section('title') Dashboard Page @stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Soe Mobile</h1>
                <h3>Phone : 09123456789</h3>
                <h5>Address : Bilu Island</h5>
                @foreach($orders as $order)
                    <p>Customer:{{$order->user->name}} </p>
                    <p>Cashier :{{$order->customer}}</p>
                    <p>Date:{{date('d-m-Y h:i A',strtotime($order->created_at))}}</p>
                    @foreach($order->cart->items as $item)
                        <table class=" table">
                            <tr>
                                <td>Name</td>
                                <td>Price</td>
                                <td>Qty</td>
                                <td>Amount</td>
                            </tr>
                            <tr>
                                <td>{{$item['item']['name']}}</td>
                                <td>{{$item['item']['sale_price']}}</td>
                                <td>{{$item['qty']}}</td>
                                <td>{{$item['price']}}</td>
                            </tr>
                            <tr>
                                <td>Total Amount</td>
                                <td>{{$order->cart->totalAmount}}</td>
                            </tr>
                        </table>

                        @endforeach
                @endforeach
            </div>

        </div>
    </div>
@endsection
