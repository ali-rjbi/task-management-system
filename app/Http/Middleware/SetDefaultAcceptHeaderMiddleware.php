<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetDefaultAcceptHeaderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the request path starts with 'api'
        if (str_starts_with($request->path(), 'api')) {
            $request->headers->set('Accept', 'application/json');
        }

        return $next($request);
    }
}
