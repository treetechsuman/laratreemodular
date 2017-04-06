<?php

Route::group(['middleware' => 'web', 'prefix' => 'admin/user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
    Route::get('/', 'UserController@index');
});
/*
|--------------------------------------------------------------------------
| RolePermission Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'web','prefix' => 'admin/user','namespace' => 'Modules\User\Http\Controllers'], function() { 
	Route::group(['prefix' => 'role-permission'], function() { 
		Route::get('/','RolePermissionController@index');
		Route::get('/create','RolePermissionController@create');
		Route::post('/store','RolePermissionController@store');
		Route::get('/{id}/edit','RolePermissionController@edit');
		Route::get('/{id}','RolePermissionController@show');
		Route::post('/update/{id}','RolePermissionController@update');
		Route::get('/delete/{id}','RolePermissionController@delete');
		//permission------
		//
		Route::get('/permission/create','RolePermissionController@createPermission');
		Route::post('/permission/store','RolePermissionController@storePermission');
		Route::get('/permission/{id}/edit','RolePermissionController@editPermission');
		Route::get('/permission/{id}','RolePermissionController@showPermission');
		Route::post('/permission/update/{id}','RolePermissionController@updatePermission');
		Route::get('/permission/delete/{id}','RolePermissionController@deletePermission');

		Route::post('/assign-permission','RolePermissionController@assignPermission');
	}); 
}); 
/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'web','prefix' => 'admin/user','namespace' => 'Modules\User\Http\Controllers'], function() { 
	Route::group(['prefix' => 'user'], function() { 
		Route::get('/','UserController@index');
		Route::get('/create','UserController@create');
		Route::post('/store','UserController@store');
		Route::get('/{id}/edit','UserController@edit');
		Route::get('/{id}','UserController@show');
		Route::post('/update/{id}','UserController@update');
		Route::get('/delete/{id}','UserController@delete');

		Route::get('/manage-user/{user_id}','UserController@manageUser');
		Route::post('/change-password','UserController@changePassword');
		
	});
	Route::get('/assign-role/{user_id}','UserController@assignRole');
	Route::post('/assign-role/','UserController@storeAssignRole'); 

	Route::get('/email-templete/{templete_name?}','UserController@emailTemplete');
	Route::get('/social-login/{templete_name?}','UserController@socialLogin');

	Route::post('/activate-user/','UserController@activateuser');

	Route::get('{provider}', 'SocialAuthController@redirectTo');
	Route::get('{provider}/callback', 'SocialAuthController@handleCallback'); 
}); 
/*
|--------------------------------------------------------------------------
| UserDetail Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'web','prefix' => 'admin/user','namespace' => 'Modules\User\Http\Controllers'], function() { 
	Route::group(['prefix' => 'userDetail'], function() { 
		Route::post('/store','UserDetailController@store');
		Route::post('/update/{id}','UserDetailController@update');
		Route::get('/delete/{id}','UserDetailController@delete');
	}); 
}); 
