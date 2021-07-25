<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
session_start();

class AdminController extends Controller
{




    public function show_dashboard(){
        return view('admin.dashboard');
    }

    public function dashboard(Request $request){
        $admin_email=$request->admin_email;
        $admin_password=md5($request->admin_password);
        $result=DB::table('admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();

        if($result){
            session()->put('admin_id', $result->admin_id);
            session()->put('admin_name', $result->admin_name);
            return redirect('dashboard');
        }else{
            return back()->with('msg','invalid password or email');
        }
    }
}
