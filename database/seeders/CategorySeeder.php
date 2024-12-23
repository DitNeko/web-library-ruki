<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            ['name' => 'Fiksi'],
            ['name' => 'Non-Fiksi'],
            ['name' => 'Fantasi'],
            ['name' => 'Misteri'],
            ['name' => 'Romansa'],
            ['name' => 'Ilmu Pengetahuan'],
            ['name' => 'Biografi'],
            ['name' => 'Thriller'],
            ['name' => 'Sastra Klasik'],
            ['name' => 'Buku Anak'],
            ['name' => 'Fiksi Ilmiah'],
            ['name' => 'Horror'],
            ['name' => 'Dystopian'],
            ['name' => 'Fiksi Sejarah'],
            ['name' => 'Memoir'],
            ['name' => 'Self-Help'],
            ['name' => 'Spiritualitas'],
            ['name' => 'Antologi'],
            ['name' => 'Graphic Novel'],
            ['name' => 'Young Adult'],
            ['name' => 'Sastra Anak'],
            ['name' => 'Puisi'],
            ['name' => 'Perjalanan'],
            ['name' => 'Buku Masak'],
            ['name' => 'Kejahatan Nyata'],
        ];

        foreach ($genres as $value) {
            Category::create($value);
        }
    }
}
