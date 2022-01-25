<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
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
             
});
