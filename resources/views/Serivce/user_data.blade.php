@include('Serivce._user_nav')
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
            <div class="col-2"><a href="/enroll_course/{{$user->id}}/{{$coures->ccode}}" class="btn btn-info">Enroll Now</a></div>
        </div>
    @endforeach
 @endisset
</div>
