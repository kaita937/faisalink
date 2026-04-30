<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FasilitasKampusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('Fasilitas_Kampus')->insert([
            [
                'nama_fasilitas' => 'Ruang Seminar A',
                'lokasi_fasilitas' => 'Gedung Akademik Lt. 2',
                'kapasitas' => 50,
                'status_fasilitas' => 'Tersedia',
                'deskripsi' => 'Ruang seminar dilengkapi AC, proyektor, dan sound system',
            ],
            [
                'nama_fasilitas' => 'Ruang Seminar B',
                'lokasi_fasilitas' => 'Gedung Akademik Lt. 2',
                'kapasitas' => 30,
                'status_fasilitas' => 'Tersedia',
                'deskripsi' => 'Ruang seminar ukuran sedang untuk meeting',
            ],
            [
                'nama_fasilitas' => 'Laboratorium Komputer',
                'lokasi_fasilitas' => 'Gedung IT Lt. 1',
                'kapasitas' => 40,
                'status_fasilitas' => 'Tersedia',
                'deskripsi' => 'Laboratorium dengan 40 unit komputer dan jaringan internet',
            ],
            [
                'nama_fasilitas' => 'Perpustakaan Digital',
                'lokasi_fasilitas' => 'Gedung Pusat Lt. 3',
                'kapasitas' => 100,
                'status_fasilitas' => 'Tersedia',
                'deskripsi' => 'Ruang perpustakaan dengan fasilitas digital dan reading room',
            ],
            [
                'nama_fasilitas' => 'Lapangan Olahraga',
                'lokasi_fasilitas' => 'Area Terbuka',
                'kapasitas' => 200,
                'status_fasilitas' => 'Tersedia',
                'deskripsi' => 'Lapangan untuk berbagai aktivitas olahraga',
            ],
            [
                'nama_fasilitas' => 'Ruang Meeting VIP',
                'lokasi_fasilitas' => 'Gedung Akademik Lt. 3',
                'kapasitas' => 20,
                'status_fasilitas' => 'Tersedia',
                'deskripsi' => 'Ruang meeting premium dengan fasilitas lengkap',
            ],
            [
                'nama_fasilitas' => 'Studio Rekaman',
                'lokasi_fasilitas' => 'Gedung Seni Lt. 2',
                'kapasitas' => 15,
                'status_fasilitas' => 'Tersedia',
                'deskripsi' => 'Studio rekaman profesional untuk mahasiswa',
            ],
        ]);
    }
}
