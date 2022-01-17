<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddUser;
use App\Http\Controllers\AddBanner;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use App\Models\ContactUs;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/adduser',[UserController::class,"showRoles"]);
Route::post('/adduser',[UserController::class,"addUser"]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Add Banner
Route::view('/addbanner',"addBanner");
Route::post('/addbanner',[AddBanner::class,"addBanner"]);

// Display Banner
Route::get('/banner',[AddBanner::class,"dispBanner"]);

// Delete Banner
Route::delete('/delbanner',[AddBanner::class,"delBanner"]);

// Edit Banner
Route::get('/editbanner/{id}',[AddBanner::class,"editBanner"]);

// Update Banner
Route::post('/editbanner',[AddBanner::class,"updateBanner"]);

//Contact us
Route::get('contactus',function(){
    $data=ContactUs::all();
    return view('contactUs',['data'=>$data]);
});

// Categories
Route::resource('/category',CategoryController::class);

// Sub Categories
Route::resource('/sub_categories',SubCategoryController::class);

// Products
Route::resource('/products',ProductController::class);
Route::post('/getSubCategories',[ProductController::class,'getSubCategories']);