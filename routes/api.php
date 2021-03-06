<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('stock')->group(function() {
	Route::post('add', 'StockController@add');
	// Route::post('edit/{id}', 'StockController@edit');
	Route::post('update/{id}', 'StockController@update');
	Route::get('item/{id}', 'StockController@show');
	Route::get('all', 'StockController@all');
	Route::post('delete', 'StockController@delete');
});

Route::prefix('invoice')->group(function() {
	Route::post('save', 'InvoiceController@save');
	Route::get('id/{id}', 'InvoiceController@get');
	Route::post('update/{id}', 'InvoiceController@update');
	Route::get('all', 'InvoiceController@all');
	Route::post('delete', 'InvoiceController@delete');
	Route::get('next', 'InvoiceController@next');
	Route::get('range/{from}/{to}', 'InvoiceController@daterange');
	Route::get('products/{id}', 'InvoiceController@getProducts');
});

Route::prefix('option')->group(function() {
	Route::get('all', 'OptionController@all');
	Route::post('save', 'OptionController@save');
  Route::get('template', 'OptionController@template');
  Route::post('custom-text/save', 'OptionController@saveCustom');
  Route::get('custom-text/get', 'OptionController@getCustom');
  Route::post('hf/save', 'OptionController@saveHF');
  Route::get('hf/get', 'OptionController@getHF');
});

Route::get('test', function() {
  try {
    DB::connection()->getPdo();
    if(DB::connection()->getDatabaseName()) {
      return response()->json( [ 'connection' => 'success', 'database' => 'success'], 200);
    }
  }
  catch(\Exception $e) {
      return response()->json([ 'connection' => 'success', 'database' => 'error'], 406);
  }

});
