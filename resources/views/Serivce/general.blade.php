 @include('Serivce._headerfooter._h') <body>

    <?php $user = auth()->user(); ?> 

    @include('popup')
    
      

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>

            <h1><a href="/" class="logo" style="text-align: center">Home</a></h1>

            <ul class="list-unstyled components mb-5">
                @if ($user->type == 'admin')  @include('Serivce.Types._admin_type')@endif
                @if ($user->type == 'advisor')@include('Serivce.Types._advisor_type')@endif
                @if ($user->type == 'student')@include('Serivce.Types._student_type')@endif
            </ul>
        </nav>
        <!----------------------------Page Content-------------------------------------->
        <div id="content" class="p-4 p-md-5 pt-5"> 
        @include('Serivce.help')<br><br>

        @auth
                @include('Serivce._me')
                @include('Serivce.Admin._deep_search')
                @include('Serivce.Admin._adduser')
                @include('Serivce.Admin._list_all_users')
        @endauth
        
        </div>
    </div>
     
 @include('Serivce._headerfooter._f')</body></html>
