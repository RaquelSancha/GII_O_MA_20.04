<?php

namespace App\Http\Middleware;

use Closure;

class usuario
{
    protected $auth;
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        switch ($this->auth->user()->idrol) {
            case '1':
                 return redirect()->to('admin');
                break;
            
            case '2':
                return redirect()->to('responsable');
                break;
            case '0':
                #usuario
                #return redirect()->to('usuario');
                break;
            
            default:
                # code...
                break;
        }
        return $next($request);
    }
}
