<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Prize;

class PrizeUser extends Model
{
    protected $table = 'prize_user';

    public function details()
    {
        return $this->hasOne(Prize::class, 'id', 'prize_id');
    }
}
