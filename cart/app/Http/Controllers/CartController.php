<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Product; 
use App\Models\Category;
use App\Models\myCart;
Use Session;
Use AUth;

class CartController extends Controller
{
    public function _construct(){
        $this->middleware('auth');
    }

    
    public function add(){     
        $r=request();
        
        $addCategory=myCart::create([    
            'orderID'=>'',
            'userID'=>Auth::id(), 
            'quantity'=>$r->quantity, 
            'productID'=>$r->id, 
            
        ]);
        Session::flash('success',"Product added to Cart succesfully!");

        return redirect()->route('product');
    }

    public function show(){
        $carts =DB::table('my_carts')
        ->leftjoin('products','products.id','=','my_carts.productID')
        ->select('my_carts.quantity as cartQty','my_carts.id as cid','products.*')
        ->where('my_carts.orderID','=','') //'' haven't make payment
        ->where('my_carts.userID','=',Auth::id())
        
        //->get();
          //$products=Product::all();
          ->paginate(12);
          return view('myCart')->with('carts',$carts);
      }

    public function showMyCart(){
      $carts =DB::table('my_carts')
      ->leftjoin('products','products.id','=','my_carts.productID')
      ->select('my_carts.quantity as cartQty','my_carts.id as cid','products.*')
      ->where('my_carts.orderID','=','') //'' haven't make payment
      ->where('my_carts.userID','=',Auth::id())
      
      //->get();
        //$products=Product::all();
        ->paginate(12);
        return view('myCart')->with('carts',$carts);
    }

    public function delete($id){
        $carts=myCart::find($id);
        $carts->delete();
        return redirect()->route('show.myCart');
    }
    
   

}
