<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Rollcall extends Model
{
    use HasFactory;
    protected $guarded =['id'];

    protected $dates = ['mula_rollcall', 'akhir_rollcall'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }  

    public function pegawai_sokong()
    {
        return $this->belongsTo(User::class, 'pegawai_sokong_id', 'id');
    }

    public function pegawai_lulus()
    {
        return $this->belongsTo(User::class, 'pegawai_lulus_id', 'id');
    }

    public function user_rollcall()
    {
        return $this->hasMany(Userrollcall::class, 'roll_id', 'id');
    }
}
 