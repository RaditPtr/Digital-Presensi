<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $fillable = ['id_jurusan', 'id_angkatan', 'id_walas', 'nama_kelas', 'tingkat_kelas',];
    public $timestamps = false;

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class);
    }

    public function wali_kelas()
    {
        return $this->belongsTo(WaliKelas::class);
    }

    public function user()
    {
        return $this->hasMany(tbl_user::class, 'id_kelas');
    }
}
