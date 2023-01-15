<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Cashier\Checkout;
use Session;

class ShopController extends Controller
{
    
    public function index(){

        if(isset($_GET['checkout'])){
            return redirect()->route('confirm');
        }

        return view('customer/shop');

    }

    public function confirm(){


        return view('customer/confirm');

    }

    public function checkout(Request $request){

        $product = Product::where('id','=',$request->id)->first();

        if(Auth::user()){

            $user = Auth::user();
            $price = $product->price *100;

            $this->clearCart();

            return $user->checkoutCharge($price, $product->name, $request->buyquantity);

        }

        Session::put('product_id', $product->id);
        Session::put('quantity', $request->buyquantity);
        
        return redirect()->route('login');

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

    public function clearCart()
    {
        \Cart::clear();

        session()->flash('success', 'Cart Cleared');

        return redirect()->route('cart.list');
    }

}
