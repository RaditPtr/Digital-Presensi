<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class tbl_user extends Authenticatable
{
    use HasFactory;
    protected $table = 'tbl_user';
    protected $primaryKey = 'id_user';
    protected $fillable = ['username','password','role'];
    public $timestamps = false;

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_user');
    }

    public function guru()
    {
        return $this->hasMany(Guru::class, 'id_user');
    }
}



