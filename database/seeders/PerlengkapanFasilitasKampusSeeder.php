<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerlengkapanFasilitasKampusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('Perlengkapan_Fasilitas_Kampus')->insert([
            ['id_fasilitas' => 1, 'nama_perlengkapan' => 'Kursi', 'jumlah' => 50, 'kondisi' => 'Baik'],
            ['id_fasilitas' => 1, 'nama_perlengkapan' => 'Meja', 'jumlah' => 10, 'kondisi' => 'Baik'],
            ['id_fasilitas' => 1, 'nama_perlengkapan' => 'Proyektor', 'jumlah' => 1, 'kondisi' => 'Baik'],
            ['id_fasilitas' => 1, 'nama_perlengkapan' => 'Screen Proyektor', 'jumlah' => 1, 'kondisi' => 'Baik'],
            ['id_fasilitas' => 1, 'nama_perlengkapan' => 'Sound System', 'jumlah' => 1, 'kondisi' => 'Baik'],
            ['id_fasilitas' => 2, 'nama_perlengkapan' => 'Kursi', 'jumlah' => 30, 'kondisi' => 'Baik'],
            ['id_fasilitas' => 2, 'nama_perlengkapan' => 'Meja', 'jumlah' => 8, 'kondisi' => 'Baik'],
            ['id_fasilitas' => 2, 'nama_perlengkapan' => 'Whiteboard', 'jumlah' => 2, 'kondisi' => 'Baik'],
            ['id_fasilitas' => 3, 'nama_perlengkapan' => 'Komputer', 'jumlah' => 40, 'kondisi' => 'Baik'],
            ['id_fasilitas' => 3, 'nama_perlengkapan' => 'Meja Kerja', 'jumlah' => 40, 'kondisi' => 'Baik'],
            ['id_fasilitas' => 3, 'nama_perlengkapan' => 'Kursi', 'jumlah' => 40, 'kondisi' => 'Baik'],
            ['id_fasilitas' => 3, 'nama_perlengkapan' => 'Printer', 'jumlah' => 2, 'kondisi' => 'Baik'],
            ['id_fasilitas' => 4, 'nama_perlengkapan' => 'Rak Buku', 'jumlah' => 30, 'kondisi' => 'Baik'],
            ['id_fasilitas' => 4, 'nama_perlengkapan' => 'Kursi Baca', 'jumlah' => 50, 'kondisi' => 'Baik'],
            ['id_fasilitas' => 4, 'nama_perlengkapan' => 'Meja Baca', 'jumlah' => 20, 'kondisi' => 'Baik'],
            ['id_fasilitas' => 5, 'nama_perlengkapan' => 'Tiang Volley', 'jumlah' => 2, 'kondisi' => 'Baik'],
            ['id_fasilitas' => 5, 'nama_perlengkapan' => 'Net Volley', 'jumlah' => 2, 'kondisi' => 'Baik'],
            ['id_fasilitas' => 5, 'nama_perlengkapan' => 'Basket Hoop', 'jumlah' => 2, 'kondisi' => 'Baik'],
            ['id_fasilitas' => 6, 'nama_perlengkapan' => 'Kursi Executive', 'jumlah' => 20, 'kondisi' => 'Baik'],
            ['id_fasilitas' => 6, 'nama_perlengkapan' => 'Meja Konferensi', 'jumlah' => 1, 'kondisi' => 'Baik'],
            ['id_fasilitas' => 6, 'nama_perlengkapan' => 'Proyektor Premium', 'jumlah' => 1, 'kondisi' => 'Baik'],
            ['id_fasilitas' => 7, 'nama_perlengkapan' => 'Microphone', 'jumlah' => 3, 'kondisi' => 'Baik'],
            ['id_fasilitas' => 7, 'nama_perlengkapan' => 'Speaker Monitor', 'jumlah' => 4, 'kondisi' => 'Baik'],
            ['id_fasilitas' => 7, 'nama_perlengkapan' => 'Recording Equipment', 'jumlah' => 1, 'kondisi' => 'Baik'],
        ]);
    }
}
