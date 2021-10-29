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

    public function penguatkuasa()
    {
        return $this->belongsTo(User::class);
    }  

    public function rollcall()
    {
        return $this->belongsTo(Rollcall::class);
    }

}
