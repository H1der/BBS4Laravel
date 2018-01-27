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
//用户模块
//注册页面
Route::get('/register', 'RegisterController@index');
//注册行为
Route::post('/register', 'RegisterController@register');
//登陆页面
Route::get('/login', 'LoginController@index');
//登陆行为
Route::post('login', 'LoginController@login');
//退出
Route::get('logout', 'LoginController@logout');
//个人设置
Route::get('/user/my/setting', 'UserController@setting');
//个人设置操作
Route::post('/user/my/setting', 'UserController@settingStore');

//文章资源
Route::resource('/posts', 'PostsController');
//图片上传
Route::post('posts/image/upload', 'PostsController@imageUpload');
