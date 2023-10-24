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
        Schema::create('siswa', function (Blueprint $table) {
            $table->integer('nis', true, false)->nullable(false);
            $table->integer('id_user');
            $table->integer('id_kelas');
            $table->string('nama_siswa');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->text('foto_siswa');

            $table->foreign('id_user')
                ->references('id_user')->on('tbl_user')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('id_kelas')->on('kelas')
                ->references('id_kelas')->onDelete('cascade')->onUpdate('cascade');
            
        });
    }


    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
