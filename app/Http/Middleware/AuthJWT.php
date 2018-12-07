<?php
/**
 * Created by PhpStorm.
 * User: igorrozu
 * Date: 12/4/18
 * Time: 12:57 AM
 */

namespace App\Http\Middleware;

use Closure;

use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthJWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $token = $request->cookie('token');
            if ($token) {
                JWTAuth::setToken($token);
                $request->setUserResolver(function () {
                    return JWTAuth::toUser();
                });
            }
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['error'=>'Token is Invalid']);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['error'=>'Token is Expired']);
            } else {
                return response()->json(['error'=>'Something is wrong']);
            }
        }

        return $next($request);
    }
}