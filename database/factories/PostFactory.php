<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nombre = $this->faker->unique()->word(20);

        return [
            'nombre' => $nombre,
            'slug' => Str::slug($nombre),
            'extracto' => $this->faker->text(250),
            'cuerpo' => $this->faker->text(2000),
            'status' => $this->faker->randomElement([ Post::BORRADOR, Post::PUBLICADO ]),
            'categoria_id' => Categoria::all()->random()->id,
            'user_id' => User::all()->random()->id
        ];
    }
}
