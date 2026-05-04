<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

// -- ===== DUMMY DATA SEEDER =====
// -- Default Password: password123 (encrypted dengan bcrypt)
// -- Semua akun menggunakan password yang sama untuk testing

class PeminjamSeeder extends Seeder
{
    public function run(): void
    {
        $hash = Hash::make('password123');

        DB::table('Peminjam')->insert([
            [
                'nama_peminjam' => 'Rudi Hermawan',
                'nomor_identitas' => '20260001',
                'username' => 'rudi_herm',
                'email' => 'rudi@student.com',
                'contact' => '081234567890',
                'password' => $hash,
            ],
            [
                'nama_peminjam' => 'Ani Wijaya',
                'nomor_identitas' => '20260002',
                'username' => 'ani_wijaya',
                'email' => 'ani@student.com',
                'contact' => '082345678901',
                'password' => $hash,
            ],
            [
                'nama_peminjam' => 'Dani Pratama',
                'nomor_identitas' => '20260003',
                'username' => 'dani_pratama',
                'email' => 'dani@student.com',
                'contact' => '083456789012',
                'password' => $hash,
            ],
            [
                'nama_peminjam' => 'Eka Putri',
                'nomor_identitas' => '20260004',
                'username' => 'eka_putri',
                'email' => 'eka@student.com',
                'contact' => '084567890123',
                'password' => $hash,
            ],
            [
                'nama_peminjam' => 'Fajar Ramadhan',
                'nomor_identitas' => '20260005',
                'username' => 'fajar_rama',
                'email' => 'fajar@student.com',
                'contact' => '085678901234',
                'password' => $hash,
            ],
        ]);
    }
}
