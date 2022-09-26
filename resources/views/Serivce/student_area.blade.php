<br>

@isset($student)
    
     
<div class="row">
    <div class="col-1 ">roadmap:</div><div class="col-1 ">live hour:</div>
    <div class="col-1 ">c gpa:</div><div class="col-1 ">lvl:</div>
    <div class="col-2 ">advisor:</div><div class="col-2 ">Department:</div>
    <div class="col-2 ">Section:</div>
</div>

<div class="row">
    <div class="col-1"><input class="form-control " disabled name="roadmap" value={{ $student->roadmap }}></div>
    <div class="col-1"><input class="form-control " disabled value={{ $student->live_hour }}></div>
    <div class="col-1"><input class="form-control " disabled value={{ $student->c_gpa }}></div>
    <div class="col-1"><input class="form-control " disabled value={{ $student->lvl }}></div>
    <div class="col-2"><input class="form-control " disabled name="adv_name" value={{ $adv_name }}></div>
    <div class="col-2"><input class="form-control " disabled name="Dep_id" value={{ $dname }}></div>
    <div class="col-2"><input class="form-control " disabled name="Sec_id" value={{ $sname }}></div>
</div>    


<div class="col-2"><a href="/user_update/ "  type="submit"  class="btn btn-info">Show Student Courses</a></div>

@endisset