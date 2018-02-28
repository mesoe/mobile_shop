@extends('admin.layouts.app')
@section('title') Report Page @stop
@section('content')
    <div id="wrapper">
        <!-- Navigation -->
        @include('admin.layouts.navbar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-bar-chart"></i> Report</h1>
                    <form method="get" action="{{route('searchByDate')}}" class="input-group custom-search-form">
                        <input type="date" name="search_date" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                    </form>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <table class="table">
                    <tr>
                        <td>ID</td>
                        <td>Cashier</td>
                        <td>Customer</td>
                        <td>Total Amount</td>
                        <td>Total Buying Price</td>
                        <td>Profit</td>
                        <td>Date</td>
                        <td>Detail</td>
                        <td>Print</td>
                    </tr>
                    <?php
                        $grantTotalAmount=0;
                        $totalBuyingPrice=0;
                    ?>
                    @foreach($orders as $order)
                        <?php
                        $buyingPrice=0;
                            $grantTotalAmount += $order->cart->totalAmount;
                        ?>

                        @foreach($order->cart->items as $item)
                            <?php $buyingPrice += $item['item']['buy_price'];?>
                            @endforeach

                        <?php $totalBuyingPrice += $buyingPrice; ?>
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->user->name}}</td>
                            <td>@if($order->customer){{$order->customer}} @else Customer @endif</td>
                            <td>{{$order->cart->totalAmount}}</td>
                            <td><?php echo $buyingPrice ?></td>
                            <td><?php echo $order->cart->totalAmount - $buyingPrice ?></td>
                            <td>{{date('d-m-Y h:i A',strtotime($order->created_at))}}</td>
                            <td><a href="{{route('detail',['id'=>$order->id])}}"><i class="fa fa-deaf"></i> </a> </td>
                            <td><a target="-_blank" href="{{route('print',['id'=>$order->id])}}"><i class="fa fa-print"></i> </a> </td>
                        </tr>
                        @endforeach
                </table>
            </div>
            <!-- /#page-wrapper -->
            <div class="panel-footer">
                <div class="text-center">
                    <p>Date:{{date('(D)d-(M)m-Y',strtotime($today))}}</p>
                    <p>Total Amount:<?php echo $grantTotalAmount?></p>
                    <p>Total Buying Price :<?php echo $totalBuyingPrice?></p>
                    <p>Profit :<?php echo $grantTotalAmount - $totalBuyingPrice ?></p>
                </div>
            </div>
        </div>
    </div>
@endsection
