<?php

namespace App\Models;

use App\Models\Traits\HasCode;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;
    use HasUuids;
    use HasCode;

    protected $fillable = [
        'name',
        'document',
        'type'
    ];

    public function address() : HasMany
    {
        return $this->hasMany(AddressClient::class, 'client_id', 'id');
    }

    public function prices() : HasMany
    {
        return $this->hasMany(Price::class, 'client_id', 'id');
    }
}
