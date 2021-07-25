<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubCategory;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
//Frontent sites......
Route::get('/',[HomeController::class,'index']);
Route::get('/ProductByCategory/{id}',[HomeController::class,'category']);
Route::get('/ProductBySubCategory/{id}',[HomeController::class,'sub_category']);
Route::get('/ProductByBrand/{id}',[HomeController::class,'brand']);





//Backend routes........
Route::get('/admin',function(){
    return view('admin.admin_login');
});
Route::get('/logout',function(){
    session()->flush();
    return redirect('admin');
});
Route::get('/dashboard',[AdminController::class,'show_dashboard'])->middleware('isLogged');
Route::post('/admin-dashboard',[AdminController::class,'dashboard']);

//Category related routes
Route::get('/all-category',[CategoryController::class,'index']);
Route::get('/add-category',function(){
    return view('admin.Category.add_category');
});
Route::post('/create-category',[CategoryController::class,'create']);
Route::get('/active_cat/{id}',[CategoryController::class,'active']);
Route::get('/unactive_cat/{id}',[CategoryController::class,'unactive']);
Route::get('/edit_cat/{id}',[CategoryController::class,'edit']);
Route::post('/update-category',[CategoryController::class,'update']);
Route::get('/delete-cat/{id}',[CategoryController::class,'delete']);

//SubCategory related routes
Route::get('/all-sub_cat',[SubCategoryController::class,'index']);
Route::get('/add-sub_cat',[SubCategoryController::class,'add']);
Route::post('/create-sub_cat',[SubCategoryController::class,'create']);
Route::get('/active-sub_cat/{id}',[SubCategoryController::class,'active']);
Route::get('/unactive-sub_cat/{id}',[SubCategoryController::class,'unactive']);
Route::get('/edit-sub_cat/{id}',[SubCategoryController::class,'edit']);
Route::post('/update-sub_cat',[SubCategoryController::class,'update']);
Route::get('/delete-sub_cat/{id}',[SubCategoryController::class,'delete']);


//brand related routes
Route::get('/add-brand', [BrandController::class,'add']);
Route::get('/all-brand',[BrandController::class,'index']);
Route::post('/create-brand', [BrandController::class,'create']);
Route::get('/active_brand/{id}',[BrandController::class,'active']);
Route::get('/unactive_brand/{id}',[BrandController::class,'unactive']);
Route::get('/edit_brand/{id}',[BrandController::class,'edit']);
Route::post('/update-brand',[BrandController::class,'update']);
Route::get('/delete_brand/{id}',[BrandController::class,'delete']);

//product related routes
Route::get('/all-product',[ProductsController::class,'index']);
Route::get('/add-product',[ProductsController::class,'add']);
Route::post('/create-product',[ProductsController::class,'create']);
Route::get('/active_product/{id}',[ProductsController::class,'active']);
Route::get('/unactive_product/{id}',[ProductsController::class,'unactive']);
Route::get('/edit_product/{id}',[ProductsController::class,'edit']);
Route::post('/update-product',[ProductsController::class,'update']);
Route::get('/delete_product/{id}',[ProductsController::class,'delete']);
Route::get('/get_brand/{id}',[ProductsController::class,'get_brand']);
Route::get('/get_sub_cat/{id}',[ProductsController::class,'get_sub_cat']);
Route::get('/view_product/{id}',[ProductsController::class,'view_product']);


//slider related routes
Route::get('/all_slider',[SliderController::class,'index']);
Route::get('/add_slider',[SliderController::class,'add']);
Route::post('/create-slider',[SliderController::class,'create']);
Route::get('/active-slider/{id}',[SliderController::class,'active']);
Route::get('/unactive-slider/{id}',[SliderController::class,'unactive']);
Route::get('/edit_slider/{id}',[SliderController::class,'edit']);
Route::post('/update-slider',[SliderController::class,'update']);
Route::get('/delete-slider/{id}',[SliderController::class,'delete']);

//orders related routes
Route::get('/all_orders',[OrderController::class,'index']);
Route::get('/active-order/{id}',[OrderController::class,'active']);
Route::get('/unactive-order/{id}',[OrderController::class,'unactive']);
Route::get('/view_order/{id}',[OrderController::class,'view']);
Route::get('/delete-slider/{id}',[OrderController::class,'delete']);

//cart releted routes
Route::post('addToCart',[CartController::class,'add_to_cart']);
Route::get('show_cart',[CartController::class,'ShowCart']);
Route::get('/delete-cart/{rowId}',[CartController::class,'delete_cart']);
Route::post('update-to-cart',[CartController::class,'updatetocart']);

//checkout related routes
Route::get('/login_check',[CheckoutController::class,'login_check']);
Route::get('/checkout',[CheckoutController::class,'checkout']);
Route::get('/payment',[CheckoutController::class,'payment']);
Route::post('/checkout-form',[CheckoutController::class,'shipping']);
Route::post('/order-place',[CheckoutController::class,'order']);

//user/customer related routes
Route::post('/login',[UserController::class,'login']);
Route::get('/login_popup',[UserController::class,'login_popup']);
Route::post('/login_first',[UserController::class,'login_first']);
Route::post('/signup',[UserController::class,'signup']);
Route::get('/user_logout',function(){
    session()->forget('user_name');
    session()->forget('user_id');
    return back();
});

