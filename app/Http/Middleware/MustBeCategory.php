<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Symfony\Component\HttpFoundation\Response;

class MustBeCategory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->user()->hasAnyPermission(['category write','category edit','category access','category delete']))
        {
            abort(403);
        }
        return $next($request);
    }
}
