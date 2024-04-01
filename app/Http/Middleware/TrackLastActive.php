<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackLastActive
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse)  $next
     * @return Response
     */
    public function handle( Request $request, Closure $next ): Response
    {
        if ( $request->user() && ( !$request->user()->last_active_at || $request->user()->last_active_at->isPast() ) ) {
            $request->user()->update( [
                'last_active_at' => now(),
            ] );
        }

        return $next( $request );
    }
}
