<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;

class RegisterController extends Controller
{
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
	    	DB::insert('INSERT INTO usersconfirm(id, name, email, password, remember_token, created_at, updated_at) VALUES (NULL,?,?,?,NULL,?,?)',[$nombre,$email,$password,$fecha,$fecha]);
	    	return view('confirm/solicitud');
    	}else{
    		
    		return view('vendor/adminlte/auth/register',compact('errorPass','errorNombreEmail'));
    	}	
    }

    public function aceptar($id)
    {
    	$fecha = date_create();
    	$user=DB::select('SELECT * FROM usersconfirm  where id=?',[$id]);
    	DB::insert('INSERT INTO users(id, name, email, password, remember_token, created_at, updated_at) VALUES (NULL,?,?,?,NULL,?,?)',[$user[0]->name,$user[0]->email,$user[0]->password,$user[0]->created_at,$fecha]);
    	$delete=DB::delete('DELETE FROM usersconfirm  where id=?',[$id]);
    	return Redirect::to('admin/users');
    }
    public function declinar($id)
    {

    	$delete=DB::delete('DELETE FROM usersconfirm  where id=?',[$id]);
    	return Redirect::to('admin/users');
    }
    protected function comprobarPass($password,$repassword)
    {
		if($password == $repassword){
			return true;
		}else{
			return false;
		}
    }
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
