<?php
\Route::group([
                 'prefix'     => 'log',
                 'namespace'  => 'App\Modules\Log\Http\Controllers\Admin\Api'
             ], function () {

	    Route::get('/log', 'LogController@index')
         ->name('log.overview');

#CONTENT#


});