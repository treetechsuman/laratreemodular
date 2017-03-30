<?php

Route::group(['middleware' => 'web', 'prefix' => 'sms', 'namespace' => 'Modules\Sms\Http\Controllers'], function()
{
    Route::get('/', 'SmsController@index');
    Route::post('/send-sms', 'SmsController@sendSms');
});
