<?php
namespace App\Http\Middleware;


use Closure;
use Session;
use Illuminate\Contracts\Routing\Middleware;
class LangMiddleware
{
    public function handle($request, Closure $next)
    {
        if($lang=$request->session()->get('lang')){
            \App::setLocale($lang);
        }
        return $next($request);
    }
}