<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    protected $fillable = ['id_user', 'id_kelas', 'nama_siswa', 'jenis_kelamin', 'foto_siswa'];
    public $timestamps = false;

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function user()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function presensi_siswa()
    {
        return $this->hasMany(presensi_siswa::class, 'nis');
    }
}
