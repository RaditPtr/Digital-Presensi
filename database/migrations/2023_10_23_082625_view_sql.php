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
        DB::unprepared("DROP VIEW IF EXISTS view_pengurus;");
        DB::unprepared("DROP VIEW IF EXISTS view_guru;");

        DB::unprepared("
        CREATE VIEW view_siswa AS
        SELECT
            s.id_user AS id_user,
            s.id_kelas AS id_kelas,
            u.role AS role,
            s.nama_siswa AS nama_siswa,	
            k.nama_kelas AS nama_kelas,
            s.foto_siswa AS foto_siswa,
            s.nis AS nis,
            s.jenis_kelamin AS jenis_kelamin
        FROM siswa s
        INNER JOIN kelas k ON s.id_kelas = k.id_kelas
        INNER JOIN tbl_user u ON s.id_user = u.id_user;
        ");

        DB::unprepared("
        CREATE VIEW view_Kelas AS
        SELECT 
        k.id_kelas AS id_kelas, 
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
        p.id_presensi AS id_presensi,
        p.nis AS nis,
        s.id_kelas AS id_kelas,
        w.id_guru AS id_guru,
        g.id_user AS id_user,
        s.nama_siswa AS nama_siswa,
        p.tanggal_presensi AS tanggal_presensi,
        p.status_hadir AS status_hadir,
        p.waktu_presensi AS waktu_presensi,
        p.foto_bukti AS foto_bukti
        FROM presensi_siswa p
        INNER JOIN siswa s ON p.nis = s.nis
        INNER JOIN kelas k ON s.id_kelas = k.id_kelas
        INNER JOIN wali_kelas w ON k.id_walas = w.id_walas
        INNER JOIN guru g ON w.id_guru = g.id_guru;
        ");

        DB::unprepared("
        CREATE VIEW view_pengurus AS
        SELECT
        e.nis AS nis,
        s.id_kelas AS id_kelas,
        w.id_guru AS id_guru,
        g.id_user AS id_user,
        e.id_pengurus AS id_pengurus,
        s.nama_siswa AS nama_siswa,
        e.jabatan AS jabatan
        FROM pengurus_kelas e
        INNER JOIN siswa s ON e.nis = s.nis
        INNER JOIN kelas k ON s.id_kelas = k.id_kelas
        INNER JOIN wali_kelas w ON k.id_walas = w.id_walas
        INNER JOIN guru g ON w.id_guru = g.id_guru;
        ");

        DB::unprepared("
        CREATE VIEW view_guru AS
        SELECT 
            guru.id_guru AS id_guru,
            guru.foto_guru AS foto_guru,
            tbl_user.id_user AS id_user,
            tbl_user.username AS nama_guru
        FROM guru
        JOIN tbl_user ON guru.id_user = tbl_user.id_user
        ORDER BY guru.id_guru ASC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_siswa;");
        DB::statement('DROP VIEW IF EXISTS view_guru');
    }
};
