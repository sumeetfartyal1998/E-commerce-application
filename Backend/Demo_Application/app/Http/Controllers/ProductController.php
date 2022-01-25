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
        $products=Product::paginate(5);
        return view('/products.index')->with('products',$products);
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
        $product=Product::find($id);
        return view('/products.edit')->with('product',$product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $validateData=$req->validate([
            'title'=>'required',
            'price'=>'required|numeric',
            'desc'=>'required'
        ],[
            'title.required'=>'Enter the product name',
            'price.required'=>'Enter the product price',
            'price.numeric'=>'Enter a valid price',
            'desc.required'=>'Description is required',
        ]);
        if($validateData){
            $product=Product::find($id);
            $product->title=$req->title;
            $product->desc=$req->desc;
            $product->price=$req->price;
            $product->save();
            return redirect('/products')->with('success','Product Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $productImages=ProductImage::where('product_id',$id)->get();
        $product=Product::find($id);
        foreach($productImages as $image){
            if(unlink(public_path('uploads/ProductImages/'.$image->image_name))){
                $image->delete();
            }
        }
        if(unlink(public_path('uploads/ProductImages/'.$product->product_main_image))){
            $product->delete();
        }
        return back()->with('success','Product updated successfully');
    }

    // Edit Product Main Image
    public function changeImageForm($id){
        return view('products.editMainImg')->with('id',$id);
    }

    public function changeImage(Request $req){
        $validateData=$req->validate([
            'img'=>'required|mimes:jpg,jpeg,png',
        ],[
            'img.required'=>'Image file is required',
            'img.mimes'=>'Upload an image file'
        ]);
        if($validateData){
            $product=Product::find($req->id);
            $imgName='Image-'.rand().'.'.$req->img->extension();
            if(unlink(public_path('uploads/ProductImages/'.$product->product_main_image))){
                $product->product_main_image=$imgName;
                if($req->img->move(public_path('uploads/ProductImages'),$imgName)){
                    $product->save();
                }
            }
            return redirect('/products')->with('success','Product deleted successfully');
        }
    }
}
