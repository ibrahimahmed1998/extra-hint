<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attend extends Model
{
    use HasFactory;
    public $timestamps = true;
    
    protected $fillable = [ 'ccode','Student_id','is_lec','date' ];  
        
}
