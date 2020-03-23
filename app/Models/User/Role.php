<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    const ADMIN = 1;
    const MEMBER = 2;

    protected $fillable = [
        'role'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
