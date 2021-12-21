<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

use App\Models\Rollcall;

class User extends Authenticatable 
{
    use HasFactory, Notifiable;

    public $with = ['user_rollcall_report'];

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // public function rollcalls()
    // {
    //     return $this->belongsToMany(Rollcall::class, );
    // }  
    public function user_rollcall_report()
     {
        return $this->hasMany(Userrollcall::class, 'penguatkuasa_id');
        // return $this->hasMany(Userrollcall::class, 'id_user', 'penguatkuasa_id');
    }
}