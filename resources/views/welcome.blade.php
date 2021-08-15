<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>AMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{------------------ External ------------------}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    {{------------------ External ------------------}}


    <script type="text/javascript">

        function myFunction()
        {
            var x = document.getElementById("login98");
            var y = document.getElementById("login98h");


            if (x.style.display === "none")
            {
                x.style.display = "block"; /// appper
            } else
            {
                x.style.display = "none";
            }


            if (y.style.display === "none")
            {
                y.style.display = "block"; /// appper
            } else
            {
                y.style.display = "none";
            }

        }

    </script>
</head>

<body>


    <header class="site-navbar" role="banner">
        <div class="container">
            <div class="row align-items-center">

                <!-- AMS TEXT -->
                <h1><b><span style=color:red>a</span><span style=color:white>m</span><span
                            style=color:yellow>s</span></b></a></h1>

                <div class="col-12 col-md-10 d-none d-xl-block">
                    <nav class="site-navigation position-relative text-right" role="navigation">

                        <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                            <li class="active"><a href="/"><span>Home</span></a></li>
                            <li class="has-children">
                                <a href="about.html"><span>Dropdown</span></a>
                                <ul class="dropdown arrow-top">
                                    <li><a href="#">Menu One</a></li>
                                    <li><a href="#">Menu Two</a></li>
                                    <li><a href="#">Menu Three</a></li>
                                </ul>
                            </li>
                            <li class="has-children">
                                <a href="about.html"><span>Discover Faculty</span></a>
                                <ul class="dropdown arrow-top">
                                    <li><a href="#">Departments</a></li>
                                    <li><a href="#">Section of department x </a></li>
                                    <li><a href="#">courses of section x </a></li>
                                    <li class="has-children">
                                    </li>
                                </ul>
                            </li>

                            <li><a href="http://127.0.0.1:8000/api/auth/test"><span>Listings</span></a></li>
                            <li><a href="http://127.0.0.1:8000/api/service/messages"><span>Chat</span></a></li>
                            <li><a  id="login98h" onclick="myFunction();"   ><span>Login</span></a></li>
                            <li><a href="/s" id="signup"    ><span>signup</span></a></li>
                        </ul>

                    </nav>
                </div>
                <!--++++login start +++++++++++++++++++++++++++++++++++++++++++++++++-->
                <div id="login98" style="display:none">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="api/auth/login" >
                                <br><br>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="email" name="email">

                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control" placeholder="password" name="password">
                                </div>
                                <div class="row align-items-center remember">
                                    <input type="checkbox">Remember Me
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Login" class="btn float-right login_btn">
                                </div>
                            </form>
                            <br><br> <br><br>
                            <div class="card-footer">
                                <div class="d-flex justify-content-center links">
                                    Don't have an account?<a href="#">Sign Up</a>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <a href="#">Forgot your password?</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!--++++login end +++++++++++++++++++++++++++++++++++++++++++++++++-->

                <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a
                        href="#" class="site-menu-toggle js-menu-toggle text-white"><span
                            class="icon-menu h3"></span></a></div>

            </div>
        </div>
        </div>

    </header>

    <div class="hero" style="background-image: url('images/home.jpg');"></div>

</body>

</html>
