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

    
    public function user()
    {
        return $this->belongsTo(tbl_user::class);
    }
    public function getUserAttribute()
    {
        return tbl_user::find($this->attributes['id_user'])->tbl_user;
    }


    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    
    public function getKelasAttribute()
    {
        return Kelas::find($this->attributes['id_kelas'])->kelas;
    }

    


    public function presensi_siswa()
    {
        return $this->hasMany(PresensiSiswa::class, 'nis');
    }


    public function pengurus_kelas()
    {
        return $this->hasMany(PengurusKelas::class, 'nis');
    }
    

    
}
