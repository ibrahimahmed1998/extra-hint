<form  kind="subdiv" style="display:none" id="adduser" method="POST" action="{{ route('add_user') }}"  >
    @csrf
    <div class="row">
        <div class="col">
            full name:<input type="text" class="form-control" value='ahmed' name="full_name">
        </div>

        <div class="col">
            password:<input type="text" class="form-control" value='12345678' name="password">
        </div>

        <div class="col">
            phone:<input type="text" class="form-control" value='01118629181' name="phone">
        </div>
        <div class="col">
            email:<input type="text" class="form-control" value='ibrahim@hotmail.com' name="email">
        </div>

        <div class="col">
            <input type="radio"  name="type" value="student">
            <label>Student</label><br>
            <input type="radio"  name="type" value="advisor">
            <label>Advisor</label><br>
            <input type="radio"  name="type" value="admin">
            <label>Admin</label>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <br>
    <button type="submit" class="btn btn-primary">Add User</button>
</form>
