<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class AddBanner extends Controller
{
    public function addBanner(Request $req){
        $validateData=$req->validate([
            'title'=>'required',
            'desc'=>'required',
            'img'=>'required|mimes:jpeg,jpg,png'
        ],[
            'title.required'=>'Title is required',
            'desc.required'=>'Description is required',
            'img.required'=>'Image is required',
        ]);
        if($validateData){
            $banner=new Banner();
            $banner->title=$req->title;
            $banner->desc=$req->desc;
            $img_name="Image-".rand().".".$req->img->extension();
            $banner->img=$img_name;
            if($req->img->move(public_path('uploads/banner'),$img_name)){
                $banner->save();
            }   
        }
        return back()->with('success','Banner uploaded successfully');
    }
    public function dispBanner(){
        $banner=Banner::all();
        return view('banner')->with('banner',$banner);
    }
    public function delBanner(Request $req){
        $banner=Banner::find($req->id);
        if(File::delete(public_path('uploads/banner/'.$banner->img))){
            $banner->delete();
        }
        return response()->json(['response'=>'Banner has been deleted']);
    }
    public function editBanner($id){
        $banner=Banner::find($id);
        return view('editBanner')->with('banner',$banner);
    }
    public function updateBanner(Request $req){
        $validateData=$req->validate([
            'title'=>'required',
            'desc'=>'required',
            'img'=>'required|mimes:jpeg,jpg,png'
        ],[
            'title.required'=>'Title is required',
            'desc.required'=>'Description is required',
            'img.required'=>'Image is required',
            'img.mimes'=>'Upload an image file'
        ]);
        if($validateData){
            $banner=Banner::find($req->id);
            $banner->title=$req->title;
            $banner->desc=$req->desc;
            if(File::delete(public_path('uploads/banner/'.$banner->img))){
                $img_name="Image-".rand().".".$req->img->extension();
                $banner->img=$img_name;
                $req->img->move(public_path('uploads/banner'),$img_name);
                $banner->save();
                return back()->with('success','Banner uploaded successfully');
            }
        }
    }
}
