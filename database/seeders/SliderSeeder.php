<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sliders = [
            [
                'title' => 'Slide 1',
                'link' => '#',
                'desc' => 'a',
                'image' => env('APP_URL') . '/storage/photos/1/60e2d5a12684a.png',
                'is_show' => 1,
                'created_by' => 1,
                'updated_by' => null
            ],
            [
                'title' => 'Slide 2',
                'link' => '#',
                'desc' => '',
                'image' => env('APP_URL') . '/storage/photos/1/60e2d5c65dd31.png',
                'is_show' => 1,
                'created_by' => 1,
                'updated_by' => null
            ],
        ];

        foreach ($sliders as $slider) {
            Slider::create([
                'title' => $slider['title'],
                'link' => $slider['link'],
                'desc' => $slider['desc'],
                'image' => $slider['image'],
                'is_show' => $slider['is_show'],
                'created_by' => $slider['created_by'],
                'updated_by' => $slider['updated_by'],
            ]);
        }
    }
}
