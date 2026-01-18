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
        Schema::create('donasis', function (Blueprint $table) {
            $table->id('id_donasi');
            $table->foreignId('id_donatur')->constrained('donaturs', 'id_donatur')->onDelete('cascade');
            $table->foreignId('id_program')->constrained('program_bantuans', 'id_program')->onDelete('cascade');
            $table->date('tanggal_donasi');
            $table->enum('jenis_donasi', ['tunai', 'barang']);
            $table->decimal('jumlah_donasi', 12, 2);
            $table->string('bukti_transfer')->nullable();
            $table->enum('status_pembayaran', ['pending', 'berhasil', 'gagal'])->default('pending');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasis');
    }
};
