<!DOCTYPE html><head id="head"><title>AMS</title>@include('Home.layout')</head>

<body>
 
    @include('Home.nav')
    @include('Home.slider')
    @include('Home.login')

    {{-- {{ dd(auth()->user()->first_name)}} --}}
    {{-- {{ dd(auth()->user())}} --}}

 </body></html>
