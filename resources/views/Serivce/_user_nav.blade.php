<nav class="navbar navbar-dark bg-dark" style="width:151.4vh">
    <a style="margin-left:15px" class="navbar-brand" href="/">Home</a>
        <li class="navbar-nav nav-item active col-3"> <a class="nav-link" href="/myserivce">Back To Serivce Page</a></li>
        @if (auth()->user()->type==3)  
        <li class="navbar-nav nav-item col-1" >  <a style="color:yellow" class="nav-link" href="#">Update Data</a> </li>
        <li class="navbar-nav nav-item col-1"><a style="color:red" class="nav-link disabled" href="#">Delete User</a> </li>
        @endif
</nav>
