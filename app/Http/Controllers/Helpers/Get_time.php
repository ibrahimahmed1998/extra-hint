<?php
namespace App\Http\Controllers\Helpers;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
class Get_time extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); }

    public function get_time()
    {
        $t=Carbon::now();
        $sem=0;
        $year=substr($t,0,4); 
        $month=substr($t,5,2);

        $sem1 =['09','10','11','00']; 
        $sem2= ['01','02','03','05']; 
        $sem3 =['06','07','08','00']; 
       
        for ($i=0; $i < 4; $i++) 
        { 
            if($month===$sem1[$i]){$sem=1;} 
            else if($month===$sem2[$i]){$sem=2;} 
            else if($month===$sem3[$i]){$sem=3;} 
        }

        return ['sem'=>$sem,'year'=>$year] ; 
    }
}