<?php
/**
 * Raquel Sancha
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol_Usuario extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'role_user';
    protected $fillable = ['role_id', 'user_id'];

}
