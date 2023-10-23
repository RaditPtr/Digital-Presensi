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

    protected $trgName = 'trgLogInsert'; 

    public function up(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS ' . $this->trgName);
        DB::unprepared(
            'CREATE TRIGGER ' . $this->trgName . ' AFTER INSERT ON siswa
        FOR EACH ROW
        BEGIN
        DECLARE siswa_id INT;
        DECLARE userid VARCHAR(200);
        DECLARE siswanama VARCHAR(200);

        SELECT username INTO userid FROM tbl_user WHERE id_user = NEW.id_user;
        SELECT nama_siswa INTO siswanama FROM siswa WHERE nis = NEW.nis;

        SELECT nis INTO siswa_id FROM siswa WHERE nis = NEW.nis;
        INSERT INTO logs (logs) VALUES (CONCAT(userid, ": Melakukan Penambahan Siswa Dengan Nomor ", siswa_id, ", yaitu ", siswanama));
        END'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
