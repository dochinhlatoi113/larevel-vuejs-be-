<?php

namespace Modules\Store\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenLogin
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

        if (auth()->guard('api')->guest()) {

            //return response('xxxxx.', 401)s
            return response()->json([
                'status' => 'ERR',
                'mess' => 'đăng nhập để sử dụng mã code',
            ]);

        }
        return $next($request);

    }
}
