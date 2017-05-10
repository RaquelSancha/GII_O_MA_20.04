<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class TableController extends Controller
{

    public function show(Request $request)
    {
    	$valYear=array();
    	$values=array();
    	$years = $request->input("years");
    	$categoria = $request->input("categoria");
    	$filtrado = $request->input("filtrado");
    	$grupos=0;
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
    	
        return view('table.show',compact('categoria','years','values','grupos','filtrado'));
    }
}
