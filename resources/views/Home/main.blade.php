<!DOCTYPE html>@include('Home._header')
<body>
    @include('Home._nav')
    @include('Home.slider')
    @include('Home.login')
    {{-- {{ dd(auth()->user()->first_name)}} --}}{{-- {{ dd(auth()->user())}} --}}

    {{-- {{auth()->guard()->user()->first_name}} --}}

   {{-- {{auth("user")}} --}}

   {{-- {{  Auth::guard('jwt')->user()    }} --}}
 

 </body></html>