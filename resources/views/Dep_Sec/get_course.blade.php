<!-- The actual snackbar -->
<div id="snackbar">Some text some message..</div>

<div id="course_layout" >

    <div class="row">
        @foreach ($arr as $i)
        <div id="card" class="col-sm-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ $i->ccode }} </h5>
              <h5> Course Level : {{  $i->c_lvl }} </h5>

              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" onclick="myFunction('{{$i->ccode}}')" class="btn btn-primary">Know More</a>
            </div>
          </div>
        </div>
         @endforeach
</div></div>
