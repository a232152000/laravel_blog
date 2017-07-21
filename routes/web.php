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



Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::any('admin/login', 'Admin\LoginController@login');//使用者後台登入頁面
    Route::get('admin/code', 'Admin\LoginController@code');//使用者後台登入頁面的隨機驗證碼

});


Route::group(['middleware' => ['web','admin.login'] , 'prefix' => 'admin' , 'namespace' => 'Admin'], function () {
    Route::get('index', 'IndexController@index');//使用者後台成功頁面
    Route::get('info', 'IndexController@info');//使用者後台成功頁面index info的模板
    Route::get('quit', 'LoginController@quit');//使用者後台離開返回登入頁面
    Route::any('pass', 'IndexController@pass');//使用者後台登入頁面的修改密碼

    Route::post('cate/changeorder', 'CategoryController@changeOrder');//文章分類頁面更改排序
    Route::resource('category', 'CategoryController');//文章分類頁面

    Route::resource('article', 'ArticleController');//文章頁面

    Route::resource('links', 'LinksController');//友情鏈結頁面
    Route::post('links/changeorder', 'LinksController@changeOrder');//友情鏈結頁面更改排序
    Route::resource('navs', 'NavsController');//自定義導航模板
    Route::post('navs/changeorder', 'NavsController@changeOrder');//自定義導航頁面更改排序
    Route::post('config/changecontent', 'ConfigController@changeContent');//配置項頁面之配置值修改
    Route::post('config/changeorder', 'ConfigController@changeOrder');//配置項頁面更改排序
    Route::resource('config', 'ConfigController');//自定義導航模板

    Route::any('upload', 'CommonController@upload');//文章頁面上傳文件
});
