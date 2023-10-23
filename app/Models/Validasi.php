<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validasi extends Model
{
    use HasFactory;
    protected $table = 'validasi';
    protected $primaryKey = 'id_validasi';
    protected $fillable = ['id_presensi', 'surat_ketidakhadiran', 'keterangan_presensi', 'pernyataan_ketidakhadiran', 'alasan_ketidakhadiran'];
    public $timestamps = false;

    public function presensiSiswa()
    {
        return $this->belongsTo(PresensiSiswa::class);
    }
}
