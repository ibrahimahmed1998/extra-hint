<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sct extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['Student_id','hmedterm_d','hlab_d','horal_d','hclass_work_d','hfinal_d','htotal_d','hpass','semester','year','ccode'];  
    

 


}
