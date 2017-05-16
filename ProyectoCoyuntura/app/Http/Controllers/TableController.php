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
        $valores=array();

    	$years = $request->input("years");
    	$categoria = $request->input("categoria");
    	$filtrado = $request->input("filtrado");
        $ambitos = $request->input("ambitos");

        foreach ($ambitos as $ambito) {
        	foreach ($categoria as $cat) {
        		foreach ($years as $year) {
        			for ($j=1; $j < 13 ; $j++) { 
                        
        				$valor=DB::select('SELECT valor FROM variableambitocategoria
                                            INNER JOIN ambito on ambito.idAmbito = variableambitocategoria.idAmbito AND ambito.Nombre=?  AND Year=? AND Mes=?  
                                            INNER JOIN categoria on categoria.idCategoria = variableambitocategoria.idCategoria AND categoria.Nombre=?  AND Year=? AND Mes=? ',[$ambito,$year,$j,$cat,$year,$j]);
        				if(empty($valor)){
        					array_push($valYear,"NaN");
        				}else{
        					array_push($valYear, $valor);
        				}
        			}
        			array_push($valores,$valYear);
        			$valYear=array();
        		}
            }	
            array_push($values,$valores);
            $valores=array();
    	}
        return view('table.show',compact('categoria','years','values','filtrado','id','ambitos'));
    }
    public function create(){

        $categorias  = DB::select('SELECT DISTINCT Nombre FROM categoria ');
        return view('table.create',compact('$categorias'));
    }
    public function edit($id)
    {
        $valYear=array();
        $values=array();
        $valores=array();

        $categoria  = DB::select('SELECT DISTINCT Nombre FROM categoria natural join variableambitocategoria WHERE idVariable=?',[$id]);
        $years = DB::select('SELECT DISTINCT Year FROM variableambitocategoria where idVariable=?',[$id]);
        $ambitos  = DB::select('SELECT DISTINCT Nombre FROM ambito natural join variableambitocategoria WHERE idVariable=?',[$id]);

        foreach ($ambitos as $ambito) {
            foreach ($categoria as $cat) {
                foreach ($years as $year) {
                    for ($j=1; $j < 13 ; $j++) { 
                        
                        $valor=DB::select('SELECT valor FROM variableambitocategoria
                                            INNER JOIN ambito on ambito.idAmbito = variableambitocategoria.idAmbito AND ambito.Nombre=?  AND Year=? AND Mes=?  
                                            INNER JOIN categoria on categoria.idCategoria = variableambitocategoria.idCategoria AND categoria.Nombre=?  AND Year=? AND Mes=? ',[$ambito->Nombre,$year->Year,$j,$cat->Nombre,$year->Year,$j]);
                        if(empty($valor)){
                            array_push($valYear,"NaN");
                        }else{
                            array_push($valYear, $valor);
                        }
                    }
                    array_push($valores,$valYear);
                    $valYear=array();
                }
            }   
            array_push($values,$valores);
            $valores=array();
        }
        return view('table.edit',compact('categoria','years','values','id','ambitos'));
    }

    public function update(Request $request, $id){

        $update=$request->input("update");
        $categoria  = DB::select('SELECT DISTINCT idCategoria FROM categoria natural join variableambitocategoria WHERE idVariable=?',[$id]);
        $years = DB::select('SELECT DISTINCT Year FROM variableambitocategoria where idVariable=?',[$id]);
        $ambito = DB::select('SELECT DISTINCT idAmbito FROM ambito natural join variableambitocategoria where idVariable=?',[$id]);

        $meses=0;
        $n_amb=0;

        foreach ($ambito as $amb ) {
            foreach ($categoria as $cat) {
                foreach ($years as $year) {
                    for ($j=1; $j < 13 ; $j++) {   
                        $valor=DB::select('SELECT Valor FROM variableambitocategoria  WHERE idAmbito=? and idCategoria= ? AND Year=? AND Mes=? ORDER BY Mes ASC',[$amb->idAmbito,$cat->idCategoria,$year->Year,$j]);
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
