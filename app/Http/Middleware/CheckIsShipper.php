<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIsShipper
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
            return redirect(route('login_shipper_get'));
        } else {
            $user = Auth::user();
            $roles = $user->role;
            if($roles->name === User::SHIPPER) {
                return $next($request);
            }
            else if($roles->name === User::CUSTOMER) {
                return redirect(route('login_shipper_get'))->with('message', 'Bạn không có quyền!');
            }
        }
        return $next($request);
    }
}
