@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color: red;font-weight: bold">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif