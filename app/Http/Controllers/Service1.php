<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Sct;
use App\Models\Shc;
use App\Models\Student;
use Illuminate\Http\Request;

class Service1 extends Controller
{
    public function __construct( )
    {
     $this->middleware('auth:api', ['except' => ['level_calc','show_courses','suggestion_courses','gpa_calc']]);
    }
 
    public function level_calc(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:Students',
        ]);

        $passed_courses = SCT:: where('hpass',1)->where('Student_id',$request->student_id)->get();

        $sum = 0 ; 
        foreach($passed_courses as $p)
        {
            $sum = $sum + Course::where('ccode',$p->ccode)->value('cch');  
        }

    $student = Student::where('student_id',$request->student_id)->first();
 
     if(  $sum >= 0 && $sum < 33 ) 
      { $student->where('student_id',$request->student_id)->update(['current_lvl' => 1]);  }
     else if ( $sum  >= 33 && $sum < 67  )  
      { $student->where('student_id',$request->student_id)->update(['current_lvl' => 2]); }
     else if ( $sum  >= 67 && $sum < 100  ) 
      { $student->where('student_id',$request->student_id)->update(['current_lvl' => 3]); }
     else if ( $sum  >= 100 && $sum< 134  ) 
      {$student->where('student_id',$request->student_id)->update(['current_lvl' => 4]);}
     else if ($sum >= 134 ) 
      { response()->json(['message' => 'student was graduated  '], 201); }
     else  
       {return response()->json(['error' => 'level calculator has error  '], 400);}

    return response()->json(['message' => 'Student Current lvl = '.$student->current_lvl ], 201);
} 

public function show_courses(Request $request)
{
    $validated = $request->validate([
        'choice' => 'required|integer',
    ]);

     switch ($request->choice)
     {
        
         case '1': // show all Faculty Courses 

            $courses = Course::all();
            return response()->json(['message' => $courses ], 201); 
             break;

        case '2':   // show all Department [id] Courses    
           
            $validated = $request->validate([
                'department_id' => 'required|integer',
            ]);
                
            $courses = Shc::where('dep_id',$request->department_id)->get();
            return response()->json(['message' => $courses ], 201); 

        break;

        case '3': // show all Departemnt-Section [id] Courses    

            $validated = $request->validate([
                'department_id' => 'required|integer',
                'section_id' => 'required|integer',
            ]);

            $courses = Shc::where('dep_id',$request->department_id)->where('sec_id',$request->section_id)->get();
            return response()->json(['message' => $courses ], 201); 

            break;

         case '4': // show all Courses Avalable for You  [student-id]   ***   Not Passed   ****

            $validated = $request->validate([
                'department_id' => 'required|integer',
                'section_id' => 'required|integer',
                'student_id' => 'required|exists:Students',
            ]);

            $section_courses = Shc::where('dep_id',$request->department_id)->where('sec_id',$request->section_id)->get();
            $passed_courses = Sct:: where('hpass',1)->where('Student_id',$request->student_id)->get();

            $x = response()->json([  $section_courses ], 201); 
            dd($x);

            foreach ($section_courses as $sc)
            {
               
                 if (  strcmp($sc->ccode,$passed_courses->ccode) && $passed_courses->hpass == 1 )
                {
                   
                }
                else 
            {
                return response()->json(['message' => $section_courses ], 201); 
            }

                
            }

           break;

            default:
            return response()->json(['error' => 'please enter right value' ], 201); 
             break;
     }


 
}

public function suggestion_courses(Request $request)
{
    /*  suggestion based on multipule things like [roadmap , short_path , best score ] */
}

public function gpa_calc(Request $request)
{
    /*  sugges */
}

}


