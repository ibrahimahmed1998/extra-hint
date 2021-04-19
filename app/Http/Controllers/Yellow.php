<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\yellow_area\Validate_Course;
use App\Http\Requests\yellow_area\Validate_delete_course;
use App\Http\Requests\yellow_area\Validate_Section;
use App\Http\Requests\yellow_area\Validate_dep;
use App\Http\Requests\yellow_area\Validate_Pre_request;
use App\Http\Requests\yellow_area\Validate_SHC;
use App\Models\Course;
use App\Models\Section;
use App\Models\Department;
use App\Models\Pre_request;
use App\Models\SHC;

class Yellow extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>[] ] );
      
    }
    
    public function Department(Validate_dep $request) //create 
    {
        $department = Department::create(
            [
                'dname' => $request->dname,
                'dep_id' => $request->dep_id,
            ]
        );

        return response()->json(['message' => 'Department Created Sucessfully '], 201);
    }

    public function Section(Validate_Section $request) //create 
    {
        $section = Section::create(
            [
                'Sec_id' => $request->Sec_id,
                'dep_id' => $request->dep_id,
                'sec_name' => $request->sec_name,
            ]
        );

        return response()->json(['message' => 'Section Created Sucessfully '], 201);
    }

    public function Course(Validate_Course $request) //create 
    {
        $sum1 = $request->dmidterm + $request->dlab + $request->doral;

        if ($sum1  !=  $request->dclass_work) 
        {
            return response()->json(['error' => 'dclass_work Not Calculated Good => ' . $sum1 . '!=' . $request->dclass_work], 400);
        }
     
        $sum2 =  $sum1 +  $request->dfinal;
        if ($sum2 != $request->dtotal) 
        {
            return response()->json(['error' => 'Total Degree Not Calculated Good => ' . $sum2 . '!=' . $request->dtotal], 400);
        }
        $Course = Course::create(
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

        return response()->json(['message' => 'Course Created Sucessfully '], 201);
    }

    public function delete_Course(Validate_delete_course $request)
    {
            Course::where('ccode', $request->ccode)->delete();
            return response()->json(['Sucessfully' => " Course deleted Sucessfully"], 201);
    }

    public function Pre_request(Validate_Pre_request $request) //create 
    {
        $check = Pre_request::where('ccode', $request->ccode)->where('pr_ccode', $request->pr_ccode)->first();

        if ($check) {
            return response()->json(['error' => "Course is Entered Before in system "], 401);
        } else
            $Pre_request = Pre_request::create(
                [
                    'ccode' => $request->ccode,
                    'pr_ccode' => $request->pr_ccode,
                ]
            );

        return response()->json(['message' => 'Pre_request Course Created Sucessfully '], 201);
    }

    public function SHC(Validate_SHC $request) // Section Has Course //create 
    {
        $SHC = SHC::create(
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
}