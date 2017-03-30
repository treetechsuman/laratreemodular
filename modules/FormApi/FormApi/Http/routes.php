<?php

Route::group(['middleware' => ['api','jwt-auth','cors'], 'prefix' => 'api/form', 'namespace' => 'Modules\FormApi\Http\Controllers'], function()
{
    Route::get('/{form_id}', 'FormApiController@index');
    Route::get('/client/forms-by-client-id', 'FormApiController@formsByClientId')->middleware('form');
    Route::post('/submit/form', 'FormApiController@formSubmit');

    Route::get('/event/forms-by-event-id', 'FormApiController@formsByEventId');
    
    //Route::get('/get-token', 'FormApiController@getToken');
});
Route::group(['middleware' => ['api','cors'], 'prefix' => 'api/form', 'namespace' => 'Modules\FormApi\Http\Controllers'], function()
{
    Route::post('/submit/form', 'FormApiController@formSubmit');


});
