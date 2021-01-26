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

Route::post('/loginUsuarios','UserController@login');

Route::get('/help', function(){
	return view('/help/help');
});
Route::get('/helpGuest', function(){
	return view('/help/helpGuest');
});
Route::get('/datosINE', function(){
	return view('/datosINE/menu');
});

Route::get('/datosINE/subirdatos', function(){
	return view('/datosINE/subirdatos');
});

Route::get('/datosINE/actualizar', 'DatosINEController@actualizarDatos');

Route::post('/datosINE/show/{id}', 'DatosINEController@show');


Route::post('/datosINE/confirmarsubida', 'DatosINEController@organizarDatos');

Route::post('/datosINE/insertarDatos/{id}', 'DatosINEController@insertarDatos');


Route::get('/equipo', function(){
	return view('/equipo');
});

Route::get('/user/editarPerfil/{id}', 'UserController@edit');

Route::post('/confirm/user/editarPerfil/{id}', 'UserController@update')->middleware('auth');

Route::get('/register/index',  'RegisterController@show')->middleware('AdminUsuarios:1');

Route::post('/register/solicitud', 'RegisterController@register');

Route::get('/register/aceptar/{id}', 'RegisterController@aceptar');

Route::get('/register/editar/{id}', 'RegisterController@edit');

Route::get('/register/declinar/{id}', 'RegisterController@declinar');

Route::get('/register/borrar/{id}', 'RegisterController@borrar');

Route::post('/confirm/user/edit/{id}', 'RegisterController@update')->middleware('auth');

Route::get('/homeGuest', function(){
	return view('/homeGuest');
});

Route::get('/form/new', 'TableController@formNew');


Route::get('/form/create', 'FormController@create');

Route::get('/form/choose', function(){
	return view('/form/choose');
});

Route::get('/data/choose', function(){
	return view('/data/choose');
})->middleware('auth');

Route::get('/data/create/ambito/', function(){
	return view('/data/create/ambito');
})->middleware('auth');

Route::get('/form/{id}/deleteAmbito','TableController@showDeleteAmbito')->middleware('auth');

Route::get('/form/{id}/deleteYear','TableController@showDeleteYear')->middleware('auth');
		
Route::get('/form/{id}/deleteCategoria','TableController@showDeleteCategoria')->middleware('auth');

Route::get('/form/{id}', 'FormController@show');


Route::post('/tables/new','TableController@new');

Route::post('/tables/create','TableController@create');

Route::get('/tables', 'VariableController@index');

Route::post('/tables/{id}', 'TableController@show');

Route::get('/tables/{id}/edit','TableController@edit')->middleware('auth');

Route::post('/tables/{id}/exportar','TableController@exportar')->middleware('auth');

Route::get('/tables/{id}/cambiarDescripcion','TableController@cambiarDescripcion')->middleware('auth');

Route::get('/tables/{id}/insertAmbito','TableController@showInsertAmbito')->middleware('auth');

Route::get('/tables/{id}/insertYear','TableController@showInsertYear')->middleware('auth');

Route::get('/tables/{id}/insertCategoria','TableController@showInsertCategoria')->middleware('auth');

Route::get('/tables/{id}/delete','TableController@delete')->middleware('auth');

Route::post('/confirm/save', 'TableController@save')->middleware('auth');

Route::post('/confirm/insert', 'TableController@insert')->middleware('auth');

Route::post('/confirm/insertAmbito/{id}', 'TableController@updateInsertAmbito')->middleware('auth');

Route::post('/confirm/insertYear/{id}', 'TableController@updateInsertYear')->middleware('auth');

Route::post('/confirm/insertCategoria/{id}', 'TableController@updateInsertCategoria')->middleware('auth');

Route::post('/confirm/deleteAmbito/{id}', 'TableController@updateDeleteAmbito')->middleware('auth');

Route::post('/confirm/deleteYear/{id}', 'TableController@updateDeleteYear')->middleware('auth');

Route::post('/confirm/deleteCategoria/{id}', 'TableController@updateDeleteCategoria')->middleware('auth');

Route::post('/confirm/{id}', 'TableController@update')->middleware('auth');


Route::post('/confirm/data/edit/variable/{id}', 'DataController@updateVariable')->middleware('auth');

Route::post('/confirm/data/edit/supercategoria/{id}', 'DataController@updateSuperCategoria')->middleware('auth');

Route::post('/confirm/data/edit/categoria/{id}', 'DataController@updateCategoria')->middleware('auth');

Route::post('/confirm/data/edit/ambito/{id}', 'DataController@updateAmbito')->middleware('auth');


Route::get('/data/index/variables', 'DataController@indexVariable')->middleware('auth');

Route::get('/data/index/supercategoria', 'DataController@indexSuperCategoria')->middleware('auth')->middleware('auth');

Route::get('/data/index/categoria', 'DataController@indexCategoria')->middleware('auth');

Route::get('/data/index/ambito', 'DataController@indexAmbito')->middleware('auth');



Route::get('/data/edit/variables/{id}', 'DataController@editVariable')->middleware('auth');

Route::get('/data/edit/supercategorias/{id}', 'DataController@editSuperCategoria')->middleware('auth');

Route::get('/data/edit/categorias/{id}', 'DataController@editCategoria')->middleware('auth');

Route::get('/data/edit/ambito/{id}', 'DataController@editAmbito')->middleware('auth');



Route::get('/data/create/supercategorias/', 'DataController@createSuperCategoria')->middleware('auth');

Route::get('/data/create/categorias/', 'DataController@createCategoria')->middleware('auth');





Route::post('confirm/data/new/supercategoria', 'DataController@newSuperCategoria')->middleware('auth');

Route::post('confirm/data/new/categoria', 'DataController@newCategoria')->middleware('auth');

Route::post('confirm/data/new/ambito', 'DataController@newAmbito')->middleware('auth');



Route::get('data/delete/supercategorias/{id}', 'DataController@deleteSuperCategoria')->middleware('auth');


Route::get('data/delete/categorias/{id}', 'DataController@chooseDeleteCategoria')->middleware('auth');

Route::get('data/delete/categorias/full/{id}', 'DataController@DeleteCategoria')->middleware('auth');

Route::get('data/delete/categorias/variable/{id}', 'DataController@chooseVariableDeleteCategoria')->middleware('auth');

Route::post('/data/delete/variables/categoria/{id}', 'DataController@DeleteCategoriaVariable')->middleware('auth');


Route::get('data/delete/ambito/{id}', 'DataController@chooseDeleteAmbito')->middleware('auth');

Route::get('data/delete/ambito/full/{id}', 'DataController@DeleteAmbito')->middleware('auth');

Route::get('data/delete/ambito/variable/{id}', 'DataController@chooseVariableDeleteAmbito')->middleware('auth');

Route::post('/data/delete/variables/ambito/{id}', 'DataController@DeleteAmbitoVariable')->middleware('auth');

Route::get('/prediccionDatos', 'VariableController@index2');

Route::get('/prediccionDatos/{id}', 'PrediccionDatosController@show');

Route::post('prediccionDatos/predecir/{id}','PrediccionDatosController@predecir');
