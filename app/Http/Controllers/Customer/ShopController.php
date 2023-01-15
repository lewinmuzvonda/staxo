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
        ->select('products.id','products.name','products.image','products.price','categories.name as category','categories.id as category_id')
        ->where('products.id','=',$id)
        ->first();

        $related = Product::leftJoin('categories','categories.id','=','products.category')
        ->select('products.id','products.name','products.image','products.price','categories.name as category')
        ->where('products.category','=',$productData->category_id)
        ->where('products.id','!=',$id)
        ->inRandomOrder()->limit(4)->get();

        return view('customer/single-product',[
            'id' => $productData->id,
            'name' => $productData->name,
            'image' => $productData->image,
            'price' => $productData->price,
            'category' => $productData->category,
            'related' => $related,

        ]);

    }

    public function cart()
    {
        $list = \Cart::getContent();
        return view('customer/cart', compact('list'));
    }

    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
            )
        ]);
        session()->flash('success', $request->name.'added to Cart.');

        return redirect()->route('home');
    }

    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Cart Updated');

        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Item Removed');

        return redirect()->route('cart.list');
    }

}
