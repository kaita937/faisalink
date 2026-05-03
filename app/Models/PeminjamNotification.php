<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamNotification extends Model
{
    protected $table = 'Peminjam_Notifications';

    protected $fillable = [
        'id_peminjam',
        'id_peminjaman',
        'type',
        'title',
        'message',
        'url',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];
}
