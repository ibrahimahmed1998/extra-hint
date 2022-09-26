@include('Serivce._headerfooter._hstudent')

@isset($student)

<div style="margin-top:5%; width:100%;" class="row">
    <div class="col-1">roadmap:</div>
    <div class="col-1">live hour:</div>
    <div class="col-1">c gpa:</div>
    <div class="col-1">lvl:</div>
    <div class="col-1">advisor:</div>
    <div class="col-2">Department:</div>
    <div class="col-2" style="margin-left: -5%">Section:</div>
</div>

<div class="row">
    <div class="col-1"><input class="form-control" disabled name="roadmap" value={{ $student->roadmap }}></div>
    <div class="col-1"><input class="form-control" disabled                value={{ $student->live_hour }}></div>
    <div class="col-1"><input class="form-control" disabled                value={{ $student->c_gpa }}></div>
    <div class="col-1"><input class="form-control" disabled                value={{ $student->lvl }}></div>
    @isset($advisors_names)
    <div class="dropdown col-2">
        <button class="btn form-control btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           Select Advisor
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @foreach ($advisors_names as $adv_name)
            <a class="dropdown-item" href="#" name="adv_name" value={{$adv_name->full_name}} >{{$adv_name->full_name}}</a>
            @endforeach 
        </div>
      </div>
      @endisset

    <div class="col-1"><input class="form-control" disabled name="adv_name"value={{ $adv_name }}></div>
    <div class="col-2"><input class="form-control" disabled name="Dep_id"  value={{ $dname }}></div>
    <div class="col-2"><input class="form-control" disabled name="Sec_id"  value={{ $sname }}></div>
</div>  


{{-- <a href="#!" style="margin:5%" class="btn btn-info">Re-Active Student</a>  --}}
<a href="#!" style="margin:5%" class="btn btn-info">Show Enrolled</a> {{-- after show enroll will see cancel course --}}
  
<a href="/list_courses/{{$student->user_id}}" style="margin:5%" class="btn btn-info">Enroll new Courses</a> 


@endisset

@include('Serivce._headerfooter._fstudent')</body>

