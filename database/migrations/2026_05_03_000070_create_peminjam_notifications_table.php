<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Peminjam_Notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_peminjam');
            $table->unsignedInteger('id_peminjaman')->nullable();
            $table->string('type', 20)->default('info');
            $table->string('title', 120);
            $table->text('message');
            $table->string('url')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index(['id_peminjam', 'read_at']);
            $table->foreign('id_peminjam')
                ->references('id_peminjam')
                ->on('Peminjam')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Peminjam_Notifications');
    }
};
