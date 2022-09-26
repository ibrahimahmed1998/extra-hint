<!DOCTYPE html>@include('Home._headerfooter._h')  
@include('Home._nav')
@if(session('msg'))@include('alert')@endif
@include('Home.slider')
@include('Home.login')
<img style="width:200px" src="image/soon.jpg" alt="">
<img style="width:200px" src="image/soon.jpg" alt="">
<img style="width:200px" src="image/soon.jpg" alt="">
<img style="width:200px" src="image/soon.jpg" alt="">
<img style="width:200px" src="image/soon.jpg" alt="">
<img style="width:200px" src="image/soon.jpg" alt="">
<img style="width:200px" src="image/soon.jpg" alt="">
@include('Home._headerfooter._f')

{{-- {{ dd(auth()->user()->first_name)}} --}}{{-- {{ dd(auth()->user())}} --}}
{{-- {{auth()->guard()->user()->first_name}} --}}
{{-- {{auth("user")}} --}}
{{-- {{  Auth::guard('jwt')->user()    }} --}}
