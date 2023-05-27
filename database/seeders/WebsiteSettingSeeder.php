<?php

namespace Database\Seeders;

use App\Models\WebsiteSettings;
use Illuminate\Database\Seeder;

class WebsiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $website_setting = [
            [
                'name' => 'Website Title',
                'key' => 'title',
                'value' => 'Deputi Bidang Kewirausahaan',
                'autoload' => 'yes'
            ],
            [
                'name' => 'Website Address',
                'key' => 'address',
                'value' => 'Jl. H. R. Rasuna Said No.Kav. 3-4, RT.6/RW.7, Kuningan, Karet Kuningan, Kecamatan Setiabudi, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12940',
                'autoload' => 'yes'
            ],
            [
                'name' => 'Website Phone',
                'key' => 'phone',
                'value' => '1500 587',
                'autoload' => 'yes'
            ],
            [
                'name' => 'Website Instagram',
                'key' => 'instagram',
                'value' => 'https://www.instagram.com/kemenkopukm/',
                'autoload' => 'yes'
            ],
            [
                'name' => 'Website Twitter',
                'key' => 'twitter',
                'value' => 'https://twitter.com/kemenkopukm',
                'autoload' => 'yes'
            ],
            [
                'name' => 'Website Facebook',
                'key' => 'facebook',
                'value' => 'https://www.facebook.com/kemenkopukm',
                'autoload' => 'yes'
            ],
            [
                'name' => 'Website Youtube',
                'key' => 'youtube',
                'value' => 'https://www.youtube.com/channel/UCoJ8KhDi60I9-yAU8DJFqoA',
                'autoload' => 'yes'
            ],
            [
                'name' => 'Website Departement Name',
                'key' => 'departement',
                'value' => 'Deputi Bidang Kewirausahaan',
                'autoload' => 'yes'
            ],
            [
                'name' => 'Website Email',
                'key' => 'email',
                'value' => 'cs.kewirausahaan@gmail.com',
                'autoload' => 'yes'
            ],
        ];

        foreach ($website_setting as $ws) {
            WebsiteSettings::create([
                'name' => $ws['name'],
                'key' => $ws['key'],
                'value' => $ws['value'],
                'autoload' => $ws['autoload']
            ]);
        }
    }
}
