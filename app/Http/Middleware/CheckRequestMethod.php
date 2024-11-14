<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRequestMethod
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $route = $request->route();
        if ($request->isMethod('get') && $route && in_array('POST', $route->methods())) {
            return redirect('/')->with('error', 'Chỉ chấp nhận phương thức POST.');
        }

        return $next($request);
    }
}
