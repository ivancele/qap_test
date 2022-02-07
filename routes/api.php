<?php

use App\Http\Controllers\Api\CartApiController;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Product
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Transaction Type
    Route::apiResource('transaction-types', 'TransactionTypeApiController', ['except' => ['show', 'destroy']]);
});

Route::middleware('auth:sanctum')->post('/cart/add-to-cart', [CartApiController::class, 'addItem']);
Route::middleware('auth:sanctum')->post('/cart/remove-from-cart', [CartApiController::class, 'removeItem']);