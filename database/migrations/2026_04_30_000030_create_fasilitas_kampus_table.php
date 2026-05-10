<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Fasilitas_Kampus', function (Blueprint $table) {
            $table->increments('id_fasilitas');
            $table->string('nama_fasilitas', 100);
            $table->string('lokasi_fasilitas', 100);
            $table->integer('kapasitas')->nullable();
            $table->enum('status_fasilitas', ['tersedia', 'maintenance'])->nullable();
            $table->text('deskripsi')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Fasilitas_Kampus');
    }
};
