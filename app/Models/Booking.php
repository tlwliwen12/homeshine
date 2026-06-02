<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'booking_date',
        'booking_time',
        'address',
        'notes',
        'status',
        'payment_status',
        'refund_status',
        'payout_status',
        'bill_code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function cleaner()
    {
        return $this->belongsTo(User::class, 'cleaner_id');
    }
}
