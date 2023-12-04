<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $url = '/images/TMS.webp';
        $faker = Faker::create();

        // Replace $userId with the desired user ID
        $userId = 1;

        foreach (range(1, 5) as $index) {
            DB::table('playlists')->insert([
                'user_id' => $userId, // Associate all playlists with the specified user ID
                'title' => $faker->sentence(2),
                'description' => $faker->text,
                'image_url' => $url,
                'creation_date' => $faker->date,
            ]);
        }
    }
}