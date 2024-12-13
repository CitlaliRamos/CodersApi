<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class Categoria extends Model
{
    //
    use HasFactory, ApiTrait;

    protected $fillable = ['nombre', 'slug'];

    protected $allowIncluded = ['posts','posts.user'];
    protected $allowFilter = ['id','nombre','slug'];
    protected $allowSort = ['id','nombre','slug'];

    //Relacion uno a muchos
    public function posts(){
        return $this->hasMany(Post::class);
    }

}
