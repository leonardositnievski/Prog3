<?php

namespace App\Http\Middleware;

use App\Models\Usuario;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateWithAPIToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->token;
        if ($request->header('Authorization')) {
            $token = explode('Bearer ', $request->header('Authorization'))[1];
        }
        if (!$token) {
            return response()->json('Unauthenticated',401);
        }
        $user = Usuario::where('api_token', $token)->first();
        if (!$user) {
            return response()->json('Unauthenticated',401);
        }
        Auth::login($user);
        
        return $next($request);
    }
}
