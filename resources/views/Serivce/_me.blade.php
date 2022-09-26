<div style="display:none" id="profile" kind="subdiv">
    <div class="row">

        <div class="col col2">full name:</div>
        <div class="col col2">phone:</div>
        <div class="col col2">email:</div>
        <div class="col col2">type:</div>
    </div>
        <div class="row">
           {{-- {{ddd($user->full_name);}} --}}
            <div class="col"><input class="form-control col2" disabled value='{{ $user->full_name }}'></div>
            <div class="col"><input class="form-control col2" disabled value={{ $user->phone }}></div>
            <div class="col"><input class="form-control col2" disabled value={{ $user->email }}></div>
            <div class="col"><input class="form-control col2" disabled value={{ $user->type }}></div>
        </div><br><br><br>

        @include('Serivce.change_pass')

</div>
