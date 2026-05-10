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
                'category' => 'Hall',
                'lokasi_fasilitas' => 'Gedung Akademik Lt. 2',
                'kapasitas' => 50,
                'status_fasilitas' => 'Tersedia',
                'deskripsi' => 'Ruang seminar dilengkapi AC, proyektor, dan sound system',
            ],
            [
                'nama_fasilitas' => 'Ruang Seminar B',
                'category' => 'Hall',
                'lokasi_fasilitas' => 'Gedung Akademik Lt. 2',
                'kapasitas' => 30,
                'status_fasilitas' => 'Tersedia',
                'deskripsi' => 'Ruang seminar ukuran sedang untuk meeting',
            ],
            [
                'nama_fasilitas' => 'Laboratorium Komputer',
                'category' => 'Laboratory',
                'lokasi_fasilitas' => 'Gedung IT Lt. 1',
                'kapasitas' => 40,
                'status_fasilitas' => 'Tersedia',
                'deskripsi' => 'Laboratorium dengan 40 unit komputer dan jaringan internet',
            ],
            [
                'nama_fasilitas' => 'Perpustakaan Digital',
                'category' => 'Library',
                'lokasi_fasilitas' => 'Gedung Pusat Lt. 3',
                'kapasitas' => 100,
                'status_fasilitas' => 'Tersedia',
                'deskripsi' => 'Ruang perpustakaan dengan fasilitas digital dan reading room',
            ],
            [
                'nama_fasilitas' => 'Lapangan Olahraga',
                'category' => 'Sport',
                'lokasi_fasilitas' => 'Area Terbuka',
                'kapasitas' => 200,
                'status_fasilitas' => 'Tersedia',
                'deskripsi' => 'Lapangan untuk berbagai aktivitas olahraga',
            ],
            [
                'nama_fasilitas' => 'Ruang Meeting VIP',
                'category' => 'Meeting',
                'lokasi_fasilitas' => 'Gedung Akademik Lt. 3',
                'kapasitas' => 20,
                'status_fasilitas' => 'Tersedia',
                'deskripsi' => 'Ruang meeting premium dengan fasilitas lengkap',
            ],
            [
                'nama_fasilitas' => 'Studio Rekaman',
                'category' => 'Studio',
                'lokasi_fasilitas' => 'Gedung Seni Lt. 2',
                'kapasitas' => 15,
                'status_fasilitas' => 'Tersedia',
                'deskripsi' => 'Studio rekaman profesional untuk mahasiswa',
            ],
                [
                    'nama_fasilitas' => 'Ruang Kelas 101',
                    'category' => 'Other',
                    'lokasi_fasilitas' => 'Gedung Akademik Lt. 1',
                    'kapasitas' => 60,
                    'status_fasilitas' => 'maintenance',
                    'deskripsi' => 'Ruang kelas standar untuk perkuliahan',
                ],
        ]);
    }
}
