<?php
\Route::group([
             //'prefix'     => 'catalog',
             'middleware' => ['auth'],
             'namespace'  => 'App\Modules\Catalog\Http\Controllers'
         ], function () {

	    Route::get('/produkt/{id}', 'ProductController@show')
         ->name('product.overview');

        Route::get('/', 'CategoryController@index')
         ->name('category.overview');

        Route::get('/kategorie/{id}','CategoryController@show')
        ->name('category.show');

#CONTENT#


});
