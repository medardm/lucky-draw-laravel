<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User\Role;

class Member extends Model
{
    protected $table = "users";
    protected $primary = "id";
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('members', function (Builder $builder) {
            $builder->where('role_id', Role::MEMBER);
        });
    }
}
