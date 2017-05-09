<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class FormController extends Controller
{

    public function show($id)
    {
    	$categorias  = DB::select('SELECT DISTINCT Nombre FROM categoria natural join variableambitocategoria WHERE idVariable=?',[$id]);
    	$years = DB::select('SELECT DISTINCT Year FROM variableambitocategoria where idVariable=?',[$id]);
    	/*$years=array();
    	$n_years=0;
    	$meses=array();

		
        $variables = DB::table('variable')->where('idVariable', $id)->get();
        $variableAmbitos  = DB::table('variableAmbito')->where('idVariable', $id)->get();
		
		
			if(!in_array($variable->Year, $years)){
				$years[] = $variable->Year;
				$n_years = $n_years + 1;
			}
			if(!in_array($variable->Mes, $meses)){
				$meses[] = $variable->Mes;
			}

		}

	
*/	
		 return view('form.show',compact('categorias','years','id'));
    }
}
