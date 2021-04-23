<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Sct;
use App\Models\Shc;
use Illuminate\Http\Request;
class intell_alg extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>  []]);
    }
    
    public function show_courses(Request $request)
    {
         $request->validate(['choice' => 'required|integer|between:1,3']);

        switch ($request->choice)
         {
            case '1':   // show all Department [id] Courses    

                $request->validate(['dep_id' => 'required|integer|exists:Departments']);
                $courses = Shc::where('dep_id', $request->dep_id)->get();
                return response()->json(['message' => $courses], 201);
                break;

            case '2': // show all Departemnt-Section [id] Courses    

                $request->validate(['dep_id' => 'required|integer|exists:Departments','sec_id' => 'required|integer|exists:Sections']);
                $courses = Shc::where('dep_id', $request->dep_id)->where('sec_id', $request->sec_id)->get();
                return response()->json(['message' => $courses], 201);
                break;

            case '3': // show all Courses Avalable for You  [student-id]   ***   Not Passed   ****

                $request->validate([
                    'dep_id' => 'required|integer|exists:Departments',
                    'sec_id' => 'required|integer|exists:Sections',
                    'student_id' => 'required|exists:Students',
                ]);

                $not_pass = [] ;

                $section_courses = Shc::where('dep_id', $request->dep_id)->where('sec_id', $request->sec_id)->get();
                if(!$section_courses){return response()->json(['error' =>'section has\'nt courses'], 400);}
                $passed_courses = Sct::where('hpass', 1)->where('Student_id', $request->student_id)->get();

                $sc_num = $section_courses->count();
                $pc_num = $passed_courses->count();

                for ($i = 0; $i < $pc_num; $i++) {
                    $pass[] = $passed_courses[$i]->ccode;
                }

                for ($i = 0; $i < $sc_num; $i++) 
                {
                    $not_pass[] = $section_courses[$i]->ccode;
                }

                for ($i = 0; $i < $pc_num; $i++) 
                {
                    if (($key = array_search($pass[$i], $not_pass)) !== false) {
                        unset($not_pass[$key]);
                    }
                }
                print_r($not_pass);
                break;
        }
    }

    public function suggestion_courses( $request)
    {
        // roaaaaaaaaaaaaaaaad maaaaaaaaaaaap
        /*  suggestion based on multipule things like [roadmap , short_path , best score ] */
    }
}