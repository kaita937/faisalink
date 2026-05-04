<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('Peminjam', function (Blueprint $table) {
            $table->string('nomor_identitas', 50)->nullable()->after('nama_peminjam');
        });
    }

    public function down(): void
    {
        Schema::table('Peminjam', function (Blueprint $table) {
            $table->dropColumn('nomor_identitas');
        });
    }
};
