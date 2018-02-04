<?php
//管理后台
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    //登陆展示页面
    Route::get('/login', 'LoginController@index')->name('login');

    //登陆行为
    Route::post('/login', 'LoginController@login');

    //退出行为
    Route::get('/logout', 'LoginController@logout');

    Route::group(['middleware' => 'auth:admin'], function () {
        //首页
        Route::get('/home', 'HomeController@index');
        //管理人员模块
        Route::get('/users', 'UserController@index');
        Route::get('/users/create', 'UserController@create');
        Route::post('/users/store', 'UserController@store');

        //审核模块
        Route::get('/posts', 'PostsController@index');
        Route::post('/posts/{post}/status', 'PostsController@index');

    });


});
