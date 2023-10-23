<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiSiswa extends Model
{
    use HasFactory;
    protected $table = 'presensi_siswa';
    protected $primaryKey = 'id_presensi';
    protected $fillable = ['nis', 'tanggal_presensi', 'status_hadir', 'waktu_presensi', 'foto_bukti'];
    public $timestamps = false;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
