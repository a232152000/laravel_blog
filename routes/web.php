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



Route::group(['middleware' => 'web'], function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::any('admin/index', 'Admin\IndexController@index');//使用者後台成功頁面
    Route::any('admin/info', 'Admin\IndexController@info');//使用者後台成功頁面index info的模板

    Route::any('admin/login', 'Admin\LoginController@login');//使用者後台登入頁面
    Route::get('admin/code', 'Admin\LoginController@code');//使用者後台登入頁面的隨機驗證碼

});


Route::group(['middleware' => ['web','admin.login'] , 'prefix' => 'admin' , 'namespace' => 'Admin'], function () {
    Route::any('index', 'IndexController@index');//使用者後台成功頁面
    Route::any('info', 'IndexController@info');//使用者後台成功頁面index info的模板
    Route::any('quit', 'LoginController@quit');//使用者後台離開返回登入頁面
});
