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
        Schema::create('pengurus_kelas', function (Blueprint $table) {
            $table->integer('id_pengurus', true, false)->nullable(false);
            $table->integer('id_user', false);
            $table->integer('nis', false);
            $table->string('jabatan', 60);

            // $table->foreign('id_user')
            //     ->references('id_user')->on('tbl_user')
            //     ->onUpdate('cascade')->onDelete('cascade');

            // $table->integer('nis')
            //     ->references('nis')->on('siswa')
            //     ->onUpdate('cascade')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengurus_kelas');
    }
};
