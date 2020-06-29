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
use DB;
/**
* Clase que se encarga de las operaciones con los datos de la aplicación.
*/
class DataController extends Controller
{
    public function subirDatos(Request $request)
    {
        $url = $request->input("url");
        $urlJson= DataController::crearUrl($url);
        print_r($urlJson);
        $datos= json_decode(file_get_contents($urlJson), true);
        print_r($datos);

    }
    function multiexplode ($delimiters,$string) {
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }
    
    public function crearUrl($url)
    {
        $tempus3 = 'jaxiT3';
        $pos = strpos($url, $tempus3);
        $urlJson= "https://servicios.ine.es/wstempus/js/ES/DATOS_TABLA";
        if ($pos === false) {//la url pertenece a PCAxis
            $input = DataController::multiexplode(array("=","&"),$url);
            $urlJson.= $input[1].$input[3];
        } else { //la url pertenece a tempus3
            $input = DataController::multiexplode(array("=","&"),$url);
            $urlJson.= "/".$input[1];
        }
        return $urlJson;
    }

    
    /**
    * Función que se encarga de mostrar las variables de la BD
    *
    *@return \Illuminate\Http\Response
    */ 
    public function indexVariable()
    {
    	$fuentes=array();
    	$fuentesAux=array();
        $variables = DB::select('SELECT * FROM variable order by Nombre ASC');
        foreach ($variables as $variable) {
        	$fuentesAux = DB::select('SELECT DISTINCT Name FROM fuente natural join variable where variable.Nombre=?',[$variable->Nombre]);
        	array_push($fuentes,$fuentesAux);
        }
        return view('data/index/variables',compact('fuentes','variables'));
    }

    /**
    * Función que se encarga de editar el tipo, la fuente, la descripcion y el nombre de la variabla pasada por parametro.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function editVariable($id)
    {
        $variables = DB::select('SELECT * FROM variable where idVariable=?',[$id]);
        $fuentes = DB::select('SELECT DISTINCT Name FROM fuente natural join variable where variable.idVariable=?',[$id]);

        return view('data/edit/variables',compact('fuentes','variables','id'));
    }

     /**
    * Función que se encarga de actualizar en la base de datos el tipo, la fuente, la descripcion y el nombre de la variabla pasada por parametro.
    *
    * @param  int  $id
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
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

    /**
    * Función que se encarga de mostrar las super categorías de la BD
    *
    *@return \Illuminate\Http\Response
    */ 
    public function indexSuperCategoria()
    {
        $categorias=array();
        $categoriasAux=array();
        $supercategorias = DB::select('SELECT * FROM supercategoria order by Name ASC');

        foreach ($supercategorias as $supercat) {
            $categoriasAux = DB::select('SELECT DISTINCT Nombre FROM categoria natural join supercategoria where supercategoria.idSuperCategoria=?',[$supercat->idSuperCategoria]);
            array_push($categorias,$categoriasAux);
        }
        return view('data/index/supercategoria',compact('categorias','supercategorias'));
    }
    /**
    * Función que se encarga de editar las categorias que forman parte de la supercategoría pasada por parametro.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function editSuperCategoria($id)
    {
        $supercategorias = DB::select('SELECT * FROM supercategoria where idSuperCategoria=?',[$id]);
        $categorias = DB::select('SELECT DISTINCT Nombre FROM categoria natural join supercategoria where supercategoria.idSuperCategoria=?',[$id]);
        $AllCategorias = DB::select('SELECT DISTINCT Nombre FROM categoria natural join supercategoria where supercategoria.idSuperCategoria!=?',[$id]);

        return view('data/edit/supercategorias',compact('categorias','supercategorias','id','AllCategorias'));
    }
    /**
    * Función que se encarga de actualizar en la base de datos poniendo y quitando categorias de una super categoria pasada por parametro.
    *
    * @param  int  $id
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
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

        return view('data/confirm/update');
    }

    /**
    * Función que se encarga de mostrar las categorias que están sin super categoria para ofrecerlas en el formulario de creacion de una nueva super categoria.
    * 
    * @return \Illuminate\Http\Response
    */
    public function createSuperCategoria()
    {
       
        $categorias = DB::select('SELECT DISTINCT Nombre FROM categoria natural join supercategoria where supercategoria.Name="Sin categoria"');
        return view('data/create/supercategorias',compact('categorias'));
    }
    /**
    * Función que se encarga de introducir una super categoria en la BD con las categorias asignadas.
    *
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
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
    /**
    * Función que se encarga de quitar de la base de datos una super Categoria.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function deleteSuperCategoria($id)
    {
        
        $idSuperCat=DB::select('SELECT idSuperCategoria FROM supercategoria WHERE Name="Sin categoria" ');
        $consulta=DB::update('UPDATE categoria SET idSuperCategoria=? WHERE idSuperCategoria=?',[$idSuperCat[0]->idSuperCategoria,$id]);
        $delete=DB::delete('DELETE FROM supercategoria WHERE idSuperCategoria=?',[$id]);

        return view('data/confirm/delete');
    }

    /**
    * Función que se encarga de mostrar las categorías de la BD
    *
    * @return \Illuminate\Http\Response
    */ 
    public function indexCategoria()
    {
        $supercategorias=array();
        $supercategoriasAux=array();
        $categorias = DB::select('SELECT * FROM categoria order by Nombre ASC');

        foreach ($categorias as $cat) {
            $supercategoriasAux = DB::select('SELECT DISTINCT Name FROM supercategoria natural join categoria where categoria.idCategoria=?',[$cat->idCategoria]);
            array_push($supercategorias,$supercategoriasAux);
        }
        return view('data/index/categoria',compact('categorias','supercategorias'));
    }

    /**
    * Función que se encarga de mostrar la super categoria a la que está asignada una categoria para mostrarla en el formulario y así poder editarla.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */ 
    public function editCategoria($id)
    {
        $categorias = DB::select('SELECT * FROM categoria where idCategoria=?',[$id]);
        $supercategorias = DB::select('SELECT DISTINCT Name FROM supercategoria natural join categoria where categoria.idSuperCategoria != ?',[$categorias[0]->idSuperCategoria]);
        $categoria_supercategoria = DB::select('SELECT DISTINCT Name FROM supercategoria where idSuperCategoria = ?',[$categorias[0]->idSuperCategoria]);


        return view('data/edit/categorias',compact('categorias','supercategorias','id','categoria_supercategoria'));
    }

     /**
    * Función que se encarga de actualizar la base de datos modificando el nombre de la categoria pasada por parametro y la super categoria a la que está asignada. 
    *
    * @param  int  $id
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function updateCategoria(Request $request, $id)
    {
        $nombre_categoria=$request->input("nombre_categoria");
        $supercategorias=$request->input("supercategorias");


        if(!(empty($nombre_categoria))){
             $consulta=DB::update('UPDATE categoria SET Nombre=? WHERE idCategoria=?',[$nombre_categoria,$id]);
        }
        if(!(empty($supercategorias))){
            $idSuperCat=DB::select('SELECT idSuperCategoria FROM supercategoria WHERE Name=? ',[$supercategorias]);
            $consulta=DB::update('UPDATE categoria SET idSuperCategoria=? WHERE idCategoria=?',[$idSuperCat[0]->idSuperCategoria,$id]);
        }
        

        return view('data/confirm/update');
    }

    /**
    * Función que se encarga de mostrar las super categorias para ofrecerlas en el formulario de creacion de una nueva categoria.
    * 
    * @return \Illuminate\Http\Response
    */
    public function createCategoria()
    {
       
        $supercategorias = DB::select('SELECT DISTINCT Name FROM supercategoria where supercategoria.Name!="Sin categoria"');
        return view('data/create/categorias',compact('supercategorias'));
    }

    /**
    * Función que se encarga de introducir una categoria en la BD con su super categoria.
    *
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function newCategoria(Request $request)
    {
        $supercategorias=$request->input("supercategorias");
        $nombre_categoria=$request->input("nombre_categoria");

        if(empty($supercategorias)){
            $idSuperCat=DB::select('SELECT idSuperCategoria FROM supercategoria WHERE Name="Sin categoria" ');
        }else{
            $idSuperCat=DB::select('SELECT idSuperCategoria FROM supercategoria WHERE Name=? ',[$supercategorias]);
        }
        DB::insert('INSERT INTO categoria(idCategoria, idSuperCategoria, Nombre) VALUES (NULL,?,?)',[$idSuperCat[0]->idSuperCategoria,$nombre_categoria]);
        
        return view('data/confirm/create');
    }

    /**
    * Función que se encarga de borrar una categoria pasada por parametro de la base de datos.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */ 
    public function deleteCategoria($id)
    {
        $delete=DB::delete('DELETE FROM variableambitocategoria WHERE idCategoria=?',[$id]);
        $delete=DB::delete('DELETE FROM categoria WHERE idCategoria=?',[$id]);

        return view('data/confirm/delete');
    }

    /**
    * Función que se encarga de borrar las variables a las que pertenece una categoría para borrarlas solo de la variable. 
    *
    * @param  int  $id
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
     public function deleteCategoriaVariable(Request $request, $id)
    {

        $variables=$request->input("variables");

        foreach ($variables as $var) {
            $idVariable=DB::select('SELECT idVariable FROM variable WHERE Nombre=? ',[$var]);
            $delete=DB::delete('DELETE FROM variableambitocategoria WHERE idCategoria=? and idVariable ',[$id,$idVariable[0]->idVariable]);
        }
            
        return view('data/confirm/delete');
    }

    /**
    * Función que nos devuelve una vista para elegir si borrar la categoria de una variable o de la aplicación. 
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function chooseDeleteCategoria($id)
    {
        return view('data/delete/categorias',compact('id'));
    }

    /**
    * Función que nos muestra las variables a las que pertenece una categoria. 
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function chooseVariableDeleteCategoria($id)
    {
        $categorias=DB::select('SELECT Nombre FROM categoria WHERE idCategoria=? ',[$id]);
        $variables=DB::select('SELECT DISTINCT Nombre FROM variable natural join variableambitocategoria WHERE idCategoria=? ',[$id]);
        return view('data/delete/variables/categorias',compact('id','variables','categorias'));
    }

    /**
    * Función que nos muestra los ambitos geograficos. 
    *
    * @return \Illuminate\Http\Response
    */
    public function indexAmbito()
    {
        $ambitos = DB::select('SELECT * FROM ambito order by Nombre ASC');
        return view('data/index/ambito',compact('ambitos'));
    }

    /**
    * Función que nos muestra el ambito escogido para editar. 
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function editAmbito($id)
    {
        $ambitos = DB::select('SELECT * FROM ambito where idAmbito=?',[$id]);
        return view('data/edit/ambito',compact('ambitos','id'));
    }

     /**
    * Función que nos permite cambiar el nombre de nuestro ambito. 
    *
    * @param \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
     public function updateAmbito(Request $request, $id)
    {
        $nombre_ambito=$request->input("nombre_ambito");
        if(!(empty($nombre_ambito))){
             $consulta=DB::update('UPDATE ambito SET Nombre=? WHERE idAmbito=?',[$nombre_ambito,$id]);
        }
        return view('data/confirm/update');
    }

     /**
    * Función que nos permite agregar un nuevo ambito a la BD. 
    *
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function newAmbito(Request $request)
    {
        $nombre_ambito=$request->input("nombre_ambito");

        DB::insert('INSERT INTO ambito(idAmbito, Nombre) VALUES (NULL,?)',[$nombre_ambito]);
        
        return view('data/confirm/create');
    }

    /**
    * Función que nos devuelve una vista para elegir si borrar el ambito de una variable o de la aplicación. 
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
     public function chooseDeleteAmbito($id)
    {
        return view('data/delete/ambito',compact('id'));
    }

     /**
    * Función que borra el ambito de la aplicacion.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
     public function deleteAmbito($id)
    {
        $delete=DB::delete('DELETE FROM variableambitocategoria WHERE idAmbito=?',[$id]);
        $delete=DB::delete('DELETE FROM ambito WHERE idAmbito=?',[$id]);

        return view('data/confirm/delete');
    }

     /**
    * Función que muestra las variables que contienen este ambito.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function chooseVariableDeleteAmbito($id)
    {
        $ambitos=DB::select('SELECT Nombre FROM ambito WHERE idAmbito=? ',[$id]);
        $variables=DB::select('SELECT DISTINCT Nombre FROM variable natural join variableambitocategoria WHERE idAmbito=? ',[$id]);
        return view('data/delete/variables/ambito',compact('id','variables','ambitos'));
    }

     /**
    * Función que borra el ambito de una variable pasada por parametro. 
    *
    * @param \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
     public function deleteAmbitoVariable(Request $request, $id)
    {

        $variables=$request->input("variables");

        foreach ($variables as $var) {
            $idVariable=DB::select('SELECT idVariable FROM variable WHERE Nombre=? ',[$var]);
            $delete=DB::delete('DELETE FROM variableambitocategoria WHERE idAmbito=? and idVariable ',[$id,$idVariable[0]->idVariable]);
        }
            
        return view('data/confirm/delete');
    }
}
