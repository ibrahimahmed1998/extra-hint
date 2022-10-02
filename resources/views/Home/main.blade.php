<!DOCTYPE html> 
@include('Home._headerfooter._h')
@include('alert') 

@include('popup')
@include('Home._nav')

<div class="container ">
    <h1>We invite you to <br><span class="auto-type"></span></h1>
</div>

@include('Home.section')
@include('Home.slider')

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
 
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<script> var typed = new Typed(".auto-type",{ strings:["Grow Fast 🧠💪","be on Top 🥇💯","Join Us 👌🤝"],typeSpeed:150,backSpeed:75,loop:true}) </script>
<script src="aos/aos.js"></script>
<script> AOS.init(); </script>
@include('Home._headerfooter._f')