<?php

namespace App\Http\Controllers;

use App\Models\Midia;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function show($id) {
        return view('profile')->with(['user' => Usuario::findOrFail($id)]);
    }

    public function create()
    {
        return view('usuarios.create', ['pagina' => 'usuarios']);
    }

    public function insert(Request $request)
    {
        

        $form = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'name' => 'required',
        ]);
        $usuario = new Usuario;
        $usuario = $usuario->fill($form);
        $usuario->password = Hash::make($request->password);
        $usuario->save();
        return redirect()->route('login')->withInput(['username' => $usuario->username]);
    }

    // Ações de login
    public function login(Request $request)
    {
            
            $credenciais = $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);
            // Tenta o login
            if (Auth::attempt($credenciais , false)){
                session()->regenerate();
                return redirect()->route('home');
            }
            else{
                return redirect()->route('login')->with('erro','Usuário ou senha inválidos.');
            }
        }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('home');
    }
    
    public function editar(Request $request) {
        $form = $request->validate([
            'photo_url' => Midia::getValidator(),
        ]);
        if (isset($form['photo_url'])) {
            try {
                DB::beginTransaction();
                $photo = Midia::upload($form['photo_url']);
                user()->photo_url = $photo->url;
                user()->photo?->delete();
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
            }
        }

        user()->fill($request->all());
        user()->save();
        return redirect()->route('profile', ['id' => user()->id]);
    }


    public function procurar(Request $request){
        if(!$request->query('q')){
            return response()->json([]);
        }

        $results = Usuario::select(['id','name','photo_url'])
                        ->where(DB::raw('lower(name)'),'LIKE', '%'.strtolower($request->query('q')).'%')
                        ->limit(10)
                        ->get();
        foreach ($results as $user) {
            $user->profile = $user->profile_url;
        }
        return response()->json($results);
    }

    public function configuracoes(Request $request){
        
        $request->validate([
            'password' => 'confirmed'
        ]);
        auth()->user()->settings = json_encode(['private_profile' => !!$request->private_profile]);
        if ($request->password) {
            auth()->user()->password = Hash::make($request->password);
        }
        auth()->user()->save();
        return redirect()->back();
    }
}
