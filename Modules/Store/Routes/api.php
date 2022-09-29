<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*...*/
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

Route::middleware('auth:api')->get('/store', function (Request $request) {
    return $request->user();
});

// Route::prefix('api')
//     ->group(function () {
//         Route::get('/index', 'AdminApiController@index');
//     });
// Route::prefix('api')->group(function () {
//     Route::get('/', 'AdminApiController@index');
// });

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminApiController@index');
    Route::get('/show', 'AdminApiController@show');
    Route::get('/post-id', 'AdminApiController@postIdUser');
    Route::match(['get', 'post'], '/store', 'AdminApiController@store');
    Route::put('/update/{id}', 'AdminApiController@update');
    Route::delete('/delete/{id}', 'AdminApiController@delete');
});

Route::prefix('authen')->group(function () {
    Route::get('/', 'UserController@index');
    Route::match(['get', 'post'], '/store', 'UserController@store');
    Route::match(['get', 'post'], 'UserController@getIdUser');
    Route::match(['get', 'post'], '/login', 'UserController@login')->name('login');
    Route::put('/update/{id}', 'UserController@update');
    Route::delete('/delete/{id}', 'UserController@delete');
});
