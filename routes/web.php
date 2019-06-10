<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

//Route::view('/', 'welcome');
//Route::view('/', 'home')->middleware('auth:web');

Route::get('download/file/{modelName}/{fileId}','FileController@downloadFile');
Route::get('delete/file/{modelName}/{fileId}','FileController@deleteFile');

Route::get('img/{imageId}/{slug}', 'ImageController@show');
Route::get('download/image/{modelName}/{fileId}','ImageController@downloadImage');
Route::get('delete/image/{modelName}/{fileId}','ImageController@deleteImage');

Route::get('language','LanguageController@setLanguage');
Route::get('language/{isoCode}','LanguageController@saveLanguage');


