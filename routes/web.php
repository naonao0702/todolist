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

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('todo/create', 'Admin\TodoController@add');
    Route::post('todo/create', 'Admin\TodoController@create'); # 追記
    Route::get('todo', 'Admin\TodoController@index'); // 追記
    Route::get('todo/edit', 'Admin\TodoController@edit'); // 追記
    Route::post('todo/edit', 'Admin\TodoController@update');
    Route::get('todo/complete', 'Admin\TodoController@complete');
    Route::get('todo/complete_list', 'Admin\TodoController@complete_list');
    Route::get('todo/incomplete', 'Admin\TodoController@incomplete');
    Route::get('todo/delete', 'Admin\TodoController@delete');
    Route::get('todo/dead_list', 'Admin\TodoController@dead_list');
    Route::get('todo/sort', 'Admin\TodoController@sort');








 // 追記

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
