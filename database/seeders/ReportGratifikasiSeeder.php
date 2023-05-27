<?php

namespace Database\Seeders;

use App\Models\Report_gratifikasi;
use Illuminate\Database\Seeder;

class ReportGratifikasiSeeder extends Seeder
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
        $status = [
            'draft',
            'followup',
            'done'
        ];

        $from_types = [
            'Batik',
            'Plakat',
            'Motor',
            'Mobil',
            'Sepeda',
            'Helikopter'
        ];
        
        for ($i = 0; $i < 5; $i++) {
            Report_gratifikasi::create([
                'fullname' => $this->faker->name,
                'email' => $this->faker->email,
                'telp' => $this->faker->phoneNumber,
                'status' => $status[rand(0, 2)],
                'position' => $this->faker->jobTitle,
                'date' => date('Y-m-d H:i:s'),
                'is_accept' => rand(0,1),
                'from_company' => $this->faker->company,
                'from_type' => $from_types[rand(0,5)],
                'from_nominal_estimate' => $this->faker->numberBetween(100000,100000000),
                'note_forward' => null,
                'file' => null,
                'reference_number' => (function () use ($i) {
                    return date('Ymd', strtotime('now')) . generateCodeLetter($i + 1);
                })()
            ]);
        }
    }
}
