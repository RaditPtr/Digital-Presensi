<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TataUsaha extends Model
{
    use HasFactory;
    protected $table = 'tata_usaha';
    protected $primaryKey = 'id_tata_usaha';
    protected $fillable = ['id_user'];

    public function user()
    {
        return $this->belongsTo(tbl_user::class);
    }
    public function getUserAttribute()
    {
        return tbl_user::find($this->attributes['id_user'])->tbl_user;
    }
}
