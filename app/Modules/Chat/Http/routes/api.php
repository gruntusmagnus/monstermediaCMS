<?php
\Route::group([
                  'namespace'  => 'App\Modules\Chat\Http\Controllers',
                  'middleware' => ['jwt.auth'],
              ], function () {

    Route::get('/api/chat', 'Api\ChatController@index')
         ->name('api.chat.overview');

    Route::get('/api/chat/{chat}/messages', 'Api\MessageController@index')
         ->name('api.messages.overview');
    Route::post('/api/chat/{chat}/read', 'Api\MessageController@read')
         ->name('api.messages.read');
    Route::post('/api/chat/{chat}/messages', 'Api\MessageController@create')
         ->name('api.messages.create');
    #CONTENT#

});