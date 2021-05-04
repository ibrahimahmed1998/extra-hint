<?php
namespace App\Http\Controllers\Yellow;
use App\Http\Controllers\Controller;
use App\Http\Requests\Course_;
use App\Models\Course;
use Illuminate\Http\Request;

class Course98 extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]);    }
  
    public function course98(Course_ $request)  
    {
        $sum1 = $request->dmidterm + $request->dlab + $request->doral;

        if ($sum1  !=  $request->dclass_work) 
        {
            return response()->json(['error' => 'dclass_work Not Calculated Good => ' . $sum1 . '!=' . $request->dclass_work], 400);
        }

        $sum2 =  $sum1 +  $request->dfinal;
        if ($sum2 != $request->dtotal) {
            return response()->json(['error' => 'Total Degree Not Calculated Good => ' . $sum2 . '!=' . $request->dtotal], 400);
        }

        $dclass_work=$request->doral+$request->dlab+$request->dmidterm;
        $dtotal=$dclass_work+$request->dfinal;

        Course::create(
            [
                'ccode' => $request->ccode,
                'cname' => $request->cname,
                'cch' => $request->cch,
                'dmidterm' => $request->dmidterm,
                'dlab' => $request->dlab,
                'doral' => $request->doral,
                'dclass_work' => $dclass_work ,
                'dfinal' => $request->dfinal,
                'dtotal' => $dtotal ,
                'instructor' => $request->instructor,
            ]
        );

        return response()->json(['Success' =>'Course Created'], 201);
    }

    public function del_Course(Request $request)
    {
        $request->validate(['ccode' => 'required|string|exists:Courses']);

        Course::where('ccode', $request->ccode)->delete();
        return response()->json(['Success' =>"Course deleted"], 201);
    }

}