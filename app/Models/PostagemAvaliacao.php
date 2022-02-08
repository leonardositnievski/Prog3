<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostagemAvaliacao extends Model
{
    use HasFactory;
    protected $table = 'postagem_avaliacoes';
    protected $fillable = [
        'postagem_id',
        'avaliador_id',
        'nota',
        'avaliacao_texto'
    ];
    public function avaliador(){
        return $this->hasOne(User::class,'id','avaliador_id');
    }
    public function postagem(){
        return $this->hasOne(Postagem::class);
    }
}
