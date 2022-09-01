 @include('Serivce._header')
<body>
  {{-- @csrf --}}
    <?php $user = auth()->user();
    if ($user->type == 1 || $user->type == 3) { $type = 'admin';} else { $type = 'Student'; } ?>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <h1><a href="/" class="logo">Home</a></h1>

            <ul class="list-unstyled components mb-5">

                @if ($type == 'admin')
                    <li class="active">
                        <a href="#" onclick="profile()"> <span class="fa fa-home mr-3"></span>Show User Data</a>
                    </li>

                    <li>
                        <a href="#"><span class="fa fa-user mr-3"></span> Add User</a>
                    </li>

                    <li>
                        <a href="#"><span class="fa fa-user mr-3"></span> Search about</a>
                    </li>
                    <li>
                        <a href="#"><span class="fa fa-sticky-note mr-3"></span> Update User Data</a>
                    </li>
                    <li>
                        <a href="#"><span class="fa fa-sticky-note mr-3"></span>Edit Student Degree</a>
                    </li>
                    <li>
                        <a id="delete" href="#"><span class="fa fa-paper-plane mr-3"></span> Delete User
                            Data</a>
                    </li>
                    {{-- <li>
                        <a href="#"><span class="fa fa-paper-plane mr-3"></span> Information</a>
                    </li> --}}
                @endif
                @if ($type == 'Student')

                <li class="active">
                    <a href="#" onclick="profile()"> <span class="fa fa-home mr-3"></span>Show User Data</a>
                </li>
                <li >
                    <a href="#"><span class="fa fa-home mr-3"></span>Enroll Course</a>
                </li>
                <li>
                    <a href="#"><span class="fa fa-user mr-3"></span> Cancel Course</a>
                </li>
                <li>
                    <a href="#"><span class="fa fa-sticky-note mr-3"></span> Success Statement</a>
                </li>
                <li>
                    <a href="#"><span class="fa fa-sticky-note mr-3"></span> My courses </a>
                </li>
                <li>
                    <a href="#"><span class="fa fa-paper-plane mr-3"></span> intell Advise</a>
                </li>
                <li>
                    <a href="#"><span class="fa fa-paper-plane mr-3"></span> Add Attend ??? </a>
                </li>
                @endif
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <h2 class="mb-4">How I Can Help You ? </h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                deserunt mollit anim id est laborum.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                deserunt mollit anim id est laborum.</p>

                @auth 

                 @include('Serivce._showuser')
                 @include('Serivce._adduser')
              
                  
                   
                @endauth
               
               

        </div>
    </div>
@include('Serivce._footer')</body></html>
