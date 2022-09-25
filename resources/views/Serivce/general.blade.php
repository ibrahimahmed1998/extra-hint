 @include('Serivce._header') <body>

     <?php $user = auth()->user();
     switch ($user->type) {
         case '1':$type = 'student';break;
         case '2':$type = 'advisor';break;
         case '3':$type = 'admin';break; } ?>

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
                 @if ($type == 'admin')@include('Serivce.Types._admin_type')@endif
                 @if ($type == 'advisor')@include('Serivce.Types._advisor_type')@endif
                 @if ($type == 'Student')@include('Serivce.Types._student_type')@endif
             </ul>
         </nav>
         <!----------------------------Page Content-------------------------------------->
         
         <div id="content" class="p-4 p-md-5 pt-5">
            
            @include('Serivce.help')

            <br> <br>
             @auth
                 @include('Serivce._deep_search')
                 @include('Serivce._showuser')
                 @include('Serivce._adduser')
                 @include('Serivce._list_all_users')

             @endauth
         </div>
     </div>
     @include('Serivce._footer')
 </body>

 </html>
