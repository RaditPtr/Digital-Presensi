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
        DB::unprepared('DROP FUNCTION IF EXISTS CountSiswa');
        DB::unprepared('DROP FUNCTION IF EXISTS CountKelas');

        DB::unprepared('
        CREATE FUNCTION CountSiswa() RETURNS INT
        BEGIN
            DECLARE total INT;
            SELECT COUNT(*) INTO total FROM siswa;
            RETURN total;
        END
        ');

        DB::unprepared('
        CREATE FUNCTION CountKelas() RETURNS INT
        BEGIN
            DECLARE total INT;
            SELECT COUNT(*) INTO total FROM kelas;
            RETURN total;
        END
        ');

        DB::unprepared('
        CREATE FUNCTION CountPresensi() RETURNS INT
        BEGIN
            DECLARE total INT;
            SELECT COUNT(*) INTO total FROM presensi_siswa;
            RETURN total;
        END
        ');
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP Procedure IF EXISTS CreateSiswa');
        DB::unprepared('DROP Procedure IF EXISTS CreateKelas');
        DB::unprepared('DROP Procedure IF EXISTS CreatePresensi');
    }
};
