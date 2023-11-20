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
        DB::unprepared('DROP PROCEDURE IF EXISTS CreateUser');
        DB::unprepared("
        CREATE PROCEDURE CreateUser(
            IN new_username VARCHAR(255),
            IN new_password TEXT,
            IN new_role VARCHAR(255)
        )
        BEGIN
        DECLARE new_id_user INT;
        DECLARE pesan_error CHAR(5) DEFAULT '00000';
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION, SQLWARNING

        BEGIN
        GET DIAGNOSTICS CONDITION 1 pesan_error = RETURNED_SQLSTATE;
        END;

        START TRANSACTION;
        SAVEPOINT satu;

        -- Sisipkan data ke dalam tabel user
        INSERT INTO tbl_user (username, password, role) VALUES (new_username, new_password, new_role);
        
        IF pesan_error != '00000' THEN ROLLBACK TO satu;
        END IF;
            
        -- Dapatkan ID user yang baru disisipkan
        SET new_id_user = LAST_INSERT_ID();
        -- Update kolom id_user dengan nilai yang baru disisipkan
        UPDATE tbl_user SET id_user = new_id_user WHERE id_user IS NULL;

        IF pesan_error != '00000' THEN ROLLBACK TO satu;
        END IF;
        COMMIT;
        END;
        ");

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

        DB::unprepared('DROP PROCEDURE IF EXISTS CreatePresensi');
        DB::unprepared("
        CREATE PROCEDURE CreatePresensi(
            IN new_nis INT,
            IN new_status VARCHAR(255),
            IN new_foto_bukti TEXT
        )
        BEGIN
            DECLARE pesan_error CHAR(5) DEFAULT '000';

            DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
            BEGIN
                SET pesan_error = '001';
            END;

            START TRANSACTION; -- Memulai transaction

            INSERT INTO presensi_siswa (nis, tanggal_presensi, status_hadir, waktu_presensi, foto_bukti)
            VALUES (new_nis, CURDATE(), new_status, CURTIME(), new_foto_bukti);

            IF pesan_error = '000' THEN
                COMMIT; -- Commit jika tidak ada error
            ELSE
                ROLLBACK; -- Rollback jika terdapat error
            END IF;
        END 
        ");


        DB::unprepared('DROP PROCEDURE IF EXISTS CreatePengurus');
        DB::unprepared("
        CREATE PROCEDURE CreatePengurus(
            IN new_nis INT,
            IN new_jabatan VARCHAR(60)
        )
        BEGIN
            DECLARE pesan_error CHAR(5) DEFAULT '000';

            DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
            BEGIN
                SET pesan_error = '001';
            END;

            START TRANSACTION; -- Memulai transaction

            INSERT INTO pengurus_kelas (nis, jabatan)
            VALUES (new_nis, new_jabatan);

            -- SELECT
            -- s.id_user AS id_user,
            -- u.role AS role,
            -- s.nis AS nis
            -- FROM siswa s
            -- INNER JOIN tbl_user u ON s.id_user = u.id_user;

            -- UPDATE tbl_user SET role = 'penguruskelas'
            -- WHERE nis = new_nis;


            IF pesan_error = '000' THEN
                COMMIT; -- Commit jika tidak ada error
            ELSE
                ROLLBACK; -- Rollback jika terdapat error
            END IF;
        END 
        ");


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP Procedure IF EXISTS CreateAkunSiswa');
        DB::unprepared('DROP PROCEDURE IF EXISTS CreatePresensi');
        DB::unprepared('DROP PROCEDURE IF EXISTS CreateUser');
    }
};
