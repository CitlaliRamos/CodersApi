<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Post;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('slug')->unique();
            $table->text('extracto');
            $table->longText('cuerpo');

            $table->enum('status',[Post::BORRADOR, Post::PUBLICADO])->default(Post::BORRADOR);

            /* 
            SI SE APLICAN LAS CONVENCIONES SE PUEDE REDUCIR EL CODIGO
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias');*/
            $table->foreignId('categoria_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
