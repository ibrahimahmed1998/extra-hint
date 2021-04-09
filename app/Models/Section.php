<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public $timestamps = false;

    
    use HasFactory;

    
    protected $fillable = [
        'Sec_id','dep_id','sec_name'  ];  

 
}
