<?php
\Route::group([
    'prefix' => 'api/vento',
    'namespace' => 'App\Modules\ApiVento\Http\Controllers'
], function () {

    Route::get('/products', 'ApiVentoController@indexProducts');

#CONTENT#

});
