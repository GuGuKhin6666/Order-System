<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use Illuminate\Routing\RouteGroup;

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
//log in /logout
Route::middleware('admin_middleware')->group(function(){
Route::redirect('/','loginpage');
Route::get('loginpage',[AuthController::class,'loginpage'])->name('login#page');
Route::get('registerpage',[AuthController::class,'registerpage'])->name('register#page');

});

//Middleware
Route::middleware(['auth'])->group(function () {
 //dashboard page Consition Admin Or user
 Route::get('dashboard',[AuthController::class,'dashboard'])->name('dash#board');

 Route::middleware('admin_middleware')->group(function(){

    Route::group(['prefix'=>'category'],function(){
        Route::get('list',[CategoryController::class,'listpage'])->name('list#page');
        Route::get('createpage',[CategoryController::class,'createcategory'])->name('create#page');
        Route::post('upload',[CategoryController::class,'upload'])->name('upload#page');
        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
        Route::get('edit/{id}',[CategoryController::class,'edit'])->name('edit#pagelist');
        Route::post('update',[CategoryController::class,'update'])->name('update#pagelist');
      });

      //Admin page
      Route::prefix('admin')->group(function(){
        Route::get('password/change',[AdminController::class,'changepassword'])->name('change#password');
        Route::post('passwordupdate',[AdminController::class,'passwordupdate'])->name('password#update');
        Route::get('deatil',[AdminController::class,'detailpage'])->name('detail#page');
        Route::get('edit',[AdminController::class,'editadminpage'])->name('editadmin#page');
        Route::post('updateprofile/{id}',[AdminController::class,'updateprofile'])->name('update#profile');
        Route::get('editadmin',[AdminController::class,'editadmin'])->name('editadmin#account');
        Route::get('delete/{id}',[AdminController::class,'deleteaccount'])->name('delete#account');
        Route::get('role/{id}',[AdminController::class,'role'])->name('role#update');
        Route::post('readyupdate',[AdminController::class,'readyupdate'])->name('readyupdate#account');
        Route::get('data',[UserController::class,'datareturn'])->name('data#return');
        Route::get('datalistdate',[UserController::class,'datalistdate'])->name('datalist#date');
      });

      Route::prefix('product')->group(function(){
        Route::get('list',[ProductController::class,'list'])->name('product#list');
        Route::get('create',[ProductController::class,'create'])->name('product#create');
        Route::post('createdata',[ProductController::class,'updateproduct'])->name('createdata#product');
        Route::get('view/{id}',[ProductController::class,'view'])->name('view#product');
        Route::get('edit/{id}',[ProductController::class,'edit'])->name('edit#product');
        Route::post('update',[ProductController::class,'update'])->name('update#data');
        Route::get('delete/{id}',[ProductController::class,'delete'])->name('delete#product');
      });

      Route::prefix('order')->group(function(){
        Route::get('orderlistpage',[OrderController::class,'orderlistpage'])->name('order#listpage');
        Route::get('data/get',[OrderController::class,'getdata'])->name('data#get');
        Route::get('datasent/{orderCode}',[OrderController::class,'datasent'])->name('data#sent');
         Route::get('change/status',[AjaxController::class,'chnagestatus'])->name('chnage#status');
      });

      Route::prefix('contact')->group(function(){
        Route::get('mail/listpage',[ContactController::class,'maillistpage'])->name('mail#listpage');
        Route::get('delete/mail/{id}',[ContactController::class,'deletemail'])->name('delete#mail');
      });
 });
 //category Admin / Home

  Route::group(['prefix'=>'user','middleware'=>'user_middleware'],function(){
    Route::get('home',[UserController::class,'list'])->name('user#home');
    Route::get('filter/{id}',[UserController::class,'filter'])->name('filter#product');

    Route::prefix('password')->group(function(){
      Route::get('editpassword',[UserController::class,'editpassword'])->name('edit#password');
      Route::post('update/{id}',[UserController::class,'updatepassword'])->name('update#password');
    });

    Route::prefix('account')->group(function(){
      Route::get('editpage/{id}',[UserController::class,'editpage'])->name('edit#page');
      Route::post('update/{id}',[UserController::class,'updatepage'])->name('update#page');
    });

    Route::prefix('ajax')->group(function(){
      Route::get('data',[AjaxController::class,'data'])->name('ajax#datalist');
      Route::get('addtocart',[AjaxController::class,'cart'])->name('cart#product');
      Route::get('orderlist',[AjaxController::class,'orderlist'])->name('order#list');
      Route::get('delete/order',[AjaxController::class,'deleteorder'])->name('deleteorder');
      Route::get('each/data',[AjaxController::class,'eachdata'])->name('each#data');
      Route::get('viewcount',[AjaxController::class,'viewcount'])->name('viewcount');
    });

    Route::prefix('product')->group(function(){
      Route::get('detail/{id}',[UserController::class,'detail'])->name('detail#product');
    });

    Route::prefix('cart')->group(function(){
      Route::get('cartpage',[CartController::class,'cart'])->name('cart#page');
      Route::get('seeorder',[CartController::class,'seeorder'])->name('see#order');
    });


    Route::prefix('contact')->group(function(){
      Route::get('sendmail',[ContactController::class,'sendmail'])->name('send#mail');
      Route::post('contact/me',[ContactController::class,'contactme'])->name('contact#me');
    });
  });
});

Route::get('webtesting',function(){
  $data=[
    'message' => 'Success'
  ];
  return response()->json($data,200);
});
