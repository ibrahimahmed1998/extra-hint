<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validate_Course;
use App\Http\Requests\Validate_Section;
use App\Http\Requests\Validate_dep;
use App\Http\Requests\Validate_Pre_request;
use App\Http\Requests\Validate_SCT;
use App\Http\Requests\Validate_SCT_degree;
use App\Http\Requests\Validate_SHC;
use App\Models\Course;
use App\Models\Section;
use App\Models\Department;
use App\Models\Pre_request;
use App\Models\Sct;
use App\Models\SHC;
 class yellow_area extends Controller
{
    public function __construct( )
    {
     $this->middleware('auth:api', ['except' => ['Section','Department','Course','Pre_request','SHC','SCT','update_student_degree'] ]);
    }

    public function Department(Validate_dep $request)
    {
        $department = Department::create(
            [
                'dname' => $request->dname,
                'dep_id' => $request->dep_id,
            ]
        );

        return response()->json(['message' => 'Department Created Sucessfully '], 201);
    }

    public function Section(Validate_Section $request    )
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

     


    public function Course(Validate_Course $request)
    {
        // check1 
        $sum1 = $request->dmidterm + $request->dlab + $request->doral ; 

        if( $sum1  !=  $request->dclass_work )
        {
            return response()->json(['error' => 'dclass_work Not Calculated Good => '.$sum1.'!='.$request->dclass_work ], 400);
        }
        // check2 
        $sum2 =  $sum1 +  $request->dfinal ;
       if ($sum2 != $request->dtotal ) 
       {
        return response()->json(['error' => 'Total Degree Not Calculated Good => '.$sum2.'!='.$request->dtotal ], 400);
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

    public function Pre_request(Validate_Pre_request $request)
    {
        $check = Pre_request::where('ccode',$request->ccode)->where( 'pr_ccode',$request->pr_ccode)->first();
         
        // dd($check);

        if( $check )
        {
            return response()->json(['error' => "Course is Entered Before in system "], 401);

        }
        else 
        $Pre_request = Pre_request::create(
            [
                'ccode' => $request->ccode,
                'pr_ccode' => $request->pr_ccode,    
            ]
        );

        return response()->json(['message' => 'Pre_request Course Created Sucessfully '], 201);
    }

    public function SHC(Validate_SHC $request)
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

    public function SCT(Validate_SCT $request)
    {
        $check = Sct::where('ccode',$request->ccode)->where('year',$request->year)->
                      where('semester',$request->semester)->where('Student_id',$request->Student_id)->first();
                     
        if( $check )
        {
            return response()->json(['error' => "Student enrolled this Course Before in same SEMESTER , YEAR"], 400);
        }
        else 
        {
         $pre_req = Pre_request::where('ccode',$request->ccode)->get();
         $p_r_counter = Pre_request::where('ccode',$request->ccode)->count();
         $counter = 0 ; 

       foreach( $pre_req as $pr) 
       {
        $pass = Sct::where('ccode',$pr->pr_ccode)->value('hpass');
       
        if ( $pass == 1 )  {   $counter= $counter + 1  ; }
        
        }

         if( $counter != $p_r_counter  )
        {
            return response()->json(['error' => "Student can't enroll this course before it has pre-request and not passed "
            .$pre_req->pr_code ], 400); 
        }
        
        else 
        {
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

    public function update_student_degree(Validate_SCT_degree $request)
    {
        $check = Sct::where('ccode',$request->ccode)->where('year',$request->year)->
        where('semester',$request->semester)->where('Student_id',$request->Student_id)->first();
        
        $update = Sct::where('ccode',$request->ccode)->where('year',$request->year)->
        where('semester',$request->semester)->where('Student_id',$request->Student_id) ; 

        $course = Course::where('ccode',$request->ccode)->first();

        $class_work = $request->hmedterm_d + $request->hlab_d +  $request->horal_d ; 
        
        $total =   $class_work  +   $request->hfinal_d  ; 

        if ( $total >=  ($course->dtotal)*0.60 )  {   $is_pass = 1 ;  }
        else { $is_pass = 0 ;  }

         if($check)
            {
                if(  $request->hmedterm_d > $course->dmidterm ||
                     $request->hlab_d > $course->dlab  ||
                     $request->horal_d > $course->doral ||
                     $class_work > $course->dclass_work  ||
                     $request->hfinal_d > $course->dfinal  ||
                     $total > $course->dtotal   
                 )
               {
                return response()->json(['error' => ' Student Degrees > Course expected Degrees'], 201);
               }
               else
               {
                $update->update(array(
                    'hmedterm_d' => $request->hmedterm_d ,
                    'hlab_d' => $request->hlab_d,
                    'horal_d' =>  $request->horal_d,
                    'hclass_work_d' =>  $class_work ,
                    'hfinal_d' => $request->hfinal_d,
                    'htotal_d' =>  $total ,
                    'hpass' =>  $is_pass    
                ) );
               }
                return response()->json(['message' => 'Student Degree has updated Sucessfully '], 201);
            }
          else
          {
            return response()->json(['error' => 'Student Degree has not updated , may be wrong data '], 400);
          }
    }
}