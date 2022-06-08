<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rollcall extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $dates = ['mula_rollcall', 'akhir_rollcall'];

    // protected $with = ["users"];

    public function users()
    {
        return $this->belongsToMany(User::class, "penguatkuasa_id");
    }

    // public function pegawai_sokong()
    // {
    //     return $this->belongsTo(User::class, 'pegawai_sokong_id', 'id');
    // }

    // public function pegawai_lulus()
    // {
    //     return $this->belongsTo(User::class, 'pegawai_lulus_id', 'id');
    // }

    public function user_rollcall()
    {
        return $this->hasMany(Userrollcall::class, 'roll_id', 'id');
    }
}
