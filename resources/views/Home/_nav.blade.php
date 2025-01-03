@guest     
    <style>#left_margin{margin-left:5%; }</style>
    <div id="announcement">
        Welcome to AMS! Claim your personal discount now. Explore programs and use within 30 days.
        <i onclick="hide_announcement()" class="fa-solid fa-xmark pl-3"></i>
    </div>
@endguest

<nav  class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/"> <img style="border-radius:10%" width="100px" height="30px"
            src="image/ams-min.jpg"></a></a></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

 <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
     @auth
      <li class="nav-item"><a class="nav-link" href="myserivce">My Services</a></li>
     @endauth
    {{-- <li class="nav-item"><a class="nav-link" href="#whyams">Why AMS ?</a></li> --}}
    <li id="left_margin" class="nav-item"><a class="nav-link" href="service/department">Explore Departments</a></li>
    <li class="nav-item"><a class="nav-link" href="soon">Blog</a></li>
    <li class="nav-item"><a class="nav-link" href="#whyams">Career</a></li>

    @guest
     <li class="nav-item active">
      <a class="nav-link" href="login">Login<span class="sr-only">(current)</span></a>
     </li>
    @endguest
    @auth
     <li class="nav-item" ><a id="logout" class="nav-link" href="logout">Logout</a></li>
    @endauth 
</ul></div></nav>