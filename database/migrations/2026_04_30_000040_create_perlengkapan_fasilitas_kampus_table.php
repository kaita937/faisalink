<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Perlengkapan_Fasilitas_Kampus', function (Blueprint $table) {
            $table->increments('id_perlengkapan_fasilitas');
            $table->unsignedInteger('id_fasilitas');
            $table->string('nama_perlengkapan', 100);
            $table->integer('jumlah');
            $table->string('kondisi', 50)->nullable();

            $table->foreign('id_fasilitas')
                ->references('id_fasilitas')
                ->on('Fasilitas_Kampus')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Perlengkapan_Fasilitas_Kampus');
    }
};
