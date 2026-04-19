<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Author;
use App\Models\Publisher;
use App\Models\Book;
use App\Models\Category;


class AuthorPublisherBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::factory(100)->create()->each(function ($author) { //Cria 100 autores e para cada autor

            $publisher = Publisher::factory()->create(); //Cria uma editora

            $author->books()->createMany(
                Book::factory(10)->make([ //Cria 10 livros por autor
                    'category_id' => Category::inRandomOrder()->first()->id, //Pega uma categoria aleatória
                    'publisher_id' => $publisher->id,
                ])->toArray()
            );

        });
    }
}
