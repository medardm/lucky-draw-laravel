<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class DrawTicket extends Model
{
    const START = 0000;
    const END = 9999;

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
            $ticketNumber = random_int(self::START, self::END);
        } while (self::ticketExists($ticketNumber));

        return $ticketNumber;
    }

    public static function ticketExists($ticketNumber)
    {
        if (self::count() == (self::END - self::START)) {
            throw new Exception('Tickets maxed out');
        }
        return self::where('ticket_number', $ticketNumber)->exists();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
