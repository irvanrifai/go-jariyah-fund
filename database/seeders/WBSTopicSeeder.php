<?php

namespace Database\Seeders;

use App\Models\WbsTopic;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use File;

class WBSTopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $faker;
    public function __construct()
    {
        $this->faker = \Faker\Factory::create('id_ID');
    }
    public function run()
    {
        $types = [
            'pengaduan',
            'permintaan-informasi',
            'aspirasi'
        ];

        for ($i = 0; $i < 5; $i++) {
            WbsTopic::create([
                'sender_id' => $i + 1,
                'recipient_id' => rand(1, 3),
                'title' => $this->faker->word,
                'content' => $this->faker->sentence(10, true),
                'file' => (function () use ($i) {
                    $files = File::files(public_path('upload-dummy'));
                    return Storage::putFile('public/wbs-media', $files[$i]->getRealPath());
                })(),
                'type' => $types[rand(0, 2)],
                'status' => 'new',
                'url_token' => (function () {
                    $uuid = Str::orderedUuid();
                    $epoch = Carbon::now()->timestamp;
                    return Str::slug($epoch . '-' . str_shuffle($uuid));
                })(),
                'reference_number' => (function () use ($i) {
                    return date('Ymd', strtotime('now')) . generateCodeLetter($i + 1);
                })(),
                'link' => null
            ]);
        }
    }
}
