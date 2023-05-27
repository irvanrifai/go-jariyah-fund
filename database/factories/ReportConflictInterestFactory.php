<?php

namespace Database\Factories;

use App\Models\ReportConflictInterest;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportConflictInterestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ReportConflictInterest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $types = [
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
    protected $status = [
        'draft',
        'followup',
        'done'
    ];
    public function definition()
    {
        return [
            'fullname' => $this->faker->name,
            'reported_fullname' => $this->faker->name,
            'reported_position' => $this->faker->suffix,
            'telp' => $this->faker->numberBetween(8000, 9000),
            'email' => $this->faker->email,
            'type' => $this->types[rand(0,8)],
            'text' => $this->faker->realText(200, 1),
            'status' => $this->status[rand(0, 2)],
            'date' => date('Y-m-d H:i:s'),
            'location' => $this->faker->address,
            'unit_id' => rand(1,2),
            'note' => null,
            'file' => null,
            'reference_number' => function () {
                $last_number = ReportConflictInterest::whereDate('created_at', date('Y-m-d', strtotime('now')))->get();
                $reference_number =  date('Ymd', strtotime('now')) . generateCodeLetter(count($last_number) + 1);
                return $reference_number;
            }
        ];
    }
}
