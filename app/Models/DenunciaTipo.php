<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DenunciaTipo extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome'
    ];
    public function denuncias(){
        return $this->hasMany(Denuncias::class, 'tipo_denuncia_id','id');
    }
}
