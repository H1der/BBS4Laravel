<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About
> 基于 laravel 编写类简书式的 BBS 交流社区

## Install
1. 获取源代码
直接下载压缩包或者 git 克隆源代码
> git clone https://github.com/H1der/BBS4Laravel.git master

2.安装依赖扩展包
> composer install

3.生成配置文件(修改其中的配置选项:数据库的一定要修改)
> cp .env.example .env

4.使用安装命
> php artisan gps:install

5.使用 elasticsearch-analysis-ik 作为搜索引擎
> https://github.com/medcl/elasticsearch-analysis-ik

6.生成通知队列
> php artisan queue:work

Usage