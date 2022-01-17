<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('sub_categories.create')->with('categories',$categories);
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
            'category_id'=>'required',
        ],[
            'title.required'=>'Title is required',
            'category_id.required'=>'Select a category',
        ]);
        if($validateData){
            $subcategories=new SubCategory();
            $subcategories->title=$req->title;
            $subcategories->desc=$req->desc;
            $subcategories->category_id=$req->category_id;
            if($subcategories->save()){
                return back()->with('success','Sub Category added successfully');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products=SubCategory::find($id)->getProduct;
        return view('products.index')->with(['products'=>$products]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subcategory=SubCategory::find($id);
        $categories=Category::all();
        return view('sub_categories.edit')->with(['subcategory'=>$subcategory,'categories'=>$categories]);
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
        $subcategories=SubCategory::find($id);
        $subcategories->title=$req->title;
        $subcategories->desc=$req->desc;
        if($subcategories->save()){
            return back()->with('success','Sub Category updated successfully');
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
        $subcategories=SubCategory::find($id);
        if($subcategories->delete()){
            return back()->with('success','Category deleted successfully');
        }
    }
}
