<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class VariableController extends Controller
{
    public function index()
    {
        $variables = DB::table('variable')->get();

        return view('table.index', ['variables' => $variables]);
    }
   
}
