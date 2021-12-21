<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kumpulan extends Model
{
    use HasFactory;
    public $with = ["user_kumpulan"];

    public function user_kumpulan() {
        return $this->hasMany(UserKumpulan::class, 'id_kumpulan');
    }
}
