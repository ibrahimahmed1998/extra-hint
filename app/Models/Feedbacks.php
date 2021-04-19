<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedbacks extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [ 'User_id','ccode' ,'fheader','fbody','fvote','fid'];  
}
