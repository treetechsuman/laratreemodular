<?php

Route::group(['middleware' => 'web', 'prefix' => 'email', 'namespace' => 'Modules\Email\Http\Controllers'], function()
{
    Route::get('/', 'EmailController@index');
    Route::get('/test', function(){
    	return view('email::maillayout');
    });
    Route::post('/sendmail', 'EmailController@sendMail');
    Route::post('/uploadCSV', 'EmailController@csvUpload');

    /*template*/
    Route::get('/template/add','EmailTemplateController@store');
    Route::get('/template/view','EmailTemplateController@index');
    Route::get('/template/single/view/{id}','EmailTemplateController@singleView');
    Route::get('/template/edit/{id}','EmailTemplateController@edit');
    Route::post('/template/update/{id}','EmailTemplateController@update');
    Route::get('/template/delete/{id}','EmailTemplateController@distroy');
    Route::post('/template/create','EmailTemplateController@create');
});
