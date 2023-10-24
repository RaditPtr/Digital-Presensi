<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('DROP Procedure IF EXISTS CreateAkunSiswa');

        DB::unprepared("
        CREATE PROCEDURE CreateAkunSiswa(
            IN new_nis INT,
            IN new_id_user INT,
            IN new_id_kelas INT,
            IN new_nama_siswa VARCHAR(255), 
            IN new_jenis_kelamin ENUM('laki-laki', 'perempuan'), 
            IN new_foto_siswa VARCHAR(255)
        )
        BEGIN
            -- Insert data user
            INSERT INTO tbl_user (nis, id_user, nama_siswa, jenis_kelamin, foto_siswa)
            VALUE (new_nis, new_id_user, new_id_kelas, new_nama_siswa, new_jenis_kelamin, new_foto_siswa);
        END 
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP Procedure IF EXISTS CreateAkunSiswa');
    }
};
