<?php
/** -- -------------------------------------------------------------
*   -- Nombre:      Proyecto Coyuntura
*   -- Organización:Escuela Politécnica Superior
*   -- Autor:       Nelson Páramo Valdivielso
*   -- Fecha:       julio del 2016
*   -- Versión:     1.0
*   -- -------------------------------------------------------------
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel;
use DB;
use App\Exports\InvoicesExport;
use App\Exports\InvoicesCollection;

/**
* Clase que se encarga de gestionar las tablas de la aplicacion.
*/
class TableController extends Controller
{
 
     /**
    * Función que se encarga de mostrar las tablas y los gráficos filtrados a partir de una id .
    *
    * @param  int  $id
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function show(Request $request,$id)
    {
    	$valYear=array();
    	$values=array();
        $valores=array();
        $valYearForm=array();
        $valuesForm=array();
        $valoresForm=array();
        $idsCategoria=array();
        $idsCategoriaAux=array();
        $supercategoriasAux=array();
        $supercategorias=array();

    	$years = $request->input("years");
    	$categoria = $request->input("categoria");
    	$filtrado = $request->input("filtrado");
        $ambitos = $request->input("ambitos");

        $ambitosForm = $request->input("ambitosForm");
        $yearsForm = $request->input("yearsForm");
        $categoriasForm = $request->input("categoriasForm");
        $tipoGrafico = $request->input("tipoGrafico");

        $fuentes = DB::select('SELECT DISTINCT Name FROM fuente natural join variable where variable.idVariable=?',[$id]);
        $nombre_variable=DB::select('SELECT * FROM variable where idVariable=?',[$id]);

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
            $supercategoriasAux = DB::select('SELECT DISTINCT Name,supercategoria.idSuperCategoria FROM supercategoria natural join categoria where categoria.Nombre=?',[$cat]);
            if(!(in_array($supercategoriasAux, $supercategorias))){
                array_push($supercategorias,$supercategoriasAux);   
            } 
            $idsCategoriaAux=DB::select('SELECT idSuperCategoria FROM categoria where Nombre=?',[$cat]);
            array_push($idsCategoria,$idsCategoriaAux);
            }	
            array_push($values,$valores);
            $valores=array();
    	}

        if(empty($ambitosForm)){
            for ($j=0; $j < count($ambitos) ; $j++) { 
                $ambitosForm[$j] = $ambitos[$j];
            }
        }
        if(empty($categoriasForm)){
            for ($j=0; $j < count($categoria) ; $j++) {
                $categoriasForm[$j] = $categoria[$j];
            }
        }
        if(empty($yearsForm)){
            for ($j=0; $j < count($years) ; $j++) {
                $yearsForm[$j] = $years[$j];
            }
        }
        if(empty($tipoGrafico)){
            $tipoGrafico = "bar";
        }


        foreach ($ambitosForm as $ambF) {
            foreach ($categoriasForm as $catF) {
                foreach ($yearsForm as $yearF) {
                    for ($j=1; $j < 13 ; $j++) { 
                        $valor=DB::select('SELECT valor FROM variableambitocategoria
                                            INNER JOIN ambito on ambito.idAmbito = variableambitocategoria.idAmbito AND ambito.Nombre=?  AND Year=? AND Mes=?  
                                            INNER JOIN categoria on categoria.idCategoria = variableambitocategoria.idCategoria AND categoria.Nombre=?  AND Year=? AND Mes=? ',[$ambF,$yearF,$j,$catF,$yearF,$j]);
                        if(empty($valor)){
                            array_push($valYearForm,'NULL');
                        }else{
                            array_push($valYearForm, $valor);
                        }
                    }
                    array_push($valoresForm,$valYearForm);
                    $valYearForm=array();
                }
            }
            array_push($valuesForm,$valoresForm);
            $valoresForm=array();
        }
        return view('table.show',compact('categoria','years','values','filtrado','id','ambitos','supercategorias','idsCategoria','nombre_variable','fuentes','ambitosForm','yearsForm','categoriasForm','tipoGrafico','valuesForm'));
    }

  /**
    * Función que se encarga de mostrar las tablas para poder editarlas.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $valYear=array();
        $values=array();
        $valores=array();
        $idsCategoria=array();
        $idsCategoriaAux=array();

        $supercategorias = DB::select('SELECT DISTINCT Name,supercategoria.idSuperCategoria FROM supercategoria
                                        INNER JOIN categoria on categoria.idSuperCategoria = supercategoria.idSuperCategoria
                                        INNER JOIN variableambitocategoria on variableambitocategoria.idCategoria = categoria.idCategoria and variableambitocategoria.idVariable=?',[$id]);
        $nombreVariable = DB::select('SELECT Nombre FROM variable where idVariable=?',[$id]);
        $categoria  = DB::select('SELECT DISTINCT Nombre FROM categoria natural join variableambitocategoria WHERE idVariable=?',[$id]);
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
                $idsCategoriaAux=DB::select('SELECT idSuperCategoria FROM categoria where Nombre=?',[$cat->Nombre]);
                array_push($idsCategoria,$idsCategoriaAux);   
            }   
            array_push($values,$valores);
            $valores=array();
        }

        return view('table.edit',compact('categoria','years','values','id','ambitos','nombreVariable','idsCategoria','supercategorias'));
    }

    /**
    * Función que se encarga de actualizar los valores de las tablas.
    *
    * @param  int  $id
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
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

    /**
    * Función que se encarga de mostrar los ámbitos para poder borrar los selecionados.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function showDeleteAmbito($id){

        $ambitos  = DB::select('SELECT DISTINCT Nombre FROM ambito natural join variableambitocategoria WHERE idVariable=?',[$id]); 
        return view('form.deleteAmbito',compact('ambitos','id'));
    }

    /**
    * Función que se encarga borrar los ambitos seleccionados de una tabla.
    *
    * @param  int  $id
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function updateDeleteAmbito(Request $request,$id){

        $ambitos = $request->input("ambitos");

        foreach ($ambitos as $ambito) {
            $idAmb=DB::select('SELECT idAmbito FROM ambito where Nombre=?',[$ambito]);
            DB::delete('DELETE FROM variableambitocategoria WHERE idAmbito=?',[$idAmb[0]->idAmbito]);
        }
        return view('confirm.update');
    }

    /**
    * Función que se encarga de mostrar la tabla con el formulario para añadir un ámbito.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
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

    /**
    * Función que actualiza los datos cuando se inserta un ambito.
    *
    * @param  int  $id
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
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

    /**
    * Función que muestra los años que se pueden borrar de una tabla.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function showDeleteYear($id){

        $years  = DB::select('SELECT DISTINCT Year FROM variableambitocategoria WHERE idVariable=?',[$id]); 
        return view('form.deleteYear',compact('years','id'));
    }

    /**
    * Función que borra los años seleccionados.
    *
    * @param  int  $id
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function updateDeleteYear(Request $request,$id){

        $years = $request->input("years");

        foreach ($years as $year) {
            DB::delete('DELETE FROM variableambitocategoria WHERE Year=?',[$year]);
        }
        return view('confirm.update');
    }

    /**
    * Función que muestra la tabla con el formulario para insertar un año.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
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
    /**
    * Función que actualiza los datos cuando se inserta un año.
    *
    * @param  int  $id
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
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
    /**
    * Función que muestra las categorias que se pueden borrar de una tabla.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function showDeleteCategoria($id){


        $categorias  = DB::select('SELECT DISTINCT Nombre,idSuperCategoria FROM categoria natural join variableambitocategoria WHERE idVariable=?',[$id]);
        $supercategorias = DB::select('SELECT DISTINCT Name,supercategoria.idSuperCategoria FROM supercategoria
                                        INNER JOIN categoria on categoria.idSuperCategoria = supercategoria.idSuperCategoria
                                        INNER JOIN variableambitocategoria on variableambitocategoria.idCategoria = categoria.idCategoria and variableambitocategoria.idVariable=?',[$id]);
       
        return view('form.deleteCategoria',compact('categorias','id','supercategorias'));
    }

    /**
    * Función que borra las categorias seleccionadas
    *
    * @param  int  $id
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function updateDeleteCategoria(Request $request,$id){

        $categoria = $request->input("categoria");

        foreach ($categoria as $cat) {
            $idCat=DB::select('SELECT idCategoria FROM categoria where Nombre=?',[$cat]);
            DB::delete('DELETE FROM variableambitocategoria WHERE idCategoria=?',[$idCat[0]->idCategoria]);
        }
        return view('confirm.update');
    }

    /**
    * Función que muestra los datos para el formulario para agregar una categoria.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function showInsertCategoria ($id){

        $nombreVariable = DB::select('SELECT Nombre FROM variable where idVariable=?',[$id]);
        $ambitos  = DB::select('SELECT DISTINCT Nombre FROM ambito natural join variableambitocategoria WHERE idVariable=?',[$id]);
        $years = DB::select('SELECT DISTINCT Year FROM variableambitocategoria where idVariable=? ORDER BY Year ASC',[$id]);
        $supercategorias = DB::select('SELECT DISTINCT Name,supercategoria.idSuperCategoria FROM supercategoria order by Name ASC');


        return view('table.insertCategoria',compact('ambitos','years','supercategorias','nombreVariable','id'));
    }

    /**
    * Función que actualiza los datos cuando se inserta una categoria.
    *
    * @param  int  $id
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
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

    /**
    * Función que obtiene los datos para el formulario que se utiliza para crear una tabla con categorias de cualquier variable
    *
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function create(Request $request)
    {
        $valYear=array();
        $values=array();
        $valores=array();
        $valYearForm=array();
        $valuesForm=array();
        $valoresForm=array();
        $idsCategoria=array();
        $idsCategoriaAux=array();
        $supercategorias=array();
        $supercategoriasAux=array();

        $years = $request->input("years");
        $categoria = $request->input("categoria");
        $filtrado = $request->input("filtrado");
        $ambitos = $request->input("ambitos");
        $variable = $request->input("nombre_variable");
        $descripcion = $request->input("descripcion");
        $tipo = $request->input("tipo");
        $fuente = $request->input("fuente");

        $ambitosForm = $request->input("ambitosForm");
        $yearsForm = $request->input("yearsForm");
        $categoriasForm = $request->input("categoriasForm");
        $tipoGrafico = $request->input("tipoGrafico");


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
                $supercategoriasAux = DB::select('SELECT DISTINCT Name,supercategoria.idSuperCategoria FROM supercategoria natural join categoria where categoria.Nombre=?',[$cat]);
                if(!(in_array($supercategoriasAux, $supercategorias))){
                    array_push($supercategorias,$supercategoriasAux);   
                } 
                $idsCategoriaAux=DB::select('SELECT idSuperCategoria FROM categoria where Nombre=?',[$cat]);
                array_push($idsCategoria,$idsCategoriaAux);   
            }   
            array_push($values,$valores);
            $valores=array();
        }

        if(empty($ambitosForm)){
            $ambitosForm[0] = $ambitos[0];
        }
        if(empty($categoriasForm)){
            $categoriasForm[0] = $categoria[0];
        }
        if(empty($yearsForm)){
            $yearsForm[0] = $years[0];
        }
        if(empty($tipoGrafico)){
            $tipoGrafico = "Barras";
        }


        foreach ($ambitosForm as $ambF) {
            foreach ($categoriasForm as $catF) {
                foreach ($yearsForm as $yearF) {
                    for ($j=1; $j < 13 ; $j++) { 
                        $valor=DB::select('SELECT valor FROM variableambitocategoria
                                            INNER JOIN ambito on ambito.idAmbito = variableambitocategoria.idAmbito AND ambito.Nombre=?  AND Year=? AND Mes=?  
                                            INNER JOIN categoria on categoria.idCategoria = variableambitocategoria.idCategoria AND categoria.Nombre=?  AND Year=? AND Mes=? ',[$ambF,$yearF,$j,$catF,$yearF,$j]);
                        if(empty($valor)){
                            array_push($valYearForm,'NULL');
                        }else{
                            array_push($valYearForm, $valor);
                        }
                    }
                    array_push($valoresForm,$valYearForm);
                    $valYearForm=array();
                }
            }
            array_push($valuesForm,$valoresForm);
            $valoresForm=array();
        }
        return view('table.create',compact('categoria','years','values','filtrado','ambitos','variable','supercategorias','idsCategoria','fuente','descripcion','tipo','ambitosForm','yearsForm','categoriasForm','tipoGrafico','valuesForm'));
    }

    /**
    * Función que obtiene los datos para el formulario que se utiliza para insertar una tabla nueva
    *
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function insert(Request $request)
    {
        $categorias = $request->input("categorias");
        $variable = $request->input("variable");
        $years = $request->input("years");
        $ambitos = $request->input("ambitos");
        $tipo = $request->input("tipo");
        $descripcion = $request->input("descripcion");
        $fuente = $request->input("fuente");
        $update = $request->input("update");

        $meses=0;
    
        $idFuente=DB::select('SELECT idFuente from fuente where Name=?',[$fuente]);
        if(empty($idFuente)){
            DB::insert('INSERT INTO fuente (idFuente,Name) VALUES (NULL,?)',[$fuente]);
            $idFuente=DB::select('SELECT idFuente from fuente where Name=?',[$fuente]);
        }
            
        DB::insert('INSERT INTO variable (idVariable, idFuente, Nombre,Descripcion, Tipo) VALUES (NULL,?,?,?,?)',[$idFuente[0]->idFuente,$variable,$descripcion,$tipo]);
        $idSuperCat=DB::select('SELECT idSuperCategoria FROM supercategoria WHERE Name="Sin categoria" ');
        
        foreach ($categorias as $cat) {
            $idCategoria=DB::select('SELECT idCategoria FROM categoria WHERE Nombre=?',[$cat]);
            if(empty($idCategoria)){
                DB::insert('INSERT INTO categoria(idCategoria, idSuperCategoria, Nombre) VALUES (NULL,?,?)',[$idSuperCat[0]->idSuperCategoria , $cat]);
            }
        }
        foreach ($ambitos as $amb) {
            $idAmbito=DB::select('SELECT idAmbito FROM ambito WHERE Nombre=?',[$amb]);
            if(empty($idAmbito)){
                DB::insert('INSERT INTO ambito(idAmbito, Nombre) VALUES (NULL,?)',[$amb]);
            }
        }
        
        $idVariable=DB::select('SELECT idVariable FROM variable WHERE Nombre=?',[$variable]);
            foreach ($ambitos as $amb ) {
                $idAmbito=DB::select('SELECT idAmbito FROM ambito WHERE Nombre=?',[$amb]);
                foreach ($categorias as $cat) {
                     $idCategoria=DB::select('SELECT idCategoria FROM categoria WHERE Nombre=?',[$cat]);
                    foreach ($years as $year) {
                        for ($j=1; $j < 13 ; $j++) { 
                                    DB::insert('INSERT INTO variableambitocategoria ( idVariable, idCategoria, idAmbito, Mes, Year, Valor ) VALUES(?,?,?,?,?,?)',[$idVariable[0]->idVariable,$idCategoria[0]->idCategoria,$idAmbito[0]->idAmbito,$j,$year,$update[($j-1)+$meses]]);

                        }
                        $meses=$meses+12;
                    }
                }
            }

        return view('confirm.save');
    }

    /**
    * Función que almacena en la base de datos una tabla creada con categorias de cualquier variable.
    *
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
     public function save(Request $request)
    {
        $categorias = $request->input("categorias");
        $variable = $request->input("variable");
        $years = $request->input("years");
        $ambitos = $request->input("ambitos");
        $tipo = $request->input("tipo");
        $descripcion = $request->input("descripcion");
        $fuente = $request->input("fuente");
        $update = $request->input("update");

        $meses=0;
    
        $idFuente=DB::select('SELECT idFuente from fuente where Name=?',[$fuente]);
        if(empty($idFuente)){
            DB::insert('INSERT INTO fuente (idFuente,Name) VALUES (NULL,?)',[$fuente]);
            $idFuente=DB::select('SELECT idFuente from fuente where Name=?',[$fuente]);
        }
            
        DB::insert('INSERT INTO variable (idVariable, idFuente, Nombre,Descripcion, Tipo) VALUES (NULL,?,?,?,?)',[$idFuente[0]->idFuente,$variable,$descripcion,$tipo]);
        $idSuperCat=DB::select('SELECT idSuperCategoria FROM supercategoria WHERE Name="Sin categoria" ');
        
        
        $idVariable=DB::select('SELECT idVariable FROM variable WHERE Nombre=?',[$variable]);
        foreach ($ambitos as $amb ) {
            $idAmbito=DB::select('SELECT idAmbito FROM ambito WHERE Nombre=?',[$amb]);
            foreach ($categorias as $cat) {
                 $idCategoria=DB::select('SELECT idCategoria FROM categoria WHERE Nombre=?',[$cat]);
                foreach ($years as $year) {
                    for ($j=1; $j < 13 ; $j++) {   
                        $valor=DB::select('SELECT Valor FROM variableambitocategoria  WHERE idAmbito=? and idCategoria= ? AND Year=? AND Mes=? ORDER BY Mes ASC',[$idAmbito[0]->idAmbito,$idCategoria[0]->idCategoria,$year,$j]);
                        if(empty($valor)){
                            DB::insert('INSERT INTO variableambitocategoria ( idVariable, idCategoria, idAmbito, Mes, Year, Valor ) VALUES(?,?,?,?,?,NULL)',[$idVariable[0]->idVariable,$idCategoria[0]->idCategoria,$idAmbito[0]->idAmbito,$j,$year]);
                        }else{
                            DB::insert('INSERT INTO variableambitocategoria ( idVariable, idCategoria, idAmbito, Mes, Year, Valor ) VALUES(?,?,?,?,?,?)',[$idVariable[0]->idVariable,$idCategoria[0]->idCategoria,$idAmbito[0]->idAmbito,$j,$year,$valor]);
                        }
                    }
                    $meses=$meses+12;
                }
            }
        }

        return view('confirm.save');
    }

    /**
    * Función que devuelve todas las categorias menos la supercategoria "sin categoria"
    *
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function formNew(Request $request)
    {
        $supercategorias = DB::select('SELECT DISTINCT Name FROM supercategoria where supercategoria.Name!="Sin categoria"');
        return view('/form/new',compact('supercategorias'));

        
    }

    /**
    * Función que devuelve los parametros para insertar valores en una tabla insertada
    *
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function new(Request $request)
    {
        $categorias = $request->input("categorias");
        $variable = $request->input("nombre_variable");
        $years = $request->input("years");
        $ambitos = $request->input("ambitos");
        $tipo = $request->input("tipo");
        $descripcion = $request->input("descripcion");
        $fuente = $request->input("fuente");
        $values=array();

        return view('table.new',compact('categorias','variable','ambitos','years','values','fuente','tipo','descripcion'));
    }
    /**
    * Función que borra una variable
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function delete($id){
         DB::delete('DELETE FROM variableambitocategoria WHERE idVariable=?',[$id]);
         DB::delete('DELETE FROM variable WHERE idVariable=?',[$id]);

    return view('confirm.delete',compact('id'));
    }

    public function exportar($id){
        $valYear=array();
        $values=array();
        $valores=array();
        $idsCategoria=array();
        $idsCategoriaAux=array();

        $supercategorias = DB::select('SELECT DISTINCT Name,supercategoria.idSuperCategoria FROM supercategoria
                                        INNER JOIN categoria on categoria.idSuperCategoria = supercategoria.idSuperCategoria
                                        INNER JOIN variableambitocategoria on variableambitocategoria.idCategoria = categoria.idCategoria and variableambitocategoria.idVariable=?',[$id]);
        $nombreVariable = DB::select('SELECT Nombre FROM variable where idVariable=?',[$id]);
        $categoria  = DB::select('SELECT DISTINCT Nombre FROM categoria natural join variableambitocategoria WHERE idVariable=?',[$id]);
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
                $idsCategoriaAux=DB::select('SELECT idSuperCategoria FROM categoria where Nombre=?',[$cat->Nombre]);
                array_push($idsCategoria,$idsCategoriaAux);   
            }   
            array_push($values,$valores);
            $valores=array();
        }
        return \Excel::download(new InvoicesExport($nombreVariable,$years,$ambitos,$supercategorias,$categoria,$values,$idsCategoria), 'datosBoletinCoyuntura.xlsx');
    }
  


}
