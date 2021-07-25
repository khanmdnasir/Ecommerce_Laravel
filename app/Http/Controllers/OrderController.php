<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(){
        $all_orders=DB::table('order')->join('user','order.user_id','=','user.user_id')->select('order.*','user.name')->get();
        return view('admin.Order.ManageOrder',['orders'=>$all_orders]);
    }
}
