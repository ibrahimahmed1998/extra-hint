
 
<div id="list_all_users" kind="subdiv">
    @isset($all_users)
     {{-- <button   onclick="hide_syntax('list_all_users')" type="submit" class="btn btn-primary col">Double Click To Hide</button> <br> --}}
      <br>
      <div class="row" style="text-align:center; font-weight: bold"  >
        <div class="col">first name:</div>
        <div class="col">last name:</div>
        <div class="col">phone:</div>
        <div class="col-3">email:</div>
        <div class="col">
            <div class="dropdown" style="margin-left:-70px; "> 
                <button style="width:100px" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Type:</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                 <a class="dropdown-item" href="#" onclick="showonly('All')" >Show All</a>
                  <a class="dropdown-item" href="#" onclick="showonly(1)" >Hide Student</a>
                  <a class="dropdown-item" href="#" onclick="showonly(2)" >Hide Advisor</a>
                  <a class="dropdown-item" href="#" onclick="showonly(3)" >Hide Admin</a>
                </div>
              </div>
        </div>

        <div class="col">Action:</div>
    </div>
     @foreach ($all_users as $single_user)
        <div class="row" style="margin:15px;" user_type="{{$single_user->type}}" gold  >
          <div class="col"><input style="text-align:center" class="form-control" disabled value={{ $single_user->first_name }}></div>
          <div class="col"><input style="text-align:center" class="form-control" disabled value={{ $single_user->last_name }}></div>
          <div class="col"><input style="width:138px;text-align:center" class="form-control" disabled value={{$single_user->phone}}></div>
          <div class="col-3"><input style="text-align:center" class="form-control" disabled value={{ $single_user->email }}></div>
          <div class="col"><input style="text-align:center"class="form-control" disabled value=
                @if($single_user->type==1) Student
                @elseif ($single_user->type==2) Advisor
                @else Admin @endif></div>
          <div class="col-1"><button type="submit" class="btn btn-info">Update</button></div>
          <div class="col-1"><button type="submit" class="btn btn-danger">Delete</button></div>
        </div>
        @endforeach
    @endisset
</div>
