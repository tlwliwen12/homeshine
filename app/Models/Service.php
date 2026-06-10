<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
    'name',
    'category',
    'description',
    'price',
    'duration',
    'image'
    ];

    public function bookings()
    {
        return $this->hasMany(
            \App\Models\Booking::class,
            'service_id'
        );
    }
}
