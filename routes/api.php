<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;

Route::post('register', [RegisterController::class, 'store'])->name('api.register');



// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');
