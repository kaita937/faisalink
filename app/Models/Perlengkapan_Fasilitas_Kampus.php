<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perlengkapan_Fasilitas_Kampus extends Model
{
    protected $table = 'Perlengkapan_Fasilitas_Kampus';
    protected $primaryKey = 'id_perlengkapan_fasilitas';
    public $timestamps = false;

    protected $fillable = [
        'id_fasilitas',
        'nama_perlengkapan',
        'jumlah',
        'kondisi'
    ];

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas_Kampus::class, 'id_fasilitas', 'id_fasilitas');
    }
}
