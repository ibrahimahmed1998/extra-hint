<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    public $timestamps = false;

    
    protected $fillable = [ 'ccode','cname','cch','dmidterm','dlab','doral','dclass_work','dfinal' ,'dtotal','instructor' ];  
    

}
