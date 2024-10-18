<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    use HasFactory;

    protected $fillable = ['name', 'slug', 'stract', 'body', 'status', 'categoria_id', 'user_id'];
    
    const BORRADOR = 1;
    const PUBLICADO = 2;

    //Relación uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    //Relación muchos a muchos 
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    //Relacion uno a muchos polimorfica 
    public function images(){
        return  $this->morphMany(Image::class, 'imageable');
    }
}
