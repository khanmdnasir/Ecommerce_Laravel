<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(){
        $data=DB::table('category')->get();
        return view('admin.Category.all_category',['categories'=>$data]);
    }

    public function Create(Request $request){
        $category_name=$request->category_name;
        $category_description=$request->category_description;
        $publication_status=$request->publication_status;
        try {
            DB::table('category')->insert([
                'category_name'=>$category_name,
                'category_description'=>$category_description,
                'publication_status'=>$publication_status
            ]);
            return back()->with('success','Category added Successfully');
        } catch (\Throwable $th) {
            return back()->with('fail_msg','Insert Fail! Something Wrong');
        }


    }

    public function active($id){
        $data=DB::table('category')->where('category_id',$id)->update(['publication_status'=>1]);
        return redirect('all-category');

    }

    public function unactive($id){
        $data=DB::table('category')->where('category_id',$id)->update(['publication_status'=>0]);
        return redirect('all-category');

    }

    public function edit($id){
        $data=DB::table('category')->where('category_id',$id)->first();
        return view('admin.Category.edit_category',['category'=>$data]);
    }

    public function update(Request $request){
        try {
            $data=DB::table('category')->where('category_id',$request->category_id)->update(['category_name'=>$request->category_name,'category_description'=>$request->category_description]);

        return back()->with('msg','Data Updated Successfully');
        } catch (\Throwable $th) {
            return back()->with('fail_msg','Data Update Fail! Something Wrong,try again.');
        }


    }
    public function delete($id)
    {
        if(DB::table('sub_category')->where('category_id',$id)->get()){
            return back()->with('msg','You are not allow to Delete');
        }else{

            DB::table('category')->where('category_id',$id)->delete();

        return back()->with('msg','Data Deleted Successfully');
        }

    }
}
