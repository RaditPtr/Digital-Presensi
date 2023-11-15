<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengurusKelas extends Model
{
    use HasFactory;
    protected $table = 'pengurus_kelas';
    protected $primaryKey = 'id_pengurus';
    protected $fillable = ['id_user', 'nis', 'jabatan'];
    public $timestamps = false;
    
    
    public function user()
    {
        return $this->belongsTo(tbl_user::class);
    }
    public function getUserAttribute()
    {
        return tbl_user::find($this->attributes['id_user'])->tbl_user;
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function getSiswaAttribute()
    {
        return Siswa::find($this->attributes['nis'])->siswa;
    }



}
