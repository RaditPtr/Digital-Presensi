<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class angkatan extends Model
{
    use HasFactory;
    protected $table = 'angkatan';
    protected $primaryKey = 'id_angkatan';
    protected $fillable = ['tahun_masuk', 'tahun_keluar'];
    public $timestamps = false;

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_angkatan');
    }

    // public function 
}
