<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    const TYPE_BILLING_ADDRESS = 1;

    const TYPE_SHIPPING_ADDRESS = 2;

    protected $fillable = [
        'name',
        'zip_code',
        'city',
        'street',
        'type',
    ];
}
