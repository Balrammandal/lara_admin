<?php
Route::get('admin', ['as' => 'admin', 'uses' => 'Admin\AdminController@index']);

Route::post('login', ['as'=>'login' ,'uses'=>'Admin\AdminController@Check_login']);

Route::get('logout', ['as' => 'logout', 'uses' => 'Admin\AdminController@logout']);
