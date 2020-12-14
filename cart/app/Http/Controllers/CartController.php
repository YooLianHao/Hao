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
            'productID'=>$r->ID, 
            'quantity'=>$r->quantity,
            
        ]);
        Session::flash('success',"Product added to Cart succesfully!");

        return redirect()->route('products');
    }

    public function showMyCart(){
        $carts =DB::table('my_carts')
      ->leftjoin('products','products.id','=','my_carts.productID')
      ->select('my_cart.quantity as cartQty','products.*')
      
      //->get();
        //$products=Product::all();
        ->paginate(12);
        return view('myCart')->with('carts',$carts);
    }

}
