<?php

Route::group(['middleware' => 'web', 'prefix' => 'form', 'namespace' => 'Modules\Form\Http\Controllers'], function()
{
    Route::get('/', 'FormController@index');
    Route::get('/create', 'FormController@create');
    Route::post('/create', 'FormController@store');
    Route::get('/delete/{id}', 'FormController@delete');
    Route::get('/edit/{id}', 'FormController@edit');
    Route::get('/form-preview/{id}', 'FormController@formPreview');
    Route::post('/update/{id}', 'FormController@update');

    Route::get('/create-field/{form_id}', 'FormController@createField');
    Route::get('/edit-field/{form_id}', 'FormController@editField');
    Route::post('/update-field/{form_id}', 'FormController@updateField');

    Route::get('/create-option/', 'FormController@createOption');
    Route::post('/store-option/', 'FormController@storeOption');
    Route::get('/update-field-option/{field_id}','FormController@updateFieldOption');
    Route::get('/delete-option/{option_id}','FormController@deleteOption');
    Route::get('/update-option/{option_id}','FormController@editOption');
    Route::post('/update-option/{option_id}','FormController@updateOption');


    //Route::get('/add-one-field/{form_id}', 'FormController@addOneField');
    Route::post('/store-field', 'FormController@storeField');

    Route::get('/delete-field/{field_id}', 'FormController@deleteField');



    Route::post('/form-submit/','FormSubmissionController@formSubmit');
    Route::get('/submitted-from-value/{form_id}', 'FormSubmissionController@submittedFormValue');

});

