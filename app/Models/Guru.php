<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'guru';
    protected $primaryKey = 'id_guru';
    protected $fillable = ['id_user', 'nama_guru', 'foto_guru'];
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

    public function user()
    {
        return $this->belongsTo(tbl_user::class, 'id_user');
    }

    public function getUserAttribute()
    {
        return tbl_user::find($this->attributes['id_user'])->username;
    }

    // public function user()
    // {
    //     return $this->belongsTo(tbl_user::class);
    // }
    // public function getUserAttribute()
    // {
    //     return tbl_user::find($this->attributes['id_user'])->tbl_user;
    // }
}


