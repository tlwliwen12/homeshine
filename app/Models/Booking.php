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
        'bill_code',
        'cleaner_id',
        'cleaner_earning',
        'company_commission',
        'refund_reference',
        'refund_date',
        'payout_reference',
        'payout_date',
        'refund_bill_code',
        'payout_bill_code',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'refund_date' => 'datetime',
        'payout_date' => 'datetime',
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

    public function cleanerStatuses()
    {
        return $this->hasMany(BookingCleanerStatus::class);
    }
}
