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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Route::resource('/mobiliaria','RealstateController');
    Route::get('/mobiliaria/status/{id}/{status}','RealstateController@changeStatus');
    
    Route::resource('/portales', 'AdController');
    Route::get('/portales/status/{id}/{status}', 'AdController@changeStatus');
    
    Route::resource('/portales', 'AdController');
    Route::get('/portales/status/{id}/{status}', 'AdController@changeStatus');
    
    Route::resource('/operaciones', 'OperationController');
    Route::get('/operaciones/status/{id}/{status}', 'OperationController@changeStatus');
    
    Route::resource('/forma-de-pago', 'FormPaymentController');
    Route::get('/forma-de-pago/status/{id}/{status}', 'FormPaymentController@changeStatus');
    
    Route::resource('/clasificacion', 'ClasificationController');
    Route::get('/clasificacion/status/{id}/{status}', 'ClasificationController@changeStatus');
    
    Route::resource('/seguimiento', 'StatusFollowController');
    Route::get('/seguimiento/status/{id}/{status}', 'StatusFollowController@changeStatus');
    
    Route::resource('/pago', 'FormPaymentController');
    Route::get('/pago/status/{id}/{status}', 'FormPaymentController@changeStatus');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
