<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{

    protected $fillable = [
        'title',
        'user',
        'description',
        'image_url',
        // Add any other attributes that can be mass-assigned here
    ];

    
    use HasFactory;
    
public function songs()
{
    return $this->belongsToMany(Song::class);
}
}