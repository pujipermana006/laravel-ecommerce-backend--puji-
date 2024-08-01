<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'address',
        'country',
        'province',
        'city',
        'district',
        'postal_code',
        'is_default',
    ];
}
