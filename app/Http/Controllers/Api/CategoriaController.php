<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

use App\Http\Resources\CategoriaResource;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //$categorias = Categoria::all();
        $categorias = Categoria::included()
            ->filter()
            ->sort()
            ->getOrPaginate();

        return CategoriaResource::collection($categorias);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nombre' => 'required|max:255',
            'slug' => 'required|max:255|unique:categorias'
        ]);

        $categoria = Categoria::create($request->all());
        
        //return $categoria;
        return CategoriaResource::make($categoria);//=>> return new CategoriaResource($categoria);
    }

    /**
     * Display the specified resource.
     */
    //public function show(Categoria $categoria)
    public function show($id)
    {
        // return $categoria;

        //$categoria = Categoria::with('posts.user')->findOrFail($id);
       // return $categoria;
       
       //$categoria = Categoria::included()->findOrFail($id);
       //return $categoria;

       $categoria = Categoria::included()->findOrFail($id);
       return CategoriaResource::make($categoria);//=>> return new CategoriaResource($categoria);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
        $request->validate([
            'nombre' => 'required|max:255',
            'slug' => 'required|max:255|unique:categorias,slug,'.$categoria->id
        ]);

        $categoria->update($request->all());
        
       // return $categoria;
       return CategoriaResource::make($categoria);//=>> return new CategoriaResource($categoria);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        //
        $categoria->delete();
        //return $categoria;
        return CategoriaResource::make($categoria);//=>> return new CategoriaResource($categoria);
    }
}
