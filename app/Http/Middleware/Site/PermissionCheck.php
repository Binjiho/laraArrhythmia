<?php

namespace App\Http\Middleware\Site;

use Closure;
use Illuminate\Http\Request;

class PermissionCheck
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
        $routeName = $request->route()->getName();

        switch ($routeName) {
            case 'overseas.register':
                if (!in_array(thisLevel(), ['M', 'S', 'A', 'G'])) {
                    return denyRedirect();
                }
                break;

            case 'research.register':
            case 'surgery.register':
                if (!in_array(thisLevel(), ['M', 'S'])) {
                    return denyRedirect();
                }
                break;
        }

        return $next($request);
    }
}
