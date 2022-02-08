<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome'
    ];
    public function postagens(){
        return $this->hasMany(PostagemCategoria::class,'categoria_id','id');
    }
}
