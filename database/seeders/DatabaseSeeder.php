<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            // PostSeeder::class,
            // CategoryRelationshipSeeder::class,
            WebsiteSettingSeeder::class,
            SliderSeeder::class,
            // GallerySeeder::class,
           // UnitSeeder::class,
            // ReportConflictInterestSeeder::class,
            // ReportGratifikasiSeeder::class,
            //WBSRecipientSeeder::class,
            //LaratrustSeeder::class,
            // WBSSenderSeeder::class,
            // WBSTopicSeeder::class
        ]);
    }
}
