<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        $url='/images/TMS.webp';

        $faker = Faker::create();

        foreach (range(1, 5) as $index) {
            DB::table('playlists')->insert([
                'title' => $faker->sentence(2),
                'user' => $faker->name,
                'description' => $faker->text,
                'image_url' => $url,
                'creation_date' => $faker->date,
            ]);
        }
    }
}