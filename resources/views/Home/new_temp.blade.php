<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">AMS_ASU </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li  class="nav-item active" style="padding-right:2%">
            <a class="btn-dingours" class="nav-link" onclick="" href="#"><h3>Login</h3></a>
          </li>
          <li class="nav-item" style="padding-right:2%">
            <a class="btn-dingours" class="nav-link" href="#"><h3>About</h3></a>
          </li>
          <li class="nav-item" style="padding-right:2%">
            <a class="btn-dingours" class="nav-link" href="#"><h3>Portfolio</h3></a>
          </li>

          <li class="nav-item" style="padding-right:2%">
            <a class="btn-dingours" class="nav-link" href="service/department"><h3>Sections</h3></a>
          </li>

          <li class="nav-item" style="padding-right:2%">
            <a class="btn-dingours" class="nav-link" href="#"><h3>Services</h3></a>
          </li>
          <li class="nav-item" style="padding-right:2%">
            <a class="btn-dingours" class="nav-link" href="#"><h3>Contact</h3></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="{{asset('/ASU-Cairo.jpg')}}" alt="First slide">
        <div class="carousel-caption d-none d-md-block">
          <h5>Slider One Item</h5>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime, nulla, tempore. Deserunt excepturi quas vero.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('/ain2.jpg')}}" alt="Second slide">
        <div class="carousel-caption d-none d-md-block">
          <h5>Slider One Item</h5>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime, nulla, tempore. Deserunt excepturi quas vero.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('/ain1.jpg')}}" alt="Third slide">
        <div class="carousel-caption d-none d-md-block">
          <h5>Slider One Item</h5>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime, nulla, tempore. Deserunt excepturi quas vero.</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

</body>
</html>
