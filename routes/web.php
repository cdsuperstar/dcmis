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
    Route::get('testit','HomeController@testit');
});

//模块管理
Route::group(['prefix' => '/sys-model'], function () {
    //得到全部model
    Route::get('','dcmodel\dcmodelController@index'); //->middleware(['permission:BrycenxKoepp']); //->middleware('role:Jayceex Medhurst MD');
    Route::get('create','dcmodel\dcmodelController@create');
    Route::put('{dcmodel}','dcmodel\dcmodelController@update');
    Route::delete('{dcmodel}','dcmodel\dcmodelController@destroy');

    Route::get('tree','dcmodel\dcmodelController@getTree');
    Route::post('movenode','dcmodel\dcmodelController@postMovenode');
    Route::get('getModTree','dcmodel\dcmodelController@getModTree');
    Route::get('getModList','dcmodel\dcmodelController@getModList');
});

//用户管理
Route::group(['prefix' => '/sys-users'], function () {
    //得到全部用户
    Route::get('','User\userController@index');
    Route::get('create','User\userController@create');
    Route::put('{dcmodel}','User\userController@update');
    Route::delete('{dcmodel}','User\userController@destroy');

    Route::get('dcUser','User\userController@getLoginUser');
    Route::get('onlineusers','User\userController@getOnlineUsers');
});

//用户个人信息
Route::group(['prefix' => '/sys-usersown'], function () {
    //得到自己信息
    Route::get('self','User\userprofileController@getSelfdata');
});

//角色管理
Route::group(['prefix' => '/sys-role'], function () {
    //得到自己信息
    Route::get('','roleController@index');
    Route::get('create','roleController@create');
    Route::put('{dcmodel}','roleController@update');
    Route::delete('{dcmodel}','roleController@destroy');
});

//权限管理
Route::group(['prefix' => '/sys-privilege-management'], function () {
    //得到自己信息
    Route::get('','permissionController@index');
    Route::get('create','permissionController@create');
    Route::put('{dcmodel}','permissionController@update');
    Route::delete('{dcmodel}','permissionController@destroy');
});

//机构设置
Route::group(['prefix' => '/user-department'], function () {
    Route::get('','unitgrpController@index');
    Route::get('create','unitgrpController@create');
    Route::put('{dcmodel}','unitgrpController@update');
    Route::delete('{dcmodel}','unitgrpController@destroy');

    Route::get('tree','unitgrpController@getTree');
    Route::post('movenode','unitgrpController@postMovenode');
    Route::post('setmember','unitgrpController@postSetMember'); //参数1为机构 参数2为用户
});

//消息
Route::group(['prefix' => '/sys-msg'], function () {
    //得到自己信息
    Route::get('', 'usermsgController@index');
    Route::get('create', 'usermsgController@create');
    Route::put('{dcmodel}', 'usermsgController@update');
    Route::delete('{dcmodel}', 'usermsgController@destroy');

    Route::get('unreadmsgs','usermsgController@getUnreadMsgs');
});