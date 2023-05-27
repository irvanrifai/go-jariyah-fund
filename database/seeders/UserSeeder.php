<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Ulul Albab',
                'email' => 'ulul@staging-kemenkop.id9.site',
                'password' => '12345678'
            ],
            [
                'name' => 'Rizky A',
                'email' => 'rizky@mail.com',
                'password' => '12345678'
            ],
            [
                'name' => 'Administrator',
                'email' => 'cs.kewirausahaan@gmail.com',
                'password' => 'cs.web2021.,?'
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password'])
            ]);
        }
    }
}
