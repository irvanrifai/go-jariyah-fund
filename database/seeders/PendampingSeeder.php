<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PendampingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pendampings = [
            [
                'name' => 'Irvan-Pendamping-Test',
                'username' => 'pendamping-1',
                'no_hp' => '08123456789',
                'email' => 'irvan@test.com',
                'password' => '12345678',
                'is_active' => 1
            ],
            [
                'name' => 'rifai-Pendamping-Test',
                'username' => 'pendamping-2',
                'no_hp' => '081223456789',
                'email' => 'rifai@test.com',
                'password' => '12345678',
                'is_active' => 1
            ],
            [
                'name' => 'Irvanrifai-Pendamping-Test',
                'username' => 'pendamping-3',
                'no_hp' => '08323456789',
                'email' => 'irvanrifai@test.com',
                'password' => '12345678',
                'is_active' => 1
            ]
        ];

        foreach ($pendampings as $pendamping) {
            DB::table('jf_pendamping')->insert([
                'name' => $pendamping['name'],
                'username' => $pendamping['username'],
                'no_hp' => $pendamping['no_hp'],
                'email' => $pendamping['email'],
                'is_active' => $pendamping['is_active'],
                'password' => Hash::make($pendamping['password'])
            ]);
        }
    }
}
