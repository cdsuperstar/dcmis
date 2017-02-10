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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::group(['prefix' => '/home/{layout}'], function () {
    Route::get('login', 'Auth\LoginController@showLoginForm');
    Route::get('dcviews/{view}', 'HomeController@views');
    Route::get('index', 'HomeController@index');
    Route::get('tpl/{tpl}', 'HomeController@tpl');
    Route::get('js/main', 'HomeController@jsMain');
    Route::get('testit','HomeController@testit');
});

Route::resource('dcmodels','dcmodel\dcmodelController');
Route::group(['prefix' => '/dcmodelopt'], function () {
    Route::get('tree','dcmodel\dcmodelController@getTree');
    Route::post('movenode','dcmodel\dcmodelController@postMovenode');
    Route::get('getModTree','dcmodel\dcmodelController@getModTree');
    Route::get('getModList','dcmodel\dcmodelController@getModList');
});

Route::resource('users', 'User\userController');
Route::group(['prefix' => '/useropt'], function () {
    Route::get('dcUser','User\userController@getLoginUser');
    Route::get('onlineusers','User\userController@getOnlineUsers');
});

Route::group(['prefix' => '/userprofile'], function () {
    Route::get('self','User\userprofileController@getSelfdata');
});
Route::resource('userprofiles', 'User\userprofileController');
Route::resource('roles','roleController');
Route::resource('permissions','permissionController');

Route::resource('unitgrps','unitgrpController');
Route::group(['prefix' => '/unitgrpopt'], function () {
    Route::get('tree','unitgrpController@getTree');
    Route::post('movenode','unitgrpController@postMovenode');
});

