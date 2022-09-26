<form  kind="subdiv" style="display:none" id="adduser" method="POST" action="{{ route('add_user') }}"  >
    @csrf
    @include('Serivce.lists.new_user')
    @include('error')
    <br>
    <button type="submit" class="btn btn-primary">Add User</button>
</form>
