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
* Clase que se encarga de gestionar las tablas de la aplicacion.
*/
class PrediccionDatosController extends Controller
{
    public function seleccionarDatos($id){
        $file = "guardar".rand(1,10000).".csv";
        


        
    return $result;
    }
    public function estimar($id){
        $tabla = PrediccionDatosController::seleccionarDatos($id);
        print_r($tabla);
    }
}