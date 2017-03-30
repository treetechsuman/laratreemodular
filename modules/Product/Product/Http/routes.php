<?php

Route::group(['middleware' => 'web', 'prefix' => 'admin/product', 'namespace' => 'Modules\Product\Http\Controllers'], function()
{
    Route::get('/', 'ProductController@index');
});
/*
|--------------------------------------------------------------------------
| Unit Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'web','prefix' => 'admin/product','namespace' => 'Modules\Product\Http\Controllers'], function() { 
	Route::group(['prefix' => 'unit'], function() { 
		Route::get('/','UnitController@index');
		Route::get('/create','UnitController@create');
		Route::post('/store','UnitController@store');
		Route::get('/{id}/edit','UnitController@edit');
		Route::get('/{id}','UnitController@show');
		Route::post('/update/{id}','UnitController@update');
		Route::get('/delete/{id}','UnitController@delete');
	}); 
}); 
/*
|--------------------------------------------------------------------------
| Category Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'web','prefix' => 'admin/product','namespace' => 'Modules\Product\Http\Controllers'], function() { 
	Route::group(['prefix' => 'category'], function() { 
		Route::get('/','CategoryController@index');
		Route::get('/create','CategoryController@create');
		Route::post('/store','CategoryController@store');
		Route::get('/{id}/edit','CategoryController@edit');
		Route::get('/{id}','CategoryController@show');
		Route::post('/update/{id}','CategoryController@update');
		Route::get('/delete/{id}','CategoryController@delete');
	}); 
}); 
/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'web','prefix' => 'admin/product','namespace' => 'Modules\Product\Http\Controllers'], function() { 
	Route::group(['prefix' => 'product'], function() { 
		Route::get('/','ProductController@index');
		Route::get('/create','ProductController@create');
		Route::post('/store','ProductController@store');
		Route::get('/{id}/edit','ProductController@edit');
		Route::get('/{id}','ProductController@show');
		Route::post('/update/{id}','ProductController@update');
		Route::get('/delete/{id}','ProductController@delete');

		Route::post('/store-attribute','ProductController@storeAttribute');
		Route::get('/edit-attribute/{id}','ProductController@editAttribute');
		Route::post('/update-attribute/{id}','ProductController@updateAttribute');
		Route::post('/store-attribute-value','ProductController@storeAttributeValue');
		Route::get('/delete-attribute/{id}','ProductController@deleteAttribute');

		Route::get('/delete-attribute-value/{id}','ProductController@deleteAttributeValue');


		Route::get('/pushcategory/{id}','ProductController@pushCategoryToSession');
	    Route::get('/pushproduct/{id}','ProductController@pushProductToSession');
	    Route::get('/pushattribute/{id}','ProductController@pushAttributeToSession');

	    Route::post('/create-image','ProductController@createProductImage');
	    Route::get('/delete-image/{id}','ProductController@deleteProductImage');
	}); 
}); 
