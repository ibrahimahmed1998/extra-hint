<div id="popup0" class="overlay">
    <div style=" margin:auto; right:70%;  position: absolute;">
        <form action="/api/auth/login" class="box" method="POST">
            <a class="close" href="#">&times;</a>
            <h1>Login</h1>
            <p class="text-muted"> Please enter your login and password!</p>
            <input type="text" name="email" placeholder="email" required>
            <input type="password" name="password" placeholder="Password" required>
            <a class="forgot text-muted" href="#">Forgot password?</a>
            <input type="submit" name="" value="Login" href="#">
        </form>
    </div>
</div>
 
 

@if (isset($data))
<div id="welcome_login" class="alert alert-success">Welcome {{ $data['first_name'] }}</div>
<script> var arr = [] ; </script>
@foreach ($data as $ind=>$item)<script>
    var object ={'{{$ind}}':'{{$item}}' }   //console.log(object);
    arr.push(object)     //console.log(arr)
</script>@endforeach

<script>
     localStorage.setItem("user_data",  JSON.stringify(arr));
     const welcome_login = document.querySelector('#welcome_login');
     setTimeout(() => {
        welcome_login.style.display = "none";}, 4000);
    window.location.href="/"

</script>
@endif

@if (isset($err))
<div id="btn4500" class="alert alert-danger">{{ $err }}</div>
<script> 
    var arr = [] ;
    localStorage.setItem("user_data",  JSON.stringify(arr));
</script>

<script >
    const div = document.querySelector('#btn4500');
    if (div) { setTimeout(() => {div.style.display = "none";}, 3000); }
    window.location.href="/#popup0"

</script>
@endif

