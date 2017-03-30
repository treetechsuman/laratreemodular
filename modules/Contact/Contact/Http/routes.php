<?php

Route::group(['middleware' => 'web', 'prefix' => 'contact', 'namespace' => 'Modules\Contact\Http\Controllers'], function()
{
    Route::get('/view', 'ContactController@index');
    Route::get('/delete/{id}', 'ContactController@delete');
    Route::get('/single/view/{id}', 'ContactController@contactSingleView');
    Route::post('/store/{id}', 'ContactController@store');
    Route::get('/edit/{id}', 'ContactController@edit');
    Route::post('/update/{id}/{group_id}', 'ContactController@update');
    Route::post('/uploadCSV/{id}', 'ContactController@contactUpload');
    Route::get('/export', 'ContactController@contactExport');
    //Route::get('/request/{url}','HttpController@httpGetRequest');
    /*Group*/
    Route::get('/group/add','ContactController@groupAdd');
    Route::get('/group/merge','ContactController@groupMergeGet');
    Route::post('/group/mergeto','ContactController@groupMergePost');
    Route::get('/group/edit/{id}','ContactController@groupEdit');
    Route::post('/group/update/{id}','ContactController@groupUpdate');
    Route::post('/group/create','ContactController@groupCreate');
    Route::get('/group/singleView/{id}','ContactController@groupSingleView');
    Route::get('/group/delete/{id}','ContactController@groupDelete');
});
Route::group(['middleware' => ['api',/*'jwt-auth',*/'cors'], 'prefix' => '/api/contact', 'namespace' => 'Modules\Contact\Http\Controllers'], function()
{
  Route::get('/','ContactApiController@apiGetContact');
  Route::get('/{contact_id}','ContactApiController@apiGetContactById');
  Route::get('/group/{group_id}','ContactApiController@getContactByGroupId');
});
Route::get('/test','Modules\Contact\Http\Controllers\HttpController@httpGetRequest');