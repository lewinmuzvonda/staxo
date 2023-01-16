<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Customer\ShopController;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use App\Models\Job;
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
            $firstPayment = $price/2;
            $total = $product->price * $quantity;
            // $shop->clearCart();

            $order = new Order;
            $order->customer_id = $user->id;
            $order->total_amount = $total;
            $order->products = $product->id;
            $order->status = 0;
            $order->save();

            Session::put('order_id', $order->id);
            
            Session::forget('product_id');
            Session::forget('quantity');

            return view('customer/pay');
            
        }

        $products = Product::leftJoin('categories','categories.id','=','products.category')
        ->select('products.id','products.name','products.image','products.price','products.status as product_status','categories.name as category_name')
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

    public function editProductForm($id){
        
        $categories = Category::get();
        $productData = Product::where('id','=',$id)->first();

        return view('admin/edit-product',[
            'categories' => $categories,
            'product' => $productData,
        ]);

    }

    public function editProduct(Request $request){

        Product::where('id',$request->id)->update([
            'name'=>$request->product_name,
            'price'=>$request->price,
            'category'=>$request->category,
        ]);

        if(isset($request->image_data)){
            Product::where('id',$request->id)->update([
                'image'=>$request->image_data,
            ]);
        }

        return redirect()->intended('/admin');


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
