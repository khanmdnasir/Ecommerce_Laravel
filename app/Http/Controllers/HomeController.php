<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $data=DB::table('product')->get();
        return view('pages.home',['products'=>$data]);
    }
    public function category($id){
        $data=DB::table('product')->where('category_id',$id)->get();
        return view('pages.home',['products'=>$data]);
    }
    public function sub_category($id){
        $data=DB::table('product')->where('sub_cat_id',$id)->get();
        return view('pages.home',['products'=>$data]);
    }
    public function brand($id){
        $data=DB::table('product')->where('brand_id',$id)->get();
        return view('pages.home',['products'=>$data]);
    }
}
