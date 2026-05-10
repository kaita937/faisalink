<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('fasilitas_kampus', function (Blueprint $table) {
            $table->enum('category', ['Hall', 'Laboratory', 'Library', 'Sport', 'Meeting', 'Studio', 'Other'])->nullable()->after('nama_fasilitas');
        });
    }

    public function down(): void
    {
        Schema::table('fasilitas_kampus', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};