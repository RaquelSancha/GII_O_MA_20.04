<?php
/** -- -------------------------------------------------------------
*   -- Nombre:      Proyecto Coyuntura
*   -- Organización:Escuela Politécnica Superior
*   -- Autor:       Nelson Páramo Valdivielso
*   -- Fecha:       julio del 2016
*   -- Versión:     1.0
*   -- -------------------------------------------------------------
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
/**
* Clase que se encarga de gestionar los formularios de la aplicacion.
*/
class FormController extends Controller
{
     /**
    * Función que se encarga de mostrar las supercategorias, categorias, ambitos y años de una variable pasada por parametro.
    *
    * @param  int  $id
    * @return view
    */
    public function show($id)
    {
    	$supercategorias = DB::select('SELECT DISTINCT Name,supercategoria.idSuperCategoria FROM supercategoria
                                        INNER JOIN categoria on categoria.idSuperCategoria = supercategoria.idSuperCategoria
                                        INNER JOIN variableambitocategoria on variableambitocategoria.idCategoria = categoria.idCategoria and variableambitocategoria.idVariable=?',[$id]);
    	
    	$categorias  = DB::select('SELECT DISTINCT Nombre,idSuperCategoria FROM categoria natural join variableambitocategoria WHERE idVariable=? order by idSuperCategoria,Nombre',[$id]);
    	$years = DB::select('SELECT DISTINCT Year FROM variableambitocategoria where idVariable=? ORDER BY Year ASC',[$id]);
    	$ambitos  = DB::select('SELECT DISTINCT Nombre FROM ambito natural join variableambitocategoria WHERE idVariable=?',[$id]);

    	

		 return view('form.show',compact('categorias','years','id','ambitos','supercategorias'));
    }
        /**
    * Función que se encarga de mostrar las supercategorias, categorias, ambitos y años de toda la aplicacion, para crear una tabla con cualquier categoria de cualquier variable.
    *
    * @return view
    */
    public function create()
    {
    	$supercategorias = DB::select('SELECT DISTINCT Name,idSuperCategoria FROM supercategoria natural JOIN categoria WHERE supercategoria.idSuperCategoria=categoria.idSuperCategoria ORDER BY idSuperCategoria ');
    	$years = DB::select('SELECT DISTINCT Year FROM variableambitocategoria ORDER BY Year ASC');
    	$ambitos  = DB::select('SELECT DISTINCT Nombre FROM ambito ');
        $categorias  = DB::select('SELECT DISTINCT Nombre,idSuperCategoria FROM categoria order by idSuperCategoria,Nombre ');

        return view('form.create',compact('categorias','years','ambitos','supercategorias'));
    }
}
