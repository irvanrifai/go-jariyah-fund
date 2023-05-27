<?php

namespace Database\Seeders;

use App\Models\WbsSender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class WBSSenderSeeder extends Seeder
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
        for ($i = 0; $i < 5; $i++) {
            WbsSender::create([
                'name' => $this->faker->name,
                'email' => $this->faker->email,
                'phone' => $this->faker->phoneNumber,
                'email_verified_at' => null,
                'url_token' => (function () {
                    $uuid = Str::orderedUuid();
                    $epoch = Carbon::now()->timestamp;
                    return Str::slug($epoch . '-' . str_shuffle($uuid));
                })(),
            ]);
        }
    }
}
