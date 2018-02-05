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

        Route::group(['middleware' => 'can:system'], function () {

            //管理人员模块
            Route::get('/users', 'UserController@index');
            Route::get('/users/create', 'UserController@create');
            Route::post('/users/store', 'UserController@store');
            Route::get('/users/{user}/role', 'UserController@role');
            Route::post('/users/{user}/role', 'UserController@storeRole');

            //角色
            Route::get('roles', 'RoleController@index');
            Route::get('roles/create', 'RoleController@create');
            Route::post('roles/store', 'RoleController@store');
            Route::get('/roles/{role}/permission', 'RoleController@permission');
            Route::post('/roles/{role}/permission', 'RoleController@storePermission');

            //权限
            Route::get('/permissions', 'PermissionController@index');
            Route::get('/permissions/create', 'PermissionController@create');
            Route::post('/permissions/store', 'PermissionController@store');
        });


        Route::group(['middleware' => 'can:post'], function () {
            //审核模块

            Route::get('/posts', 'PostsController@index');
            Route::post('/posts/{post}/status', 'PostsController@status');
        });


    });


});
