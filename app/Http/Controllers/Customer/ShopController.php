<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Job;
use App\Models\Order;
use App\Models\Transaction;
use Laravel\Cashier\Checkout;
use Session;
use Stripe;

class ShopController extends Controller
{
    
    public function index(){

        return view('customer/shop');

    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function pay(Request $request)
    {
        $product = Product::where('id','=',$request->id)->first();

        if(Auth::user()){

            $user = Auth::user();
            
            $price = $product->price *100;
            $total = $product->price * $request->buyquantity;
            $payment = $price/2;

            $this->clearCart();

            $order = new Order;
            $order->customer_id = $user->id;
            $order->total_amount = $total;
            $order->products = $product->id;
            $order->status = 0;
            $order->save();

            Session::put('order_id', $order->id);

            return view('customer/pay');

        }

        Session::put('product_id', $product->id);
        Session::put('quantity', $request->buyquantity);

        return redirect()->route('login');
    }

    public function payProcess(Request $request)
    {
        $order_id = Session::get('order_id');
        $order = Order::where('id','=',$order_id)->first();
        $firstPayment = $order->total_amount/2;
        $firstPayment = 100 * $firstPayment;

        $transaction = new Transaction;
        $transaction->order_id = $order_id;
        $transaction->type = 1;
        $transaction->amount = $order->total_amount / 2;
        $transaction->status = 0;
        $transaction->save();

        //2nd payment to be paid later
        $unpaid_transaction = new Transaction;
        $unpaid_transaction->order_id = $order_id;
        $unpaid_transaction->type = 2;
        $unpaid_transaction->amount = $order->total_amount / 2;
        $unpaid_transaction->status = 0;
        $unpaid_transaction->save();


        $job = new Job;
        $job->transaction_id = $unpaid_transaction->id;
        $job->status = 0;
        $job->paymentMethodId = $request->paymentMethodId;
        $job->save();
 
        $stripeCharge = $request->user()->charge(
            $firstPayment, $request->paymentMethodId
        );

        if($stripeCharge->status == "succeeded"){
            $user = Auth::user();

            $mail = new MailController;
            $mail->confirmationEmail();

            // Change to Paid
            Order::where('id',$order_id)->update(['status'=>1]);
            Transaction::where('id',$transaction->id)->update(['status'=>1]);

            $order = Order::where('id','=',$order_id)->first();

            Session::forget('order_id');

            return redirect()->route('confirm');
        }else{
            $user = Auth::user();
            $mail = new MailController;
            $mail->cancelledEmail();

             // Change to Failed
            Order::where('id',$order_id)->update(['status'=>3]);
            Session::forget('order_id');

            return redirect()->route('cancelled');
        }

    }

    public function confirm(){


        return view('customer/confirm');

    }

    public function cancelled(){


        return view('customer/cancelled');

    }

    // public function checkout(Request $request){

    //     $product = Product::where('id','=',$request->id)->first();

    //     if(Auth::user()){

    //         $user = Auth::user();
            
    //         $price = $product->price *100;
    //         $total = $product->price * $request->buyquantity;
    //         $payment = $price/2;

    //         $this->clearCart();

    //         $order = new Order;
    //         $order->customer_id = $user->id;
    //         $order->total_amount = $total;
    //         $order->products = $product->id;
    //         $order->status = 0;
    //         $order->save();

    //         Session::put('order_id', $order->id);

    //         return $user->checkoutCharge($payment, $product->name, $request->buyquantity);

    //     }

    //     Session::put('product_id', $product->id);
    //     Session::put('quantity', $request->buyquantity);
        
    //     return redirect()->route('login');

    // }    

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
