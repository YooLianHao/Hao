<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Category; //laravel 8 format

class CategoryController extends Controller
{
    //

    public function store(){    //step 2 
        $r=request(); //step 3 get data from HTML
        $addCategory=Category::create([    //step 3 bind data
            'id'=>$r->ID, //add on
            //'id' -> id in  database            id -> id name from HTML

            'name'=>$r->name, //'name' -> name in  database            name -> fullname from HTML
        
    ]);
    
    Return view('insertCategory');// step 5 back to last page
}

public function show(){
    $categories=Category::all();

    return view('showCategory')->with('categories',$categories);
}

public function delete($id){
    $categories=Category::find($id);
    $categories->delete();
    return redirect()->route('showCategory');
}



}
