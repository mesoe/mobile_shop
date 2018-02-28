<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class CartController extends Controller
{
    public function getSale(){
        if(Session::has('cart')){
            $pds=Product::all();
            $carts=Session::get('cart');
            return view('Products.sale')->with(['pds'=>$pds])->with(['carts'=>$carts->items])->with(['totalAmount'=>$carts->totalAmount]);
        }else{
            $pds=Product::all();
            return view('Products.sale')->with(['pds'=>$pds]);
        }

    }
    public function addToCart(Request $request){
        $sale_item=$request['sale_item'];
        $pd = Product::where('name', $sale_item)->orWhere('barcode', $sale_item)->first();
        if($pd) {
            if($pd->qty > 0) {
                $oldCart = Session::has('cart') ? Session::get('cart') : null;
                $cart = new Cart($oldCart);
                $cart->add($pd, $pd->id);
                Session::put('cart', $cart);

                $oldQty = $pd->qty;
                $newQty = $oldQty - 1;
                $pd->qty = $newQty;
                $pd->update();
                return redirect()->back();
            }else{
                return redirect()->back()->with('err','the selected item is out of stop');
            }
        }else{
            return redirect()->back();
        }
    }
    public  function getRemoveItem($id){

        $oldCart=Session::get('cart');

        $cart=new Cart($oldCart);
        $cart->remove($id);
        if(count($cart->items)){
            Session::put('cart',$cart);
        }else{
        Session::forget('cart');
        }
        return redirect()->back();
    }
    public  function increaseCart($id){
        $pd=Product::where('id',$id)->first();
        if($pd->qty >0){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            $cart->increase($id);
            Session::put('cart',$cart);
            return redirect()->back();
        }else{
            return redirect()->back()->with('err','the select item has been out off stop');
        }

    }
    public  function  decreaseCart($id){
        $pd=Product::where('id',$id)->first();
        $oldCart=Session::get('cart');
        $cart=new Cart($oldCart);
        $cart->decrease($id);
        if(count($cart->items > 0)){
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }
        return redirect()->back();
    }
    public  function postPayment(Request $request){
        $amount_tendered=$request['amount_tendered'];
        Session::put('pay',$amount_tendered);
        return redirect()->back();
    }
    public  function postCustomer(Request $request){
        $customer=$request['customer'];
        $user_id=Auth::User()->id;
        $amount_tendered=Session::get('pay');
        $cart=Session::get('cart');
        $od=new Order();
        $od->customer=$customer;
        $od->user_id=$user_id;
        $od->amount_tendered=$amount_tendered;
        $od->cart=serialize($cart);
        $od->save();

        Session::forget('cart');
        Session::forget('pay');
        $id=$od->id;
        $orders=Order::where('id',$id)->get();
        $orders->transform(function ($order,$key){
            $order->cart=unserialize($order->cart);
            return $order;
        });
        return view('print')->with(['orders'=>$orders]);


    }

}
