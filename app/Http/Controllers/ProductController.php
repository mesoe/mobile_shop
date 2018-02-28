<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function editProduct($id){
        $pd=Product::where('id',$id)->first();
        $cats=Category::all();
        return view('Products.editProduct')->with(['pd'=>$pd])->with(['cats'=>$cats]);
    }
    public function postEditProduct(Request $request){
        $id=$request['id'];
        $up=Product::where('id',$id)->first();
        $up->name=$request['name'];
        $up->buy_price=$request['buy_price'];
        $up->sale_price=$request['sale_price'];
        $up->qty=$request['qty'];
        $up->cat_id=$request['cat_id'];
        $up->update();
        return redirect()->route("showProduct");
    }
    public function deleteProduct(Request $request){
        $id=$request['id'];
        $pd=Product::where('id',$id)->first();
        $pd->delete();
        echo "delete success";
    }
    public  function getBarcode(Request $request){
        $id=$request['getBarcode'];
        if($id) {
        $pds=Product::whereIn('id',$id)->get();
            return view('Products.barcode')->with(['pds' => $pds]);
        }else{
            return redirect()->back();
        }
    }
    public function getCategory(){
        $cats=Category::OrderBy('id','desc')->paginate("9");
        return view('Products.categories')->with(['cats'=>$cats]);
    }
    public function newCategory(Request $request){
        $cat=new Category();
        $cat->cat_name=$request['cat_name'];
        $cat->save();
        echo "<div class='alert alert-success'>The new category have been created</div>";
    }
    public function deleteCategory(Request $request){
        $id=$request['id'];
        $del=Category::find($id);
        $del->delete();
        return redirect()->back();
    }
    public function getNewProduct(){
        $cats=Category::OrderBy('id','desc')->get();
        return view('Products.new_product')->with(['cats'=>$cats]);
    }
    public function postNewProduct(Request $request){
        $this->validate($request,[
           'name'=>'required',
            'buy_price'=>'required',
            'sale_price'=>'required',
            'qty'=>'required',
            'cat_id'=>'required'
        ]);
        $name=$request['name'];
        $buy_price=$request['buy_price'];
        $sale_price=$request['sale_price'];
        $qty=$request['qty'];
        $cat_id=$request['cat_id'];
        $pd=new Product();
        $pd->name=$name;
        $pd->buy_price=$buy_price;
        $pd->sale_price=$sale_price;
        $pd->barcode=rand(000000,999999);
        $pd->qty=$qty;
        $pd->cat_id=$cat_id;
        $pd->save();
        return redirect()->back();
    }
    public  function  showProduct(){
        $pds=Product::all();
        return view('Products.product')->with(['pds'=>$pds]);
    }

}
