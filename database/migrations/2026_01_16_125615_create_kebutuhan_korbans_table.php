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
        Schema::create('kebutuhan_korbans', function (Blueprint $table) {
            $table->id('id_kebutuhan');
            $table->foreignId('id_korban')->constrained('korbans', 'id_korban')->onDelete('cascade');
            $table->enum('kategori', ['makanan', 'pakaian', 'obat-obatan', 'tempat_tinggal', 'lainnya']);
            $table->string('nama_kebutuhan', 100);
            $table->integer('jumlah');
            $table->string('satuan', 20);
            $table->enum('prioritas', ['rendah', 'sedang', 'tinggi'])->default('sedang');
            $table->enum('status', ['dibutuhkan', 'terpenuhi_sebagian', 'terpenuhi'])->default('dibutuhkan');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kebutuhan_korbans');
    }
};
