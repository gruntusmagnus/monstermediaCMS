<?php
/**
 * Created by PhpStorm.
 * User: vojtech
 * Date: 7.5.19
 * Time: 21:58
 */

//zatím se nepoužívá

    Route::group(['namespace' => 'App\Modules\Catalog\Http\Controllers\Admin\Api', 'prefix' => 'api', 'middleware' => ['jwt.auth']], function () {
        Route::apiResource('category', 'CategoryController');
        Route::get('/produkt/{id}', 'ProductController@modal')
            ->name('product.modal');

    });
