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
    // '24':{
    //     text: 'Discurso de Odio',
    //     children : {
    //         '42' : {
    //             text: 'teste odio'
    //         }
    //     }
    // },
    // '43':{
    //     text: 'Esta conta é falsa',
    //     children : {
    //         '42' : {
    //             text: 'teste falsa',
    //             children : {
    //                 '42' : {
    //                     text: 'teste falsa'
    //                 }
    //             }
    //         }
    //     }
    // },
    // '52':{
    //     text: 'Ele me agride',
    // },
    // '54':{
    //     text: 'Outro Motivo',
    //     children : {
    //         '42' : {
    //             text: 'teste outro motivo'
    //         }
    //     }
    // }
    public function getNomeAttribute(){
        return __("view.report.{$this->attributes['nome']}");
    }
    public static function get(){
        $tipos = DenunciaTipo::all();
        $categorias = [];

        foreach ($tipos as $tipo) {
            if(!$tipo->categoria_pai_id){
                $categorias[$tipo->id] = [
                    'text' => $tipo->nome
                ];
                continue;
            }

            if (!isset($categorias[$tipo->categoria_pai_id]['children'])) {
                $categorias[$tipo->categoria_pai_id]['children'] = [];
            }

            $categorias[$tipo->categoria_pai_id]['children'][$tipo->id] = ['text'=>$tipo->nome];


        }
        return $categorias;
    }
    public function denuncias(){
        return $this->hasMany(Denuncias::class, 'tipo_denuncia_id','id');
    }
}
