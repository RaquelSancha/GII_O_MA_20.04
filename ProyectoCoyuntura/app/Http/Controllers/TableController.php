<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class TableController extends Controller
{

    public function show(Request $request,$id)
    {
    	$valYear=array();
    	$values=array();
    	$years = $request->input("years");
    	$categoria = $request->input("categoria");
    	$filtrado = $request->input("filtrado");
    	foreach ($categoria as $cat) {
    		foreach ($years as $year) {
    			for ($j=1; $j < 13 ; $j++) { 
    				$valor=DB::select('SELECT Valor FROM variableambitocategoria NATURAL JOIN categoria WHERE categoria.Nombre= ? AND Year=? and Mes=? ORDER BY Mes ASC',[$cat,$year,$j]);
    				if(empty($valor)){
    					array_push($valYear,"NaN");
    				}else{
    					array_push($valYear, $valor);
    				}
    			}
    			array_push($values,$valYear);
    			$valYear=array();
    		}	
    	}
        return view('table.show',compact('categoria','years','values','filtrado','id'));
    }
    public function create(){

        $categorias  = DB::select('SELECT DISTINCT Nombre FROM categoria ');
        return view('table.create',compact('$categorias'));
    }
    public function edit($id)
    {
        $valYear=array();
        $values=array();
        $categoria  = DB::select('SELECT DISTINCT Nombre FROM categoria natural join variableambitocategoria WHERE idVariable=?',[$id]);
        $years = DB::select('SELECT DISTINCT Year FROM variableambitocategoria where idVariable=?',[$id]);
        foreach ($categoria as $cat) {
            foreach ($years as $year) {
                for ($j=1; $j < 13 ; $j++) {    
                    $valor=DB::select('SELECT Valor FROM variableambitocategoria NATURAL JOIN categoria WHERE categoria.Nombre= ? AND Year=? and Mes=? ORDER BY Mes ASC',[$cat->Nombre,$year->Year,$j]);
                    if(empty($valor)){
                        array_push($valYear,"NaN");
                    }else{
                        array_push($valYear, $valor);
                    }
                }
                array_push($values,$valYear);
                $valYear=array();
            } 
        }
        return view('table.edit',compact('categoria','years','values','id'));
    }
    public function update(Request $request, $id){

        $update=$request->input("update");
        $categoria  = DB::select('SELECT DISTINCT idCategoria FROM categoria natural join variableambitocategoria WHERE idVariable=?',[$id]);
        $years = DB::select('SELECT DISTINCT Year FROM variableambitocategoria where idVariable=?',[$id]);
        $ambito = DB::select('SELECT DISTINCT idAmbito FROM variableambitocategoria where idVariable=?',[$id]);
        $meses=0;
        foreach ($ambito as $amb ) {
            foreach ($categoria as $cat) {
                foreach ($years as $year) {
                    for ($j=1; $j < 13 ; $j++) {   
                        $valor=DB::select('SELECT Valor FROM variableambitocategoria  WHERE idCategoria= ? AND Year=? AND Mes=? ORDER BY Mes ASC',[$cat->idCategoria,$year->Year,$j]);
                         if(empty($valor)){
                            if(!(is_null($update[($j-1)+$meses]))) {
                                DB::insert('INSERT INTO variableambitocategoria ( idVariable, idCategoria, idAmbito, Mes, Year, Valor ) VALUES(?,?,?,?,?,?)',[$id,$cat->idCategoria,$amb->idAmbito,$j,$year->Year,$update[($j-1)+$meses]]);
                            }
                         }else{
                            if(!(is_null($update[($j-1)+$meses]))) {
                                $consulta=DB::update('UPDATE variableambitocategoria SET Valor= ? WHERE idVariable=? AND idCategoria=? AND Year=? AND Mes =?', [$update[($j-1)+$meses],$id,$cat->idCategoria,$year->Year,$j]);
                            }
                         }

                    }
                    $meses=$meses+12;
                }
            }
        }
       

        return view('confirm.update',compact('update','valor'));
    }
}
