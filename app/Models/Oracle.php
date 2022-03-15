<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oracle extends Model
{
    use HasFactory;
    protected $connection = 'oracle';
    public $table ='MAJLIS.PRUSER';


}
  