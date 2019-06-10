<?php
//
//Route::group(['middleware' => ['assign.guard:api']], function () {
    Route::get('/{vue_capture?}', 'AdminController@index')
         ->where('vue_capture', '[\/\w\.-]*')
         ->name('dashboard');
//});

//Route::get('/', 'DashboardController@index')->name('dashboard');
//Route::resource('employee', 'EmployeeController');
