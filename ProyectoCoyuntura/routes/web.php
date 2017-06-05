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

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes


    
});
Route::get('/form/new', function () {
    return view('/form/new');
});

Route::get('/form/choose', function(){
	return view('/form/choose');
});

Route::get('/form/create', 'FormController@create');

Route::get('/form/{id}', 'FormController@show');



Route::post('/tables/new','TableController@new');

Route::post('/tables/create','TableController@create');

Route::get('/tables', 'VariableController@index');

Route::post('/tables/{id}', 'TableController@show');

Route::get('/tables/{id}/edit','TableController@edit');

Route::get('/tables/{id}/insertAmbito','TableController@showInsertAmbito');

Route::get('/tables/{id}/insertYear','TableController@showInsertYear');

Route::get('/tables/{id}/insertCategoria','TableController@showInsertCategoria');

Route::get('/tables/{id}/delete','TableController@delete');



Route::post('/confirm/save', 'TableController@save');

Route::post('/confirm/insertAmbito/{id}', 'TableController@updateInsertAmbito');

Route::post('/confirm/insertYear/{id}', 'TableController@updateInsertYear');

Route::post('/confirm/insertCategoria/{id}', 'TableController@updateInsertCategoria');

Route::post('/confirm/{id}', 'TableController@update');