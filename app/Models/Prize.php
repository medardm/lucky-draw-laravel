<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Models\User\Winner;

class Prize extends Model
{
    protected $fillable = [
        'prize', 'num_of_winners'
    ];

    public function getRemainingWinnersAttribute()
    {
        return $this->attributes['num_of_winners'] - $this->winners->count();
    }

    public function give(User $user)
    {
        if ($user->hasPrize) {
            return false;
        }
        $this->winners()->attach($user->id);
        return $user->hasPrize;
    }

    public function winners()
    {
        return $this->belongsToMany(Winner::class, 'prize_user', 'prize_id', 'user_id');
    }

    public static function scopeAvailable($q)
    {
        // $noWin = self::doesntHave('winners')->get();
        // $notEnoughWin = self::has('winners')->get();
        return $q->has('winners', '!=', DB::raw('prizes.num_of_winners'));
    }
}
