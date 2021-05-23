<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public $timestamps = true;

    
    use HasFactory;

    
    protected $fillable = ['layer_value','token','ccode','is_lec','date'] ; 
  

 
}
