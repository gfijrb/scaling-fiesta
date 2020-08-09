<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    //throw new Error('gewdf');
   return [
       'result' => 'Api documentation can be found on resource http:\/\/example.com'
   ];
});

// APP
Route::prefix('category')->group(function () {
    Route::match(['post'], '/store', 'CategoryController@create');
    Route::match(['get'], '/all', 'CategoryController@read');
    Route::match(['put'], '/edit', 'CategoryController@update');
    Route::match(['delete'], '/destroy', 'CategoryController@delete');
});

Route::prefix('product')->group(function () {
    Route::match(['post'], '/store', 'ProductController@create');
    Route::match(['get'], '/all', 'ProductController@read');
    Route::match(['put'], '/edit', 'ProductController@update');
    Route::match(['delete'], '/destroy', 'ProductController@delete');

    Route::match(['delete'], '/search', 'ProductController@delete');
});

// fallback
Route::fallback(function() {
    return response()->json([
            'message' => 'Resource not exist.'
        ],
        404
    );
});


