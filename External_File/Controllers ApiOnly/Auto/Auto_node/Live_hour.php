<?php
namespace App\Http\Controllers\Auto\Auto_node;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\enroll;
use App\Models\Student;
 
class Live_hour extends Controller
{
    public function __construct() {   $this->middleware('auth:api', ['except' => []]); }

    public function live_hour($id)
    {
        $table = Student::where('Student_id', $id);
        
        $live_hours = 12 ;  //$student=$table->first(); $live_hours =  $student->live_hour  ;
        $ec = enroll::where('Student_id',$id)->get(); // enrolled courses 

        $arr=[]; $new=[]; $filter=[];
       
        for ($i=0; $i <  $ec->count() ; $i++) { $arr[]=$ec[$i]; }
     
        for ($i = 0; $i < sizeof($arr)-1; $i++) 
        {
            for ($j =$i+1; $j < sizeof($arr); $j++)
             {
                if ($arr[$i]->ccode == $arr[$j]->ccode) 
                { 
                    if($arr[$i]->counter !== $arr[$j]->counter)
                     {
                         $new[] = $arr[$j]->ccode;
                         unset($arr[$j]->ccode);
                     }
                }
            }
        }

        for ($i=0; $i<sizeof($new); $i++) 
        { 
            if( $new[$i] != null )  {   $filter[]= $new[$i];  }   
        } 
        
        for ($i=0; $i<sizeof($filter); $i++) 
        { 
            $cch=Course::where('ccode',$filter[$i])->value('cch');
            $live_hours=$live_hours-$cch;    
        }  
        
       // $table->update(array('live_hour'=> $live_hours));  return  $student->first();
       if($live_hours < 0 ) { $live_hours = 0 ; }
       return  $live_hours;
    }
}