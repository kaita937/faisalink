<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Review_Fasilitas', function (Blueprint $table) {
            $table->increments('id_review');
            $table->unsignedInteger('id_peminjaman')->unique();
            $table->unsignedInteger('id_fasilitas');
            $table->unsignedInteger('id_peminjam');
            $table->unsignedTinyInteger('rating');
            $table->text('komentar');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_peminjaman')
                ->references('id_peminjaman')
                ->on('Peminjaman')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Review_Fasilitas');
    }
};
