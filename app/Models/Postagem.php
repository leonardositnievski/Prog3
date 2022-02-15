<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postagem extends Model
{
    use HasFactory;
    protected $table= "postagens";
    protected $filable = [
        'owner_id',
        'photo_url',
        'descricao',
        'titulo',
        'autorizado_por_id',
        'autorizado_em',
        'autorizado',
    ];
    protected $casts = [
        'autorizado_em' => 'datetime',
        'autorizado'=>'boolean',
    ];
    protected $guarded = [];
    public function owner(){
        return $this->hasOne(Usuario::class, 'id','owner_id');
    }

    public function autorizador(){
        return $this->hasOne(Usuario::class, 'id','autorizado_por_id');
    }
    public function comentarios(){
        return $this->hasMany(PostagemComentario::class,'postagem_id','id');
    }

    public function avaliacoes(){
        return $this->hasMany(PostagemAvaliacao::class,'postagem_id','id');
    }
    
    public function categorias(){
        return $this->hasMany(PostagemCategoria::class,'postagem_id','id');
    }

    public function avaliacaoUsuario(){
        return $this->hasOne(PostagemAvaliacao::class,'postagem_id','id')->where('avaliador_id', auth()->user()->id); 
    }

    public function scopeNaoAutorizado($query){
        $query->where('autorizado', false);
    }
    
    public function scopeAutorizado($query){
        $query->where('autorizado', true);
    }

    public function getTimestampAttribute(){
        return $this->created_at->diffForHumans();
    }
    public function getNotaAttribute(){
        return $this->avaliacoes()->avg('nota');
    }
    public function autorizar(){
        if(!auth()->user()->isAdmin or $this->autorizado){
            return;
        }
        
        $this->autorizado = true;
        $this->autorizado_por_id = auth()->user()->id;
        $this->autorizado_em = now();
        $this->save();
        return $this;

    }
    public function getPhotoUrlAttribute(){
        return route('image',['url' => $this->attributes['photo_url']]);
    }
    public function getRawPhotoUrlAttribute(){
        return $this->attributes['photo_url'];
    }


    public function avaliar($stars, $texto = null){
        return PostagemAvaliacao::create([
            'postagem_id' => $this->id,
            'avaliador_id' => auth()->user()->id,
            'nota' => $stars,
            'avaliacao_texto' => $texto
        ]);
    }
    public function userReview(){
        return PostagemAvaliacao::where('postagem_id', $this->id)
                                    ->where('avaliador_id', auth()->user()->id)
                                    ->first();

    }

    public function denunciar($tipo){
        $denuncia = Denuncia::where('postagem_id', $this->id)
                        ->where('denunciante_id',user()->id)
                        ->first();
        if($denuncia){
            throw new \Exception("Usuario ja denunciado");
        }

        return Denuncia::create([
            'denunciante_id' => user()->id,
            'postagem_id' => $this->id,
            'tipo_denuncia_id' => $tipo,
        ]);
    }
}
