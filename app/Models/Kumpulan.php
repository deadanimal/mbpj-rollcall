<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kumpulan extends Model
{
    use HasFactory;
    public $with = ["user_kumpulan", 'pegawaiLulus', 'pegawaiSokong'];

    public function user_kumpulan()
    {
        return $this->hasMany(UserKumpulan::class, 'id_kumpulan');
    }

    public function pegawaiSokong()
    {
        return $this->belongsTo(User::class, 'pegawai_sokong_id');
    }
    public function pegawaiLulus()
    {
        return $this->belongsTo(User::class, 'pegawai_lulus_id');
    }
}
