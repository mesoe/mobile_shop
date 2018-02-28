<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{
    public function getDetail($id){
        $orders=Order::where('id',$id)->get();
        $orders->transform(function ($order,$key){
            $order->cart=unserialize($order->cart);
            return $order;
        });
        return view('detail')->with(['orders'=>$orders]);
    }
    public function getPrint($id){
        $orders=Order::where('id',$id)->get();
        $orders->transform(function ($order,$key){
            $order->cart=unserialize($order->cart);
            return $order;
        });
        return view('print')->with(['orders'=>$orders]);
    }
    public  function getSearchByDate(Request $request){
        $today=$request['search_date'];
        $orders=Order::where('created_at','LIKE','%'.$today.'%')->get();
        $orders->transform(function ($order,$key){
            $order->cart=unserialize($order->cart);
            return $order;

        });
        return view('report')->with(['orders'=>$orders])->with(['today'=>$today]);
    }
    public function report(){
        $today=date('Y-m-d');
        $orders=Order::where('created_at','LIKE','%'.$today.'%')->get();
        $orders->transform(function ($order,$key){
           $order->cart=unserialize($order->cart);
           return $order;

        });
        return view('report')->with(['orders'=>$orders])->with(['today'=>$today]);
    }
}
