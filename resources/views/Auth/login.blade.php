@include('Home.layout')

<div style=" margin:auto; right:70%;  position: absolute;">
    <form  action="/api/auth/login" class="box" method="post">
        <h1>Login</h1>
        <p class="text-muted"> Please enter your login and password!</p>
        <input type="text" name="email" placeholder="email" required>
        <input type="password" name="password" placeholder="Password" required>
         <a class="forgot text-muted" href="#">Forgot password?</a>
         <input type="submit" name="" value="Login" href="#">
    </form>
</div>
