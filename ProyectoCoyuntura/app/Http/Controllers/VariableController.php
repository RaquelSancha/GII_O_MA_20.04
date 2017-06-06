<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class VariableController extends Controller
{
    public function index()
    {
       $fuentes=array();
    	$fuentesAux=array();
        $variables = DB::select('SELECT * FROM variable');
        foreach ($variables as $variable) {
        	$fuentesAux = DB::select('SELECT DISTINCT Name FROM fuente natural join variable where variable.Nombre=?',[$variable->Nombre]);
        	array_push($fuentes,$fuentesAux);
        }
        return view('table/index',compact('fuentes','variables'));
    }
   
}
