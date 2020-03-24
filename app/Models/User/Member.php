<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User\Role;
use App\Models\DrawTicket;

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

    public function tickets()
    {
        return $this->hasMany(DrawTicket::class, 'user_id');
    }
}
