<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCheckUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check()) {
            return redirect(route('screen_admin_login'));
        } else {
            $user = Auth::user();
            $roles = $user->role;
            if($roles->name === User::ADMIN || $roles->name === User::MANAGER) {
                return $next($request);
            } else if($roles->name === User::SHIPPER || $roles->name === User::CUSTOMER) {
                return redirect(route('screen_admin_login'));
            }
        }
        
        return $next($request);
    }
}
