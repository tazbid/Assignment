<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Traits\UserTrait;

class IsActive
{
    use UserTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            //dd("Here");
            if (Auth::user()->status == $this->userDeactive) {
                
                Auth::logout();

                // Auth::logoutOtherDevices();
                return redirect(RouteServiceProvider::HOME);
            }
        }
        return $next($request);
    }
}
