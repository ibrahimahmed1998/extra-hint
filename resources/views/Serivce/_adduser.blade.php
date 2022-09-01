<form style="display:none" id="adduser" method="POST" action="{{ route('add_user') }}">
    @csrf
    <div class="row">
        <div class="col">
            first name:<input type="text" class="form-control" value='ahmed' name="first_name">
        </div>
    
        <div class="col">
            last_name:<input type="text" class="form-control" value='mohammed' name="last_name">
        </div>

        <div class="col">
            id:<input type="text" class="form-control" value='mohammed' name="id">
        </div>

        <div class="col">
            password:<input type="text" class="form-control" value='mohammed' name="password">
        </div>

        <div class="col">
            phone:<input type="text" class="form-control" value='01118629181' name="phone">
        </div>
        <div class="col">
            email:<input type="text" class="form-control" value='ibrahim@hotmail.com' name="email">
        </div>

        <div class="col">
            type:<input type="text" class="form-control" value='1 Admin ? 2 Student ? Advisor' name="type">
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
