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
        'nomor_identitas',
        'username',
        'email',
        'contact',
        'password',
        'avatar_path'
    ];

    protected $hidden = [
        'password',
    ];

    public function notifications()
    {
        return $this->hasMany(PeminjamNotification::class, 'id_peminjam', 'id_peminjam');
    }
}
