<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attend extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = [ 'ccode','Student_id','day_date','is_attend','is_lecture' ];  
        
}
