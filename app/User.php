<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\User
 *
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'deletable'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'deletable' => 'boolean'
    ];

    /**
     * @return boolean
     */
    public function canDeleteUser()
    {
        return $this->deletable;
    }

    /**
     * @return array
     */
    public function getPermissions()
    {
        return [];
    }
}
