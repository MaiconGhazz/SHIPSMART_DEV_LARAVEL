<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait HasCode
{
    protected static function bootHasCode()
    {
        static::creating(function ($query) {
            $code = '';
            do{
                $code = (string) Str::upper(Str::random(3));
                $exists = self::where('code', $code)->first();
            }while($exists);
            $query->code = $code;
        });
    }
}
