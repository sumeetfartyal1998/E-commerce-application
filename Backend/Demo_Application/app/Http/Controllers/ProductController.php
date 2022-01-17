<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('products.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        
        $validateData=$req->validate([
            'title'=>'required',
            'price'=>'required|numeric',
            'category_id'=>'required',
            'sub_category_id'=>'required',
            'main_image'=>'required',
            'main_image'=>'mimes:jpeg,jpg,png',
            'image'=>'required',
            'image.*'=>'mimes:jpeg,jpg,png'
        ],[
            'title.required'=>'Enter the product name',
            'price.required'=>'Enter the product price',
            'price.numeric'=>'Enter a valid price',
            'category_id.required'=>'Select category of the product',
            'sub_category_id.required'=>'Sub category is required',
            'main_image.required'=>'Product main image is required',
            'main_image.mimes'=>'Upload an image file',
            'image.required'=>'Product image is required',
            // 'image.*.mimes'=>'Upload an image file',
        ]);
        if($validateData){
            $main_image_name="Image-".rand().".".$req->main_image->extension();
            $product=new Product();
            $product->title=$req->title;
            $product->desc=$req->desc;
            $product->price=$req->price;
            $product->sub_category_id=$req->sub_category_id;
            $product->product_main_image=$main_image_name;
            if($req->main_image->move(public_path('uploads/ProductImages'),$main_image_name)){
                if($product->save()){
                    foreach($req->image as $image){
                        $image_name="Image-".rand().".".$image->extension();
                        $latest_product=Product::latest()->first();
                        $img=new ProductImage();
                        $img->image_name=$image_name;
                        $img->product_id=$latest_product['id'];
                        if($image->move(public_path('uploads/ProductImages'),$image_name)){
                            $img->save();
                        }  
                    }
                    return back()->with('success','Product added successfully');
                }
            }
        }
    }
    public function getSubCategories(Request $req){
        $subcategories=Category::find($req->catId)->getSubCat;
        $result="<option value='' disabled selected>Select Sub-Category</option>";
        foreach($subcategories as $subcat){
            $result.="<option value='".$subcat->id."'>".$subcat->title."</option>";
        }
        if(count($subcategories)==0){
            return "Error";
        }
        return $result;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
