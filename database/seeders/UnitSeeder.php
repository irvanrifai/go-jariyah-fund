<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = [
            [
                'unit' => 'Sekretariat Deputi',
                'desc' => ''
            ],
            [
                'unit' => 'ASDEP Konsultasi Bisnis Dan Pendampingan',
                'desc' => ''
            ],
        ];

        foreach ($units as $unit) {
            Unit::create([
                'unit' => $unit['unit'],
                'desc' => $unit['desc']
            ]);
        }
    }
}
