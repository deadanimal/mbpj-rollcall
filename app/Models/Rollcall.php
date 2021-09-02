<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Rollcall extends Model
{
    use HasFactory;

    protected $dates = ['mula_rollcall', 'akhir_rollcall'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }  

}
 