<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address_name',
        'address_street',
        'address_zip',
        'address_city',
        'address_country',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAddressAttribute()
    {
        return [
            'name' => $this->address_name,
            'street' => $this->address_street,
            'zip' => $this->address_zip,
            'city' => $this->address_city,
            'country' => $this->address_country,
        ];
    }
}
