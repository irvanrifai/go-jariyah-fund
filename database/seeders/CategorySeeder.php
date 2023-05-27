<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'slug' => 'berita',
                'title' => 'Berita',
                'description' => '',
                'icon' => null
            ],
            [
                'slug' => 'opini',
                'title' => 'Opini',
                'description' => '',
                'icon' => null
            ],
            [
                'slug' => 'pengumuman',
                'title' => 'Pengumuman',
                'description' => '',
                'icon' => null
            ],
        ];

        foreach ($categories as $category) {
            Categories::create([
                'slug' => $category['slug'],
                'title' => $category['title'],
                'description' => $category['description'],
                'icon' => $category['icon'],
            ]);
        }
    }
}
