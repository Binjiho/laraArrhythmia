<?php

namespace App\Http\Middleware\Site;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class SessionCheck
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
        $code = $request->code; // 게시판 code
        $routeName = $request->route()->getName(); // route 이름

//        if( $_SERVER['REMOTE_ADDR']=="218.235.94.247") {
//            dd($routeName, ': : routename');
//        }

        switch ($routeName) {
            case 'main':
                Session::put('siteType', 'main');
//                $request->attributes->set('siteType', 'main');
                break;
            case 'pro':
                Session::put('siteType', 'pro');
//                $request->attributes->set('siteType', 'pro');
                break;
            case 'eng':
                Session::put('siteType', 'eng');
//                $request->attributes->set('siteType', 'eng');
                break;
            case 'general':
                Session::put('siteType', 'general');
//                $request->attributes->set('siteType', 'general');
                break;
            case 'board':
                break;
            default:
                if (Session::has('siteType')) {
                    Session::forget('siteType');
                }
                break;
        }

        return $next($request);
    }
}
