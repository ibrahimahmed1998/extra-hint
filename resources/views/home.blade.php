<!DOCTYPE html>
<html> <head id="head"> <title>Blog System</title>
<link rel="stylesheet" href={{ asset('css/main.css') }}>
<link rel="stylesheet" href={{ asset('css/login.css') }}>
<script src={{'js/login.js' }}></script>
<script src={{'js/logout.js' }}></script>
<link rel="stylesheet" href={{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css') }}>
<script src={{'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js' }}></script>
<link rel="stylesheet" href={{ asset('fonts/icomoon/style.css') }}>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head><body>
    @include('navhome')
<div class="collapse" id="collapseExample"> <div class="card"><div class="card-body">
    <div class="input-group form-group">
        <div class="input-group-prepend"> <span class="input-group-text"><i class="fas fa-user"></i></span></div>
        <input type="email" class="form-control" placeholder="enter e-mail here" name="email">
    </div>

    <div class="input-group form-group">
        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-key"></i></span></div>
        <input type="password" class="form-control" placeholder="enter password here" name="pass">
    </div>

    <div class="form-group">
        <input id="login" type="submit" value="Login" class="btn float-right login_btn">
    </div>

    <div class="card-footer" >
        <div class="d-flex justify-content-center links">Haven't account!<a href="/signup">Sign Up Now</a></div>
        <div class="d-flex justify-content-center"><a href="#">Forgot your Password?</a> </div>
    </div>
</div></div></div>

<script type="text/javascript">

    var token=localStorage.getItem("token");  var type=localStorage.getItem("type");
    var name=localStorage.getItem("name");

    console.log(token);     console.log(type);  console.log(name);
    if(type==1){disply="admin"}else {disply="visitor"}
    $("#Name").html(`<a>Name: ${name}</a>`);
    $("#Type").html(`<a>Type: ${disply}</a>`);

    if(token == null){     $("#logout").hide();             $("#Name").hide();  $("#Type").hide();
}
    else if(token != null){ $("#create").hide()   }

    $('#mypanel').click(function(event){ event.preventDefault();
        if(type==1){ window.location.href = '/admin'; }
        if(type==2){ window.location.href = '/visitor'; }  })

    $('#login').click(function(event){



        event.preventDefault();
        let email1 = $("input[name=email]").val();
        let pass = $("input[name=pass]").val();
        if (email1 == "" || pass=="" ) {  alert("email1 and Password must be filled out");   return false; }
        else if (pass.length < 8) { alert("password less than 8 ! Not Allowed"); }

        else{   login(email1,pass);  }   })

    $('#logout').click(function(event) {  event.preventDefault();    logout(token) })
</script></body></html>
