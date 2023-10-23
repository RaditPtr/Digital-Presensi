<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'guru';
    protected $primaryKey = 'id_guru';
    protected $fillable = ['nama_guru', 'foto_guru'];
    public $timestamps = false;

    public function guru_piket()
    {
        return $this->hasMany(GuruPiket::class, 'id_guru');
    }

    public function guru_bk()
    {
        return $this->hasMany(GuruBk::class, 'id_guru');
    }

    public function wali_kelas()
    {
        return $this->hasMany(WaliKelas::class, 'id_guru');
    }
}


