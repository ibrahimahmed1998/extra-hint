@include('Serivce._user_nav')
@if(session('msg'))@include('alert')@endif
@include('popup')
<div style="margin:3%">
      <div class="row">@include('Serivce.lists.user_fields')</div>
    {{-- {{dd($user)}} --}}
    <form action="/user_update/{{$user->id}}" method="POST">
        @csrf
        @include('Serivce.lists.user_fields_values')
        
        <br>
        @include('Serivce.student_area')
        
        <div  id="update-btn" style="display: none" class="col-2">
            <button style="margin-top:33%" type="submit" class="btn btn-info">Make Update !</a>
        </div>
    </form>
    @include('error')

 @isset($courses)
    <div style="margin-top:1%; width:100%;" class="row">
        <div class="col-1">ccode:</div>
        <div class="col-1">dep id:</div>
        <div class="col-1">Sec id:</div>
        <div class="col-1" style="margin-right:1%">theoretical ratio:</div>
        <div class="col-1">elective:</div>
        <div class="col-1">semester:</div>
        <div class="col-1" style="margin-left:-1%">lvl:</div>
    </div>
    @foreach($courses as $coures)
        <div class="row" style="margin:1%"> 
            <div class="col-1"><input class="form-control col2 " disabled value={{ $coures->ccode }}></div>
            <div class="col-1"><input class="form-control col2 " disabled value={{ $coures->dep_id }}></div>
            <div class="col-1"><input class="form-control col2" disabled value={{ $coures->Sec_id }}></div>
            <div class="col-1"><input class="form-control col2" disabled value={{ $coures->c_theoretical_ratio }}></div>
            <div class="col-1"><input class="form-control col2" disabled value={{ $coures->c_elective }}></div>
            <div class="col-1"><input class="form-control col2" disabled value={{ $coures->c_semester }}></div>
            <div class="col-1"><input class="form-control col2" disabled value={{ $coures->c_lvl }}></div>
            <div class="col-2" style="margin-right: -5%"><a href="course/{{$coures->ccode}}"  type="submit"  class="btn btn-warning">View {{$coures->ccode}}</a></div>
            <div class="col-2"><a href="/enroll_courses/{{$user->id}}/{{$coures->ccode}}" class="btn btn-info">Enroll Now</a></div>
        </div>
    @endforeach
 @endisset


 @isset($enrolled_courses)
    <div style="margin-top:5%; width:100%;" class="row">
        <div class="col-1" style="margin-left:-10px;">ccode:</div>
        <div style="margin-left:-55px;" class="col-1">semester:</div>
        <div style="margin-left:-60px;" class="col-1" >year:</div>
        <div class="col-1" style="margin-left:-3%">medterm:</div>
        <div class="col-1" style="margin-left:-3%">lab_d:</div>
        <div class="col-1" style="margin-left:-70px;" >oral:</div>
        <div class="col-1" style="margin-left:-3%">class_work:</div>
        <div class="col-1" style="margin-left:-3%">final:</div>
        <div class="col-1" style="margin-left:-4%">total:</div>
        <div class="col-1" style="margin-left:-4%">pass:</div>
        <div class="col-1" style="margin-left:-1%">created_at:</div>
        <div class="col-1" style="margin-left:-1%">signature:</div>
    </div>

    @foreach($enrolled_courses as $single_course)
        <div class="row" style="margin:1%">           
            <div class="col-1" style="margin-left:-32px;"><input style="width:90px"  class="form-control col2 " disabled value={{ $single_course->ccode }}></div>
            <div class="col-1" style="margin-left:25px;"><input style="width:40px" class="form-control col2 " disabled value={{ $single_course->semester }}></div>
            <div class="col-1" style="margin-left:15px;"><input style="margin-left:-42px;width:70px" class="form-control col2" disabled value={{ $single_course->year }}></div>
            <div class="col-1" style="margin-left:-15px;"><input style="margin-left:-15px; width:50px" class="form-control col2" disabled value='{{ $single_course->hmedterm_d }}'></div>
            <div class="col-1" style="margin-left:-15px;"><input style="margin-left:-5px; width:50px" class="form-control col2" disabled value={{ $single_course->hlab_d }}></div>
            <div class="col-1" style="margin-left:-15px;"><input style="margin-left:-5px; width:50px"class="form-control col2" disabled value={{ $single_course->horal_d }}></div>
            <div class="col-1" style="margin-left:-15px;"><input style="margin-left:-2px;width:50px" class="form-control col2" disabled value={{ $single_course->hclass_work_d }}></div>
            <div class="col-1" style="margin-left:-15px;"><input style="margin-left:8px; width:50px " class="form-control col2" disabled value={{ $single_course->hfinal_d }}></div>
            <div class="col-1" style="margin-left:-15px;"><input style="width:50px" class="form-control col2" disabled value={{ $single_course->htotal_d }}></div>
            <div class="col-1" style="margin-left:-15px;"><input style="width:50px" class="form-control" disabled value={{ $single_course->hpass }}></div>
            <div class="col-1" style="margin-left:-10px;"><input style="margin-right:185px;width:100px" class="form-control " disabled value={{ $single_course->created_at }}></div>
            <div class="col-1" style="margin-left:5%;"><input style="width:50px;" class="form-control col2" disabled value={{ $single_course->signature }}></div>
            <div class="col" style="margin-left:0%;width:50px" ><a href="/enroll_courses/{{$user->id}}/{{$single_course->ccode}}" class="btn btn-danger">Cancel</a></div>

            {{-- <div class="col-2" style="margin-right: -5%"><a href="course/{{$single_course->ccode}}"  type="submit"  class="btn btn-warning">View {{$coures->ccode}}</a></div>  --}}
         </div>
    @endforeach
@endisset

</div>
