<?php 
namespace App\Helpers;

class Helpers{


    public static function to_KB($b){
        return round($b / 1024);
    }

}