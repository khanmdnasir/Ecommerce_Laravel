<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{

    public function add(){
        $data=DB::table('category')->get();
        return view('admin.Sub-Category.add-sub_cat',['categories'=>$data]);
    }
    public function index(){
        $data=DB::table('sub_category')->get();
        $data1=DB::table('category')->get();
        return view('admin.Sub-Category.all-sub_cat',['sub_categories'=>$data,'categories'=>$data1]);
    }
    public function create(Request $request){
        $sub_cat_name=$request->sub_cat_name;
        $category_id=$request->category_id;
        $sub_cat_description=$request->sub_cat_description;
        $publication_status=$request->publication_status;
        try {
            DB::table('sub_category')->insert([
                'sub_cat_name'=>$sub_cat_name,
                'category_id'=>$category_id,
                'sub_cat_description'=>$sub_cat_description,
                'publication_status'=>$publication_status

            ]);
            return back()->with('success','SubCategory added Successfully');
        } catch (\Throwable $th) {
            return back()->with('fail_msg','Insert Fail! Something Wrong');
        }
    }

    public function active($id){
        $data=DB::table('sub_category')->where('sub_cat_id',$id)->update(['publication_status'=>1]);
        return redirect('all-sub_cat');

    }

    public function unactive($id){
        $data=DB::table('sub_category')->where('sub_cat_id',$id)->update(['publication_status'=>0]);
        return redirect('all-sub_cat');

    }

    public function edit($id){
        $data=DB::table('sub_category')->where('sub_cat_id',$id)->first();
        $data1=DB::table('category')->get();
        return view('admin.Sub-Category.edit-sub_cat',['sub_category'=>$data,'categories'=>$data1]);
    }

    public function update(Request $request){
        try {
            DB::table('sub_category')->where('sub_cat_id',$request->sub_cat_id)->update(['sub_cat_name'=>$request->sub_cat_name,'category_id'=>$request->category_id,'sub_cat_description'=>$request->sub_cat_description]);

        return back()->with('msg','Data Updated Successfully');
        } catch (\Throwable $th) {
            return back()->with('fail_msg','Data Update Fail! Something Wrong,try again.');
        }


    }
    public function delete($id)
    {
        if(DB::table('brand')->where('sub_cat_id',$id)->get()){
            return back()->with('msg','You are not allow to Delete');
        }else{

            DB::table('sub_category')->where('sub_cat_id',$id)->delete();

        return back()->with('msg','Data Deleted Successfully');
        }

    }
}


