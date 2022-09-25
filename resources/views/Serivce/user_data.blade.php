
@include('Serivce._header_student')   
@include('Serivce._user_nav')

<div style="margin: 3%">

    <div class="row">
        <div class="col-2 ">first name:</div><div class="col-2 ">last name:</div>
        <div class="col-2 ">phone:</div><div class="col-2 ">email:</div>
        <div class="col-1 ">Type:</div>
    </div>
    <form action="/update" method="POST">
    <div class="row">
        <div class="col-2"><input class="form-control " disabled name="first_name" value={{ $user->first_name }}></div>
        <div class="col-2"><input class="form-control " disabled name="last_name" value={{ $user->last_name }}></div>
        <div class="col-2"><input class="form-control " disabled name="phone" value={{ $user->phone }}></div>
        <div class="col-2"><input class="form-control " disabled name="email" value={{ $user->email }}></div>
        <div class="col-2"> 
            @if($user->type==1) <input style="text-align:center;" class="form-control" name="type" disabled value="Student">
            @elseif ($user->type==2) <input style="text-align:center;" class="form-control" disabled name="type"  value="Advisor">
            @else <input style="text-align:center" class="form-control" disabled name="type"  value="Admin"> @endif 
        </div>
    </div><br>

    @if($student)
    
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
    </div><br>  

    <div class="col-2"><a href="/user_update/ "  type="submit"  class="btn btn-info">Show Student Courses</a></div>

      @endif
    </form>

     <div id="update-btn" style="display: none" class="col-2"><a href="/user_update/ "  type="submit"  class="btn btn-info">Make Update !</a></div>

    </div>
@include('Serivce._footer_student')</body>