<?php

Route::group(['middleware' => 'web', 'prefix' => 'app', 'namespace' => 'Modules\App\Http\Controllers'], function()
{
    Route::get('/', 'AppController@index');
    Route::get('/create','AppController@create');
    Route::post('/store','AppController@store');
    Route::get('/edit/{id}','AppController@edit');
    Route::post('/update/{id}','AppController@update');
    Route::get('/delete/{id}','AppController@destroy');


    Route::get('/permission/{id}','AppController@permission');
    Route::post('/permission/add/{id}','AppController@givePermission');
    Route::post('/permission/remove/{id}','AppController@removePermission');
});
Route::group(['middleware' => ['api','cors'], 'prefix' => 'api/app', 'namespace' => 'Modules\App\Http\Controllers'], function()
{
    //Route::post('/register', 'ApiAuthController@register');
    Route::post('/get-token', 'ApiAuthController@getToken');

});
Route::group(['middleware' => ['api','jwt-auth','cors'], 'prefix' => 'api/app', 'namespace' => 'Modules\App\Http\Controllers'], function()
{
    Route::post('/register', 'ApiAuthController@register');
    //Route::get('/get-token', 'FormApiController@getToken');
    Route::get('/get-app-by-token', 'ApiAuthController@getAppByToken');
});
