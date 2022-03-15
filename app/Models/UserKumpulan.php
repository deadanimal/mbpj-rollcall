<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKumpulan extends Model
{
    public $table = "userkumpulans";
    use HasFactory;

    public $with = ['user_info', 'user_rollcall_report'];
    
    public function user_info() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function user_rollcall_report() {
        return $this->hasMany(Userrollcall::class, 'penguatkuasa_id', 'id_user');
        // return $this->hasMany(Userrollcall::class, 'id_user', 'penguatkuasa_id');
    }
}
