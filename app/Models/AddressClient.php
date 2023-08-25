<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressClient extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'cep',
        'city',
        'district',
        'address',
        'state',
        'type'
    ];
}
