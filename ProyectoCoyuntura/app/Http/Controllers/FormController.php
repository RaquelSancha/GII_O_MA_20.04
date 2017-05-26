<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class FormController extends Controller
{

    public function show($id)
    {
    	$supercategorias = DB::select('SELECT DISTINCT Name,supercategoria.idSuperCategoria FROM supercategoria
                                        INNER JOIN categoria on categoria.idSuperCategoria = supercategoria.idSuperCategoria
                                        INNER JOIN variableambitocategoria on variableambitocategoria.idCategoria = categoria.idCategoria and variableambitocategoria.idVariable=?',[$id]);
    	
    	$categorias  = DB::select('SELECT DISTINCT Nombre,idSuperCategoria FROM categoria natural join variableambitocategoria WHERE idVariable=? order by idSuperCategoria,Nombre',[$id]);
    	$years = DB::select('SELECT DISTINCT Year FROM variableambitocategoria where idVariable=? ORDER BY Year ASC',[$id]);
    	$ambitos  = DB::select('SELECT DISTINCT Nombre FROM ambito natural join variableambitocategoria WHERE idVariable=?',[$id]);

    	

		 return view('form.show',compact('categorias','years','id','ambitos','supercategorias'));
    }

    public function create()
    {
    	$supercategorias = DB::select('SELECT DISTINCT Name,supercategoria.idSuperCategoria FROM supercategoria ');
    	$years = DB::select('SELECT DISTINCT Year FROM variableambitocategoria ORDER BY Year ASC');
    	$ambitos  = DB::select('SELECT DISTINCT Nombre FROM ambito ');
        $categorias  = DB::select('SELECT DISTINCT Nombre,idSuperCategoria FROM categoria order by idSuperCategoria,Nombre ');

        return view('form.create',compact('categorias','years','ambitos','supercategorias'));
    }
}
