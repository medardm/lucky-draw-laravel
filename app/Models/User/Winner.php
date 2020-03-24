<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\User;
use App\Models\PrizeUser;

class Winner extends User
{
    protected $table = "users";
    protected $primary = "id";

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('winners', function (Builder $builder) {
            $builder->has('prize');
        });
    }
}
