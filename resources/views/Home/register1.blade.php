@include('Home._header') 


<form style="margin: 3%" method="POST" action="{{ route('add_user') }}"  >
    @csrf

    
    <div class="row">
        <div class="col">
            full nmae:<input required class="form-control" placeholder='ahmed' name="full_name">
        </div>

        <div class="col">
            password:<input required type="password" class="form-control" placeholder='12345678' name="password">
        </div>

        <div class="col">
            phone:<input required type="number" class="form-control" placeholder='01118629181' name="phone">
        </div>

        <div class="col">
            email:<input required type="email" class="form-control" placeholder='ibrahim@hotmail.com' name="email">
        </div>

        <div class="col">
            <input hidden required class="form-control" value='student' name="type">
        </div>

    </div>
    <br><br>
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
    <button type="submit" class="btn btn-primary col-2">Add User</button>
</form>

 