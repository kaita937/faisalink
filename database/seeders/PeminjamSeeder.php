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
                'username' => 'rudi_herm',
                'email' => 'rudi@student.com',
                'contact' => '081234567890',
                'password' => $hash,
            ],
            [
                'nama_peminjam' => 'Ani Wijaya',
                'username' => 'ani_wijaya',
                'email' => 'ani@student.com',
                'contact' => '082345678901',
                'password' => $hash,
            ],
            [
                'nama_peminjam' => 'Dani Pratama',
                'username' => 'dani_pratama',
                'email' => 'dani@student.com',
                'contact' => '083456789012',
                'password' => $hash,
            ],
            [
                'nama_peminjam' => 'Eka Putri',
                'username' => 'eka_putri',
                'email' => 'eka@student.com',
                'contact' => '084567890123',
                'password' => $hash,
            ],
            [
                'nama_peminjam' => 'Fajar Ramadhan',
                'username' => 'fajar_rama',
                'email' => 'fajar@student.com',
                'contact' => '085678901234',
                'password' => $hash,
            ],
        ]);
    }
}
