<?php

namespace App\Http\Controllers;

use App\Models\Midia;
use App\Models\Postagem;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class PostController extends Controller
{
    public function home(){
        $posts = Postagem::inRandomOrder()->autorizado()->limit(5)->get();
        return view('home')->with(['posts'=> $posts]);
    }


    public function publicar(Request $request){
        $form = $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'description' => 'required',
            'midia' => Midia::getValidator(),
        ]);

        $photo = Midia::upload($request->file('midia'));     
        
        Postagem::create([
            'owner_id' => Usuario::current()->id,
            'photo_url' => $photo->url,
            'descricao' => $form['description'],
            'titulo' => $form['title']
        ]);

        return redirect()->route('home');
    }

    public function show($id){
        return view('post')->with([
            'post' => Postagem::findOrFail($id)
        ]);
    }

    public function avaliar(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'stars' => 'required|max:10|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $post = Postagem::findOrFail($request->id);
        $avalicao = $post->userReview();
        if ($avalicao) {
            $avalicao->nota = $request->stars;
            $avalicao->avaliacao_texto = $request->texto;
            $avalicao->save();
            return response()->json(__('api.post.review.update'));
        }
        $post->avaliar($request->stars, $request->texto);
        return response()->json(__('api.post.review.insert'), 201);
    }
    public function denunciar() {
    }


}
