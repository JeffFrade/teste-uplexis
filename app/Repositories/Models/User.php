<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $table = 'usuario';
    protected $fillable = [
        'usuario', 'password',
    ];

    protected $hidden = [
        'password'
    ];
}
