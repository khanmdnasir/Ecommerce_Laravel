<?php

namespace App\Http\Controllers;

use App\Models\SliderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    public function index(){
        $data=DB::table('slider')->get();

        return view('admin.Slider.allSlider',['slides'=>$data]);
    }
    public function add(){

        return view('admin.Slider.addSlider');

    }

    public function create(Request $request){


        try {
            $slider_id=$request->slider_id;

            $slider_name=$request->slider_name;
            $slider_description=$request->slider_description;



            $file = $request->file('slider_image');

            if(!$file==null){
                // $file=Image::make($image->getRealPath());
                // $file->resize(300, 300);
                $filename = time() . '.' . $file->extension();
                $file->move('images/slider/',$filename);
            }else{
                $filename="";
            }

            $file1 = $request->file('slider_priceImage');

            if(!$file1==null){
                // $file=Image::make($image->getRealPath());
                // $file->resize(300, 300);
                $filename1 = time() . '.' . $file1->extension();
                $file1->move('images/prices/',$filename1);
            }else{
                $filename1="";
            }

            $publication_status=$request->publication_status;

            DB::table('slider')->insert([
                'slider_id'=>$slider_id,

                'slider_name'=>$slider_name,
                'slider_description'=>$slider_description,

                'slider_image'=>$filename,
                'slider_priceImage'=>$filename1,

                'publication_status'=>$publication_status

            ]);

             return back()->with('success','Slider added Successfully');
         } catch (\Throwable $th) {
             return back()->with('fail_msg','Insert Fail! Something Wrong');
         }
    }

    public function active($id){
        $data=DB::table('slider')->where('slider_id',$id)->update(['publication_status'=>1]);
        return redirect('all_slider');

    }

    public function unactive($id){
        $data=DB::table('slider')->where('slider_id',$id)->update(['publication_status'=>0]);
        return redirect('all_slider');

    }

    public function edit($id){
        $data=DB::table('slider')->where('slider_id',$id)->first();

        return view('admin.Slider.editSlider',['slide'=>$data]);
    }

    public function update(Request $request){


        try {
                $data=SliderModel::find($request->slider_id);
            $data->slider_name=$request->input('slider_name');
            $data->slider_description=$request->input('slider_description');
            $file = $request->file('slider_image');

            if(!$file==null){
                // $file=Image::make($image->getRealPath());
                // $file->resize(300, 300);
                $filename = time() . '.' . $file->extension();
                $file->move('images/slider/',$filename);
                $data->slider_image=$filename;
            }

        $file1 = $request->file('slider_priceImage');

        if(!$file1==null){
            // $file=Image::make($image->getRealPath());
            // $file->resize(300, 300);
            $filename1 = time() . '.' . $file1->extension();
            $file1->move('images/prices/',$filename1);
            $data->slider_priceImage=$filename1;
        }
        $data->save();

        return back()->with('msg','Data Updated Successfully');
        } catch (\Throwable $th) {
            return back()->with('fail_msg','Data Update Fail! Something Wrong,try again.');
        }


    }
    public function delete($id)
    {

        DB::table('slider')->where('slider_id',$id)->delete();


        return back()->with('msg','Data Deleted Successfully');
    }
}
