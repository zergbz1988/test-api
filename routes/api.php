<?php

use App\Category;
use App\Http\Resources\{Category as CategoryResource, Product as ProductResource};


/**
 * Get all categories
 */
Route::get('/categories', function () {
    return response()->json([
            'status' => 'ok',
            'categories' => CategoryResource::collection(Category::all())
        ]
    );
});

/**
 * Get all products by category
 */
Route::get('/categories/{category}/products', function (Category $category) {
    return response()->json([
            'status' => 'ok',
            'id' => $category->id,
            'products' => ProductResource::collection($category->products)
        ]
    );
});

/**
 * Authorizes user
 */
Route::post('login', 'AuthController@login')->name('login');

/**
 * Only for authorized users
 */
Route::group(['middleware' => 'auth:api'], function () {
    /**
     * Revokes user's token
     */
    Route::post('logout', 'AuthController@logout');

    Route::put('/products', 'ProductController@store');
    Route::patch('/products/{product}', 'ProductController@update');
    Route::delete('/products/{product}', 'ProductController@destroy');

    Route::put('/categories', 'CategoryController@store');
    Route::patch('/categories/{category}', 'CategoryController@update');
    Route::delete('/categories/{category}', 'CategoryController@destroy');
});




