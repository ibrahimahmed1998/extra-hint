<head>
    <link rel="stylesheet" href={{asset('css/in_style.css')}} type="text/css">
</head> 


<nav class="navbar navbar-expand-lg navbar-light fixed-top"><div class="container">

      <a  class="navbar-brand" style="color:black" href="#">       
          <a class="btn btn-primary" class="nav-link" href="#"><b>A  M  S</b> </a>
      </a>

      <p style="margin-left:30px"> <b>welcome UserName</b> </p>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">

          {{-- when logiin logn hidden and logout apper --}}
          <li  class="nav-item active" style="padding-right:2%">
            <a href="#popup0" class="btn btn-primary" class="nav-link" onclick="" href="#"><b>Login</b></a>
          </li>

          <li class="nav-item" style="padding-right:2%">
            <a class="btn btn-primary" class="nav-link" href="service/department"><b>Sections</b></a>
          </li>

          {{-- hiiden and apper when login --}}
          <li class="nav-item" style="padding-right:2%">
            <a class="btn btn-primary" class="nav-link" href="#"><b>My Services</b></a>
          </li>

          <li class="nav-item" style="padding-right:2%">
            <a class="btn btn-primary" class="nav-link" href="#"><b>Contact Us</b></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

    <ol class="carousel-indicators"><li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li><li data-target="#carouselExampleIndicators" data-slide-to="1"></li><li data-target="#carouselExampleIndicators" data-slide-to="2"></li></ol>

    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="{{asset('/ASU-Cairo.jpg')}}" alt="First slide">
        <div class="carousel-caption d-none d-md-block">
          <h5>Help To Improve Your Career</h5>
          <p> Choosing Wright Courses For You </p>
        </div>
      </div>

      <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('/ain2.jpg')}}" alt="Second slide">
        <div class="carousel-caption d-none d-md-block">
          <h5>Calculate Your KPIs</h5>
          <p>depend on your Goals and GPA suggest many road map for you</p>
        </div>
      </div>

      <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('/ain1.jpg')}}" alt="Third slide">
        <div class="carousel-caption d-none d-md-block">
          <h5>Help You To Know What your foundation offer</h5>
          <p> by know it's products and how it help you to make your carrer </p>
        </div>
      </div>
    </div>

    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a>
  </div>

  <div id="popup0" class="overlay">
        <div style=" margin:auto; right:70%;  position: absolute;">
            <form action="/api/auth/login" class="box" method="post">
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
</body></html>