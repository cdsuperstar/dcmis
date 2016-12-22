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

//Route::get('/home/{layout}', 'HomeController');
Route::get('/logout', 'Auth\LoginController@logout');
Route::group(['prefix' => '/home/{layout}'], function () {
    Route::get('index', 'HomeController@index');
    Route::get('tpl/{tpl}', 'HomeController@tpl');
    Route::get('js/main', 'HomeController@jsMain');
});


//Route::controllers([
//    'auth' => 'Auth\AuthController',
//    'password' => 'Auth\PasswordController',
//    'dcassets'=>'dcResController',
//    'user'=>'User\userController',
//    'dcmodel'=>'dcmodel\dcmodelController',
//    'pxunit'=>'pxunit\pxunitController',
//    'sysmsg'=>'sysmsg\sysmsgController',
//    'userprofile'=>'User\userprofileController',
//]);