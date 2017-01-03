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
    Route::get('login', 'HomeController@login');
    Route::get('dcviews/{view}', 'HomeController@views');
    Route::get('index', 'HomeController@index');
    Route::get('tpl/{tpl}', 'HomeController@tpl');
    Route::get('js/main', 'HomeController@jsMain');
});

Route::group(['prefix'=>'/dcmodel'],function(){
    Route::get('list','dcmodel\dcmodelController@getList');
    Route::get('data/{id}','dcmodel\dcmodelController@getData');
    Route::get('movenode','dcmodel\dcmodelController@postMovenode');
    Route::get('tree','dcmodel\dcmodelController@getTree');
    Route::get('edition','dcmodel\dcmodelController@getEdition');
});
Route::resource('users', 'User\userController');
/*
Route::group(['prefix'=>'/user'],function(){
    Route::get('data/{id}','User\userController@getData');
    Route::get('list','User\userController@getList');
    Route::get('putUserpwd','User\userController@postUserpwd');
    Route::get('postData','User\userController@postData');
    Route::get('putData','User\userController@putData');
    Route::get('delete/{id}','User\userController@deleteData');
});
*/

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