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
        if (Session::has(['credencial_id', 'empresa_id', 'empresa_nombre'])) {
            return $next($request);
        }
        Session::forget(['credencial_id', 'empresa_id', 'empresa_nombre']);
        return redirect()->route('credenciales.index');
    }
}
