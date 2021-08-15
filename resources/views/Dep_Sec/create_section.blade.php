<div  id="sec_style" class="btn-group" > {{-- Sections DropDown Menu --}}
    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Sections </button>

    <div class="dropdown-menu"  >
            @foreach ($section as $i)
                <a class="dropdown-item" href="#"> {{ $i->sec_name }}</a>
            @endforeach
    </div>

 </div>
