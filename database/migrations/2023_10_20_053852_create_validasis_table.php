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
        Schema::create('validasi', function (Blueprint $table) {
            $table->integer('id_validasi', true)->nullable(false);
            $table->integer('id_presensi', false)->nullable(false);
            $table->string('surat_ketidakhadiran')->nullable(false);
            $table->text('keterangan_presensi')->nullable(false);
            $table->text('pernyataan_ketidakhadiran')->nullable(false);
            $table->string('alasan_ketidakhadiran', 60)->nullable(false);

            $table->foreign('id_presensi')
                ->references('id_presensi')->on('presensi_siswa')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validasi');
    }
};
