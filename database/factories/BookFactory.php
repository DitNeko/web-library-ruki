<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = FakerFactory::create('id_ID');

        return [
            'title' => $faker->sentence(3),
            'author' => $faker->name(),
            'isbn' => $faker->isbn10(),
            'publication_year' => $faker->year(),
            'category_id' => $faker->numberBetween(1, 25),
            'stock' => $faker->randomNumber(3, true)
        ];
    }
}
