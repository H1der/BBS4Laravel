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

//个人中心
Route::get('/user/{user}', 'UserController@show');
Route::post('/user/{user}/fan', 'UserController@fan');
Route::post('/user/{user}/unfan', 'UserController@unfan');

//文章搜索
Route::get('/posts/search', 'PostsController@search');
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
Route::get('/user/me/setting', 'UserController@setting');
//个人设置操作
Route::post('/user/me/setting', 'UserController@settingStore');

//文章资源
Route::resource('/posts', 'PostsController');

//提交评论
Route::post('/posts/{post}/comment', 'PostsController@comment');

//图片上传
Route::post('posts/image/upload', 'PostsController@imageUpload');

//文章点赞
Route::get('/posts/{post}/zan', 'PostsController@zan');
//取消点赞
Route::get('/posts/{post}/unzan', 'PostsController@unzan');

//专题详情页
Route::get('/topic/{topic}', 'TopicController@show');
//投稿
Route::post('/topic/{topic}/submit', 'TopicController@submit');

//通知
Route::get('/notices', 'NoticeController@index');

include_once('admin.php');