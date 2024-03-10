<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VenueMedia extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'venue_id',
        'type',
        'path'
    ];
}
