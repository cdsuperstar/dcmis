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
    Route::get('','dcmodel\dcmodelController@index')->middleware(['permission:sys-model.allmodels']); //->middleware(['permission:sys-model.allmodels']);; //->middleware(['permission:BrycenxKoepp']); //->middleware('role:Jayceex Medhurst MD');
    Route::get('create','dcmodel\dcmodelController@create')->middleware(['permission:sys-model.create']); //sys-model.create
    Route::put('{id}','dcmodel\dcmodelController@update')->middleware(['permission:sys-model.update']); //sys-model.update
    Route::post('','dcmodel\dcmodelController@store')->middleware(['permission:sys-model.store']); //sys-model.store
    Route::delete('{id}','dcmodel\dcmodelController@destroy')->middleware(['permission:sys-model.delete']); //sys-model.delete
    //得到模块树
    Route::get('tree','dcmodel\dcmodelController@getTree')->middleware(['permission:sys-model.gettree']); //sys-model.gettree
    //移动节点
    Route::post('movenode','dcmodel\dcmodelController@postMovenode')->middleware(['permission:sys-model.movenode']); //sys-model.movenode
    //得到mod树 菜单
    Route::get('getModTree','dcmodel\dcmodelController@getModTree'); //sys-model.modtree
    //得到mod列表
    Route::get('getModList','dcmodel\dcmodelController@getModList'); //sys-model.modlist
});

//用户管理
Route::group(['prefix' => '/sys-users'], function () {
    //得到全部用户
    Route::get('','User\userController@index')->middleware(['permission:sys-users.allusers']); //sys-users.allusers
//    Route::get('','User\userController@getUsersByUnitgrpOrEmptyunitgrp');  //sys-users.unitgrporempty
    Route::get('create','User\userController@create')->middleware(['permission:sys-users.create']); //sys-users.create
    Route::put('{id}','User\userController@update')->middleware(['permission:sys-users.update']); //sys-users.update
    Route::post('','User\userController@store')->middleware(['permission:sys-users.store']); //sys-users.store
    Route::delete('{user}','User\userController@destroy')->middleware(['permission:sys-users.destroy']); //sys-users.destroy

    //得到用户参数
    Route::get('userperms','User\userController@getUserPerms');
    //得到登录用户详细信息
    Route::get('dcUser','User\userController@getLoginedUser')->middleware(['permission:sys-users.logineduser']); //sys-users.logineduser
    //得到在线用户
    Route::get('onlineusers','User\userController@getOnlineUsers')->middleware(['permission:sys-users.onlineusers']); //sys-users.onlineusers
});

//用户个人信息
Route::group(['prefix' => '/sys-usersown'], function () {
    //得到所有用户配置信息
    Route::get('','User\userprofileController@index');
    //得到自己信息
    Route::get('self','User\userprofileController@show')->middleware(['permission:sys-usersown.selfdata']); //sys-usersown.selfdata
    //保存用户个人信息
    Route::post('','User\userprofileController@store');
    //保存用户配置信息
    Route::put('{id}','User\userprofileController@update')->middleware(['permission:sys-users.update']); //sys-users.update
});

//预算管理
Route::group(['prefix'=>'/am-budget-management'],function(){
    Route::get('','ambudgetController@index');
    Route::get('create','ambudgetController@create');
    Route::put('{ambudget}','ambudgetController@update');
    Route::post('','ambudgetController@store@store');
    Route::delete('{ambudget}','ambudgetController@destroy@destroy');

});


//角色管理
Route::group(['prefix' => '/sys-role'], function () {
    //得到自己信息
    Route::get('','roleController@index')->middleware(['permission:sys-role.allroles']); //sys-role.allroles
    Route::get('create','roleController@create')->middleware(['permission:sys-role.create']); //sys-role.create
    Route::post('','roleController@store')->middleware(['permission:sys-role.store']); //sys-role.store
    Route::post('{role}/{dcmodels}','roleController@postSetModels');

    //得到角色所拥有模块
    Route::get('{role}/rolemodels','roleController@getRoleModels');
    //得到角色所拥有权限
    Route::get('{role}/roleperms','roleController@getRolePerms');
    //根据模块id得到权限
    Route::get('getListByModel/{dcmodel}','roleController@getListByModel');
    //设置角色权限
    Route::post('setPermOfRole/{action}/{role}/{permission}','roleController@setPermOfRole');

    Route::put('{dcmodel}','roleController@update')->middleware(['permission:sys-role.update']); //sys-role.update
    Route::delete('{dcmodel}','roleController@destroy')->middleware(['permission:sys-role.destroy']); //sys-role.destroy
});

//权限管理
Route::group(['prefix' => '/sys-privilege-management'], function () {
    //得到自己信息
    Route::get('','permissionController@index')->middleware(['permission:sys-privilege-management.allperms']); //sys-privilege-management.allperms

    Route::get('create','permissionController@create')->middleware(['permission:sys-privilege-management.create']); //sys-privilege-management.create
    Route::put('{permission}','permissionController@update')->middleware(['permission:sys-privilege-management.update']); //sys-privilege-management.update
    Route::post('','permissionController@store')->middleware(['permission:sys-privilege-management.store']);//sys-privilege-management.store
    Route::delete('{permission}','permissionController@destroy')->middleware(['permission:sys-privilege-management.destroy']);//sys-privilege-management.destroy
});

//机构设置
Route::group(['prefix' => '/user-department'], function () {
    Route::get('','unitgrpController@index')->middleware(['permission:user-department.allunits']); // user-department.allunits
    Route::get('create','unitgrpController@create')->middleware(['permission:user-department.create']); // user-department.create
    Route::put('{dcmodel}','unitgrpController@update')->middleware(['permission:user-department.update']); // user-department.update
    Route::post('','unitgrpController@store')->middleware(['permission:user-department.store']); //user-department.store
    Route::delete('{permission}','unitgrpController@destroy')->middleware(['permission:user-department.destroy']); // user-department.destroy

    //得到机构的树形
    Route::get('tree','unitgrpController@getTree')->middleware(['permission:user-department.tree']); // user-department.tree
    //移动节点
    Route::post('movenode','unitgrpController@postMovenode')->middleware(['permission:user-department.movenode']); // user-department.movenode
    //设置为成员
    Route::post('setmember','unitgrpController@postSetMember')->middleware(['permission:user-department.setmember']);  // user-department.setmember  //参数1为机构 参数2为用户
});

//预算类别
Route::group(['prefix'=>'/am-budget-lb'],function(){
    Route::get('','ambudgettypeController@index'); //
    Route::get('create','ambudgettypeController@create'); //
    Route::put('{ambudgettype}','ambudgettypeController@update'); //
    Route::post('','ambudgettypeController@store'); //
    Route::delete('{ambudgettype}','ambudgettypeController@destroy'); //
});

// 物资目录
Route::group(['prefix'=>'/icon-basket-setindex'],function(){
    Route::get('','ambaseasController@index'); //
    Route::get('create','ambaseasController@create'); //
    Route::put('{ambaseas}','ambaseasController@update'); //
    Route::post('','ambaseasController@store'); //
    Route::delete('{ambaseas}','ambaseasController@destroy'); //
});

// 供应商目录
Route::group(['prefix'=>'/icon-basket-setsupplier'],function(){
    Route::get('','amsupplierController@index'); //
    Route::get('create','amsupplierController@create'); //
    Route::put('{amsupplier}','amsupplierController@update'); //
    Route::post('','amsupplierController@store'); //
    Route::delete('{amsupplier}','amsupplierController@destroy'); //
});

//消息
Route::group(['prefix' => '/sys-msg'], function () {
    //得到自己信息
    Route::get('', 'usermsgController@index')->middleware(['permission:sys-msg.allmsgs']); //sys-msg.allmsgs
    Route::get('create', 'usermsgController@create')->middleware(['permission:sys-msg.create']); //sys-msg.create
    Route::delete('{dcmodel}', 'usermsgController@destroy')->middleware(['permission:sys-msg.destroy']); //sys-msg.destroy

    //得到未读信息
    Route::get('unreadmsgs','usermsgController@getUnreadMsgs')->middleware(['permission:sys-msg.unreadmsgs']); //sys-msg.unreadmsgs
});

// Debug all sqls
DB::listen(function ($event) {
    Log::info($event->sql);
    Log::info($event->bindings);
});