<?php

Route::get('/welcome', function () {

	return view('welcome');
});

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Route::group(['middleware' => 'auth'], function() 
{
	Route::resource('items', 'ItemController');
	Route::resource('dealers', 'DealerController');
	Route::resource('orders', 'OrderController');
	Route::resource('category', 'CategoryController');

	Route::get('/testing', 'CategoryController@readItems');
	Route::get('/getdealers', 'OrderController@getDealers');	
	Route::get('/getdealers-order', 'DealerController@getDealersOrder');
	Route::get('/dealer/{id}', 'DealerController@getCreditLimit');	
	Route::get('/getorderby-dealer/{id}', 'OrderController@getNewOrders');
	Route::get('/getpending-order/{id}', 'OrderController@pending');
	Route::get('/get-attribute', 'ItemController@getAttribute');

	// Reports	
	Route::get('sales-report', 'ReportsController@salesReport');
	Route::get('receivable', 'ReportsController@receivable');	
	// Route::get('export', 'ReportsController@export')->name('export');
	Route::get('export-view/{id}', 'ReportsController@export_view')->name('export');
	Route::get('export-view/{id}', 'ReportsController@export_view')->name('export');
	Route::get('export-inventory/{id}', 'ReportsController@export_view')->name('export.inventory');

	Route::get('inventory/{inventory}', 'ItemController@index')->name('inventory');
	Route::get('receipt', 'OrderController@receipt')->name('receipt');

	Route::post('/add-orderid', 'OrderController@addOrderId');
	Route::post('/category/{id}', 'CategoryController@update');
	Route::post('/save-items', 'OrderController@store');
	Route::post('/complete-order/{id}', 'OrderController@completeOrder');
	Route::post('/save-attribute', 'ItemController@saveAttribute');
	Route::post('/add-value/{id}', 'ItemController@addAttributeValue');
	Route::patch('/edit-attribute/', 'ItemController@updateAttribute');
	Route::patch('/edit-attrvalue/', 'ItemController@update_attrvalue');

	Route::delete('/delete-order/{id}', 'OrderController@destroy');
	
	Route::post('order-step-2/{id}', 'OrderController@process_order')->name('process_order');
	Route::post('process-order', 'OrderController@process_order')->name('process_order');
	Route::post('pay-order', 'OrderController@pay_order');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
