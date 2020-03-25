<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Prize;
use App\User;

class PrizeUser extends Model
{
    protected $table = 'prize_user';

    public function details()
    {
        return $this->hasOne(Prize::class, 'id', 'prize_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ticket()
    {
        return $this->hasOne(DrawTicket::class, 'id', 'draw_ticket_id');
    }
}
