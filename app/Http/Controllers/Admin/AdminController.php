<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Customer\ShopController;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Session;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){

        $product_id = Session::get('product_id');
        $quantity = Session::get('quantity');

        if($product_id > 0 && $quantity > 0){

            $shop = new ShopController;
            $product = Product::where('id','=',$product_id)->first();

            $user = Auth::user();
            $price = $product->price *100;

            $shop->clearCart();
            Session::forget('product_id');
            Session::forget('quantity');

            return $user->checkoutCharge($price, $product->name, $quantity);
            
        }

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
