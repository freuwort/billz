<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'email',
        'phone',
        'tax_id',
        'office',
        'bank_name',
        'bank_account_holder',
        'bank_iban',
        'bank_bic',
        'address_name',
        'address_street',
        'address_zip',
        'address_city',
        'address_country',
        'note',
    ];

    public function getBankAttribute()
    {
        return [
            'name' => $this->bank_name,
            'account_holder' => $this->bank_account_holder,
            'iban' => $this->bank_iban,
            'bic' => $this->bank_bic,
        ];
    }

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
