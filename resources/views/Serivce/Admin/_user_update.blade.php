@include('Serivce._header_student')

<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Home</a>
        <li class="navbar-nav nav-item active col-1"> <a class="nav-link" href="/myserivce">Back To Serivce</a></li>
        <li class="navbar-nav nav-item col-1" >   <a class="nav-link" href="#">Link</a> </li>
        <li class="navbar-nav nav-item col-1"><a class="nav-link disabled" href="#">Disabled</a> </li>
</nav>

  
<div class="row">
    <div class="col-2 ">first name:</div>
    <div class="col-2 ">last name:</div>
    <div class="col-2 ">phone:</div>
    <div class="col-2 ">email:</div>
    <div class="col-1 ">Type:</div>

</div>
<div class="row">
    <div class="col-2"><input class="form-control " disabled value={{ $user->first_name }}></div>
    <div class="col-2"><input class="form-control " disabled value={{ $user->last_name }}></div>
    <div class="col-2"><input class="form-control " disabled value={{ $user->phone }}></div>
    <div class="col-2"><input class="form-control " disabled value={{ $user->email }}></div>
    <div class="col"> @if($single_user->type==1) </a>
        <a style="text-align:center ;text-decoration:underline" class="form-control" disabled href="/student_data/{{$single_user->id}}">Student</a>
            @elseif ($single_user->type==2) 
            <input style="text-align:center;" class="form-control" disabled value="Advisor">

            @else                 
             <input style="text-align:center" class="form-control" disabled value="Admin">
             @endif 
            </div>
</div>
 
<br>

<div class="row">
    <div class="col-1 ">roadmap:</div>
    <div class="col-1 ">live hour:</div>
    <div class="col-1 ">c gpa:</div>
    <div class="col-1 ">lvl:</div>
    <div class="col-1 ">adv id:</div>
    <div class="col-1 ">Dep id :</div>
    <div class="col-1 ">Sec id:</div>

</div>

@isset($student)
<div class="row">
    <div class="col-1"><input class="form-control " disabled value={{ $student->roadmap }}></div>
    <div class="col-1"><input class="form-control " disabled value={{ $student->live_hour }}></div>
    <div class="col-1"><input class="form-control " disabled value={{ $student->c_gpa }}></div>
    <div class="col-1"><input class="form-control " disabled value={{ $student->lvl }}></div>
    <div class="col-1"><input class="form-control " disabled value={{ $student->adv_id }}></div>
    <div class="col-1"><input class="form-control " disabled value={{ $student->Dep_id }}></div>
    <div class="col-1"><input class="form-control " disabled value={{ $student->Sec_id }}></div>

</div>
@endisset
@include('Serivce._footer_student')

