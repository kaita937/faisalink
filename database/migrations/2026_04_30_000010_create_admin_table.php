<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Admin', function (Blueprint $table) {
            $table->increments('id_admin');
            $table->string('nama_admin', 100);
            $table->string('email', 100)->unique();
            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->string('contact', 20)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Admin');
    }
};
