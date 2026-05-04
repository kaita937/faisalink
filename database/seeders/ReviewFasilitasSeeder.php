<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewFasilitasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('Review_Fasilitas')->insert([
            [
                'id_peminjaman' => 1,
                'id_fasilitas' => 1,
                'id_peminjam' => 1,
                'rating' => 5,
                'komentar' => 'Ruangan bersih, AC dingin, dan proyektor berfungsi baik.',
                'created_at' => '2026-05-04 09:15:00',
                'updated_at' => '2026-05-04 09:15:00'
            ],
            [
                'id_peminjaman' => 4,
                'id_fasilitas' => 1,
                'id_peminjam' => 4,
                'rating' => 4,
                'komentar' => 'Sound system bagus, hanya kursi perlu ditata ulang.',
                'created_at' => '2026-05-04 10:20:00',
                'updated_at' => '2026-05-04 10:20:00'
            ],
            [
                'id_peminjaman' => 8,
                'id_fasilitas' => 3,
                'id_peminjam' => 3,
                'rating' => 5,
                'komentar' => 'Komputer lengkap dan koneksi internet stabil.',
                'created_at' => '2026-05-04 11:05:00',
                'updated_at' => '2026-05-04 11:05:00'
            ],
            [
                'id_peminjaman' => 11,
                'id_fasilitas' => 4,
                'id_peminjam' => 2,
                'rating' => 4,
                'komentar' => 'Tempat nyaman, ruang baca tenang untuk diskusi.',
                'created_at' => '2026-05-04 12:10:00',
                'updated_at' => '2026-05-04 12:10:00'
            ],
            [
                'id_peminjaman' => 12,
                'id_fasilitas' => 5,
                'id_peminjam' => 3,
                'rating' => 5,
                'komentar' => 'Lapangan luas dan bersih, fasilitas mendukung.',
                'created_at' => '2026-05-04 12:30:00',
                'updated_at' => '2026-05-04 12:30:00'
            ],
            [
                'id_peminjaman' => 13,
                'id_fasilitas' => 6,
                'id_peminjam' => 1,
                'rating' => 4,
                'komentar' => 'Ruang meeting nyaman, proyektor jelas.',
                'created_at' => '2026-05-04 13:00:00',
                'updated_at' => '2026-05-04 13:00:00'
            ],
            [
                'id_peminjaman' => 14,
                'id_fasilitas' => 7,
                'id_peminjam' => 5,
                'rating' => 5,
                'komentar' => 'Studio bersih, peralatan lengkap dan mudah digunakan.',
                'created_at' => '2026-05-04 13:30:00',
                'updated_at' => '2026-05-04 13:30:00'
            ],
        ]);
    }
}
