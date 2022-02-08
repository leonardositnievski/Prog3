<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostagemCategoria extends Model
{
    use HasFactory;
    protected $fillable = [
        'postagem_id',
        'categoria_id'
    ];
    public function categoria(){
        return $this->hasOne(Categoria::class, 'id','categoria_id');
    }
    public function postagem(){
        return $this->hasOne(Postagem::class, 'id','postagem_id');
    }
}
