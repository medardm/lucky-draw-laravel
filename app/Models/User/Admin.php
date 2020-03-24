<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use App\User;
use App\Models\User\Role;

class Admin extends Authenticatable
{
    protected $table = "users";
    protected $primary = "id";
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('admins', function (Builder $builder) {
            $builder->where('role_id', Role::ADMIN);
        });
    }
}
