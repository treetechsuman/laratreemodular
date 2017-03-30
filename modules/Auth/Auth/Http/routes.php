<?php

Route::group(['middleware' => 'web', 'prefix' => 'auth', 'namespace' => 'Modules\Auth\Http\Controllers'], function()
{
    Route::get('/', 'AuthController@index');
    Route::get('/home', 'AuthController@home')->middleware('pass-me');
    Route::get('/sendverification', 'AuthController@sendVerification');
    Route::post('/send-verification-email', 'AuthController@sendVerificationEmail');
    Route::get('/profile', 'AuthController@profile');
    Route::get('/setting', 'AuthController@setting');
    Route::post('/update', 'AuthController@update');
    Route::post('/change-password', 'AuthController@changePassword');
    Route::get('/unauthorized', 'AuthController@unauthorized');

    Route::get('/login', 'LoginController@login');
    Route::post('/login', 'LoginController@authenticate');
    Route::get('/logout', 'LoginController@logout');

    Route::get('/register', 'RegisterController@create');
    Route::post('/register', 'RegisterController@store'); 
    Route::get('/verify/{verification_code}', 'RegisterController@verify');   
    
	Route::get('{provider}', 'SocialAuthController@redirectTo');
	Route::get('{provider}/callback', 'SocialAuthController@handleCallback');

    

});
Route::group(['middleware' => ['api','cors'], 'prefix' => 'api/auth', 'namespace' => 'Modules\Auth\Http\Controllers'], function()
{
    
    Route::post('/register', 'AuthApiController@register'); 

    Route::post('/our-register', 'AuthApiController@ourRegister'); 

    Route::post('/our-login', 'AuthApiController@ourLogin'); 
    
});

