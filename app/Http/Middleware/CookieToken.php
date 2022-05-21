<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CookieToken
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
        $token = $request->cookie('library-token');
        if(!$token){
            session(['library.next' => $request->path()]);
            return redirect()->route('login');
        }

        $user = User::where('remember_token', hash('md5', $token))->first();

        if(!$user){
            session(['library.next' => $request->path()]);
            return redirect()->route('login');
        }

        return $next($request);
    }
}
