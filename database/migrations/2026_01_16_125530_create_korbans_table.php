<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('korbans', function (Blueprint $table) {
            $table->id('id_korban');
            $table->string('nama_korban', 100);

            // kolom login
            $table->string('email')->unique();
            $table->string('password');

            // profil
            $table->text('alamat');
            $table->string('jenis_bencana', 50);
            $table->text('keterangan')->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->enum('status_verifikasi', ['pending', 'terverifikasi', 'ditolak'])->default('pending');

            $table->rememberToken()->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('korbans');
    }
};
