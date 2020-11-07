<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;

   const STATUS_ACTIVE = "active";
   const STATUS_INACTIVE = "inactive";
   const STATUS_BLOCK = "block";
   const TYPE_ADMIN = "admin";
   const TYPE_USER = "user";

    const ROLE_SUPER_ADMIN = "Super Admin";
    const ROLE_ADMIN = "Admin";
    const ROLE_USER = "User";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * @param $value
     * @return string
     */
    public function  setPasswordAttribute($value)
    {
        return $this->attributes['password'] = bcrypt($value);
    }
}
