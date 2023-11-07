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
        DB::unprepared('DROP PROCEDURE IF EXISTS CreateAkunSiswa');
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
            DECLARE pesan_error CHAR(5) DEFAULT '000';
        
            DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
            BEGIN
                SET pesan_error = '001';
            END;
        
            START TRANSACTION;

            INSERT INTO siswa (nis, id_user, id_kelas, nama_siswa, jenis_kelamin, foto_siswa)
            VALUES (new_nis, new_id_user, new_id_kelas, new_nama_siswa, new_jenis_kelamin, new_foto_siswa);

            IF pesan_error = '000' THEN
                COMMIT; -- Commit the transaction if no error occurs
            ELSE
                ROLLBACK; -- Rollback the transaction if an error occurs
            END IF;
        END;
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
