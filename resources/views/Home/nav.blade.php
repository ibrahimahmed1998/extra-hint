<head>
    <link rel="stylesheet" href="{{ asset('css/home.nav.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>

<nav id="nav98" class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">

        <a class="navbar-brand" style="color:black" href="#">
            <a class="" class="nav-link" href="/">
                <img width="100px" src="{{ asset('image/ams-min.jpg') }}">
            </a>
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a id="loginbtn" href="#popup0" class="btn btn-dark" class="nav-link" href="#">Login</a>
                </li>

                <li class="nav-item">
                    <a class="btn btn-dark" class="nav-link" href="service/department">Sections</a>
                </li>

                {{-- hiiden and apper when login --}}
                <li class="nav-item">
                    <a id="user_serivce"  class="btn btn-dark" class="nav-link" href="myserivce">My Services</a>
                </li>

                <li class="nav-item">
                    <a class="btn btn-dark" class="nav-link" href="https://github.com/ibrahimahmed1998">Contact Us</a>
                </li>

                <li class="nav-item">

        
                        <button type="submit" name="logout" id="logout" class="btn btn-dark"
                            class="nav-link">Logout
                        </button>

                        <script>
                            data = localStorage.getItem('user_data');
                            data = JSON.parse(data);
                            var test = data[0]
                            token = test['token']
                            // console.log(token);
 
                            $('#logout').on('click', function() {

                                console.log("test: "+token);
                                        $.ajax({
                                                url: "/api/auth/logout",
                                                type: 'POST',
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

                        </script>
                </li>
            </ul>
        </div>
    </div>
</nav>
