<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [ 'as' => 'login', 'uses' => 'Master\AuthController@login']);
Route::post('logout', [ 'as' => 'logout', 'uses' => 'Master\AuthController@logout']);

Route::group(['middleware' => 'jwt.verify'], function () {

 Route::resource('menu', 'Master\MenuController');
 Route::resource('role', 'Master\RoleController');
 Route::resource('resp', 'Master\RespController');
 Route::resource('menu_detail', 'Master\MenuDetailController');
 Route::resource('user', 'Master\AuthController', ['only' => ['index', 'show', 'update', 'destroy']]);

 Route::post('register', 'Master\AuthController@register');
 Route::get('userProfile', 'Master\AuthController@userProfile');

});




