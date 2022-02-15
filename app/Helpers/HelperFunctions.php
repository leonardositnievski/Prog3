<?php

use App\Models\DenunciaTipo;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\HtmlString;


function componentCSS($component){
     return new HtmlString('<link rel="stylesheet" href="'.URL::asset("css/components/$component.css").'">');
}


function componentJS($component) {
    return new HtmlString("<script src='" . URL::asset("js/components/$component.js") . "'></script>");
}

/**
 * user
 *
 * @return Usuario
 */
function user() {
    return auth()->user();
}
function categorias_denuncias(){
    return DenunciaTipo::get();
}

function routeLang($route, $params = []) {
    $route = route($route, $params, false);
    $lang = config('app.url_locales')[app()->getLocale()];
    return app('url')->to($lang . $route);
}
