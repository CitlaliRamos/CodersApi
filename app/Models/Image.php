<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class Image extends Model
{
    //
    use HasFactory, ApiTrait;
    
    //Habilitar relaciones polimorficas
    public function imageable(){
        return $this->morphTo();
    }
}
