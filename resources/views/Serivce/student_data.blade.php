
@include('Serivce._header_student')
<body style="width:100vh">
    

<nav class="navbar navbar-dark bg-dark" style="width:151.4vh">
    <a style="margin-left:15px" class="navbar-brand" href="/">Home</a>
        <li class="navbar-nav nav-item active col-3"> <a class="nav-link" href="/myserivce">Back To Serivce Page</a></li>
        @if (auth()->user()->type==3)  
        <li class="navbar-nav nav-item col-1" >  <a style="color:yellow" class="nav-link" href="#">Update Data</a> </li>
        <li class="navbar-nav nav-item col-1"><a style="color:red" class="nav-link disabled" href="#">Delete User</a> </li>
        @endif
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
    <div class="col-2"> @if($user->type==1) </a>
        <input style="text-align:center;" class="form-control" disabled value="Student">
 
            @elseif ($user->type==2) 
            <input style="text-align:center;" class="form-control" disabled value="Advisor">

            @else                 
             <input style="text-align:center" class="form-control" disabled value="Admin">
             @endif 
            </div>
</div>
 
<br>
@if ($student)
<div class="row">
    <div class="col-1 ">roadmap:</div>
    <div class="col-1 ">live hour:</div>
    <div class="col-1 ">c gpa:</div>
    <div class="col-1 ">lvl:</div>
    <div class="col-1 ">adv id:</div>
    <div class="col-1 ">Dep id :</div>
    <div class="col-1 ">Sec id:</div>

</div>


{{-- @isset($student) --}}
<div class="row">
    <div class="col-1"><input class="form-control " disabled value={{ $student->roadmap }}></div>
    <div class="col-1"><input class="form-control " disabled value={{ $student->live_hour }}></div>
    <div class="col-1"><input class="form-control " disabled value={{ $student->c_gpa }}></div>
    <div class="col-1"><input class="form-control " disabled value={{ $student->lvl }}></div>
    <div class="col-1"><input class="form-control " disabled value={{ $student->adv_id }}></div>
    <div class="col-1"><input class="form-control " disabled value={{ $student->Dep_id }}></div>
    <div class="col-1"><input class="form-control " disabled value={{ $student->Sec_id }}></div>
</div>
{{-- @endisset --}}
@endif
@include('Serivce._footer_student')

</body>