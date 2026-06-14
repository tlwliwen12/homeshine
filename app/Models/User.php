<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'status',
        'approval_status',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'postcode',
        'bank_name',
        'bank_account_name',
        'bank_account_number',
        'gender',
        'profile_image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function assignedBookings()
    {
        return $this->hasMany(Booking::class, 'cleaner_id');
    }

    public function cleanerBookings()
    {
        return $this->hasMany(
            \App\Models\Booking::class,
            'cleaner_id'
        );
    }
}
