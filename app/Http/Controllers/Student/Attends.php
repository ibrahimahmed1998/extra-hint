<?php
namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Http\Requests\Attend_;
use App\Models\Attend;
use App\Models\enroll;
use Illuminate\Support\Str;

class Attends extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>  [' ']]);
    }

    public function layer(Attend_ $request)
    {
        Str::random(6);

        $_SESSION['user_start'] = time();

        if (time() - $_SESSION['user_start'] < 3) 
        {
            $user = auth()->user();

            if($user->type!=1)
            {
                return response()->json(['error' => "not student,please use student id "], 400);
            }

            $check_enroll = enroll::where('Student_id', $user->id)->where('ccode', $request->ccode)->first();

            $duplicated = Attend::where('Student_id', $user->id)
                ->where('ccode', $request->ccode)
                ->where('day_date', $request->day_date)->where('is_attend', $request->is_attend)
                ->where('is_lecture', $request->is_lecture)->first();

            if ($duplicated)
             {
                 return response()->json(['error' => "Duplicated !"], 400);
             }
             
            if (!$check_enroll)
             {
                return response()->json(['error'=>"student not enrolled ".$request->ccode], 400);
            } else {
                Attend::create(
                    [
                        'Student_id' =>  $user->id,
                        'ccode' => $request->ccode,
                        'day_date' => $request->day_date,
                        'is_attend' => $request->is_attend,
                        'is_lecture' => $request->is_lecture,
                    ]
                );
                return response()->json(['success' => 'Attended'], 201);
            }
        } else 
        {
            // sorry, you're out of time
            unset($_SESSION['user_start']); // and unset any other session vars for this task

            dd("okay");
        }
        // 'expires_in' => auth()->factory()->getTTL() * 60

    }
}
