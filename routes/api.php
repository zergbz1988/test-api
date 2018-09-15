<?php

use App\Category;
use App\Http\Resources\{Category as CategoryResource, Product as ProductResource};

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
Route::post('login', 'AuthController@login')->name('login');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'AuthController@logout');
});

Route::get('/categories', function () {
    return CategoryResource::collection(Category::all());
});

Route::get('/categories/{category}/products', function (Category $category) {
    return ProductResource::collection($category->products);
});

