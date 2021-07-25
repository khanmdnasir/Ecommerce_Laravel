<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function login_check(){
        if(session()->get('user_name')){
            return redirect('/checkout');
        }else{
            return view('pages.login');
        }

    }

    public function checkout(){
        if(!session()->has('user_name')){
            return redirect('/');
        }
        return view('pages.checkout');
    }

    public function shipping(Request $request){
        $email=$request->email;
        $fname=$request->fname;
        $lname=$request->lname;
        $address=$request->address;
        $mobile=$request->mobile;
        $shipping_id=DB::table('shipping')->insertGetId([
            'email'=>$email,
            'fname'=>$fname,
            'lname'=>$lname,
            'address'=>$address,
            'mobile'=>$mobile

        ]);
        session()->put('shipping_id',$shipping_id);
        return redirect('/payment');
    }

    public function payment(){

        return view('pages.payment');
    }
    public function order(Request $request){
        $payment_method=$request->payment_method;
        $payment_status="pending";
        $payment_id=DB::table('payment')->insertGetId([
            'payment_method'=>$payment_method,
            'payment_status'=>$payment_status
        ]);

        $user_id=session()->get('user_id');
        $shipping_id=session()->get('shipping_id');

        $order_id=DB::table('order')->insertGetId([
            'user_id'=>$user_id,
            'shipping_id'=>$shipping_id,
            'payment_id'=>$payment_id,
            'order_total'=>Cart::count(),
            'order_status'=>'pending'
        ]);

        $contents=Cart::content();
        foreach($contents as $content){
            $product_id=$content->id;
            $product_name=$content->name;
            $product_price=$content->price;
            $product_quantity=$content->qty;
            DB::table('order_details')->insert([
                'order_id'=>$order_id,
                'product_id'=>$product_id,
                'product_name'=>$product_name,
                'product_price'=>$product_price,
                'product_quantity'=>$product_quantity,
            ]);
        }
        if($payment_method=='handcash'){
            Cart::destroy();
            session()->forget('shipping_id');
            return view('pages.OrderSuccess',['order_id'=>$order_id]);
        }elseif($payment_method=='visa'){
            return 'visa';
        }elseif($payment_method=='master'){
            return 'master';
        }else{
            return 'bkash';
        }

    }
}
