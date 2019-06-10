<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::group(['middleware' => ['assign.guard:api']], function () {

Route::get('/me', 'Api\MeController@index')->middleware('jwt.auth');

Route::post('admin/auth/login', 'Admin\Api\TokenController@create');

Route::post('admin/auth/reset-password', 'Admin\Api\PasswordResetController@sendPasswordResetLink');
Route::post('admin/auth/reset/password', 'Admin\Api\PasswordResetController@callResetPassword');

Route::group(['namespace' => 'Admin\Api', 'middleware' => ['admin']], function () {

    Route::get('admin/auth/refresh', 'TokenController@refresh');
    Route::delete('admin/auth/logout', 'TokenController@destroy');

    Route::resource('menu', 'MenuController');
    Route::apiResource('employee', 'EmployeeController');
    Route::apiResource('user', 'UserController');
    Route::apiResource('userGroup', 'UserGroupController');
    Route::apiResource('employeeGroup', 'EmployeeGroupController');
});
//});

//moduly
Route::group(['middleware' => ['jwt.auth', 'api.role:employee']], function () {

    // @todo presunout do modulu!

    Route::group(['namespace'  => '\App\Modules\Catalog\Http\Controllers\Admin\Api',
                  'middleware' => ['jwt.auth:employee']
                 ], function () {
        Route::apiResource('category', 'CategoryController');
        Route::apiResource('product', 'ProductController');
    });

    Route::group(['namespace'  => '\App\Modules\Log\Http\Controllers\Admin\Api',
                  'middleware' => ['jwt.auth:employee']
                 ], function () {
        Route::apiResource('log', 'LogController');
    });

    Route::group(['namespace'  => '\App\Modules\Order\Http\Controllers\Admin\Api',
                  'middleware' => ['jwt.auth:employee']
                 ], function () {
        Route::apiResource('archive', 'ArchiveController');
        Route::apiResource('order', 'KitchenController');
    });
});

Route::fallback(function () {
    return response()->json(['message' => ['message' => 'Page Not Found. If problem persists contact info@monstermedia.cz']], 404);
});

