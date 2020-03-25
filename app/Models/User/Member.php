<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User\Role;
use App\Models\PrizeUser;
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

    public function prize()
    {
        return $this->hasOne(PrizeUser::class, 'user_id');
    }

    public static function scopeMostTicketCount($q)
    {
        $maxTicketCount = (int) DrawTicket::getMostNumberOfTickets();
        return $maxTicketCount > 0? $q->with('tickets')->has('tickets', $maxTicketCount): $q->has('tickets');
    }
}
