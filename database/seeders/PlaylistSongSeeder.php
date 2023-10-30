<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PlaylistSongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Assuming you have 50 songs and 5 playlists
        foreach (range(1, 50) as $songId) {
            // Associate each song with random playlists
            $playlistIds = $faker->randomElements(range(1, 5), $faker->numberBetween(1, 5));
            
            foreach ($playlistIds as $playlistId) {
                DB::table('playlist_song')->insert([
                    'playlist_id' => $playlistId,
                    'song_id' => $songId,
                ]);
            }
        }
    }
}