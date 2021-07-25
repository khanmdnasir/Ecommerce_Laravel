<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function add_to_cart(Request $request){
        $qty=$request->qty;

        $product=ProductModel::find($request->product_id);
        $data['id']=$product->product_id;
        $data['name']=$product->product_name;
        $data['price']=$product->product_price;
        $data['qty']=$qty;
        $data['weight']=$product->product_price*$qty;
        $data['options']['image']=$product->product_image;
        Cart::add($data);
        return redirect('show_cart');
    }

    public function ShowCart(){
        return view('pages.add_to_cart');
    }
    public function delete_cart($rowId
    ){
        Cart::update($rowId,0);
        return redirect('show_cart');
    }

    public function updatetocart(Request $request)
    {
        $qty=$request->qty;
        $data['qty']=$qty;
        $data['weight']=$request->product_price*$qty;
        $rowId=$request->rowId;
        Cart::update($rowId,$data);
        return redirect('show_cart');
    }
}
