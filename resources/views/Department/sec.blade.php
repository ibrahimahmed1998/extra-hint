
<div   class="btn-group" >
    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Sections </button>

    <div class="dropdown-menu"  >
            @foreach ($section as $i)
                <a class="dropdown-item" dep_id="{{$i->dep_id}}"
                                         sec_id="{{$i->Sec_id}}"
                                         onclick="get_course({{$i->dep_id}},{{$i->Sec_id}})"
                href="#"> {{ $i->sec_name }}</a>
            @endforeach
    </div>
 </div>


