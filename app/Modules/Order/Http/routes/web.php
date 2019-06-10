<?php
\Route::group([
                  'namespace' => 'App\Modules\Order\Http\Controllers\Admin\Api'
              ], function () {

    Route::get('/archive', 'ArchiveController@index')
         ->name('archive.overview');

    Route::get('/kitchen', 'KitchenController@index')
         ->name('kitchen.overview');;

#CONTENT#

});

\Route::group([
    'namespace' => 'App\Modules\Order\Http\Controllers'
              ], function () {

    Route::get('/objednavka', 'OrderController@detail');
    Route::get('/order/{capture?}', 'OrderController@detail');

});
