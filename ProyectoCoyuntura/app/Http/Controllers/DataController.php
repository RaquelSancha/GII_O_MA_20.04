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

        return view('data/confirm/update');
    }
    public function indexSuperCategoria()
    {
        $categorias=array();
        $categoriasAux=array();
        $supercategorias = DB::select('SELECT * FROM supercategoria');

        foreach ($supercategorias as $supercat) {
            $categoriasAux = DB::select('SELECT DISTINCT Nombre FROM categoria natural join supercategoria where supercategoria.idSuperCategoria=?',[$supercat->idSuperCategoria]);
            array_push($categorias,$categoriasAux);
        }
        return view('data/index/supercategoria',compact('categorias','supercategorias'));
    }

    public function editSuperCategoria($id)
    {
        $supercategorias = DB::select('SELECT * FROM supercategoria where idSuperCategoria=?',[$id]);
        $categorias = DB::select('SELECT DISTINCT Nombre FROM categoria natural join supercategoria where supercategoria.idSuperCategoria=?',[$id]);
        $AllCategorias = DB::select('SELECT DISTINCT Nombre FROM categoria natural join supercategoria where supercategoria.idSuperCategoria!=?',[$id]);

        return view('data/edit/supercategorias',compact('categorias','supercategorias','id','AllCategorias'));
    }
     public function updateSuperCategoria(Request $request, $id)
    {
        $nombre_supercategoria=$request->input("nombre_supercategoria");
        $categoriasPoner=$request->input("categoriasPoner");
        $categoriasQuitar=$request->input("categoriasQuitar");

        if(!(empty($nombre_supercategoria))){
             $consulta=DB::update('UPDATE supercategoria SET Name=? WHERE idSuperCategoria=?',[$nombre_supercategoria,$id]);
        }
        if(!(empty($categoriasQuitar))){
            foreach ($categoriasQuitar as $quitar) {
                $idSuperCat=DB::select('SELECT idSuperCategoria FROM supercategoria WHERE Name="Sin categoria" ');
                $consulta=DB::update('UPDATE categoria SET idSuperCategoria=? WHERE Nombre=?',[$idSuperCat[0]->idSuperCategoria,$quitar]);
            }
        }
        if(!(empty($categoriasPoner))){
            foreach ($categoriasPoner as $poner) {
             
                $consulta=DB::update('UPDATE categoria SET idSuperCategoria=? WHERE Nombre=?',[$id,$poner]);
            }
        }

        return view('data/confirm/update',compact('fuente','descripcion','tipo','nombre_variable'));
    }
     public function createSuperCategoria()
    {
       
        $categorias = DB::select('SELECT DISTINCT Nombre FROM categoria natural join supercategoria where supercategoria.Name="Sin categoria"');
        return view('data/create/supercategorias',compact('categorias'));
    }
    public function newSuperCategoria(Request $request)
    {
        $categoriasPoner=$request->input("categoriasPoner");
        $nombre_supercategoria=$request->input("nombre_supercategoria");

        DB::insert('INSERT INTO supercategoria(idSuperCategoria,Name) VALUES (NULL,?)',[$nombre_supercategoria]);
        $idSuperCat=DB::select('SELECT idSuperCategoria FROM supercategoria WHERE Name=? ',[$nombre_supercategoria]);
        if(!(empty($categoriasPoner))){
            foreach ($categoriasPoner as $cat) {
                 $consulta=DB::update('UPDATE categoria SET idSuperCategoria=? WHERE Nombre=?',[$idSuperCat[0]->idSuperCategoria,$cat]);
            }
        }
        return view('data/confirm/create');
    }
    public function deleteSuperCategoria($id)
    {
        
        $idSuperCat=DB::select('SELECT idSuperCategoria FROM supercategoria WHERE Name="Sin categoria" ');
        $consulta=DB::update('UPDATE categoria SET idSuperCategoria=? WHERE idSuperCategoria=?',[$idSuperCat[0]->idSuperCategoria,$id]);
        $delete=DB::delete('DELETE FROM supercategoria WHERE idSuperCategoria=?',[$id]);

        return view('data/confirm/delete');
    }
  
    
}
