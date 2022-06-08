<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userrollcall extends Model
{
    use HasFactory;

    protected $fillable = [

        'penguatkuasa_id',
    ];

    public $with = ['rollcall'];

    public function penguatkuasa()
    {
        return $this->belongsTo(User::class);
    }

    // public function rollcall()
    // {
    //     return $this->belongsTo(Rollcall::class);
    // }

    //nama rollcall
    public function nama_rollcall()
    {
        return $this->belongsTo(Rollcall::class, 'roll_id');
    }
    public function nama_kakitangan()
    {
        return $this->belongsTo(User::class, 'penguatkuasa_id');
    }

    public function rollcall()
    {
        return $this->belongsTo(Rollcall::class, 'roll_id');
    }

    public function pegawaiLulus()
    {
        return $this->belongsTo(User::class, 'pegawai_lulus_id');
    }
    public function pegawaiSokong()
    {
        return $this->belongsTo(User::class, 'pegawai_sokong_id');
    }

    // public function user_rollcall() {
    //     return $this->belongsTo(UserRollcall::class,  'id_user');
    // }
}
