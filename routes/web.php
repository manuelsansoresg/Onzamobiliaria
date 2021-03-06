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

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::redirect('/', '/login', 301);

Route::group(['prefix' => 'admin', 'middleware' => 'auth'],   function () {

    Auth::routes();

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

    Route::resource('/propiedad', 'PropertyController');
    Route::get('/propiedad/status/{id}/{status}', 'PropertyController@changeStatus');
    Route::get('/destroy-document/{name_column}/{name}', 'PropertyController@destroyDocument');
    Route::get('/property/addUser/{id}/{user_id}', 'PropertyController@addUser');
    Route::get('/propiedad/search/easybroker/{easy_broker}', 'PropertyController@searchEasyBroker');
    Route::get('/propiedad/{id}/confirm','PropertyController@confirm')->name('propiedad.confirm');
    
    Route::get('/property_assignment/view_more/{property_assignment_id}', 'PropertyAssigmentController@viewMore');

    Route::resource('/postal', 'PostalController');

    Route::resource('/prospecto', 'LeadController');
    Route::get('/prospecto/status/{id}/{status}', 'LeadController@changeStatus');
    Route::get('/prospecto/imagen/delete/{id}', 'LeadController@delete_image');

    Route::get('delete/{id}', 'PropertyAssigmentController@destroy')->name('seguimiento-asesores.delete'); 
    Route::resource('/seguimiento-asesores', 'PropertyAssigmentController');
    Route::get('/seguimiento-asesores/status/{id}/{status}', 'PropertyAssigmentController@changeStatus');

    Route::resource('/historico-seguimiento', 'HistoricAssigmentController');
    Route::get('/historico-seguimiento/create/{id_assigment}', 'HistoricAssigmentController@create');

    //Route::get('/seguimiento-asesores/{property_id}/create', 'PropertyAssigmentController@create');

    Route::get('/property/getAll', 'PropertyAssigmentController@getAll');

    Route::resource('/usuarios', 'UserController');
    Route::resource('/clientes', 'ClientController');

    Route ::get('/cancelar',function(){ 
        return redirect()->route('propiedad.index')->with('cancelar','Accion Cancelada!'); 
    })->name('cancelar');

    Route::get('/catalogos', function () {
        return view('catalogos');
    });

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

