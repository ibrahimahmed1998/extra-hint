<nav id="nav98" class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">

        <a class="navbar-brand" style="color:black" href="#"><a class="" class="nav-link" href="/">
                <img style="border-radius:10%" width="100px" src="{{ asset('image/ams-min.jpg') }}"></a></a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">

@guest
<li class="nav-item"><a id="loginbtn" href="#popup0" class="btn btn-dark" class="nav-link"href="#">Login</a></li>
@endguest

<li class="nav-item"><a class="btn btn-dark" class="nav-link" href="service/department">Departments</a></li>

@auth
<li class="nav-item"><a id="user_serivce" class="btn btn-dark" class="nav-link" href="myserivce">My Services</a></li>
@endauth

<li  class="nav-item"><a target="_blank" class="btn btn-dark" class="nav-link" href="/soon" >AMS Blog</a></li>
<li  class="nav-item"><a target="_blank" class="btn btn-dark" class="nav-link" href="/soon" >GPA +-</a></li>

@auth
<li class="nav-item"><a href="logout" type="submit" name="logout" id="logout" class="btn btn-dark"class="nav-link">Logout</a></li>
@endauth
            </ul>
        </div>
    </div>
</nav>

{{-- <script>  OLLLLLLLLLLLLLLLLLD CODE 
                            data = localStorage.getItem('user_data');
                            data = JSON.parse(data);
                            var test = data[0]
                            token = test['token']     // console.log(token);
 
                            $('#logout').on('click', function() {

                                console.log("test: "+token);
                                        $.ajax({
                                                url: "logout",
                                                type: 'get',
                                                contentType:'application/json',
                                                headers: {"Authorization": "Bearer "+token},
                                                async: false,
                                                success: function(data){

                                                    var arr = [] ;
                                                    localStorage.setItem("user_data",  JSON.stringify(arr));

                                                // create an object with the key of the array
                                                   window.location.href="/"
                                            }
                                        });
                                    })
                        </script> --}}
