<nav  class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#!"> <img style="border-radius:10%" width="100px" height="30px"
            src="image/ams-min.jpg"></a></a></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            @guest
                <li class="nav-item active">
                    <a class="nav-link" href="#popup0">Login<span class="sr-only" href="#">(current)</span></a>
                </li>
            @endguest

            @auth
                <li class="nav-item">
                    <a class="nav-link" href="myserivce">My Services</a>
                </li>
            @endauth

            <li class="nav-item">
                <a class="nav-link" href="service/department">Department</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="soon">Blog</a>
            </li>

            @auth

            <li class="nav-item" >
                <a id="logout" class="nav-link" href="logout">Logout</a>
            </li>

                {{-- <li class="nav-item"><a href="logout" type="submit" name="logout" id="logout"
                        class="btn btn-dark"class="nav-link">Logout</a></li> --}}
            @endauth

            {{-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li> --}}


        </ul>
        {{-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> --}}
    </div>
</nav>