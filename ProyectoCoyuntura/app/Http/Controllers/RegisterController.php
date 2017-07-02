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
use Illuminate\Support\Facades\Redirect;
use DB;
/**
* Clase que se encarga de gestionar los registros de la aplicacion.
*/
class RegisterController extends Controller
{
     /**
    * Función que se encarga de realizar la peticion de solicitud de registro
    *
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
     public function register(Request $request)
    {
    	$errorNombreEmail=true;
    	$errorPass=true;
    	$nombre = $request->input("nombre");
    	$email = $request->input("email");
    	$password = $request->input("password");
    	$repassword = $request->input("repassword");

    	if(RegisterController::comprobarPass($password,$repassword)){
    		$errorPass=false;
    	}
    	if(RegisterController::comprobarEmailNombre($email,$nombre)){
    		$errorNombreEmail=false;
    	}
    	if($errorNombreEmail==false and $errorPass==false){
	    	$fecha = date_create();
	    	DB::insert('INSERT INTO usersconfirm(id, name, email, password, remember_token, created_at, updated_at) VALUES (NULL,?,?,?,?,?,?)',[$nombre,$email,$password,$nombre,$fecha,$fecha]);
	    	return view('confirm/solicitud');
    	}else{
    		
    		return view('vendor/adminlte/auth/register',compact('errorPass','errorNombreEmail'));
    	}	
    }

     /**
    * Función que se encarga de aceptar la peticion de solicitud de registro
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function aceptar($id)
    {
    	$fecha = date_create();
    	$user=DB::select('SELECT * FROM usersconfirm  where id=?',[$id]);
    	DB::insert('INSERT INTO users(id, name, email, password, remember_token, created_at, updated_at) VALUES (NULL,?,?,?,?,?,?)',[$user[0]->name,$user[0]->email,$user[0]->password,$user[0]->remember_token,$user[0]->created_at,$fecha]);
    	$delete=DB::delete('DELETE FROM usersconfirm  where id=?',[$id]);
    	return Redirect::to('admin/users');
    }

         /**
    * Función que se encarga de declinar la peticion de solicitud de registro
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function declinar($id)
    {

    	$delete=DB::delete('DELETE FROM usersconfirm  where id=?',[$id]);
    	return Redirect::to('admin/users');
    }

    /**
    * Función que se encarga de comprobar si la contraseña es correcta
    *
    * @param String $password
    * @param String $repassword
    * @return boolean
    */
    protected function comprobarPass($password,$repassword)
    {
		if($password == $repassword){
			return true;
		}else{
			return false;
		}
    }
    /**
    * Función que se encarga de comprobar si el email o el nombre está repetido
    *
    * @param String $email
    * @param String $nombre
    * @return boolean
    */
    protected function comprobarEmailNombre($email,$nombre)
    {
		$nombreRepetido=DB::select('SELECT * FROM users where name=?',[$nombre]);
		$emailRepetido=DB::select('SELECT * FROM users where email=?',[$email]);

		if(empty($nombreRepetido) and empty($emailRepetido)){
			return true;
		}else{
			return false;
		}
    }
}
