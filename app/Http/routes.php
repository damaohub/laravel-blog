<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::group(['middleware'=>['']],function(){
    //还真是网上所说！web中间件从laravel5.2.27版本以后默认全局加载，不需要自己手动载入，如果自己子手动重复载入，会导致session无法加载的情况。
Route::group(['namespace'=>'Home'],function(){
    Route::get('/','IndexController@index');
    //Route::post('home/pagenum','IndexController@pageNum');
    Route::get('/a/{aid}','IndexController@art');
    Route::get('/a','IndexController@artList');
    Route::get('/cate/{cate_id}','IndexController@cate');
});


    Route::any('admin/login','Admin\LoginController@login');
    Route::get('admin/code','Admin\LoginController@code');

Route::group(['middleware'=>['admin.login'],'prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::get('index','IndexController@index');
    Route::get('info','IndexController@info');
    Route::get('quit','LoginController@quit');
    Route::any('pass','IndexController@pass');
    Route::post('cate/changeOrder','CategoryController@changeOrder');
    Route::resource('category','CategoryController');
    Route::resource('article','ArticleController');

    Route::resource('links','LinksController');
    Route::post('links/changeOrder','LinksController@changeOrder');

    Route::resource('navs','NavsController');
    Route::post('navs/changeOrder','NavsController@changeOrder');

    //同一个控制器的资源路由放到最后，否则回报关于控制器内restfull方法不全的错？
    Route::post('config/changeOrder','ConfigController@changeOrder');
    Route::post('config/changecontent','ConfigController@changeContent');
    Route::get('config/putfile','ConfigController@putFile');
    Route::resource('config','ConfigController');


    Route::any('upload','CommonController@upload');
});


//});