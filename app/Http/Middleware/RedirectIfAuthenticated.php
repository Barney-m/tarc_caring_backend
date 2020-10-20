<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */

    //*Guard Attempt Failed 1*

    // public function handle($request, Closure $next, $guard = null)
    // {
    //     if (Auth::check() && auth()->user()->role_id <= 5){
    //         return redirect()->route('user.home');
    //     }

    //     if (Auth::check() && auth()->user()->role_id >= 6){
    //         return redirect()->route('admin.home');
    //     }

    //     return $next($request);
    // }

    //*Guard Re-attempt 2*

    public function handle($request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if ($guard == "admin" && Auth::guard($guard)->check()){
                return redirect(RouteServiceProvider::ADMIN_HOME);
            }

            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::USER_HOME);
            }
        }

        return $next($request);
    }

    // public function handle($request, Closure $next, ...$guards)
    // {
    //     switch(Auth::user()->role_id){
    //         case 1:
    //         case 2:
    //         case 3:
    //         case 4:
    //         case 5:
    //             return redirect()->route('user.home');
    //             break;
    //         case 6:
    //         case 7:
    //             return redirect()->route('admin.home');
    //             break;
    //         default:
    //             return redirect()->route('user.login');
    //     }
    // }
}
