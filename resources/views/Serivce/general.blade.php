
@include('Home.layout')
<title>AMS -> Service</title>
<script>
    var x = 1 ; 
    function profile()
     {
        const item = document.querySelector('#profile');
        if(x>0){ item.style.display="inline-block"; }
        else{ item.style.display="none"; }
        x= x*-1; 
     }
</script>

<?php 
    $user = auth()->user();
    if( $user->type == 1 ){ $type = "admin"; }
    else { $type = "Student";  }
?>

<a href="/"style="margin: 5%" class="btn btn-primary" >Back</a>
@if( $type=="admin" )
    <button style="margin: 5%" class="btn btn-primary" onclick="profile()">Add new User</button>
    <button style="margin: 5%" class="btn btn-primary" onclick="profile()">Search about <b>user</b></button>
    <button style="margin: 5%" class="btn btn-primary" onclick="profile()">Update User Data</button>
    
    {
        <button style="margin: 5%" class="btn btn-primary" onclick="profile()"> Enter Student Degree ??? </button>

    }

    <button style="margin: 5%" class="btn btn-primary" onclick="profile()">Delete User Data</button>

@endif
@if ($type=="student")
<button style="margin: 5%" class="btn btn-primary" onclick="profile()">Enroll Course</button>
<button style="margin: 5%" class="btn btn-primary" onclick="profile()">Cancel Course</button>
<button style="margin: 5%" class="btn btn-primary" onclick="profile()">Success Statement</button>
<button style="margin: 5%" class="btn btn-primary" onclick="profile()">My courses</button>

<button style="margin: 5%" class="btn btn-primary" onclick="profile()">intell Advise</button>

<button style="margin: 5%" class="btn btn-primary" onclick="profile()">Add Attend ??? </button>


@endif
<button style="margin: 5%" class="btn btn-primary" onclick="profile()">Show User Data</button>
<br>
 <h1 style="display:none" id="profile">
    first_name: {{$user->first_name}} <br>
    last_name: {{$user->last_name}}<br>
    phone: {{$user->phone}}<br>
    email: {{$user->email}}<br>
    type: {{  $type }}
</h1>