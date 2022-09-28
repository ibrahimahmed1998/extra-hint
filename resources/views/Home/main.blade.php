<!DOCTYPE html>@include('Home._headerfooter._h')  

@guest
    

<div id="announcement" style="
background-color:#FFDF01;
margin:1%;
color: ; 
text-align: center; 
font-weight: bold;
margin: 0;
padding: 0.5%
"
>
    Welcome to AMS! Claim your personal discount now. Explore programs and use within 30 days. 
    <i onclick="hide_announcement()" class="fa-solid fa-xmark pl-3"></i>
</div>

<script>
    function hide_announcement(){

        announcement = document.querySelector('#announcement');
        announcement.style.display = 'none';
    }
</script>
@endguest

@include('Home._nav')
@include('popup')
@if(session('msg'))@include('alert')@endif
@include('Home.slider')
@include('Home.login')

{{-- <div style=" background-color: white;"  >
    <img style="width:200px" src="image/soon.jpg" alt="">
    <img style="width:200px" src="image/soon.jpg" alt="">
    <img style="width:200px" src="image/soon.jpg" alt="">
    <img style="width:200px" src="image/soon.jpg" alt="">
    <img style="width:200px" src="image/soon.jpg" alt="">
    <img style="width:200px" src="image/soon.jpg" alt="">
    <img id="whyams" style="width:200px" src="image/soon.jpg" alt="">
</div> --}}



<div style="width:100%;height:500px; background-color: white; 
/* background: -webkit-linear-gradient(to right, #0575E6, #00F260);   */
/* background: linear-gradient(to right, #0575E6, #00F260);  */
">
<br>

    <b style="float: left; margin:6% 0% 0% 25%;   font-size:40px; background-position-x:50px ">
        Transforming lives, businesses, and nations.
    </b>
     
    <a href="/register1"  style="width:350px;height: 60px; text-align: center; font-weight: bold; font-size: 30px; float:left; margin:5% 0% 0% 40%;"  class="btn btn-warning"> Get in touch</a>
     
</div>

 
@include('Home._headerfooter._f')