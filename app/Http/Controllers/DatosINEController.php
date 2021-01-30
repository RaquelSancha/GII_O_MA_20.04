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
        $datos= json_decode(file_get_contents($urlJson), true);
        $urlObjeto = UrlJson::where('url', $urlJson)->first();
        if(empty($urlObjeto)){
            DB::insert('INSERT INTO urlDatosINE (url) VALUES (?)',[$urlJson]);
            $urlObjeto = UrlJson::where('url', $urlJson)->first();
        }
        $id= $urlObjeto->id;
        $fechas= DatosINEController::seleccionarFechas($datos);
        $nombres= DatosINEController::quitarRepetidos($datos);
       return view('datosINE.seleccionar',compact('nombres','fechas','id'));
    }
public function subirDatos($datos, $idUrl){
    $count = count($datos);
    $periodo= " ";
    $año=0;
    $primero=true;
    $id;
    for ($i = 0; $i < $count; $i++) {
        $nombre= $datos[$i]['Nombre'];
        $valor= $datos[$i]['Datos'][0]['Valor'];
        if(array_key_exists('Año',$datos[$i]['Datos'][0])){
            for($j = 0; $j< count($datos[$i]['Datos']); $j++){ 
                $año= $datos[$i]['Datos'][$j]['Año'];
                if(array_key_exists('Periodo',$datos[$i]['Datos'][0])){
                    $periodo= $datos[$i]['Datos'][$j]['Periodo'];
                }
                $valor= $datos[$i]['Datos'][$j]['Valor'];
                if($primero){
                    $ultimoIdConsulta = DB::select('SELECT * FROM datosINE ORDER BY id DESC');
                    if(!isset($ultimoIdConsulta[0])){
                        $id=1;
                    }else{
                        $id= $ultimoIdConsulta[0]->id + 1;
                    }
                    DB::insert('INSERT INTO datosINE (id, nombre, periodo, año, valor, idUrl ) VALUES(?,?,?,?,?,?)',[$id,$nombre,$periodo,$año,$valor,$idUrl]);
                    $primero= false;
                }else{
                    DB::insert('INSERT INTO datosINE (id,nombre, periodo, año, valor, idUrl ) VALUES(?,?,?,?,?,?)',[$id,$nombre,$periodo,$año,$valor,$idUrl]);
                }
            } 
        }else{
            if($primero){
                $ultimoIdConsulta = DB::select('SELECT * FROM datosINE ORDER BY id DESC');
                if(!isset($ultimoIdConsulta[0])){
                    $id=1;
                }else{
                    $id= $ultimoIdConsulta[0]->id + 1;
                }
                DB::insert('INSERT INTO datosINE (id,nombre, periodo, año, valor, idUrl ) VALUES(?,?,?,?,?,?)',[$id, $nombre,$periodo,$año,$valor,$idUrl]);
                $primero= false;
            }else{
                DB::insert('INSERT INTO datosINE (id,nombre, periodo, año, valor, idUrl ) VALUES(?,?,?,?,?,?)',[$id,$nombre,$periodo,$año,$valor,$idUrl]);
            }
        }
    }
    return $id;
}
    public function quitarRepetidos($datos){
        $nomSinRepetir=array();
        $aux= array();
        $count = count($datos);
        for ($i = 0; $i < $count; $i++) {
            $aux2=$datos[$i]['Nombre'];
            $aux=DatosINEController::multiexplodeEspecial(array(".",","),$aux2);
            $tamAux= count($aux);
            for ($j = 0; $j < $tamAux; $j++){
                $nomSinRepetir[$j][]= $aux[$j];
            }
            for ($l = 0; $l<count($nomSinRepetir) ;$l++){
                $nomSinRepetirFinal[$l] =array_values(array_unique($nomSinRepetir[$l]));
            }
            $aux= array();
        }
        return $nomSinRepetirFinal;
    }
    public function multiexplode ($delimiters,$string) {
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch2 = explode($delimiters[0], $ready);
        foreach($launch2 as $l){
            if($l!==" "){
                $launch[]=$l;
            }
        }
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
                $fechasFinal= DatosINEController::traducirPeriodos($fechasFinal);
        }
        if(array_key_exists('NombrePeriodo',$datos[0]['Data'][0])){
            for($j = 0; $j< count($datos[0]['Data']); $j++){ 
                $fechas['Año'][]= $datos[0]['Data'][$j]['NombrePeriodo'];
            } 
            $fechasFinal['Año']= array_values(array_unique($fechas['Año']));
        }
        return $fechasFinal;
    }
    public function traducirPeriodos($fechas){ 
        for($i=0; $i< count($fechas['Periodo']); $i++){
            if($fechas['Periodo'][$i]=="19"){
                $fechas['Periodo'][$i]="T1";
            }
            if($fechas['Periodo'][$i]=="20"){
                $fechas['Periodo'][$i]="T2";
            }
            if($fechas['Periodo'][$i]=="21"){
                $fechas['Periodo'][$i]="T3";
            }
            if($fechas['Periodo'][$i]=="22"){
                $fechas['Periodo'][$i]="T4";
            }
            if($fechas['Periodo'][$i]=="28"){
                $fechas['Periodo'][$i]=" ";
            }
            if($fechas['Periodo'][$i]=="1"){
                $fechas['Periodo'][$i]="Enero";
            }
            if($fechas['Periodo'][$i]=="2"){
                $fechas['Periodo'][$i]="Febrero";
            }
            if($fechas['Periodo'][$i]=="3"){
                $fechas['Periodo'][$i]="Marzo";
            }
            if($fechas['Periodo'][$i]=="4"){
                $fechas['Periodo'][$i]="Abril";
            }
            if($fechas['Periodo'][$i]=="5"){
                $fechas['Periodo'][$i]="Mayo";
            }
            if($fechas['Periodo'][$i]=="6"){
                $fechas['Periodo'][$i]="Junio";
            }
            if($fechas['Periodo'][$i]=="7"){
                $fechas['Periodo'][$i]="Julio";
            }
            if($fechas['Periodo'][$i]=="8"){
                $fechas['Periodo'][$i]="Agosto";
            }
            if($fechas['Periodo'][$i]=="9"){
                $fechas['Periodo'][$i]="Septiembre";
            }
            if($fechas['Periodo'][$i]=="10"){
                $fechas['Periodo'][$i]="Octubre";
            }
            if($fechas['Periodo'][$i]=="11"){
                $fechas['Periodo'][$i]="Noviembre";
            }
            if($fechas['Periodo'][$i]=="12"){
                $fechas['Periodo'][$i]="Diciembre";
            }
        }
        return $fechas;
    }
    public function multiexplodeEspecial($delimiters,$string) {
        if(strpos($string, ",")!== FALSE && strpos($string, ".")!== FALSE){
            $launch2= explode(".", $string);
        }else{
            $ready = str_replace($delimiters, $delimiters[0], $string);
            $launch2 = explode($delimiters[0], $ready);
        }
        foreach($launch2 as $l){
            if($l!==" "){
                $launch[]=$l;
            }
        }
        return  $launch;
    }
    public function show(Request $request,$id){
        $opciones=$request->input("opciones");
        $fechas=$request->input("fechas");
        $urlObjeto= urlJson::find($id);
        $idUrl= $id;
        $url= $urlObjeto->url;
        $datos= json_decode(file_get_contents($url), true);
        $count = count($datos);
        $aux =DatosINEController::multiexplodeEspecial(array(".",","),$datos[0]['Nombre']);
        $valores=array();
        $tiemposaux= array();
        $nOpciones= count($aux);
        $existeFecha=!empty($fechas);
        $encontrado=0;
        $nombrePeriodo=array_key_exists('NombrePeriodo',$datos[0]['Data'][0]);
        $fechaNormal= array_key_exists('Anyo',$datos[0]['Data'][0]);
        for ($i = 0; $i < $count; $i++) {
                $nombre= $datos[$i]['Nombre'];
                $nombre_array= DatosINEController::multiexplodeEspecial(array(".",","),$nombre); 
                for($j = 0; $j< count($nombre_array); $j++){
                    $trimmed= ltrim($nombre_array[$j]);
                    foreach($opciones as $opcion){
                        if(strcmp($trimmed,$opcion)==0){
                            $encontrado++;
                        }
                    }   
                 if($encontrado==$nOpciones){
                     $valores[$i]['Nombre']=$nombre;
                    if($existeFecha){
                        for ($j=0; $j<count($datos[$i]['Data']); $j++){
                            foreach($fechas as $fecha){
                              $fechaDividida= explode(" ",$fecha);
                              $tamFecha= count(explode(" ",$fecha)); //Si es 1 solo tiene año, si es 2 también tiene periodo
                              if($tamFecha==1 && $nombrePeriodo){
                                    if(in_array($fecha,$datos[$i]['Data'][$j]['NombrePeriodo'])){
                                        $valores[$i]['Datos'][$j]['Año']= $datos[$i]['Data'][$j]['NombrePeriodo'];
                                        $valores[$i]['Datos'][$j]['Valor']= $datos[$i]['Data'][$j]['Valor'];
                                    
                                    }   
                               }
                               if($tamFecha==2){
                                $fechaAux['Periodo'][]= $datos[$i]['Data'][$j]['FK_Periodo'];
                                $fechaTraducida= DatosINEController::traducirPeriodos($fechaAux);
                                if($fechaDividida[0]==$datos[$i]['Data'][$j]['Anyo'] && $fechaDividida[1]==$fechaTraducida['Periodo'][0]){
                                    $valores[$i]['Datos'][$j]['Año']= $datos[$i]['Data'][$j]['Anyo'];
                                    $tiemposaux[$datos[$i]['Data'][$j]['Anyo']][]= $fechaTraducida['Periodo'][0];
                                    $valores[$i]['Datos'][$j]['Periodo']= $fechaTraducida['Periodo'][0];
                                    $valores[$i]['Datos'][$j]['Valor']= $datos[$i]['Data'][$j]['Valor'];
                                    $valores[$i]['Datos']= array_values($valores[$i]['Datos']);
                                }
                                $fechaAux=array();
                               }
                            }
                        }
                    }else{
                        $valores[$i]['Datos'][$j]['Valor']= $datos[$i]['Data'][0]['Valor'];
                    }
                  }
                }
                $encontrado=0;

        }
        $valores= array_values($valores);
        foreach($tiemposaux as $tiempo){
            $tiempos[key($tiemposaux)][]= array_unique($tiempo);
            next($tiemposaux);
        }
        $variables = DB::select('SELECT * FROM variable order by Nombre ASC');
        $categorias = DB::select('SELECT * FROM categoria order by Nombre ASC');
        $ambitos = DB::select('SELECT * FROM ambito order by Nombre ASC');
        $id=  DatosINEController::subirDatos($valores, $idUrl);
        return view('datosINE.show',compact('valores','tiempos','variables','categorias','ambitos','id'));
    }
    public function insertarDatos(Request $request,$id){ //PERIODOS: T1= Meses 1, 2, 3  T2= Meses 4, 5, 6  T3= 7, 8, 9  T4= 10, 11, 12
        $categoria=$request->input("categoria");
        $variable=$request->input("variable");
        $ambito=$request->input("ambito");
        $fecha= $request->input("fecha");
        $mesAux=0;
        $valores= DB::select('SELECT * FROM datosINE where id=?',[$id]);
        $idCategoria= DB::select('SELECT categoria.idCategoria FROM categoria where nombre=?', [$categoria]);
        $idVariable= DB::select('SELECT variable.idVariable FROM variable where nombre=?', [$variable]);
        $idAmbito= DB::select('SELECT ambito.idAmbito FROM ambito where nombre=?', [$ambito]);
        DB::insert('UPDATE datosINE SET idVariable=?, idCategoria=?, idAmbito=? WHERE id=?',[$idVariable[0]->idVariable,$idCategoria[0]->idCategoria,$idAmbito[0]->idAmbito,$id]);
        foreach($valores as $valor){
            if(!empty($fecha)){
                $mesAux++;
                DB::insert('INSERT INTO variableambitocategoria (idVariable, idCategoria, idAmbito, Mes, Year, Valor) VALUES (?,?,?,?,?,?)'
                ,[$idVariable[0]->idVariable,$idCategoria[0]->idCategoria,$idAmbito[0]->idAmbito,$mesAux,$fecha,$val]);
            }else{
                $mes= DatosINEController::traducirPeriodo($valor->periodo);
                $mesAux=0;
                $año= $valor->año;
                $val= $valor->valor;
                if($mes=="T1" || $mes=="T2" || $mes=="T3" || $mes=="T4" ){
                    for($i=0; $i<3; $i++){
                        if($mes=="T1"){
                            $mesAux = 1 + $i;
                        }
                        if($mes=="T2"){
                            $mesAux = 4 + $i;
                        }
                        if($mes=="T3"){
                            $mesAux = 7 + $i;
                        }
                        if($mes=="T4"){
                            $mesAux = 10 + $i;
                        }
                        DB::insert('INSERT INTO variableambitocategoria (idVariable, idCategoria, idAmbito, Mes, Year, Valor) VALUES (?,?,?,?,?,?)'
                        ,[$idVariable[0]->idVariable,$idCategoria[0]->idCategoria,$idAmbito[0]->idAmbito,$mesAux,$año,$val]);
                    }
                }elseif($mes== " "){
                    for($i=0; $i<12; $i++){
                        $mesAux= 1 + $i;
                        DB::insert('INSERT INTO variableambitocategoria (idVariable, idCategoria, idAmbito, Mes, Year, Valor) VALUES (?,?,?,?,?,?)'
                        ,[$idVariable[0]->idVariable,$idCategoria[0]->idCategoria,$idAmbito[0]->idAmbito,$mesAux,$año,$val]);
                    }
                }else{
                    DB::insert('INSERT INTO variableambitocategoria (idVariable, idCategoria, idAmbito, Mes, Year, Valor) VALUES (?,?,?,?,?,?)'
                    ,[$idVariable[0]->idVariable,$idCategoria[0]->idCategoria,$idAmbito[0]->idAmbito,$mes,$año,$val]);
                }
            }
            DB::delete('DELETE FROM variableambitocategoria WHERE idVariable=? AND idCategoria=? AND idAmbito=? AND Mes=? AND Year=? AND Valor IS NULL',
            [$idVariable[0]->idVariable,$idCategoria[0]->idCategoria,$idAmbito[0]->idAmbito,$mes,$año]);
        }
        return view('datosINE.confirmar');
    }
    public function traducirPeriodo($periodo){
        switch($periodo){
            case "Enero":
                $periodo=1;
                break;
            case "Febrero":
                $periodo=2;
                break;
            case "Marzo":
                $periodo=3;
                break;
            case "Abril":
                $periodo=4;
                break;
            case "Mayo":
                $periodo=5;
                break;
            case "Junio":
                $periodo=6;
                break;
            case "Julio":
                $periodo=7;
                break;
            case "Agosto":
                $periodo=8;
                break;
            case "Septiembre":
                $periodo=9;
                break;
            case "Octubre":
                $periodo=10;
                break;
            case "Noviembre":
                $periodo=11;
                break;
            case "Diciembre":
                $periodo=12;
                break;
            default:
                break;
        }
        return $periodo;
    }
    public function actualizarDatos(){
        $datos= DB::select('SELECT * FROM datosINE');
        foreach($datos as $dato){
            $idUrl= $dato->idUrl;
            $urls[]= DB::select('SELECT * FROM urldatosine WHERE id=?',[$idUrl]);
        }
        foreach($urls as $url){
            $valores= json_decode(file_get_contents($url[0]->url), true);
            $count = count($valores);
            $idUrl2= $url[0]->id;
            $datosSubidos= DB::select('SELECT * FROM datosINE where idUrl=?',[$idUrl2]);
            foreach($datosSubidos as $dat){
                $nombre=$dat->nombre;
                $ultimaFecha= DatosINEController::ultimaFecha($nombre,$datosSubidos);
                $categoria= $dat->idCategoria;
                $ambito= $dat->idAmbito;
                $variable= $dat->idVariable;
                $idCategoria= DB::select('SELECT categoria.idCategoria FROM categoria where idCategoria=?', [$categoria]);
                $idAmbito= DB::select('SELECT ambito.idAmbito FROM ambito where idAmbito=?', [$ambito]);
                $idVariable= DB::select('SELECT variable.idVariable FROM variable where idVariable=?', [$variable]);
                $id= $dat->id;
                for ($i = 0; $i < $count; $i++) {
                        $nombreNoSubido=$valores[$i]['Nombre'];
                        if(strcmp($nombre,$nombreNoSubido)==0){
                            for($j = 0; $j < count($valores[$i]['Data']) ;$j++){
                                $año = $valores[$i]['Data'][$j]['Anyo'];
                                $mes = $valores[$i]['Data'][$j]['FK_Periodo'];
                                if($año >= $ultimaFecha['Año'] ){
                                    if($mes > $ultimaFecha['Mes'] ){
                                        $datoASubir= $valores[$i]['Data'][$j]['Valor'];
                                        $subido= DB::select('SELECT * FROM datosINE where nombre=? and periodo=? and año=?',[$nombre,$dat->periodo,$año]);
                                        if(empty($subido)){
                                            DatosINEController::subirDatoActualizado($datoASubir,$idCategoria,$idAmbito,$idVariable,$mes,$año);
                                            DatosINEController::subirDatoATablaAuxiliar($id,$nombre,$mes,$año,$datoASubir,$idUrl2,$categoria,$ambito,$variable);
                                        }
                                    }
                                }   
                            }
                        }
                }   
            }
        }
        return view('datosINE.confirmarActualizacion');
    }

    public function ultimaFecha($nombre,$datosSubidos){
        $aux = 0;
        $mesAux=0;
        foreach($datosSubidos as $dato){
            if($nombre==$dato->nombre){
                $año= $dato->año;
                if($año >= $aux){
                    $aux = $año;
                    $mes= DatosINEController::traducirPeriodo($dato->periodo);
                    if($mes=="T1"){
                        $mes= 19;
                    }
                    if($mes=="T2"){
                        $mes=20;
                    }
                    if($mes=="T3"){
                        $mes=21;
                    }
                    if($mes=="T4"){
                        $mes=22;
                    }
                    if($mes==" "){
                        $mes=28;
                    }
                    if($mes > $mesAux){
                        $mesAux = $mes;
                        $mayor= $dato;
                    }
                }
            }
        }
        $ultimaFecha['Año']=$mayor->año;
        $ultimaFecha['Mes']=$mayor->periodo;
        return $ultimaFecha;
    }
    public function subirDatoActualizado($datoASubir,$idCategoria,$idAmbito,$idVariable,$mes,$año){
        if($mes=="19" || $mes=="20" || $mes=="21" || $mes=="22" ){
            for($i=0; $i<3; $i++){
                if($mes=="19"){
                    $mesAux = 1 + $i;
                }
                if($mes=="20"){
                    $mesAux = 4 + $i;
                }
                if($mes=="21"){
                    $mesAux = 7 + $i;
                }
                if($mes=="22"){
                    $mesAux = 10 + $i;
                }
                DB::insert('INSERT INTO variableambitocategoria (idVariable, idCategoria, idAmbito, Mes, Year, Valor) VALUES (?,?,?,?,?,?)'
                ,[$idVariable[0]->idVariable,$idCategoria[0]->idCategoria,$idAmbito[0]->idAmbito,$mesAux,$año,$datoASubir]);
            }
        }elseif($mes= "28"){
            for($i=0; $i<12; $i++){
                $mesAux= 1 + $i;
                DB::insert('INSERT INTO variableambitocategoria (idVariable, idCategoria, idAmbito, Mes, Year, Valor) VALUES (?,?,?,?,?,?)'
                ,[$idVariable[0]->idVariable,$idCategoria[0]->idCategoria,$idAmbito[0]->idAmbito,$mesAux,$año,$datoASubir]);
            }
        }else{
            DB::insert('INSERT INTO variableambitocategoria (idVariable, idCategoria, idAmbito, Mes, Year, Valor) VALUES (?,?,?,?,?,?)'
            ,[$idVariable[0]->idVariable,$idCategoria[0]->idCategoria,$idAmbito[0]->idAmbito,$mesAux,$año,$datoASubir]);
        }
    }
    public function subirDatoATablaAuxiliar($id,$nombre,$mes,$año,$datoASubir,$idUrl2,$categoria,$ambito,$variable){
        switch($mes){
            case "1":
                $mesAux="Enero";
                break;
            case "2":
                $mesAux="Febrero";
                break;
            case "3":
                $mesAux="Marzo";
                break;
            case "4":
                $mesAux="Abril";
                break; 
            case "5":
                $mesAux="Mayo";
                break;   
            case "6":
                $mesAux="Junio";
                break;
            case "7":
                $mesAux="Julio";
                break;
            case "8":
                $mesAux="Agosto";
                break;
            case "9":
                $mesAux="Septiembre";
                break; 
            case "10":
                $mesAux="Octubre";
                break;
            case "11":
                $mesAux="Noviembre";
                break;
            case "12":
                $mesAux="Diciembre";
                break;
            case "19":
                $mesAux="T1";
                break;
            case "20":
                $mesAux="T2";
                break; 
            case "21":
                $mesAux="T3";
                break;
            case "22":
                $mesAux="T4";
                break; 
            case "28":
                $mesAux=" ";
                break;   
         }
         DB::insert('INSERT INTO datosINE (id,nombre, periodo, año, valor, idUrl, idVariable, idCategoria, idAmbito ) VALUES(?,?,?,?,?,?,?,?,?)',[$id,$nombre,$mesAux,$año,$datoASubir,$idUrl2,$variable,$categoria,$ambito]);
    }
}