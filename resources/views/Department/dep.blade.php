

<div  class="btn-group" >
    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Departments </button>

    <div class="dropdown-menu"   >
            @foreach ($dep as $i)
                <a class="dropdown-item"  dep_id="{{$i->dep_id}}"
                onclick='get_section({{$i->dep_id}})' href="#"> {{ $i->dname }}</a>
            @endforeach
    </div>
</div>
