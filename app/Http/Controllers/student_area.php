<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\student_area\Validate_SCT;
use App\Http\Requests\student_area\Validate_SCT_degree;
use App\Models\Course;
use App\Models\Pre_request;
use App\Models\Sct;
use App\Models\Shc;
use App\Models\Student;
use Illuminate\Http\Request;

class Student_Area extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>[ ]]);
    }

    

    public function level_calc(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:Students',
        ]);

        $passed_courses = SCT::where('hpass', 1)->where('Student_id', $request->student_id)->get();

        $sum = 0;
        foreach ($passed_courses as $p) {
            $sum = $sum + Course::where('ccode', $p->ccode)->value('cch');
        }

        $student = Student::where('student_id', $request->student_id)->first();

        if ($sum >= 0 && $sum < 33) {
            $student->where('student_id', $request->student_id)->update(['current_lvl' => 1]);
        } else if ($sum  >= 33 && $sum < 67) {
            $student->where('student_id', $request->student_id)->update(['current_lvl' => 2]);
        } else if ($sum  >= 67 && $sum < 100) {
            $student->where('student_id', $request->student_id)->update(['current_lvl' => 3]);
        } else if ($sum  >= 100 && $sum < 134) {
            $student->where('student_id', $request->student_id)->update(['current_lvl' => 4]);
        } else if ($sum >= 134) {
            response()->json(['message' => 'student was graduated  '], 201);
        } else {
            return response()->json(['error' => 'level calculator has error  '], 400);
        }

        return response()->json(['message' => 'Student Current lvl = ' . $student->current_lvl], 201);
    }

    public function show_courses(Request $request)
    {
        $validated = $request->validate([
            'choice' => 'required|integer',
        ]);

        switch ($request->choice) {

            case '1': // show all Faculty Courses 

                $courses = Course::all();
                return response()->json(['message' => $courses], 201);
                break;

            case '2':   // show all Department [id] Courses    

                $validated = $request->validate([
                    'department_id' => 'required|integer',
                ]);

                $courses = Shc::where('dep_id', $request->department_id)->get();
                return response()->json(['message' => $courses], 201);

                break;

            case '3': // show all Departemnt-Section [id] Courses    

                $validated = $request->validate([
                    'department_id' => 'required|integer',
                    'section_id' => 'required|integer',
                ]);

                $courses = Shc::where('dep_id', $request->department_id)->where('sec_id', $request->section_id)->get();
                return response()->json(['message' => $courses], 201);

                break;

            case '4': // show all Courses Avalable for You  [student-id]   ***   Not Passed   ****

                $validated = $request->validate([
                    'department_id' => 'required|integer',
                    'section_id' => 'required|integer',
                    'student_id' => 'required|exists:Students',
                ]);

                $section_courses = Shc::where('dep_id', $request->department_id)->where('sec_id', $request->section_id)->get();
                $passed_courses = Sct::where('hpass', 1)->where('Student_id', $request->student_id)->get();

                $x = response()->json([$section_courses], 201);
                dd($x);

                foreach ($section_courses as $sc) {

                    if (strcmp($sc->ccode, $passed_courses->ccode) && $passed_courses->hpass == 1) {
                    } else {
                        return response()->json(['message' => $section_courses], 201);
                    }
                }

                break;

            default:
                return response()->json(['error' => 'please enter right value'], 201);
                break;
        }
    }

    public function update_student_degree(Validate_SCT_degree $request)
    {

        /* permison */
        $check = Sct::where('ccode', $request->ccode)->where('year', $request->year)->where('semester', $request->semester)->where('Student_id', $request->Student_id)->first();

        $update = Sct::where('ccode', $request->ccode)->where('year', $request->year)->where('semester', $request->semester)->where('Student_id', $request->Student_id);

        $course = Course::where('ccode', $request->ccode)->first();

        $class_work = $request->hmedterm_d + $request->hlab_d +  $request->horal_d;

        $total =   $class_work  +   $request->hfinal_d;

        if ($total >=  ($course->dtotal) * 0.60) {
            $is_pass = 1;
        } else {
            $is_pass = 0;
        }

        if ($check) {
            if (
                $request->hmedterm_d > $course->dmidterm ||
                $request->hlab_d > $course->dlab  ||
                $request->horal_d > $course->doral ||
                $class_work > $course->dclass_work  ||
                $request->hfinal_d > $course->dfinal  ||
                $total > $course->dtotal
            ) {
                return response()->json(['error' => ' Student Degrees > Course expected Degrees'], 201);
            } else {
                $update->update(array(
                    'hmedterm_d' => $request->hmedterm_d,
                    'hlab_d' => $request->hlab_d,
                    'horal_d' =>  $request->horal_d,
                    'hclass_work_d' =>  $class_work,
                    'hfinal_d' => $request->hfinal_d,
                    'htotal_d' =>  $total,
                    'hpass' =>  $is_pass
                ));
            }
            return response()->json(['message' => 'Student Degree has updated Sucessfully '], 201);
        } else {
            return response()->json(['error' => 'Student Degree has not updated , may be wrong data '], 400);
        }
    }

    public function SCT(Validate_SCT $request)
    {
        $x = Sct::where('ccode', $request->ccode)->where('year', $request->year)->where('semester', $request->semester)->where('Student_id', $request->Student_id)->first();

        if ($x) {
            return response()->json(['error' => "Student enrolled this Course Before in same SEMESTER , YEAR"], 400);
        } else {
            $pre_req = Pre_request::where('ccode', $request->ccode)->get();
            $p_r_counter = Pre_request::where('ccode', $request->ccode)->count();
            $counter = 0;

            foreach ($pre_req as $pr) {
                $pass = Sct::where('ccode', $pr->pr_ccode)->value('hpass');
                if ($pass == 1) {
                    $counter = $counter + 1;
                } else {
                    return response()->json(['error' => "Student not passed in pre-request " . $pr->pr_ccode], 400);
                }
            }

            if ($counter != $p_r_counter) {
                return response()->json(['error' => "Student can't enroll this course before it has pre-request and not passed "
                    . $pre_req->pr_code], 400);
            } else {
                $Sct = Sct::create(
                    [
                        'Student_id' => $request->Student_id,
                        'semester' => $request->semester,
                        'year' => $request->year,
                        'ccode' => $request->ccode,
                    ]
                );
                return response()->json(['message' => 'Student Has Course Rel Created Sucessfully '], 201);
            }
        }
    }

    public function gpa_calc(Request $request)
    {
        /*  sugges */
    }

    public function suggestion_courses(Request $request)
    {
        /*  suggestion based on multipule things like [roadmap , short_path , best score ] */
    }
}
