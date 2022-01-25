<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddUser;
use App\Http\Controllers\AddBanner;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactInfoController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use App\Models\ContactUs;
use App\Models\Product;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

Route::resource('/user',UserController::class);

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
Route::get('/contactus',function(){
    $data=ContactUs::all();
    return view('contactUs',['data'=>$data]);
});
Route::get('/userMessage/{id}',function($id){
    $contactUs=ContactUs::find($id);
    return view('userMessage')->with('contactUs',$contactUs);
});
Route::post('/sendMessage',function(Request $req){
    $data=['msg'=>$req->message];
    $user['to']=$req->email;
    Mail::send('mail.adminReply',$data,function($message) use ($user){
        $message->to($user['to']);
        $message->subject('Shopping Cart Team Reply');
    });
    return back()->with('success',"Mail has been sent to the customer.");
})->name('sendMessage');

// Categories
Route::resource('/category',CategoryController::class);

// Sub Categories
Route::resource('/sub_categories',SubCategoryController::class);

// Products
Route::resource('/products',ProductController::class);
Route::post('/getSubCategories',[ProductController::class,'getSubCategories']);
Route::get('/changeImage/{id}',[ProductController::class,'changeImageForm']);
Route::post('/changeImage',[ProductController::class,'changeImage']);

//Orders
Route::resource('/orders',OrderController::class);

//Settings
Route::resource('/settings',SettingsController::class);

// ContactInfo
Route::get('/contactInfo',[ContactInfoController::class,'contactInfoForm']);
Route::post('/contactInfo',[ContactInfoController::class,'contactInfo']);

// coupon management
Route::resource('/coupons',CouponController::class);

// Reports
Route::get('/reports',[ReportsController::class,'reports']);