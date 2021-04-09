<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shc extends Model
{
    use HasFactory;
    public $timestamps = false;

    
    protected $fillable = [ 'dep_id','Sec_id','ccode','c_theoretical_ratio','c_elective','c_semester','c_lvl' ];  
    

 


}
