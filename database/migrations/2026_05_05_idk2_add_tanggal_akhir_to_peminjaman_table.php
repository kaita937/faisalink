<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('Peminjaman', function (Blueprint $table) {
            $table->date('tanggal_pengajuan_akhir')->nullable()->after('tanggal_pengajuan_awal');
        });
    }

    public function down(): void
    {
        Schema::table('Peminjaman', function (Blueprint $table) {
            $table->dropColumn('tanggal_pengajuan_akhir');
        });
    }
};