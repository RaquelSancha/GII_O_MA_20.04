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
*Clase que se engarga de mostrar las variables que existen en la base de datos.
*
*/
class VariableController extends Controller
{  
     /**
    * Función que se encarga de mostrar las variables de la BD
    *
    *@return \Illuminate\Http\Response
    */ 
    public function index()
    {
       $fuentes=array();
    	$fuentesAux=array();
        $variables = DB::select('SELECT * FROM variable order by Nombre');
        foreach ($variables as $variable) {
        	$fuentesAux = DB::select('SELECT DISTINCT Name FROM fuente natural join variable where variable.Nombre=?',[$variable->Nombre]);
        	array_push($fuentes,$fuentesAux);
        }
        return view('table/index',compact('fuentes','variables'));
    }
   
}
