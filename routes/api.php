<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminCategoryApiController;
use App\Http\Controllers\AdminRestaurantApiController;
use App\Http\Controllers\AdminProductApiController;
use App\Http\Controllers\FrontApiController;
use App\Http\Controllers\UserApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::get('/Cars' , function() {
    // return ['Status' => 'hello world !' , 'Names' => ['ali' , 'reza' , 'mohsen']];
// });

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register' , [UserApiController::class , 'register']);

Route::post('/login' , [UserApiController::class , 'login']);

Route::get('/logout' , [UserApiController::class , 'logout'])->middleware('auth:sanctum');

//

Route::get('/admin/category' , [AdminCategoryApiController::class , 'index'])->middleware(['auth:sanctum' , 'auth.role.admin.json']);

Route::get('/admin/category/{id}' , [AdminCategoryApiController::class , 'show'])->middleware(['auth:sanctum' , 'auth.role.admin.json']);

Route::post('/admin/category' , [AdminCategoryApiController::class , 'create'])->middleware(['auth:sanctum' , 'auth.role.admin.json']);

Route::put('/admin/category/{id}' , [AdminCategoryApiController::class , 'update'])->middleware(['auth:sanctum' , 'auth.role.admin.json']);

Route::delete('/admin/category/{id}' , [AdminCategoryApiController::class , 'delete'])->middleware(['auth:sanctum' , 'auth.role.admin.json']);

//

Route::get('/admin/restaurant' , [AdminRestaurantApiController::class , 'index'])->middleware(['auth:sanctum' , 'auth.role.admin.json']);

Route::get('/admin/restaurant/{id}' , [AdminRestaurantApiController::class , 'show'])->middleware(['auth:sanctum' , 'auth.role.admin.json']);

Route::post('/admin/restaurant' , [AdminRestaurantApiController::class , 'create'])->middleware(['auth:sanctum' , 'auth.role.admin.json']);

Route::put('/admin/restaurant/{id}' , [AdminRestaurantApiController::class , 'update'])->middleware(['auth:sanctum' , 'auth.role.admin.json']);

Route::delete('/admin/restaurant/{id}' , [AdminRestaurantApiController::class , 'delete'])->middleware(['auth:sanctum' , 'auth.role.admin.json']);

//

Route::get('/admin/product' , [AdminProductApiController::class , 'index'])->middleware(['auth:sanctum' , 'auth.role.admin.json']);

Route::get('/admin/product/{id}' , [AdminProductApiController::class , 'show'])->middleware(['auth:sanctum' , 'auth.role.admin.json']);

Route::post('/admin/product' , [AdminProductApiController::class , 'create'])->middleware(['auth:sanctum' , 'auth.role.admin.json']);

Route::put('/admin/product/{id}' , [AdminProductApiController::class , 'update'])->middleware(['auth:sanctum' , 'auth.role.admin.json']);

Route::delete('/admin/product/{id}' , [AdminProductApiController::class , 'delete'])->middleware(['auth:sanctum' , 'auth.role.admin.json']);

//

Route::get('/restaurant/search/{q}' , [FrontApiController::class , 'searchRestaurant']);

Route::get('/front' , [FrontApiController::class , 'index']);

Route::get('/front/restaurant/{id}' , [FrontApiController::class , 'restaurant']);