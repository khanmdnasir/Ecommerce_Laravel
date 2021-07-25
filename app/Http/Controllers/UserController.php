<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{
    public function login_popup(){
        return "login popup";
    }
    public function signup(Request $request){
        $name=$request->input('name');
        $email=$request->input('email');
        $password=$request->input('password');
        $mobile=$request->input('mobile');
        $address=$request->input('address');

        $result=DB::table('user')->insert([
            'name'=>$name,
            'email'=>$email,
            'password'=>$password,
            'mobile'=>$mobile,
            'address'=>$address
        ]);
        return redirect('/checkout')->with('user_name',$name);
    }

    public function login_first(Request $request){
        $email=$request->input('email');
        $password=$request->input('password');
        $result=DB::table('user')->where('email',$email)->where('password',$password)->first();

        if($result){
            // session()->put('user_id', $result->user_id);
            session()->put('user_name', $result->name);
            session()->put('user_id', $result->id);
            return back()->with('success','Successfully logged in');
        }else{
            return back()->with('msg','invalid password or email');
        }
    }
    public function login(Request $request){
        $email=$request->input('email');
        $password=$request->input('password');
        $result=DB::table('user')->where('email',$email)->where('password',$password)->first();

        if($result){
            // session()->put('user_id', $result->user_id);
            session()->put('user_name', $result->name);
            session()->put('user_id', $result->user_id);
            return redirect('/checkout');
        }else{
            return back()->with('msg','invalid password or email');
        }
    }


}
