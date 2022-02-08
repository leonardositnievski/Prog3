<?php

namespace App\Http\Controllers;

use App\Models\Postagem;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.aprovacoes')->with(['posts' => Postagem::naoAutorizado()->get()]);
    }
    public function autorizacao ($id, $action){

        $postagem = Postagem::findOrFail($id);

        $action == 'aprovar' ? $postagem->autorizar() : $postagem->delete();

        return redirect()->route('aprovacoes');


        
    }
}
