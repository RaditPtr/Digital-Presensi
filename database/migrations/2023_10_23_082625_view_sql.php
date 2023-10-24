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
        DB::unprepared("DROP VIEW IF EXISTS view_siswa;");

        DB::unprepared("
        CREATE VIEW view_siswa AS
        SELECT
            s.nama_siswa AS nama_siswa,	
            k.nama_kelas AS nama_kelas,
            s.foto_siswa AS foto_siswa,
            s.nis AS nis,
            s.jenis_kelamin AS jenis_kelamin
        FROM siswa s
        INNER JOIN kelas k ON s.id_kelas = k.id_kelas
        ");

    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // DB::unprepared("DROP VIEW IF EXISTS view_siswa;");
    }
};
