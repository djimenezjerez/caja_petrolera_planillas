<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Credencial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class VerificarCredencial
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Session::has('credencial_id')) {
            if (Credencial::where('id', Session::get('credencial_id'))->exists()) {
                Session::put('credencial_nombre', Credencial::find(Session::get('credencial_id'))->empresa->nombre);
                return $next($request);
            }
        }
        return redirect()->route('credenciales.index');
    }
}
