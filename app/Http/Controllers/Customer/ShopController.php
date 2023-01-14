<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    
    public function index(){

        return view('customer/shop');

    }

    public function product($id){

        $productData = Product::leftJoin('categories','categories.id','=','products.category')
        ->select('products.name','products.image','products.price','categories.name as category','categories.id as category_id')
        ->where('products.id','=',$id)
        ->first();

        $related = Product::leftJoin('categories','categories.id','=','products.category')
        ->select('products.id','products.name','products.image','products.price','categories.name as category')
        ->where('products.category','=',$productData->category_id)
        ->where('products.id','!=',$id)
        ->inRandomOrder()->limit(4)->get();

        return view('customer/single-product',[
            'name' => $productData->name,
            'image' => $productData->image,
            'price' => $productData->price,
            'category' => $productData->category,
            'related' => $related,

        ]);

    }
}
