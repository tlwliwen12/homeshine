<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingCleanerStatus extends Model
{
    protected $fillable = [
        'booking_id',
        'cleaner_id',
        'status'
    ];
}
