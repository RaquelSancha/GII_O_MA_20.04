<?php
/** -- -------------------------------------------------------------
*   -- Nombre:      Proyecto Coyuntura
*   -- Organización:Escuela Politécnica Superior
*   -- Autor:       Raquel Sancha Sánchez
*   -- Fecha:       julio del 2020
*   -- Versión:     1.0
*   -- -------------------------------------------------------------
*/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\UrlJson;

/**
* Clase que se encarga de las operaciones con los datos de la aplicación.
*/
class DatosINEController extends Controller
{
public function organizarDatos(Request $request)
    {
        $url = $request->input("url");
        $urlJson= DatosINEController::crearUrl($url);
        print_r($urlJson);
        $datos= json_decode(file_get_contents($urlJson), true);
        DB::insert('INSERT INTO urlDatosINE (url) VALUES (?)',[$urlJson]);
        $urlObjeto = UrlJson::where('url', $urlJson)->first();
        $id= $urlObjeto->id;
        //DatosINEController::subirDatos($datos);
        $fechas= DatosINEController::seleccionarFechas($datos);
        $nombres= DatosINEController::quitarRepetidos($datos);
       return view('datosINE.seleccionar',compact('nombres','fechas','id'));
    }
public function subirDatos($datos){
    $count = count($datos);
    $periodo;
    $año;
    $noExisteFecha=true;
    for ($i = 0; $i < $count; $i++) {
        $nombre= $datos[$i]['Nombre'];
        $valor= $datos[$i]['Data'][0]['Valor'];
        if(array_key_exists('Anyo',$datos[$i]['Data'][0])){
            $noExisteFecha=false;
            for($j = 0; $j< count($datos[$i]['Data']); $j++){ 
                $año= $datos[$i]['Data'][$j]['Anyo'];
                if(array_key_exists('FK_Periodo',$datos[$i]['Data'][0])){
                    $periodo= $datos[$i]['Data'][$j]['FK_Periodo'];
                }
                $valor= $datos[$i]['Data'][$j]['Valor'];
                DB::insert('INSERT INTO datosINE (nombre, periodo, año, valor ) VALUES(?,?,?,?)',[$nombre,$periodo,$año,$valor]);
            } 
        }
        if($noExisteFecha){
            DB::insert('INSERT INTO datosINE (nombre, periodo, año, valor ) VALUES(?,?,?,?)',[$nombre,$periodo,$año,$valor]);
        }
    }
}
    public function quitarRepetidos($datos){
        $nomSinRepetir=array();
        $aux= array();
        $count = count($datos);
        for ($i = 0; $i < $count; $i++) {
            $aux2=$datos[$i]['Nombre'];
            $aux=DatosINEController::multiexplode(array(".",","),$aux2);
            $tamAux= count($aux);
            $k=0;
            for ($j = 0; $j < $tamAux; $j++){
                if($aux[$j]!==" "){
                $nomSinRepetir[$j][]= $aux[$j];
                }
                $k++;
            }
            for ($l = 0; $l<count($nomSinRepetir) ;$l++){
                $nomSinRepetirFinal[$l] =array_values(array_unique($nomSinRepetir[$l]));
            }
            $aux= array();
        }
        return $nomSinRepetirFinal;
    }
    function multiexplode ($delimiters,$string) {
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }
    
    public function crearUrl($url)
    {
        $tempus3 = 'jaxiT3';
        $pos = strpos($url, $tempus3);
        $urlJson= "https://servicios.ine.es/wstempus/js/ES/DATOS_TABLA";
        if ($pos === false) {//la url pertenece a PCAxis
            $input = DatosINEController::multiexplode(array("=","&"),$url);
            $urlJson.= $input[1].$input[3];
        } else { //la url pertenece a tempus3
            $input = DatosINEController::multiexplode(array("=","&"),$url);
            $urlJson.= "/".$input[1];
        }
        return $urlJson;
    }
    public function seleccionarFechas($datos){ 
        $fechasFinal= array();
        if(array_key_exists('Anyo',$datos[0]['Data'][0])){
                for($j = 0; $j< count($datos[0]['Data']); $j++){ 
                    $fechas['Año'][]= $datos[0]['Data'][$j]['Anyo'];
                    if(array_key_exists('FK_Periodo',$datos[0]['Data'][0])){
                        $fechas['Periodo'][]= $datos[0]['Data'][$j]['FK_Periodo'];
                    }
                } 
                $fechasFinal['Año']= array_values(array_unique($fechas['Año']));
                $fechasFinal['Periodo']= array_values(array_unique($fechas['Periodo']));

        }
        return $fechasFinal;
    }
    public function show(Request $request,$id){
        $opciones=$request->input("opciones");
        $fechas=$request->input("fechas");
        $urlObjeto= urlJson::find($id);
        $url= $datos->url;
        $datos= json_decode(file_get_contents($url), true);
    }
}