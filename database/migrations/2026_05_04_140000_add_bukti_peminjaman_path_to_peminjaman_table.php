<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('Peminjaman', function (Blueprint $table) {
            $table->string('bukti_peminjaman_path', 255)->nullable()->after('administrasi_peminjaman');
        });
    }

    public function down(): void
    {
        Schema::table('Peminjaman', function (Blueprint $table) {
            $table->dropColumn('bukti_peminjaman_path');
        });
    }
};
