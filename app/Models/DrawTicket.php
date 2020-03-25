<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Models\User\Winner;

class DrawTicket extends Model
{
    protected $fillable = [
        'ticket_number',
        'user_id'
    ];

    protected $attributes = [
        'ticket_number' => ''
    ];

    public function setTicketNumberAttribute($value)
    {
        if (empty($value)) {
            $ticketNumber = self::generateTicket();
        } else {
            $ticketNumber = self::ticketExists($value)? self::generateTicket() : $value;
        }

        $this->attributes['ticket_number'] = $ticketNumber;
    }

    public static function generateTicket()
    {
        do {
            $ticketNumber = random_int(config('luckydraw.start'), config('luckydraw.end'));
        } while (self::ticketExists($ticketNumber));

        return $ticketNumber;
    }

    public static function ticketExists($ticketNumber)
    {
        if (!self::areTicketsAvailable()) {
            throw new \Exception('Tickets maxed out, please modify ticket range');
        }
        return self::where('ticket_number', $ticketNumber)->exists();
    }

    public static function areTicketsAvailable()
    {
        if (self::count() == (config('luckydraw.end') - config('luckydraw.start'))) {
            return false;
        }
        return true;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prize()
    {
        return $this->hasOne(PrizeUser::class, 'id');
    }

    public static function hasPrize($ticketNumber)
    {
        $ticket = self::where('ticket_number', $ticketNumber)->first();
        if (is_null($ticket)) {
            return false;
        }
        $winner = Winner::find($ticket->user->id);
        return is_null($winner)? false: true;
    }

    public static function getMostNumberOfTickets()
    {
        $ticket = DrawTicket::addSelect(DB::raw('COUNT(*) as ticketCount'))
            ->groupBy(['user_id'])
            ->latest('ticketCount');

        return $ticket->exists()? $ticket->first()->ticketCount : 0;
    }
}
