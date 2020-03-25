<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Models\User\Winner;
use App\Models\User\Member;

class Prize extends Model
{
    protected $fillable = [
        'prize', 'num_of_winners'
    ];



    public function getRemainingWinnersAttribute()
    {
        return $this->attributes['num_of_winners'] - $this->winners->count();
    }

    public function give(User $user, $winningTicket)
    {
        if ($user->hasPrize) {
            return false;
        }
        $this->winners()->attach($user->id, [
            'draw_ticket_id' => $user->tickets()->where('ticket_number', $winningTicket)->first()->id
        ]);
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

    public function getIsAvailableAttribute($q)
    {
        return self::available()->get()->contains($this);
    }

    public function findRandomWinner()
    {
        if (!$this->isAvailable) {
            return false;
        }
        switch ($this->attributes['prize']) {
            case 'Grand Prize':
                // get users with most number of tickets
                // get the tickets of these users
                // randomly pick from the tickets of these users
                $winningTicket = DrawTicket::whereIn(
                    'user_id',
                    Member::mostTicketCount()
                        ->doesntHave('prize')
                        ->get()
                        ->pluck('id')
                        ->toArray()
                )->get()->random();

                $this->give($winningTicket->user, $winningTicket->ticket_number);

                return $winningTicket->user;
                break;

            default:
                // randomly pick from the tickets of the users
                $winningTicket = DrawTicket::whereIn(
                    'user_id',
                    Member::has('tickets')
                        ->doesntHave('prize')
                        ->get()
                        ->pluck('id')
                        ->toArray()
                )->get()->random();

                $winner = $this->give($winningTicket->user, $winningTicket->ticket_number);

                return $winningTicket->user;
                break;
        }
    }
}
