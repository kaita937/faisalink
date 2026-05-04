<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review_Fasilitas extends Model
{
    protected $table = 'Review_Fasilitas';
    protected $primaryKey = 'id_review';

    protected $fillable = [
        'id_peminjaman',
        'id_fasilitas',
        'id_peminjam',
        'rating',
        'komentar'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman', 'id_peminjaman');
    }

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas_Kampus::class, 'id_fasilitas', 'id_fasilitas');
    }

    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class, 'id_peminjam', 'id_peminjam');
    }
}
