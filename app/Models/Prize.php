<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\User\Winner;

class Prize extends Model
{
    protected $fillable = [
        'prize', 'num_of_winners'
    ];

    public function give(User $user)
    {
        $this->winners()->attach($user->id);
    }

    public function winners()
    {
        return $this->belongsToMany(Winner::class, 'prize_user', 'prize_id', 'user_id');
    }
}
