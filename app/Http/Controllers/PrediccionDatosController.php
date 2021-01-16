<?php
/** -- -------------------------------------------------------------
*   -- Nombre:      Proyecto Coyuntura
*   -- Organización:Escuela Politécnica Superior
*   -- Autor:       Raquel Sancha Sánchez
*   -- Fecha:       octubre de 2020
*   -- Versión:     1.0
*   -- -------------------------------------------------------------
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

/**
* Clase que se encarga de predecir los datos a futuro.
*/
class PrediccionDatosController extends Controller
{
    public function seleccionarDatos($idVariable,$idCategoria,$idAmbito){
        $variables = DB::select('SELECT idVariable,idCategoria,idAmbito,Mes,Year FROM variableambitocategoria WHERE idVariable=? AND idCategoria=? AND idAmbito=?',[$idVariable,$idCategoria,$idAmbito]);
        $valores = DB::select('SELECT Valor FROM variableambitocategoria WHERE idVariable=? AND idCategoria=? AND idAmbito=?',[$idVariable,$idCategoria,$idAmbito]);
        


        
    return $result;
    }
    public function predecir(Request $request,$id){
        echo 'HOLA';
        $years = $request->input("years");
    	$categoria = $request->input("categoria");
        $ambitos = $request->input("ambitos");
        PrediccionDatosController::seleccionarDatos($idVariable,$idCategoria,$idAmbito);
       
    }
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

    	

		 return view('prediccionDatos.show',compact('categorias','years','id','ambitos','supercategorias'));
    }
}