<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'Peminjaman';
    protected $primaryKey = 'id_peminjaman';
    public $timestamps = false;

    protected $fillable = [
        'id_fasilitas',
        'id_peminjam',
        'id_admin',
        'tanggal_pengajuan',
        'tanggal_peminjaman',
        'jam_mulai',
        'jam_selesai',
        'status_peminjaman',
        'administrasi_peminjaman',
        'keterangan',
        'keperluan',
        'alasan_penolakan'
    ];

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas_Kampus::class, 'id_fasilitas', 'id_fasilitas');
    }

    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class, 'id_peminjam', 'id_peminjam');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}
