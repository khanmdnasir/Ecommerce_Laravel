<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Inline\Element\Image;

class ProductsController extends Controller
{
    public function index(){
        $data=DB::table('product')->get();
        $brands=DB::table('brand')->get();
        $categories=DB::table('category')->get();
        $sub_categories=DB::table('sub_category')->get();
        return view('admin.Product.all_product',['products'=>$data,'brands'=>$brands,'categories'=>$categories,'sub_categories'=>$sub_categories]);
    }
    public function add(){
        // $brands=DB::table('brand')->get();
        $categories=DB::table('category')->pluck('category_name','category_id');
        // $sub_categories=DB::table('sub_category')->get();
        return view('admin.Product.add_product',['categories'=>$categories]);
        // return response()->json($brands);
    }
    public function get_brand($id){
        $brands=DB::table('brand')->where('sub_cat_id',$id)->pluck('brand_name','brand_id');
        // $categories=DB::table('category')->get();
        // $sub_categories=DB::table('sub_category')->get();

        return response()->json($brands);



    }
    public function get_sub_cat($id){
        //  $brands=DB::table('brand')->get();
        //  $categories=DB::table('category')->get();
        $sub_categories=DB::table('sub_category')->where('category_id',$id)->pluck('sub_cat_name','sub_cat_id');
        return response()->json($sub_categories);
    }
    public function create(Request $request){


        try {
            $category_id=$request->category_id;
        $sub_cat_id=$request->sub_cat_id;
        $brand_id=$request->brand_id;
        $product_name=$request->product_name;
        $product_short_description=$request->product_short_description;
        $product_long_description=$request->product_long_description;
        $product_price=$request->product_price;
        $this->validate($request, [
            'product_image' => 'required|mimes:jpeg,jpg|max:90480'
        ]);
        $file = $request->file('product_image');

        if(!$file==null){
            // $file=Image::make($image->getRealPath());
            // $file->resize(300, 300);
            $filename = time() . '.' . $file->extension();
            $file->move('images',$filename);
        }else{
            $filename="";
        }
        $product_size=$request->product_size;
        $product_color=$request->product_color;
        $publication_status=$request->publication_status;

        DB::table('product')->insert([
            'category_id'=>$category_id,
            'sub_cat_id'=>$sub_cat_id,
            'brand_id'=>$brand_id,
            'product_name'=>$product_name,
            'product_short_description'=>$product_short_description,
            'product_long_description'=>$product_long_description,
            'product_price'=>$product_price,
            'product_image'=>$filename,
            'product_size'=>$product_size,
            'product_color'=>$product_color,
            'publication_status'=>$publication_status

        ]);

             return back()->with('success','Product added Successfully');
         } catch (\Throwable $th) {
             return back()->with('fail_msg','Insert Fail! Something Wrong');
         }
    }

    public function active($id){
        $data=DB::table('product')->where('product_id',$id)->update(['publication_status'=>1]);
        return redirect('all-product');

    }

    public function unactive($id){
        $data=DB::table('product')->where('product_id',$id)->update(['publication_status'=>0]);
        return redirect('all-product');

    }

    public function edit($id){
        $data=DB::table('product')->where('product_id',$id)->first();
        $brands=DB::table('brand')->get();
        $categories=DB::table('category')->get();
        $sub_categories=DB::table('sub_category')->get();
        return view('admin.Product.edit_product',['product'=>$data,'brands'=>$brands,'categories'=>$categories,'sub_categories'=>$sub_categories]);
    }

    public function update(Request $request){

        try {
            // $file = $request->file('product_image');
            // if(!$file==null){
            //     $filename = time() . '.' . $file->extension();
            //     $file->move('images',$filename);
            // }else{

            //     $filename=DB::table('product')->select('product_image')->where('product_id',$request->product_id);
            // }
            DB::table('product')->where('product_id',$request->product_id)->update([
                'category_id'=>$request->category_id,
                'sub_cat_id'=>$request->sub_cat_id,
                'brand_id'=>$request->brand_id,
                'product_name'=>$request->product_name,
                'product_short_description'=>$request->product_short_description,
                'product_long_description'=>$request->product_long_description,
                'product_price'=>$request->product_price,
                // 'product_image'=>$filename,
                'product_size'=>$request->product_size,
                'product_color'=>$request->product_color,

            ]);

        return back()->with('msg','Data Updated Successfully');
        } catch (\Throwable $th) {
            return back()->with('fail_msg','Data Update Fail! Something Wrong,try again.');
        }


    }
    public function delete($id)
    {

        DB::table('product')->where('product_id',$id)->delete();


        return back()->with('msg','Data Deleted Successfully');
    }

    public function view_product($id){
        $data=DB::table('product')->where('product_id',$id)->first();
        return view('pages.product_details',['product'=>$data]);
    }
}
