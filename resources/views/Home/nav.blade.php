<head>
    <link rel="stylesheet" href="{{ asset('css/home.nav.css') }}">
</head>

<nav id="nav98" class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">

        <a class="navbar-brand" style="color:black" href="#">
            <a class="" class="nav-link" href="/">
                <img width="100px" src="{{ asset('image/ams-min.jpg') }}">
            </a>
        </a>

        {{-- <p style="margin-left:30px"> welcome UserName </p> --}}
        {{-- i will make it in my serivfce btn it will be dashboard have all user data  --}}
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">

                {{-- when logiin logn hidden and logout apper --}}
                <li class="nav-item">
                    <a id="loginbtn" href="#popup0" class="btn btn-dark" class="nav-link" href="#">Login</a>
                </li>

                <li class="nav-item">
                    <a class="btn btn-dark" class="nav-link" href="service/department">Sections</a>
                </li>

                {{-- hiiden and apper when login --}}
                <li class="nav-item">
                    <a class="btn btn-dark" class="nav-link" href="myserivce">My Services</a>
                </li>

                <li class="nav-item">
                    <a class="btn btn-dark" class="nav-link" href="https://github.com/ibrahimahmed1998">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
