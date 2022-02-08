<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    use HasFactory;
    protected $fillable = [
        'denunciante_id',
        'postagem_id',
        'tipo_denuncia_id',
        'comentario_id',
        'analizado_por_id',
        'analizado_em',
        'denuncia_texto'
    ];
    protected $casts = [
        'analizado_em' => 'datetime',
    ];
    public function postagem(){
        return $this->hasOne(Postagem::class);
    }
    public function denunciante(){
        return $this->hasOne(User::class, 'id', 'denunciante_id');
    }
    public function tipo(){
        return $this->hasOne(DenunciaTipo::class,'id','tipo_denuncia_id');
    }
    public function analista(){
        return $this->hasOne(User::class, 'id', 'analizado_por_id');
    }
}
