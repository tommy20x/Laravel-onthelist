<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VenueBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'venue_id',
        'booking_type',
        'type',
        'price',
        'date',
        'time',
        'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function venue() {
        return $this->belongsTo(Venue::class);
    }
}
