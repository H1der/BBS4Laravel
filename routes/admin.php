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
    });


});
