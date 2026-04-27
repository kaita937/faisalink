<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas_Kampus extends Model
{
    protected $table = 'Fasilitas_Kampus';
    protected $primaryKey = 'id_fasilitas';
    public $timestamps = false;

    protected $fillable = [
        'nama_fasilitas',
        'lokasi_fasilitas',
        'kapasitas',
        'status_fasilitas',
        'deskripsi'
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_fasilitas', 'id_fasilitas');
    }

    public function perlengkapan()
    {
        return $this->hasMany(Perlengkapan_Fasilitas_Kampus::class, 'id_fasilitas', 'id_fasilitas');
    }
}
