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
use App\User;
use App\Usersconfirm;
use App\Role;
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
     $user = Usersconfirm::find($id);
     $user->entrustPasswordHash();
     $name = $user->name;
     $email= $user->email;
     $password= $user->password;
     $remember_token= $user->rembember_token;
     $created_at= $user->created_at;
      $insert=DB::insert('INSERT INTO users(id, name, email, password, remember_token, created_at, updated_at) VALUES (NULL,?,?,?,?,?,?);',[$name,$email,$password,$remember_token,$created_at,$fecha]);
      $idusuario= DB::select('SELECT id FROM users where email=?',[$email]);
      $insert2=DB::insert('INSERT INTO role_user(user_id, role_id) VALUES (?,?);',[$idusuario[0]->id,'2']);
      $delete=DB::delete('DELETE FROM usersconfirm  where id=?',[$id]);
    	return Redirect::to('register/index');
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
    	return Redirect::to('register/index');
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
     /**
    * Función que se encarga de mostrar la información para editar el rol del usuario
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {  
      $user = User::find($id);    
      $roles= Role::all();
        return view('register/edit',compact('user','id','roles'));
    }
    /**
     * Esta función actualiza los datos cambiados del rol del usuario
     * 
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
      $usuario= User::find($id);
      $rol= $request->input("roles");
      if(empty($rol)){
        $rol_aux= DB::select('SELECT roles.id FROM roles 
        inner join role_user on roles.id=role_user.role_id 
        inner join users on users.id=role_user.user_id and users.id=?',[$id]);
      }else{
        $rol_aux= DB::select('SELECT roles.id FROM roles WHERE name=?',[$rol]);
      }
      $update_rol_user=DB::update('UPDATE role_user SET role_id= ? WHERE user_id=? ', [$rol_aux[0]->id,$id]);
    	return Redirect::to('register/index');
    }
      /**
    * Función que se encarga de declinar la peticion de solicitud de registro
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function borrar($id)
    {
    	$delete=DB::delete('DELETE FROM users  where id=?',[$id]);
    	return Redirect::to('register/index');
    }

      /**
    * Función que se encarga de mostrar los usuarios y los usuarios por confirmar
    *
    * @return view
    */
    public function show()
    {
      $users=DB::select('SELECT * FROM users'); 
      $usersconfirm=DB::select('SELECT * FROM usersconfirm');  
		 return view('register.index',compact('users','usersconfirm'));
    }
}
