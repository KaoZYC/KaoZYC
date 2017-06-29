<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/User','UserController@index');
Route::get('/User/Delete/{id}','UserController@destroy');

Route::get('/Post', function(){
	return view('Post');
});
Route::get('/Post/{id}', function($id){
	return view('Post-single', [
		'id' => $id
	]);
});

Route::get('/Product', function(){
	return view('Product');
});
Route::get('/Product/Product_List','ProductController@product_list');
Route::get('/Product/Add_Cart/{id}','ProductController@add_cart');
Route::get('/Product/Cart','ProductController@cart');

Route::get('/Chat', 'ChatController@index');
Route::get('/Chat/all', 'ChatController@look');
Route::post('/Chat/Create', 'ChatController@store');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
