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
    	$ambitos  = DB::select('SELECT DISTINCT Nombre FROM ambito natural join variableambitocategoria WHERE idVariable=?',[$id]);

		 return view('form.show',compact('categorias','years','id','ambitos'));
    }
}
