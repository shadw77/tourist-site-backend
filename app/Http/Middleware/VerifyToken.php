<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Traits\GeneralTrait;

class VerifyToken
{    use GeneralTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $token = $request->header('authorization');

            if (!$token) {
                return  $this -> returnError('Token not provided','401');
            }
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return  $this -> returnError('Unauthenticated user','401');
            }

            return $next($request);

        } catch (\JWTException $e) {
            return  $this -> returnError('Invalid token'.$e->getMessage(),'401');

        }
    }
}
