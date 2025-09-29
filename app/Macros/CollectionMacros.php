<?php

namespace App\Macros;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CollectionMacros
{
    public static function register()
    {
        Collection::macro('toUpper', function () {
            return $this->map(fn($value) => Str::upper($value));
        });


        Collection::macro("toLower",function(){
          return $this->map(fn($value) => Str::lower($value));
        });
    }
}