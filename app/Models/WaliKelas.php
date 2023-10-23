<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliKelas extends Model
{
    use HasFactory;
    protected $table = 'wali_kelas';
    protected $primaryKey = 'id_walas';
    protected $fillable = ['id_guru'];
    public $timestamps = false;

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function getGuruAttribute()
    {
        return Guru::find($this->attributes['id_guru'])->guru;
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_walas');
    }

}
