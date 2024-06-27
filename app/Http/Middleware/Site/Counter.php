<?php

namespace App\Http\Middleware\Site;

use Closure;
use Illuminate\Http\Request;
use App\Services\Admin\Status\StatusServices;

class Counter
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
//        (new StatusServices())->setCountService();
        return $next($request);
    }
}
