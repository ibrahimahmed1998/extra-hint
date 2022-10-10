@include('Home._headerfooter._h')
@include('alert') 
@include('popup')
@include('Home._nav') 
{{-- make user profile icon [ pic + name + setting ] --}}

@auth
    @include('Home.auth.main')
@endauth

@guest
    @include('Home.guest.section')
    @include('Home.guest.slider')
    {{-- what people say || our parnter  --}}
    @include('Home.guest.section3')
    {{-- Plans || lifetime plans 100%  --}}
@endguest

@include('Home._footer')
@include('Home._headerfooter._f')

 {{--
<div
    style="width:100%;height:200px; background-color: white; 
/* background: -webkit-linear-gradient(to right, #0575E6, #00F260);   */
/* background: linear-gradient(to right, #0575E6, #00F260);  */
">
    <br>

    <div data-aos="fade-in">
    <b style="float:left; width:700px; margin:4% 0% 0% 7%; font-size:40px; clear:both">
        Is an automated academic advising system it was programmed to be used in E-learning platforms, universities,
    and schools, for helping all students, advisors, and administrators work meticulously and not be preoccupied
    with the management process
    </b>
<br>
 
    <x-embed url="https://www.youtube.com/watch?v=snG4LP7io3c"/>
</div> --}}
 