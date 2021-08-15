<?php
namespace App\Http\Controllers\Yellow;
use App\Http\Controllers\Controller;
use App\Http\Requests\Course_;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class Course98 extends Controller // CRUD
{
    public function __construct() { $this->middleware('auth:api', ['except' => ['read']]);    }

    public function create(Course_ $req)
    {
        $sum1 = $req->dmidterm + $req->dlab + $req->doral;

        if ($sum1  !=  $req->dclass_work){
            return response()->json(['error' => 'dclass_work Not Calculated Good => ' . $sum1 . '!=' . $req->dclass_work], 400);}

        $sum2 =  $sum1 +  $req->dfinal;

        if ($sum2 != $req->dtotal){
            return response()->json(['error' => 'Total Degree Not Calculated Good => ' . $sum2 . '!=' . $req->dtotal], 400);}

        $dclass_work=$req->doral+$req->dlab+$req->dmidterm;

        $dtotal=$dclass_work+$req->dfinal;

        Course::create(['ccode' => $req->ccode,'cname' => $req->cname,'cch' => $req->cch,'dmidterm' => $req->dmidterm,'dlab' => $req->dlab,'doral' => $req->doral,'dclass_work' => $dclass_work ,'dfinal' => $req->dfinal,'dtotal' => $dtotal ,'instructor' => $req->instructor,]);

        return response()->json(['Success' =>'Course Created'], 201);
    }

    public function delete(Request $req){
        $req->validate(['ccode' => 'required|string|exists:Courses']);
        Course::where('ccode', $req->ccode)->delete();
        return response()->json(['Success' =>"Course deleted"], 201);}

    public function read(Request $req){
        $req->validate(['ccode' => 'required|string|exists:Courses']);
        $course = Course::where('ccode', $req->ccode)->first();

        //return $course;
        return View::make("Dep_Sec/course_det",['course' => $course]);
     }}
