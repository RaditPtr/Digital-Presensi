<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruPiket extends Model
{
    use HasFactory;
    protected $table = 'guru_piket';
    protected $primaryKey = 'id_piket';
    protected $fillable = ['id_guru'];
    public $timestamps = false;


    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    // public function getGuruAttribute()
    // {
    //     return Guru::find($this->attributes['id_guru'])->guru;
    // }

}
