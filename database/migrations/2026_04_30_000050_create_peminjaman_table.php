<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Peminjaman', function (Blueprint $table) {
            $table->increments('id_peminjaman');
            $table->unsignedInteger('id_fasilitas');
            $table->unsignedInteger('id_peminjam');
            $table->unsignedInteger('id_admin')->nullable();
            $table->date('tanggal_pengajuan');
            $table->date('tanggal_peminjaman');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('status_peminjaman', 50);
            $table->string('administrasi_peminjaman', 255)->nullable();
            $table->text('keterangan')->nullable();
            $table->text('keperluan');

            $table->foreign('id_fasilitas')
                ->references('id_fasilitas')
                ->on('Fasilitas_Kampus')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_peminjam')
                ->references('id_peminjam')
                ->on('Peminjam')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_admin')
                ->references('id_admin')
                ->on('Admin')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Peminjaman');
    }
};
