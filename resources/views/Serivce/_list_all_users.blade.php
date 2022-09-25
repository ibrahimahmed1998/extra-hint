
 
<div id="list_all_users" kind="subdiv">
    @isset($all_users)
     {{-- <button   onclick="hide_syntax('list_all_users')" type="submit" class="btn btn-primary col">Double Click To Hide</button> <br> --}}
      <br>

     @foreach ($all_users as $single_user)
        <div class="row">
            <div class="col">
                first name:<input type="text" class="form-control" disabled value={{ $single_user->first_name }}>
            </div>
            <div class="col">
                last name:<input type="text" class="form-control" disabled value={{ $single_user->last_name }}>
            </div>
            <div class="col">
                phone:<input type="text" class="form-control" disabled value={{ $single_user->phone }}>
            </div>
            <div class="col">
                email:<input type="text" class="form-control" disabled value={{ $single_user->email }}>
           </div>
           <div class="col">type:<input type="text" class="form-control" disabled value={{$single_user->type}}></div>
           <div style="margin-top:25px" class="col-1"><button type="submit" class="btn btn-info">Update</button></div>
           <div style="margin-top:25px" class="col-1"><button type="submit" class="btn btn-danger">Delete</button></div>
        </div>
        @endforeach
    @endisset
</div>
