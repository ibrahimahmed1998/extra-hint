<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pre_request extends Model
{
    use HasFactory;
    public $timestamps = false;

 
    protected $fillable = [ 'ccode','pr_ccode' ];  
    

}
