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
        'approval_status',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'postcode',
        'bank_name',
        'bank_account_name',
        'bank_account_number',
    ];
}
