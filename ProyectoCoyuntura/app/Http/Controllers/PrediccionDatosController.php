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
        $hostname = "localhost";
        $nombreUsuario = "root";
        $contraseña= "";
        $nombreConexion = mysqli_connect($hostname , $nombreUsuario , $contraseña);
        mysqli_select_db($nombreConexion, "bdcoyuntura");
        $result = mysqli_query($nombreConexion, "SELECT * FROM variableambitocategoria ");
        print_r($result);
       // mysqli_data_seek ($result, 0);
        //$extraido= mysqli_fetch_array($result);
       // mysqli_free_result($result);
        mysqli_close($nombreConexion);
       // $datos=DB::select("SELECT * INTO OUTFILE '$file' FROM variableambitocategoria  where idVariable=?",[$id]);
        /*  
        $datos = DB::select('SELECT idVariable, idCategoria, idAmbito, Mes, Year, Valor 
        INTO OUTFILE '/prueba.csv'
        FIELDS TERMINATED BY "," ENCLOSED BY '"', ESCAPED BY '\' LINES TERMINATED BY "\n"
        FROM variableambitocategoria where idVariable=?',[$id]);
        */
        return $result;
    }
    public function estimar($id){
        $tabla = PrediccionDatosController::seleccionarDatos($id);
        print_r($tabla);
    }
}