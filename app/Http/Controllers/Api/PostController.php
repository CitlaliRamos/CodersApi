<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

use App\Http\Resources\PostResource;

class PostController extends Controller implements HasMiddleware
{
   /* public function __construct()
    {
        $this->middleware('auth:api')->except(['index','show']);
    }*/
    public static function middleware(): array
    {
        return [
            new Middleware(middleware: 'auth:api', except: ['index', 'show','store','destroy', 'update']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::included()
            ->filter()
            ->sort()
            ->getOrPaginate();
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        //
        $data = $request->validate([
            'nombre' => 'required|max:255',
            'slug' => 'required|max:255|unique:posts',
            'extracto'=> 'required',
            'cuerpo'=> 'required',
            'categoria_id'=> 'required|exists:categorias,id',
            
        ]);//'user_id'=> 'required|exists:users,id'

        //$user = auth()->user();
        //$data['user_id'] = $user->id;
        $data['user_id'] = 1;

        $post = Post::create($data);
        return PostResource::make($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        $post = Post::included()->findOrFail($post->id);
        return PostResource::make($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {   
        //
        $request->validate([
            'nombre' => 'required|max:255',
            'slug' => 'required|max:255|unique:posts,slug,'.$post->id,
            'extracto'=> 'required',
            'cuerpo'=> 'required',
            'categoria_id'=> 'required|exists:categorias,id',
        ]);

        //$user = auth()->user();
        //$data['user_id'] = $user->id;

        $post->update($request->all());
        return PostResource::make($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();

        return PostResource::make($post);
    }
}
