<?php
\Route::group([
                 'prefix'     => 'contentpage',
                 'namespace'  => 'App\Modules\ContentPage\Http\Controllers'
             ], function () {

	    Route::get('/', 'ContentPageController@index')
         ->name('contentpage.overview');

#CONTENT#




});

\Route::group([
                     'prefix'     => 'admin/contentpage',
                     'namespace'  => 'App\Modules\ContentPage\Http\Controllers\Admin',
                     'middleware' => ['admin']
                 ], function () {

    Route::get('/', 'PageController@index')
         ->name('contentpage.index');
});