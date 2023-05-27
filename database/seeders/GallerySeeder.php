<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $galleries = [
            [
                'title' => 'Gambar satu',
                'desc' => 'ini deskripsinya gambar satu',
                'image' => env('APP_URL') . '/storage/photos/1/610935f2359dd.png',
                'is_show' => 1,
                'count_show' => 0,
                'created_by' => null,
                'updated_by' => null
            ],
            [
                'title' => 'Kegiatan Sebelum Covid 19 Diluar',
                'desc' => '-',
                'image' => env('APP_URL') . '/storage/photos/1/61093614d7cd4.jpeg',
                'is_show' => 1,
                'count_show' => 0,
                'created_by' => null,
                'updated_by' => null
            ],
            [
                'title' => 'Taufik Nikahan',
                'desc' => '-',
                'image' => env('APP_URL') . '/storage/photos/1/610935f2359dd.png',
                'is_show' => 1,
                'count_show' => 0,
                'created_by' => null,
                'updated_by' => null
            ],
        ];

        foreach ($galleries as $gallery) {
            Gallery::create([
                'title' => $gallery['title'],
                'desc' => $gallery['desc'],
                'image' => $gallery['image'],
                'is_show' => $gallery['is_show'],
                'count_show' => $gallery['count_show'],
                'created_by' => $gallery['created_by'],
                'updated_by' => $gallery['updated_by']
            ]);
        }
    }
}
