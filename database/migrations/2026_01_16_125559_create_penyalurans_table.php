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
        Schema::create('penyalurans', function (Blueprint $table) {
            $table->id('id_penyaluran');
            $table->foreignId('id_program')->constrained('program_bantuans', 'id_program')->onDelete('cascade');
            $table->foreignId('id_korban')->constrained('korbans', 'id_korban')->onDelete('cascade');
            $table->foreignId('id_volunteer')->nullable()->constrained('volunteers', 'id_volunteer')->onDelete('set null');
            $table->date('tanggal_penyaluran');
            $table->decimal('jumlah_disalurkan', 12, 2);
            $table->text('keterangan')->nullable();
            $table->string('foto_bukti')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyalurans');
    }
};
