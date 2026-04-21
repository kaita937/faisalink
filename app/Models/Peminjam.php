<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Peminjam extends Authenticatable
{
    use Notifiable;

    protected $table = 'Peminjam';
    protected $primaryKey = 'id_peminjam';

    public $timestamps = false;

    protected $fillable = [
        'nama_peminjam',
        'username',
        'email',
        'contact',
        'password'
    ];

    protected $hidden = [
        'password',
    ];
}
