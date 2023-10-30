<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            DB::table('songs')->insert([
                'name' => $faker->sentence(2),
                'category' => $faker->word,
                'artist' => $faker->name,
                'album_id' => $faker->numberBetween(1, 10), // Assuming you have 10 albums
                'playlist_id' => $faker->numberBetween(1, 5), // Assuming you have 5 playlists
            ]);
        }
    }
}
