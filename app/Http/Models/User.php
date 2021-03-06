<?php

namespace App\Http\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * 用户信息
 * Class User
 *
 * @package App\Http\Models
 */
class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'user';
    protected $primaryKey = 'id';

    function payment()
    {
        return $this->hasMany(Payment::class, 'user_id', 'id');
    }

    function label()
    {
        return $this->hasMany(UserLabel::class, 'user_id', 'id');
    }

    function referral()
    {
        return $this->hasOne(User::class, 'id', 'referral_uid');
    }

    function getBalanceAttribute($value)
    {
        return $value / 100;
    }

    function setBalanceAttribute($value)
    {
        return $this->attributes['balance'] = $value * 100;
    }
}