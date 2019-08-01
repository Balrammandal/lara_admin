<?php
Route::group(['as'=>'admin::','prefix'=>'cpanel/admin','middleware' => ['web','AdminMiddleWare','revalidate']], function () {

    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'Admin\Dashboard\DashboardController@dashboard']);
    Route::get('changePassForm', ['as' => 'changePassForm', 'uses' => 'Admin\AdminController@changePassForm']);
    Route::post('ChangePass', ['as' => 'ChangePass', 'uses' => 'Admin\AdminController@ChangePass']);
    Route::get('profile/{id}', ['as' => 'profile', 'uses' => 'Admin\AdminController@profile']);
    Route::post('update-profile', ['as' => 'updateProfile', 'uses' => 'Admin\AdminController@updateProfile']);

    /* Users route start*/
    Route::get('manage-user', ['as'=>'manageUser' ,'uses'=>'Admin\User\UserController@index']);
    Route::get('add-user', ['as' => 'addUser', 'uses' => 'Admin\User\UserController@addUser']);
    Route::post('save-user', ['as' => 'saveUser', 'uses' => 'Admin\User\UserController@saveUser']);
    Route::get('edit-user-form/{id}', ['as' => 'editUserForm', 'uses' => 'Admin\User\UserController@editUserForm']);
    Route::post('edit-user', ['as' => 'editUser', 'uses' => 'Admin\User\UserController@editUser']);
    Route::get('del-user/{id}', ['as' => 'delUser', 'uses' => 'Admin\User\UserController@delUser']);
    Route::post('active-inactive-user/', ['as' => 'active_inactive_user', 'uses' => 'Admin\User\UserController@active_inactive_user']);
    /* Users route end*/

});