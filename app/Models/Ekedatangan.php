<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekedatangan extends Model
{
    use HasFactory;
    protected $connection = 'oracle';
    public $table ='EKEDATANGAN.OT';
}
