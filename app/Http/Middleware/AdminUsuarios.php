<?php

namespace App\Http\Middleware;

use Closure;
use App\Role;
use App\Rol_Usuario;
class AdminUsuarios
{
    /**
     * Handle an incoming request.
     * Raquel Sancha
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $rol)
    {
        if (! $request->user()->hasRol($rol)) {
            abort(403, "No puedes acceder aquí con tus privilegios");
        }
        return $next($request);
    }
}
