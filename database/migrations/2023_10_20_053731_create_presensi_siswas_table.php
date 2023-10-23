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
        Schema::create('presensi_siswa', function (Blueprint $table) {
            $table->integer('id_presensi', true, false)->nullable(false);
            $table->integer('nis', false);
            $table->date('tanggal_presensi', false);
            $table->string('status_hadir', false);
            $table->time('waktu_presensi');
            $table->text('foto_bukti')->nullable(false);

            $table->foreign('nis')
                ->references('nis')->on('siswa')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_siswa');
    }
};
