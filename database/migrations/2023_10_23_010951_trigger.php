<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */


    public function up(): void
    {
        DB::unprepared('
        CREATE TRIGGER add_siswa
        BEFORE INSERT ON siswa
        FOR EACH ROW
        BEGIN
            INSERT logs(tabel, tanggal, jam, aksi, record)
            VALUES ("siswa", CURDATE(), CURTIME(), "Tambah", "Sukses");
        END
        ');

        DB::unprepared('
        CREATE TRIGGER update_siswa
        AFTER UPDATE ON siswa
        FOR EACH ROW
        BEGIN
            INSERT logs(tabel, tanggal, jam, aksi, record)
            VALUES ("siswa", CURDATE(), CURTIME(), "Update", "Sukses");
        END
        ');

        DB::unprepared('
        CREATE TRIGGER delete_siswa
        AFTER DELETE ON siswa
        FOR EACH ROW
        BEGIN
            INSERT logs(tabel, tanggal, jam, aksi, record)
            VALUES ("siswa", CURDATE(), CURTIME(), "Hapus", "Sukses");
        END
        ');



        // DB::unprepared('DROP TRIGGER IF EXISTS ' . $this->trgName);
        // DB::unprepared(
        // 'CREATE TRIGGER ' . $this->trgName . ' AFTER INSERT ON siswa
        // FOR EACH ROW
        // BEGIN
        // DECLARE siswa_id INT;
        // DECLARE userid VARCHAR(200);
        // DECLARE siswanama VARCHAR(200);

        // SELECT username INTO userid FROM tbl_user WHERE id_user = NEW.id_user;
        // SELECT nama_siswa INTO siswanama FROM siswa WHERE nis = NEW.nis;

        // SELECT nis INTO siswa_id FROM siswa WHERE nis = NEW.nis;
        // INSERT INTO logs (logs) VALUES (CONCAT(userid, ": Melakukan Penambahan Siswa Dengan Nomor ", siswa_id, ", yaitu ", siswanama));
        // END'
        // );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
