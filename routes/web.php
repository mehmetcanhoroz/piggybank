<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::resource('transactions','TransactionsController');

Route::resource('transactionChild','TransactionChildController');
Route::resource('homeChild','TransactionChildController');
Route::resource('User','UserController');
Route::resource('posts','PostController');
Route::resource('failedTransactions','FailedTransactionController');
Route::get('posts/{{$post->id}}','PostController@show');

Auth::routes();

Route::get('/', 'homeChildController@index')->name('homeChild');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/homeChild', 'homeChildController@index')->name('homeChild');
Route::get('/makeTransaction', function () {
    return view("makeTransaction");
});


//Route::get('/','TransactionsController@storevalue');
Route::post('session/dateValue', 'TransactionsController@storeValue');
Route::post('session/dateCValue', 'TransactionChildController@storeValue');
Route::post('session/dateFValue', 'FailedTransactionController@storeValue');