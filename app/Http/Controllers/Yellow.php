<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validate_Course;
use App\Http\Requests\Validate_Section;
use App\Http\Requests\Validate_SHC;
use App\Models\Course;
use App\Models\Section;
use App\Models\Department;
use App\Models\Pre_request;
use App\Models\Shc;
use Illuminate\Http\Request;

class Yellow extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function Department(Request $request) //create 
    {
        $request->validate([
             'dname' => 'required|string|unique:Departments',       
             'dep_id' => 'required|integer|unique:Departments']);
        
        Department::create(['dname' => $request->dname,'dep_id' => $request->dep_id]);
           
        return response()->json(['Success' => 'Department Created'], 201);
    }

    public function delete_department(Request $request)
    {
        $request->validate(['dep_id' => 'required|exists:Departments']);

        Department::where('dep_id', $request->dep_id)->delete();
        return response()->json(['Success'=>"Department deleted"], 201);
    }

    public function list_departemnts()
    {
        $d = Department::all();
        return response()->json(['all Departments' =>  $d], 201);
    }

    public function Section(Validate_Section $request) //create 
    {
       Section::create(['Sec_id' => $request->Sec_id, 'dep_id' => $request->dep_id, 'sec_name' => $request->sec_name]);     
       return response()->json(['Success' => 'Section Created'], 201);
    }

    public function delete_section(Request $request)
    {
        $request->validate(['sec_id' => 'required|integer|exists:Sections','dep_id' => 'required|exists:Departments']);
        Section::where('sec_id', $request->sec_id)->where('dep_id',$request->dep_id)->delete();
        return response()->json(['Success'=>"Section deleted"], 201);
    }

    public function add_course(Validate_Course $request)  
    {
        $sum1 = $request->dmidterm + $request->dlab + $request->doral;

        if ($sum1  !=  $request->dclass_work) {
            return response()->json(['error' => 'dclass_work Not Calculated Good => ' . $sum1 . '!=' . $request->dclass_work], 400);
        }

        $sum2 =  $sum1 +  $request->dfinal;
        if ($sum2 != $request->dtotal) {
            return response()->json(['error' => 'Total Degree Not Calculated Good => ' . $sum2 . '!=' . $request->dtotal], 400);
        }
        Course::create(
            [
                'ccode' => $request->ccode,
                'cname' => $request->cname,
                'cch' => $request->cch,
                'dmidterm' => $request->dmidterm,
                'dlab' => $request->dlab,
                'doral' => $request->doral,
                'dclass_work' => $request->dclass_work,
                'dfinal' => $request->dfinal,
                'dtotal' => $request->dtotal,
                'instructor' => $request->instructor,
            ]
        );

        return response()->json(['Success' =>'Course Created'], 201);
    }

    public function delete_Course(Request $request)
    {
        $request->validate(['ccode' => 'required|string|exists:Courses']);

        Course::where('ccode', $request->ccode)->delete();
        return response()->json(['Success' =>"Course deleted"], 201);
    }

    public function Pre_request(Request $request) //create 
    {
        $request->validate([
            'ccode' => 'required|string|exists:Courses',
            'pr_ccode' => 'required|string|different:ccode|exists:Courses,ccode'
        ]);
       
        $check = Pre_request::where('ccode', $request->ccode)->where('pr_ccode', $request->pr_ccode)->first();
     
        if ($check)
         {
            return response()->json(['error' => "Course is added Before in AMS "], 401);
        } else 
        {

            Pre_request::create( ['ccode' => $request->ccode, 'pr_ccode' => $request->pr_ccode]);
            

            return response()->json(['message' => 'Pre_request Course Created Sucessfully '], 201);
        }
    }

    public function delete_Pre_request(Request $request) //create 
    {
        $request->validate([ 
            'ccode' => 'required|string|exists:Courses,ccode',      
            'pr_ccode' => 'required|string|different:ccode|exists:Courses']);
            
        Pre_request::where('ccode', $request->ccode)
            ->where('pr_ccode', $request->pr_ccode)->delete();
        return response()->json(['Sucessfully' => " Prerequest Course deleted Sucessfully"], 201);
    }

    public function SHC(Validate_SHC $request) // Section Has Course //create 
    {
         Shc::create(
            [
                'dep_id' => $request->dep_id,
                'Sec_id' => $request->Sec_id,
                'ccode' => $request->ccode,
                'c_theoretical_ratio' => $request->c_theoretical_ratio,
                'c_elective' => $request->c_elective,
                'c_semester' => $request->c_semester,
                'c_lvl' => $request->c_lvl,

            ]
        );
        return response()->json(['message' => 'Section Has Course Rel Created Sucessfully '], 201);
    }

    public function list_c_sem(Request $request) // LIST COURSES - WHERE( LVL && SEMESTER && DEPARTMENT && SECITON )
    {
        $request->validate([
            'c_semester'=>'between:1,3|integer|required',
            'c_lvl'=>'required|between:1,4|integer',
            'sec_id' => 'required|integer|exists:Sections',
            'dep_id' => 'required|integer|exists:Departments']);

        $c = Shc::where('c_semester',$request->c_semester)->
                  where("c_lvl",$request->c_lvl)->
                  where("Sec_id",$request->Sec_id)->
                  where("dep_id",$request->dep_id)->get();

            foreach ($c as $cc ) 
            {
              print($cc);
            }
        return response()->json(['all list_courses' =>  $c], 201);
    }

    public function delete_SHC(Request $request)
    {
        $request->validate([ 
            'ccode' => 'required|string|exists:Courses',     
            'sec_id' => 'required|integer|exists:Sections',
            'dep_id' => 'required|integer|exists:Departments']);
       
        Shc::where('ccode', $request->ccode)
            ->where('sec_id', $request->sec_id)
            ->where('dep_id', $request->dep_id)
            ->delete();
        return response()->json(['Sucessfully' => " Course deleted Sucessfully from Scetion"], 201);
    }
}
