<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Peminjam', function (Blueprint $table) {
            $table->increments('id_peminjam');
            $table->string('nama_peminjam', 100);
            $table->string('username', 50)->unique();
            $table->string('email', 100)->unique();
            $table->string('contact', 20)->nullable();
            $table->string('password', 255);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Peminjam');
    }
};
