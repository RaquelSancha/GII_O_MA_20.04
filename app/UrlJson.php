<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class UrlJson extends Model
{
 /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'urlDatosINE';

  protected $throwValidationExceptions = true;
 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'url'];
}