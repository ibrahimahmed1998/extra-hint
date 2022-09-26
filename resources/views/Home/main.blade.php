<!DOCTYPE html>@include('Home._header') <body>

    @isset($msg)
       <script>
          alert("Welcome on board,Member Joined Successfully");
       </script>
    @endisset 
 
    @include('Home._nav')
    @include('Home.slider')
    @include('Home.login')
    <img style="width:200px" src="image/soon.jpg" alt="">  
    <img style="width:200px" src="image/soon.jpg" alt="">  
    <img style="width:200px" src="image/soon.jpg" alt="">  
    <img style="width:200px" src="image/soon.jpg" alt="">  
    <img style="width:200px" src="image/soon.jpg" alt="">  
    <img style="width:200px" src="image/soon.jpg" alt="">  
    <img style="width:200px" src="image/soon.jpg" alt="">  

    @include('Home._footer')

 </body></html>
     {{-- {{ dd(auth()->user()->first_name)}} --}}{{-- {{ dd(auth()->user())}} --}}
    {{-- {{auth()->guard()->user()->first_name}} --}}
   {{-- {{auth("user")}} --}}
   {{-- {{  Auth::guard('jwt')->user()    }} --}}
