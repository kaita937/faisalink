<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

// -- ===== DUMMY DATA SEEDER =====
// -- Default Password: password123 (encrypted dengan bcrypt)
// -- Semua akun menggunakan password yang sama untuk testing

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $hash = Hash::make('password123');
        $pwadmin = Hash::make('123456');

        DB::table('Admin')->insert([
            [
                'nama_admin' => 'Budi Santoso',
                'email' => 'budi@admin.com',
                'username' => 'budi_admin',
                'password' => $hash,
                'contact' => '082123456789',
            ],
            [
                'nama_admin' => 'Siti Nurhaliza',
                'email' => 'siti@admin.com',
                'username' => 'siti_admin',
                'password' => $hash,
                'contact' => '081987654321',
            ],
            [
                'nama_admin' => 'Ahmad Hidayat',
                'email' => 'ahmad@admin.com',
                'username' => 'ahmad_admin',
                'password' => $hash,
                'contact' => '085123456789',
            ],
            [
                'nama_admin' => 'jamal',
                'email' => 'jamal@admin.com',
                'username' => 'jamal_admin',
                'password' => $pwadmin,
                'contact' => '082123456789',
            ]
        ]);
    }
}
