<form style="display:none" id="profile">
    <div class="row">
        <div class="col">
            first name:<input type="text" class="form-control" disabled value={{ $user->first_name }}>
        </div>
        <div class="col">
            last name:<input type="text" class="form-control" disabled value={{ $user->last_name }}>
        </div>
        <div class="col">
            phone:<input type="text" class="form-control" disabled value={{ $user->phone }}>
        </div>
        <div class="col">
          email:<input type="text" class="form-control" disabled value={{ $user->email }}>
      </div>
    </div>
        {{-- <div class="col">type:<input type="text" class="form-control" disabled value={{ $type }}></div> --}}
</form>