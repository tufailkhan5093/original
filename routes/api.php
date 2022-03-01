<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('register',[\App\Http\Controllers\AuthController::class,'register']);
Route::post('loginn',[\App\Http\Controllers\AuthController::class,'login']);

Route::group([
    'middleware' => 'auth:api'
  ], function() {
    Route::get('logout',[\App\Http\Controllers\AuthController::class,'logout']);
    Route::post('addcategory',[\App\Http\Controllers\CategoryController::class,'addcategory']);
    Route::get('all_categories',[\App\Http\Controllers\CategoryController::class,'all_categories']);
    Route::get('all_products',[\App\Http\Controllers\ProductController::class,'all_products']);
    Route::get('delete_product/{id}',[\App\Http\Controllers\ProductController::class,'delete_product']);
    Route::post('addproduct',[\App\Http\Controllers\ProductController::class,'addproduct']);
});