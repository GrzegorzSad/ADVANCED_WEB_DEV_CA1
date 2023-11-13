<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AlbumSeeder;
use Database\Seeders\SongSeeder;
use Database\Seeders\PlaylistSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\RoleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call([
            AlbumSeeder::class,
            SongSeeder::class,
            PlaylistSeeder::class,
            PlaylistSongSeeder::class,
            RoleSeeder::class,
            UserSeeder::class
        ]);
    }
}