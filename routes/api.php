<?php

use App\Http\Controllers\Api\CategoriaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\PostController;

Route::post('register', [RegisterController::class, 'store'])->name('api.register');

/*Route::get('categorias',[CategoriaController::class, 'index'])->name('api.categoria.index');
Route::post('categorias',[CategoriaController::class, 'store'])->name('api.categorias.store');
Route::get('categorias/{categoria}',[CategoriaController::class, 'show'])->name('api.categorias.show');
Route::put('categorias/{categoria}',[CategoriaController::class, 'update'])->name('api.categorias.update');
Route::delete('categorias/{categoria}',[CategoriaController::class, 'delete'])->name('api.categorias.delete');
*/

Route::apiResource('categorias',CategoriaController::class)->names('api.categorias');
Route::apiResource('posts',PostController::class)->names('api.posts');

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');
