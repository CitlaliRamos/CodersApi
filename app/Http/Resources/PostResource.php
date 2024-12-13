<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'nombre' => $this->nombre,
            'slug' => $this->slug,
            'extracto' => $this->extracto,
            'cuerpo' => $this->cuerpo,
            'status' => $this->status == 1 ? 'BORRADOR' : 'PUBLICADO',
            'categoria_id'=> $this->categoria_id,
            'user' => UserResource::make($this->whenLoaded('user')),
            'categoria' => CategoriaResource::make($this->whenLoaded('categoria'))
        ];//
    }
}
