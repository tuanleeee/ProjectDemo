<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Cache;
use Carbon\Carbon;

class CheckUserStatus
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
        if (Auth::check()){
            $expireAt = Carbon::now()->addMinutes(1);
            Cache::put('user-is-online-' . Auth::user()->id,true,$expireAt);
        }
        return $next($request);
    }
}
