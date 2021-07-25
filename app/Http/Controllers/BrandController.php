<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function add(){
        $data=DB::table('sub_category')->get();
        return view('admin.Brand.add_brand',['sub_categories'=>$data]);
    }
    public function index(){
        $data=DB::table('brand')->get();
        $data1=DB::table('sub_category')->get();
        return view('admin.Brand.all_brand',['brands'=>$data,'sub_categories'=>$data1]);
    }
    public function create(Request $request){
        $brand_name=$request->brand_name;
        $sub_cat_id=$request->sub_cat_id;
        $brand_description=$request->brand_description;
        $publication_status=$request->publication_status;
        try {
            DB::table('brand')->insert([
                'brand_name'=>$brand_name,
                'sub_cat_id'=>$sub_cat_id,
                'brand_description'=>$brand_description,
                'publication_status'=>$publication_status

            ]);
            return back()->with('success','Brand added Successfully');
        } catch (\Throwable $th) {
            return back()->with('fail_msg','Insert Fail! Something Wrong');
        }
    }

    public function active($id){
        $data=DB::table('brand')->where('brand_id',$id)->update(['publication_status'=>1]);
        return redirect('all-brand');

    }

    public function unactive($id){
        $data=DB::table('brand')->where('brand_id',$id)->update(['publication_status'=>0]);
        return redirect('all-brand');

    }

    public function edit($id){
        $data=DB::table('brand')->where('brand_id',$id)->first();
        $data1=DB::table('sub_category')->get();
        return view('admin.Brand.edit_brand',['brand'=>$data,'sub_categories'=>$data1]);
    }

    public function update(Request $request){
        try {
            $data=DB::table('brand')->where('brand_id',$request->brand_id)->update(['brand_name'=>$request->brand_name,'sub_cat_id'=>$request->sub_cat_id,'brand_description'=>$request->brand_description]);

        return back()->with('msg','Data Updated Successfully');
        } catch (\Throwable $th) {
            return back()->with('fail_msg','Data Update Fail! Something Wrong,try again.');
        }


    }
    public function delete($id)
    {
        DB::table('brand')->where('brand_id',$id)->delete();

        return back()->with('msg','Data Deleted Successfully');
    }
}
