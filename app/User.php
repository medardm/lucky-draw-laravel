<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\User\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Default role
     * @var array
     */
    protected $attributes = [
        'role_id' => Role::MEMBER
    ];

    /**
     * User role
     * @method role
     * @return App\Models\User\Role User role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getIsAdminAttribute()
    {
        return $this->role->id == Role::ADMIN;
    }
}
