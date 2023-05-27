<?php

namespace Database\Seeders;

use App\Models\ReportConflictInterest;
use Illuminate\Database\Seeder;

class ReportConflictInterestSeeder extends Seeder
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
            'afiliasi',
            'gratifikasi',
            'kerja_tambahan',
            'orang_dalam',
            'pengadaan_barang',
            'tuntutan_keluarga',
            'kedudukan_ganda',
            'intervensi_jabatan',
            'rangkap_jabatan'
        ];
        $status = [
            'draft',
            'followup',
            'done'
        ];
        
        for ($i = 0; $i < 5; $i++) {
            ReportConflictInterest::create([
                'fullname' => $this->faker->name,
                'reported_fullname' => $this->faker->name,
                'reported_position' => $this->faker->jobTitle,
                'telp' => $this->faker->phoneNumber,
                'email' => $this->faker->email,
                'type' => $types[rand(0, 8)],
                'text' => $this->faker->realText(200, 1),
                'status' => $status[rand(0, 2)],
                'date' => date('Y-m-d H:i:s'),
                'location' => $this->faker->address,
                'unit_id' => rand(1, 2),
                'note' => null,
                'file' => null,
                'reference_number' => (function () use ($i) {
                    return date('Ymd', strtotime('now')) . generateCodeLetter($i + 1);
                })()
            ]);
        }
    }
}
