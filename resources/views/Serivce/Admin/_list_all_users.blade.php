<div id="list_all_users" kind="subdiv">
    @isset($all_users)
        {{-- <button   onclick="hide_syntax('list_all_users')" type="submit" class="btn btn-primary col">Double Click To Hide</button> <br> --}}
        <br>

        @include('Serivce.lists.user_fields')

        <div class="dropdown" style="margin-left:-70px; ">
            <button style="width:100px" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Type:</button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#" onclick="showonly('All')">Show All</a>
                <a class="dropdown-item" href="#" onclick="showonly('student')">Hide Student</a>
                <a class="dropdown-item" href="#" onclick="showonly('advisor')">Hide Advisor</a>
                <a class="dropdown-item" href="#" onclick="showonly('admin')">Hide Admin</a>
            </div>
        </div>
    </div>
    </div>

    @foreach ($all_users as $user)
        @include('Serivce.lists.user_fields_values')
        <div class="col-1"><a href="/user_update/{{$user->id}}"  type="submit"  class="btn btn-info">View</a></div>
    </div>
    @endforeach
@endisset
</div>
