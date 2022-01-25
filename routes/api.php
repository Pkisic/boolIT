<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ExportsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/categories')->group(function() {

    Route::get('/',
    [CategoriesController::class, 'allCategories'])
    ->name('all.categories');

    Route::post('/update/{category}',
    [CategoriesController::class, 'update'])
    ->name('update.categories')
    ->missing(function(Request $request){
        return response()->json(["Missing requested category"]);
    });

    Route::post('/delete/{category}',
    [CategoriesController::class , 'delete'])
    ->name('admin.users.delete')
    ->missing(function(Request $request){
        return response()->json(["Missing requested category"]);
    });
              
});

Route::prefix('/products')->group(function() {

    Route::get('/',
    [ProductsController::class, 'allProducts'])
    ->name('all.products');

    Route::get('/category/{category}',
    [ProductsController::class,'categoryProducts'])
    ->name('category.products')
    ->missing(function(Request $request){
        return response()->json(["Missing or unavailable category!"]);
    });

    Route::post('/update/{product}',
    [ProductsController::class, 'update'])
    ->name('update.product')
    ->missing(function(Request $request){
        return response()->json(["Missing or unavailable product!"]);
    });

    Route::post('/delete/{product}',
    [ProductsController::class],'delete')
    ->name('delete.product')
    ->missing(function(Request $request){
        return response()->json(["Missing or unavailable product!"]);
    });
             
});

Route::prefix('/csv')->group(function() {
    Route::get('/products/category/{category}',
    [ExportsController::class, 'exportProductsCategory'])
    ->missing(function(){
        return redirect(route('all.products'));
    });
});
