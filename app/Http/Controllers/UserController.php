<?php
/** -- -------------------------------------------------------------
*   -- Nombre:      Proyecto Coyuntura
*   -- Organización:Escuela Politécnica Superior
*   -- Autor:       Raquel Sancha
*   -- Fecha:       junio del 2020
*   -- Versión:     1.0
*   -- -------------------------------------------------------------
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\User;

class UserController extends Controller
{
  /**
   * Función que muestra los datos del usuario que se quieren cambiar
   * @param int $id
   * @return \Illuminate\Http\Response
   */
    public function edit($id)
    {
        $user = User::find($id);   
        return view('user/editarPerfil',compact('user','id'));
    }
    /**
   * Función que cambia los datos del usuario
   * @param Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
    public function update(Request $request, $id){
     $usuario= User::find($id);
      $nombre=$request->input("nombre_usuario");
      if(empty($nombre)){
        $nombre=$usuario->name;
      }
      $email=$request->input("email");
      if(empty($email)){
        $email=$usuario->email;
      }
      $contraseña=$request->input("contraseña");
      if(empty($contraseña)){
        $contraseña=$usuario->password;
      }
    $update_user=DB::update('UPDATE users SET name= ?, email= ?, password=? WHERE id=? ', [$nombre,$email,$contraseña,$id]);
    $usuario->entrustPasswordHash();
    return Redirect::to('/home');
    }
  

}