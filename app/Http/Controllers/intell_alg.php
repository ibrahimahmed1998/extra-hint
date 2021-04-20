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
         $request->validate(['choice' => 'required|integer', ]);

        switch ($request->choice)
         {
            case '1': // show all Faculty Courses 

                $courses = Course::all();
                return response()->json(['message' => $courses], 201);
                break;

            case '2':   // show all Department [id] Courses    

                $validated = $request->validate([
                    'dep_id' => 'required|integer',
                ]);

                $courses = Shc::where('dep_id', $request->dep_id)->get();
                return response()->json(['message' => $courses], 201);

                break;

            case '3': // show all Departemnt-Section [id] Courses    

                $validated = $request->validate([
                    'dep_id' => 'required|integer',
                    'sec_id' => 'required|integer',
                ]);

                $courses = Shc::where('dep_id', $request->dep_id)->where('sec_id', $request->sec_id)->get();
                return response()->json(['message' => $courses], 201);
                break;

            case '4': // show all Courses Avalable for You  [student-id]   ***   Not Passed   ****

                $request->validate([
                    'dep_id' => 'required|integer|exists:Departments',
                    'sec_id' => 'required|integer|exists:Sections',
                    'student_id' => 'required|exists:Students',
                ]);

                $section_courses = Shc::where('dep_id', $request->dep_id)->where('sec_id', $request->sec_id)->get();
                $passed_courses = Sct::where('hpass', 1)->where('Student_id', $request->student_id)->get();

                $sc_num = $section_courses->count();
                $pc_num = $passed_courses->count();

                for ($i = 0; $i < $pc_num; $i++) {
                    $pass[] = $passed_courses[$i]->ccode;
                }

                for ($i = 0; $i < $sc_num; $i++) {
                    $not_pass[] = $section_courses[$i]->ccode;
                }

                for ($i = 0; $i < $pc_num; $i++) {
                    if (($key = array_search($pass[$i], $not_pass)) !== false) {
                        unset($not_pass[$key]);
                    }
                }
                print_r($not_pass);
                break;

            default:
                return response()->json(['error' => 'please enter right value'], 201);
                break;
        }
    }

    public function suggestion_courses( $request)
    {
        // roaaaaaaaaaaaaaaaad maaaaaaaaaaaap
        /*  suggestion based on multipule things like [roadmap , short_path , best score ] */
    }
}