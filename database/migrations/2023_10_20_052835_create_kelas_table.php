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
        Schema::create('kelas', function (Blueprint $table) {
            $table->increments('id_kelas');
            $table->integer('id_jurusan');
            $table->integer('id_angkatan');
            $table->integer('id_walas');
            $table->string('nama_kelas', 60);

            $table->foreign('id_jurusan')
                ->references('id_jurusan')->on('jurusan')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('id_angkatan')
                ->references('id_angkatan')->on('angkatan')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('id_walas')
                ->references('id_walas')->on('wali_kelas')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
