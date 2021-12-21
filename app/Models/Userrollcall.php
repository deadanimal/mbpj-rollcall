<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Userrollcall extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'penguatkuasa_id'
    ];

    public $with=['rollcall'];

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

    public function rollcall() {
        return $this->belongsTo(Rollcall::class, 'roll_id')
;    }
    // public function user_rollcall() {
    //     return $this->belongsTo(UserRollcall::class,  'id_user');
    // }
}
