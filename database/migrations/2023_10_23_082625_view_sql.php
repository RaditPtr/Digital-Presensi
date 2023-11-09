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
        DB::unprepared("DROP VIEW IF EXISTS view_kelas;");
        DB::unprepared("DROP VIEW IF EXISTS view_presensi;");

        DB::unprepared("
        CREATE VIEW view_siswa AS
        SELECT
            s.nama_siswa AS nama_siswa,	
            k.nama_kelas AS nama_kelas,
            s.foto_siswa AS foto_siswa,
            s.nis AS nis,
            s.jenis_kelamin AS jenis_kelamin
        FROM siswa s
        INNER JOIN kelas k ON s.id_kelas = k.id_kelas;
        ");

        DB::unprepared("
        CREATE VIEW view_Kelas AS
        SELECT 
        k.nama_kelas AS nama_kelas, 
        g.nama_guru AS nama_guru,
        j.nama_jurusan AS nama_jurusan,
        a.tahun_masuk AS tahun_masuk,
        a.tahun_keluar AS tahun_keluar
        FROM kelas k
        INNER JOIN wali_kelas w ON k.id_walas = w.id_walas
        INNER JOIN guru g ON w.id_guru = g.id_guru
        INNER JOIN jurusan j ON k.id_jurusan = j.id_jurusan
        INNER JOIN angkatan a ON k.id_angkatan = a.id_angkatan;
        ");

        DB::unprepared("
        CREATE VIEW view_presensi AS
        SELECT
        p.nis AS nis,
        p.id_presensi AS id_presensi,
        s.nama_siswa AS nama_siswa,
        p.tanggal_presensi AS tanggal_presensi,
        p.status_hadir AS status_hadir,
        p.waktu_presensi AS waktu_presensi,
        p.foto_bukti AS foto_bukti
        FROM presensi_siswa p
        INNER JOIN siswa s ON p.nis = s.nis;
        ");

    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_siswa;");
    }
};
