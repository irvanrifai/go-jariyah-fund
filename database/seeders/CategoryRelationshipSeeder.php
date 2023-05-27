<?php

namespace Database\Seeders;

use App\Models\CategoryRelationships;
use Illuminate\Database\Seeder;

class CategoryRelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_relationships = [
            [
                'post_id' => 2,
                'category_id' => 1
            ],
            [
                'post_id' => 3,
                'category_id' => 2
            ],
            [
                'post_id' => 4,
                'category_id' => 3
            ],
        ];

        foreach ($category_relationships as $category) {
            CategoryRelationships::create([
                'post_id' => $category['post_id'],
                'category_id' => $category['category_id']
            ]);
        }
    }
}
