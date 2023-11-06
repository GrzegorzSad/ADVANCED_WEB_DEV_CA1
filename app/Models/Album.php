<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // Add 'name' to the $fillable property
        'artist',
        'description',
        'image_url',
        'release_date',
    ];


public function songs()
    {
        return $this->hasMany(Song::class);
    }

}