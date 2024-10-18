<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    use HasFactory;
    
    //Habilitar relaciones polimorficas
    public function imageable(){
        return $this->morphTo();
    }
}