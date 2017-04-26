<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class TableController extends Controller
{

    public function show($id)
    {
        $variables = DB::table('variable')->where('idVariable', $id)->get();
        $variableAmbitos  = DB::table('variableAmbito')->where('idVariable', $id)->get();
		
        return view('table.show',compact('variables','variableAmbitos'));
    }
}
