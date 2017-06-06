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
        $idsCategoria=array();
        $idsCategoriaAux=array();

    	$years = $request->input("years");
    	$categoria = $request->input("categoria");
    	$filtrado = $request->input("filtrado");
        $ambitos = $request->input("ambitos");
        $supercategorias = DB::select('SELECT DISTINCT Name,supercategoria.idSuperCategoria FROM supercategoria
                                        INNER JOIN categoria on categoria.idSuperCategoria = supercategoria.idSuperCategoria
                                        INNER JOIN variableambitocategoria on variableambitocategoria.idCategoria = categoria.idCategoria and variableambitocategoria.idVariable=?',[$id]);
        $nombre_variable=DB::select('SELECT  Nombre FROM variable where idVariable=?',[$id]);
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
            $idsCategoriaAux=DB::select('SELECT idSuperCategoria FROM categoria where Nombre=?',[$cat]);
            array_push($idsCategoria,$idsCategoriaAux);
            }	
            array_push($values,$valores);
            $valores=array();
    	}
       
        return view('table.show',compact('categoria','years','values','filtrado','id','ambitos','supercategorias','idsCategoria','nombre_variable'));
    }

    public function edit($id)
    {
        $valYear=array();
        $values=array();
        $valores=array();
        $idsCategoria=array();
        $idsCategoriaAux=array();
        $supercategorias=array();
        $scategorias=array();

        $nombreVariable = DB::select('SELECT Nombre FROM variable where idVariable=?',[$id]);
        $categoria  = DB::select('SELECT DISTINCT Nombre FROM categoria natural join variableambitocategoria WHERE idVariable=? order by idSuperCategoria',[$id]);
        $years = DB::select('SELECT DISTINCT Year FROM variableambitocategoria where idVariable=? ORDER BY Year ASC',[$id]);
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
                $scategorias=DB::select('SELECT DISTINCT Name,supercategoria.idSuperCategoria FROM supercategoria NATURAL join categoria where categoria.Nombre=?',[$cat->Nombre]);
                array_push($supercategorias,$scategorias);

                $idsCategoriaAux=DB::select('SELECT idSuperCategoria FROM categoria where Nombre=?',[$cat->Nombre]);
                array_push($idsCategoria,$idsCategoriaAux);   
            }   
            array_push($values,$valores);
            $valores=array();
        }

        return view('table.edit',compact('categoria','years','values','id','ambitos','nombreVariable','idsCategoria','supercategorias'));
    }

    public function update(Request $request, $id){
 
        $update=$request->input("update");
        $categoria  = DB::select('SELECT DISTINCT idCategoria FROM categoria natural join variableambitocategoria WHERE idVariable=?',[$id]);
        $years = DB::select('SELECT DISTINCT Year FROM variableambitocategoria where idVariable=? ORDER BY Year ASC',[$id]);
        $ambito = DB::select('SELECT DISTINCT idAmbito FROM variableambitocategoria where idVariable=?',[$id]);
        $meses=0;
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
                                $consulta=DB::update('UPDATE variableambitocategoria SET Valor= ? WHERE idAmbito=? AND idVariable=? AND idCategoria=? AND Year=? AND Mes =?', [$update[($j-1)+$meses],$amb->idAmbito,$id,$cat->idCategoria,$year->Year,$j]);
                            }
                        }
 
                    }
                    $meses=$meses+12;
                }
            }
        }
        
 
        return view('confirm.update');
    }

    public function showDeleteAmbito($id){

        $ambitos  = DB::select('SELECT DISTINCT Nombre FROM ambito natural join variableambitocategoria WHERE idVariable=?',[$id]); 
        return view('form.deleteAmbito',compact('ambitos','id'));
    }

    public function updateDeleteAmbito(Request $request,$id){

        $ambitos = $request->input("ambitos");

        foreach ($ambitos as $ambito) {
            $idAmb=DB::select('SELECT idAmbito FROM ambito where Nombre=?',[$ambito]);
            DB::delete('DELETE FROM variableambitocategoria WHERE idAmbito=?',[$idAmb[0]->idAmbito]);
        }
        return view('confirm.update');
    }

    public function showInsertAmbito($id){

        $valYear=array();
        $values=array();
        $valores=array();
        $idsCategoria=array();
        $idsCategoriaAux=array();

        $nombreVariable = DB::select('SELECT Nombre FROM variable where idVariable=?',[$id]);
        $categoria  = DB::select('SELECT DISTINCT Nombre FROM categoria natural join variableambitocategoria WHERE idVariable=? order by idSuperCategoria',[$id]);
        $years = DB::select('SELECT DISTINCT Year FROM variableambitocategoria where idVariable=? ORDER BY Year ASC',[$id]);
        $ambitos  = DB::select('SELECT DISTINCT Nombre FROM ambito natural join variableambitocategoria WHERE idVariable=?',[$id]);
        $supercategorias = DB::select('SELECT DISTINCT Name,supercategoria.idSuperCategoria FROM supercategoria
                                        INNER JOIN categoria on categoria.idSuperCategoria = supercategoria.idSuperCategoria
                                        INNER JOIN variableambitocategoria on variableambitocategoria.idCategoria = categoria.idCategoria and variableambitocategoria.idVariable=?',[$id]);
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
                 $idsCategoriaAux=DB::select('SELECT idSuperCategoria FROM categoria where Nombre=?',[$cat->Nombre]);
                 array_push($idsCategoria,$idsCategoriaAux);
            }   
            array_push($values,$valores);
            $valores=array();
        }
        return view('table.insertAmbito',compact('categoria','years','values','id','ambitos','nombreVariable','idsCategoria','supercategorias'));
    }
 public function updateInsertAmbito (Request $request, $id){

        $update=$request->input("update");
        $new_Ambito=$request->input("new_Ambito");
        
        $meses=0;

        $categoria  = DB::select('SELECT DISTINCT idCategoria FROM categoria natural join variableambitocategoria WHERE idVariable=?',[$id]);
        $years = DB::select('SELECT DISTINCT Year FROM variableambitocategoria where idVariable=? ORDER BY Year ASC',[$id]);


        if(empty(DB::select('SELECT Nombre FROM ambito where Nombre= ?',[$new_Ambito]))){
            DB::insert('INSERT INTO ambito (idAmbito, Nombre) VALUES (NULL, ? );',[$new_Ambito]);
        }
        $idAmb=DB::select('SELECT idAmbito FROM ambito where Nombre= ?',[$new_Ambito]);
        DB::insert('INSERT INTO variableambitocategoria(idVariable, idCategoria, idAmbito, Mes, Year, Valor) VALUES (?,?,?,?,?,NULL);',[$id,$categoria[0]->idCategoria,$idAmb[0]->idAmbito,1,$years[0]->Year]);

        $categoria  = DB::select('SELECT DISTINCT idCategoria FROM categoria natural join variableambitocategoria WHERE idVariable=?',[$id]);
        $years = DB::select('SELECT DISTINCT Year FROM variableambitocategoria where idVariable=? ORDER BY Year ASC',[$id]);
        $ambito = DB::select('SELECT DISTINCT idAmbito FROM ambito natural join variableambitocategoria where idVariable=?',[$id]);

        foreach ($categoria as $cat) {
            foreach ($years as $year) {
                for ($j=1; $j < 13 ; $j++) {   
                    $valor=DB::select('SELECT Valor FROM variableambitocategoria  WHERE idAmbito=? and idCategoria= ? AND Year=? AND Mes=? ORDER BY Mes ASC',[$idAmb[0]->idAmbito,$cat->idCategoria,$year->Year,$j]);
                     if(empty($valor)){
                        if(!(is_null($update[($j-1)+$meses]))) {
                            DB::insert('INSERT INTO variableambitocategoria ( idVariable, idCategoria, idAmbito, Mes, Year, Valor ) VALUES(?,?,?,?,?,?)',[$id,$cat->idCategoria,$idAmb[0]->idAmbito,$j,$year->Year,$update[($j-1)+$meses]]);
                        }
                     }else{
                        if(!(is_null($update[($j-1)+$meses]))) {
                            $consulta=DB::update('UPDATE variableambitocategoria SET Valor= ? WHERE idAmbito=? AND idVariable=? AND idCategoria=? AND Year=? AND Mes =?', [$update[($j-1)+$meses],$idAmb[0]->idAmbito,$id,$cat->idCategoria,$year->Year,$j]);
                        }
                     }

                }
                $meses=$meses+12;
            }
        }
           

       

        return view('confirm.update',compact('update','valor','new_Ambito'));
    }

    public function showDeleteYear($id){

        $years  = DB::select('SELECT DISTINCT Year FROM variableambitocategoria WHERE idVariable=?',[$id]); 
        return view('form.deleteYear',compact('years','id'));
    }

    public function updateDeleteYear(Request $request,$id){

        $years = $request->input("years");

        foreach ($years as $year) {
            DB::delete('DELETE FROM variableambitocategoria WHERE Year=?',[$year]);
        }
        return view('confirm.update');
    }
    public function showInsertYear($id){

        $valYear=array();
        $values=array();
        $valores=array();
        $idsCategoria=array();
        $idsCategoriaAux=array();

        $nombreVariable = DB::select('SELECT Nombre FROM variable where idVariable=?',[$id]);
        $categoria  = DB::select('SELECT DISTINCT Nombre FROM categoria natural join variableambitocategoria WHERE idVariable=? order by idSuperCategoria',[$id]);
        $years = DB::select('SELECT DISTINCT Year FROM variableambitocategoria where idVariable=? ORDER BY Year ASC',[$id]);
        $ambitos  = DB::select('SELECT DISTINCT Nombre FROM ambito natural join variableambitocategoria WHERE idVariable=?',[$id]);
        $supercategorias = DB::select('SELECT DISTINCT Name,supercategoria.idSuperCategoria FROM supercategoria
                                        INNER JOIN categoria on categoria.idSuperCategoria = supercategoria.idSuperCategoria
                                        INNER JOIN variableambitocategoria on variableambitocategoria.idCategoria = categoria.idCategoria and variableambitocategoria.idVariable=?',[$id]);
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
                 $idsCategoriaAux=DB::select('SELECT idSuperCategoria FROM categoria where Nombre=?',[$cat->Nombre]);
                 array_push($idsCategoria,$idsCategoriaAux);

            }   
            array_push($values,$valores);
            $valores=array();
        }
        return view('table.insertYear',compact('categoria','years','values','id','ambitos','nombreVariable','idsCategoria','supercategorias'));
    }

    public function updateInsertYear (Request $request, $id){

        $update=$request->input("update");
        $new_Year=$request->input("new_Year");
        
        $meses=0;

        $categoria  = DB::select('SELECT DISTINCT idCategoria FROM categoria natural join variableambitocategoria WHERE idVariable=?',[$id]);
        $ambito = DB::select('SELECT DISTINCT idAmbito FROM ambito natural join variableambitocategoria where idVariable=?',[$id]);

        DB::insert('INSERT INTO variableambitocategoria(idVariable, idCategoria, idAmbito, Mes, Year, Valor) VALUES (?,?,?,?,?,NULL);',[$id,$categoria[0]->idCategoria,$ambito[0]->idAmbito,1,$new_Year]);
       
        foreach ($ambito as $amb) {
            foreach ($categoria as $cat) {
                
                    for ($j=1; $j < 13 ; $j++) {   
                        $valor=DB::select('SELECT Valor FROM variableambitocategoria  WHERE idAmbito=? and idCategoria= ? AND Year=? AND Mes=? ORDER BY Mes ASC',[$amb->idAmbito,$cat->idCategoria, $new_Year,$j]);
                         if(empty($valor)){
                            if(!(is_null($update[($j-1)+$meses]))) {
                                DB::insert('INSERT INTO variableambitocategoria ( idVariable, idCategoria, idAmbito, Mes, Year, Valor ) VALUES(?,?,?,?,?,?)',[$id,$cat->idCategoria,$amb->idAmbito,$j, $new_Year,$update[($j-1)+$meses]]);
                            }
                         }else{
                            if(!(is_null($update[($j-1)+$meses]))) {
                                $consulta=DB::update('UPDATE variableambitocategoria SET Valor= ? WHERE idAmbito=? AND idVariable=? AND idCategoria=? AND Year=? AND Mes =?', [$update[($j-1)+$meses],$amb->idAmbito,$id,$cat->idCategoria, $new_Year,$j]);
                            }
                         }

                    }
                    $meses=$meses+12;
                
            }
        }
        return view('confirm.update');
    }
    public function showInsertCategoria ($id){

        $nombreVariable = DB::select('SELECT Nombre FROM variable where idVariable=?',[$id]);
        $ambitos  = DB::select('SELECT DISTINCT Nombre FROM ambito natural join variableambitocategoria WHERE idVariable=?',[$id]);
        $years = DB::select('SELECT DISTINCT Year FROM variableambitocategoria where idVariable=? ORDER BY Year ASC',[$id]);
        $supercategorias = DB::select('SELECT DISTINCT Name,supercategoria.idSuperCategoria FROM supercategoria order by Name ASC');


        return view('table.insertCategoria',compact('ambitos','years','supercategorias','nombreVariable','id'));
    }
    public function updateInsertCategoria (Request $request, $id){

        $update=$request->input("update");
        $new_categoria=$request->input("new_categoria");
        $new_supercategoria=$request->input("new_supercategoria");
        $supercategoria=$request->input("supercategoria");


        $years = DB::select('SELECT DISTINCT Year FROM variableambitocategoria where idVariable=? ORDER BY Year ASC',[$id]);
        $ambito  = DB::select('SELECT DISTINCT Nombre,idAmbito FROM ambito natural join variableambitocategoria WHERE idVariable=?',[$id]);

        $meses=0;

        //si no se ha introducido nada
        if( (empty($supercategoria)) and (empty($new_supercategoria)) ){
                $idSuperCat=DB::select('SELECT idSuperCategoria FROM supercategoria WHERE Name="Sin categoria" ');
                DB::insert('INSERT INTO categoria(idCategoria, idSuperCategoria, Nombre) VALUES (NULL,?,?)',[$idSuperCat[0]->idSuperCategoria,$new_categoria]);  
        
        }elseif ((!(empty($supercategoria))) and (!(empty($new_supercategoria))) ) {
            //si se han escogido las dos, doy preferencia a lo que el usuario a escrito.
                DB::insert('INSERT INTO supercategoria(idSuperCategoria, Name) VALUES (NULL,?)',[$new_supercategoria]);
                $idSuperCat=DB::select('SELECT idSuperCategoria FROM supercategoria WHERE Name=? ',[$new_supercategoria]);
                DB::insert('INSERT INTO categoria(idCategoria, idSuperCategoria, Nombre) VALUES (NULL,?,?)',[$idSuperCat[0]->idSuperCategoria,$new_categoria]);   
        }elseif(empty($new_supercategoria)){
            // si se ha escogido una supercategoria ya existente
            $idSuperCat=DB::select('SELECT idSuperCategoria FROM supercategoria WHERE Name=? ',[$supercategoria]);
            DB::insert('INSERT INTO categoria(idCategoria, idSuperCategoria, Nombre) VALUES (NULL,?,?)',[$idSuperCat[0]->idSuperCategoria,$new_categoria]);  
        }elseif(empty($supercategoria)){
              //si se ha introducido una supercategoria nueva
            DB::insert('INSERT INTO supercategoria(idSuperCategoria, Name) VALUES (NULL,?)',[$new_supercategoria]);
            $idSuperCat=DB::select('SELECT idSuperCategoria FROM supercategoria WHERE Name=? ',[$new_supercategoria]);
            DB::insert('INSERT INTO categoria(idCategoria, idSuperCategoria, Nombre) VALUES (NULL,?,?)',[$idSuperCat[0]->idSuperCategoria,$new_categoria]);  
        }

         $id_new_categoria=DB::select('SELECT Nombre,idCategoria FROM Categoria where Nombre=?',[$new_categoria]);

         DB::insert('INSERT INTO variableambitocategoria(idVariable, idCategoria, idAmbito, Mes, Year, Valor) VALUES (?,?,?,?,?,NULL);',[$id,$id_new_categoria[0]->idCategoria,$ambito[0]->idAmbito,1,$years[0]->Year]);

        foreach ($ambito as $amb ) {
                foreach ($years as $year) {
                    for ($j=1; $j < 13 ; $j++) {   
                        $valor=DB::select('SELECT Valor FROM variableambitocategoria  WHERE idAmbito=? and idCategoria= ? AND Year=? AND Mes=? ORDER BY Mes ASC',[$amb->idAmbito,$id_new_categoria[0]->idCategoria,$year->Year,$j]);
                        if(empty($valor)){
                            if(!(is_null($update[($j-1)+$meses]))) {
                                DB::insert('INSERT INTO variableambitocategoria ( idVariable, idCategoria, idAmbito, Mes, Year, Valor ) VALUES(?,?,?,?,?,?)',[$id,$id_new_categoria[0]->idCategoria,$amb->idAmbito,$j,$year->Year,$update[($j-1)+$meses]]);
                            }
                        }else{
                            if(!(is_null($update[($j-1)+$meses]))) {
                                $consulta=DB::update('UPDATE variableambitocategoria SET Valor= ? WHERE idAmbito=? AND idVariable=? AND idCategoria=? AND Year=? AND Mes =?', [$update[($j-1)+$meses],$amb->idAmbito,$id,$id_new_categoria[0]->idCategoria,$year->Year,$j]);
                            }
                        }
                    }
                    $meses=$meses+12;
                }     
        }

        return view('confirm.update',compact('new_categoria','new_supercategoria','supercategoria','update'));
    }

    public function create(Request $request)
    {
        $valYear=array();
        $values=array();
        $valores=array();
        $idsCategoria=array();
        $idsCategoriaAux=array();
        $supercategorias=array();
        $scategorias=array();

        $years = $request->input("years");
        $categoria = $request->input("categoria");
        $filtrado = $request->input("filtrado");
        $ambitos = $request->input("ambitos");
        $variable = $request->input("nombre_variable");
        
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
                $scategorias=DB::select('SELECT DISTINCT Name,supercategoria.idSuperCategoria FROM supercategoria NATURAL join categoria where categoria.Nombre=?',[$cat]);
                array_push($supercategorias,$scategorias);
                $idsCategoriaAux=DB::select('SELECT idSuperCategoria FROM categoria where Nombre=?',[$cat]);
                array_push($idsCategoria,$idsCategoriaAux);   
            }   
            array_push($values,$valores);
            $valores=array();
        }
        return view('table.create',compact('categoria','years','values','filtrado','ambitos','variable','supercategorias','idsCategoria'));
    }
    public function save(Request $request)
    {
       
        
    
        return view('confirm.save');
    }
    public function new(Request $request)
    {
        $categorias = $request->input("categorias");
        $variable = $request->input("nombre_variable");
        $years = $request->input("years");
        $ambitos = $request->input("ambitos");
        $values=array();

        return view('table.new',compact('categorias','variable','ambitos','years','values'));
    }

    public function delete($id){

    return view('confirm.delete',compact('id'));
    }
}
