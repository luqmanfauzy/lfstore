<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    
    public function run(): void
    {
        $categories = [
            ['category_name' => 'kacamata anti radiasi'],
            ['category_name' => 'kacamata photocromic'],
            ['category_name' => 'kacamata anak anak'],
            ['category_name' => 'kacamata baca'],
            ['category_name' => 'kacamata hitam'],
            ['category_name' => 'kaos kaki panjang'],
            ['category_name' => 'kaos kaki pendek'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
