<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Product; 
use App\Models\Category;
Use Session;
use Illuminate\Pagination\Paginator;

class ClientProductController extends Controller
{
         public function show(){
     
        $products=Product::paginate(9);
        return view('showClientProduct')->with('products',$products);
    }

    public function search(){
        $r=request();//retrive submited form data
        $keyword=$r ->searchProduct;
        $products =DB::table('products')
        ->leftjoin('categories','categories.id','=','products.categoryID')
        ->select('categories.name as catname','categories.id as catid','products.*')
        ->where('products.name','like','%'.$keyword.'%')
        ->orWhere('products.description','like','%'.$keyword.'%')
        //->get();
        ->paginate(9);
  
        return view('showClientProduct')->with('products',$products);
      }
}
