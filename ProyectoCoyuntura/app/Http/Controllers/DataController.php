<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class DataController extends Controller
{
    public function indexVariable()
    {
    	$fuentes=array();
    	$fuentesAux=array();
        $variables = DB::select('SELECT * FROM variable');
        foreach ($variables as $variable) {
        	$fuentesAux = DB::select('SELECT DISTINCT Name FROM fuente natural join variable where variable.Nombre=?',[$variable->Nombre]);
        	array_push($fuentes,$fuentesAux);
        }
        return view('data/index/variables',compact('fuentes','variables'));
    }
    public function editVariable($id)
    {
        $variables = DB::select('SELECT * FROM variable where idVariable=?',[$id]);
        $fuentes = DB::select('SELECT DISTINCT Name FROM fuente natural join variable where variable.idVariable=?',[$id]);

        return view('data/edit/variables',compact('fuentes','variables','id'));
    }
     public function updateVariable(Request $request, $id)
    {
        $nombre_variable=$request->input("nombre_variable");
        $descripcion=$request->input("descripcion");
        $tipo=$request->input("tipo");
        $fuente=$request->input("fuente");

        if(!(empty($nombre_variable))){
        	 $consulta=DB::update('UPDATE variable SET Nombre=? WHERE idVariable=?',[$nombre_variable,$id]);
        }
         if(!(empty($descripcion))){
        	 $consulta=DB::update('UPDATE variable SET descripcion=? WHERE idVariable=?',[$descripcion,$id]);
        }
         if(!(empty($tipo))){
        	 $consulta=DB::update('UPDATE variable SET tipo=? WHERE idVariable=?',[$tipo,$id]);
        }
         if(!(empty($fuente))){
         	$fuenteAux=DB::select('SELECT idFuente from fuente where Name=?',[$fuente]);
         	if(empty($fuenteAux)){
         		DB::insert('INSERT INTO fuente(idFuente,Name) VALUES (NULL,?)',[$fuente]);
         		$fuenteAux=DB::select('SELECT idFuente from fuente where Name=?',[$fuente]);
         	}
         	DB::update('UPDATE variable SET idFuente=? WHERE idVariable=?',[$fuenteAux[0]->idFuente,$id]);		
        }

        return view('confirm/update',compact('fuente','descripcion','tipo','nombre_variable'));
    }

   
}
