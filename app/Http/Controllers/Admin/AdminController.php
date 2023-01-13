<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){

        $products = Product::leftJoin('categories','categories.id','=','products.category')
        ->select('products.name','products.image','products.price','products.status as product_status','categories.name as category_name')
        ->get();

        return view('admin/products',[
            'products' => $products,
        ]);

    }

    public function productForm(){
        
        $categories = Category::get();

        return view('admin/add-product',[
            'categories' => $categories,
        ]);

    }

    public function saveProduct(Request $request){

        $product = new Product;

        $product->name = $request->product_name;
        $product->image = $request->image_data;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->status = 1;

        $product->save();

        return redirect()->intended('/admin');


    }

    public function saveCategory(Request $request){

        $category = new Category;

        $category->name = $request->category_name;
        $category->status = 1;

        $category->save();

        return redirect()->intended('/admin/categories');


    }

    public function categories(){
        
        $categories = Category::get();

        return view('admin/categories',[
            'categories' => $categories,
        ]);

    }
}
