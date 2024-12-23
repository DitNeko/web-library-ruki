<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = FakerFactory::create('id_ID');
        $categoryCount = Category::count();

        return [
            'name' => $faker->name(),
            'book_id' => $faker->numberBetween(1, $categoryCount),
            'loan_date' => $faker->date(),
            'return_date' => $faker->date(),
        ];
    }
}
