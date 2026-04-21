<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'Admin';
    protected $primaryKey = 'id_admin';

    public $timestamps = false;

    protected $fillable = [
        'nama_admin',
        'email',
        'username',
        'password',
        'contact'
    ];

    protected $hidden = [
        'password',
    ];
}
