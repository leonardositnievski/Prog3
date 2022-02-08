<?php

namespace App\Http\Controllers;

use App\Models\Midia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MidiaController extends Controller
{
    public function get($url){
        $midia = Midia::where('url', $url)->first();
        if (!$midia) {
            return response('',404);
        }

        $file = Storage::get('images/'.$midia->url);
        return response($file, 200)
            ->header('Content-Type', 'image/jpg');
    }
}
