<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\basketController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\WalletController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/person', function() {
//     return 'Hello MR.Alireza Garmkhorani';
// });

// Route::get('/person', function() {
//     return 'Hello MR.Alireza';
// });

// Route::get('/array', function() {
//     return ['ali','reza','hassan'];
// });

// Route::get('/', function() {
//     return view('test');
// });

// Route::get('/' , [HomeController::class , 'home']);

// Route::get('name/{name}' , [HomeController::class , 'hello'])->where('name' , '[a-z]+');

// Route::get('sum/{num1}/{num2}' , [HomeController::class , 'plus'])->where(['num1' => '[0-9]+' , 'num2' => '[0-9]+']);

// Route::get('/Text/New/line' , [HomeController::class , 'hello'])->name('hello');

Route::get('/' , [HomeController::class , 'home'])->name('home');

Route::get('/search' , [HomeController::class , 'search'])->name('searchHome');

Route::get('/category/{id}' , [HomeController::class , 'category'])->name('home-category');

Route::get('/restaurant/all' , [HomeController::class , 'restaurantAll'])->name('restaurantAll');

Route::get('/restaurant/{id}' , [HomeController::class , 'restaurant'])->name('restaurant');

Route::get('/baskets/{product_id}/{restaurant_id}' , [basketController::class , 'Add'])->name('basket.add');

Route::get('/basketproducts/{user_id}' , [basketController::class , 'ShowBasket'])->name('basket.show');

Route::post('/basketproducts/walletcharg' , [WalletController::class , 'walletCharg'])->name('walletCharg');

Route::get('/basketproducts/checkoutpay/{user_id}' , [basketController::class , 'CheckOutPay'])->name('CheckOutPay');

Route::get('/basketproducts/delete/{id}' , [basketController::class , 'Delete'])->name('deleteProduct');

//

Route::get('/admin' , [AdminController::class , 'admin'])->name('admin')->middleware('auth' , 'auth.role.admin');

//

Route::get('/admin/category/list' , [AdminController::class , 'categoryList'])->name('category-list')->middleware(['auth' , 'auth.role.admin']);

Route::get('/admin/category/create' , [AdminController::class , 'categoryCreate'])->name('category-create')->middleware(['auth' , 'auth.role.admin']);

Route::post('/admin/category/insert' , [AdminController::class , 'categoryInsert'])->name('category-insert')->middleware(['auth' , 'auth.role.admin']);

Route::get('/admin/category/edit/{id}' , [AdminController::class , 'categoryEdit'])->name('category-edit')->middleware(['auth' , 'auth.role.admin']);

Route::post('/admin/category/update' , [AdminController::class , 'categoryUpdate'])->name('category-update')->middleware(['auth' , 'auth.role.admin']);

Route::get('/admin/category/delete/{id}' , [AdminController::class , 'categoryDelete'])->name('category-delete')->middleware(['auth' , 'auth.role.admin']);

//

Route::get('/admin/product/list' , [AdminController::class , 'productList'])->name('product-list')->middleware(['auth' , 'auth.role.admin']);

Route::get('/admin/product/create' , [AdminController::class , 'productCreate'])->name('product-create')->middleware(['auth' , 'auth.role.admin']);

Route::post('/admin/product/insert' , [AdminController::class , 'productInsert'])->name('product-insert')->middleware(['auth' , 'auth.role.admin']);

Route::get('/admin/product/edit/{id}' , [AdminController::class , 'productEdit'])->name('product-edit')->middleware(['auth' , 'auth.role.admin']);

Route::post('/admin/product/update' , [AdminController::class , 'productUpdate'])->name('product-update')->middleware(['auth' , 'auth.role.admin']);

Route::get('/admin/product/delete/{id}' , [AdminController::class , 'productDelete'])->name('product-delete')->middleware(['auth' , 'auth.role.admin']);

//

Route::get('/admin/restaurant/list' , [AdminController::class , 'restaurantList'])->name('restaurant-list')->middleware(['auth' , 'auth.role.admin']);

Route::get('/admin/restaurant/create' , [AdminController::class , 'restaurantCreate'])->name('restaurant-create')->middleware(['auth' , 'auth.role.admin']);

Route::post('/admin/restaurant/insert' , [AdminController::class , 'restaurantInsert'])->name('restaurant-insert')->middleware(['auth' , 'auth.role.admin']);

Route::get('/admin/restaurant/edit/{id}' , [AdminController::class , 'restaurantEdit'])->name('restaurant-edit')->middleware(['auth' , 'auth.role.admin']);

Route::post('/admin/restaurant/update' , [AdminController::class , 'restaurantUpdate'])->name('restaurant-update')->middleware(['auth' , 'auth.role.admin']);

Route::get('/admin/restaurant/delete/{id}' , [AdminController::class , 'restaurantDelete'])->name('restaurant-delete')->middleware(['auth' , 'auth.role.admin']);

//

Auth::routes();

Route::get('/logout' , [LogoutController::class , 'logout'])->name('logout');


