<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class DrawTicket extends Model
{
    protected $fillable = [
        'ticket_number',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
