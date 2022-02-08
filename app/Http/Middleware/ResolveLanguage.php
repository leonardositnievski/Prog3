<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ResolveLanguage
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
        $path = explode('/',$request->getRequestUri());
        $lang = $path[1];
        if(isset(config('app.supported_locales')[$lang])){
            $locale = config('app.supported_locales')[$lang];
            unset($path[1]);
        }else{
            $locale = config('app.locale');
        }
        app()->setLocale($locale);
        $path = implode('/',$path);


        $request_vars = $request->server->all();
        $request_vars['PATH_INFO'] = $path;
        $request_vars['PHP_SELF'] = '/index.php'.$path;
        $request_vars['REQUEST_URI'] = $path;


        $request->initialize(
            $request->query->all(),
            $request->request->all(),
            $request->attributes->all(),
            $request->cookies->all(),
            $request->files->all(),
            $request_vars,
            $request->getContent()
        );
        return $next($request);
    }
}
