<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    protected $table = 'music';
    protected $fillable = ['name', 'artist', 'listeners', 'image']; // Define the fillable fields

    // Add any relationships or custom methods as needed
}
