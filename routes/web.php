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

//文章列表页
Route::get('/posts','PostsController@index');
//文章详情页
Route::get('/posts/{post}','PostsController@show');
//创建文章
Route::get('/posts/create','PostsController@create');
Route::post('/posts','PostsController@store');
//编辑文章
Route::get('/posts/{post}/edit','PostsController@edit');
Route::put('/posts/{post}','PostsController@update');
//删除文章
Route::get('/posts/delete','PostsController@delete');