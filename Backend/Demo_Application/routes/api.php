<?php

use App\Http\Controllers\APIAddressController;
use App\Http\Controllers\APICartController;
use App\Http\Controllers\APIController;
use App\Http\Controllers\APIWishlistController;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware'=>'api'],function($router){
    // API for Registration
    Route::post('/userRegister',[APIController::class,'register']);

    // API for user login
    Route::post('/userLogin',[APIController::class,'login']);

    //API to change password
    Route::put('/changePassword',[APIController::class,'changePassword']);

    //API for contact us
    Route::post('/contactUs',[APIController::class,'contactUs']);

    //API for profile
    Route::post('/profile',[APIController::class,'profile']);
    Route::post('/refresh',[APIController::class,'refresh']);

    //API for shopping cart
    Route::apiResource('/cart',APICartController::class);

    // API for address
    Route::apiResource('/addresses',APIAddressController::class);

    // API for wishlist
    Route::apiResource('/wishlist',APIWishlistController::class);
});

//API for fetching categories
Route::get('/categories',function(){
    $categories=Category::all();
    return response()->json(['categories'=>$categories]);
});

//API for fetching sub categories
Route::get('/subcategories',function(){
    $subcategories=SubCategory::all();
    return response()->json(['subcategories'=>$subcategories]);
});

//API for fetching products
Route::get('/products/{id}',function($id){
    $products=Product::where('sub_category_id',$id)->get();
    return response()->json(['products'=>$products]);
});

//API for fetching banners
Route::get('/banners',function(){
    $banners=Banner::all();
    return response()->json(['banners'=>$banners]);
});

// API for fetching profile 
Route::get('/userProfile/{email}',function($email){
    $profile=User::where('email',$email)->get();
    return response()->json(['profile'=>$profile]);
});