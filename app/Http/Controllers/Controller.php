<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

/*
    * ENV : 
        - Debug = true [ in case under Developing ] , = False [ after Deployment or Execution Phase ] 
    * protected $table = Table_Name ;  
    * protected $hidden // timestamp , created_at , Updated_at
    * protected $fillable = []  
        is array used in protect database from attacks or sending false data 
        and when user send data to database must defind in $fillable to cross
        controller to database others " not defind in $fillable will not access
        to database   
 */
}
