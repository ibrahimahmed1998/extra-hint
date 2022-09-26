<head>
    <style>
            #phone{ margin-left: -98px;}
            #email{ margin-left: -37px;}
            #join_date{ margin-left: -37px;}
            #type_val{ width: 350px}
    </style>
</head>

<nav class="navbar navbar-dark bg-dark" style="width:151.4vh">
    <a style="margin-left:15px" class="navbar-brand" href="/">Home</a>
        <li class="navbar-nav nav-item active col-3"> <a class="nav-link" href="/myserivce">Back To Serivce Page</a></li>
        @if (auth()->user()->type=='admin')  
        <li class="navbar-nav nav-item col-1" ><a onclick="update_on()" style="color:rgb(234, 209, 68)" class="nav-link" href="#!">Update Data</a> </li>
        <li class="navbar-nav nav-item col-1"> <a style="color:red" class="nav-link" href="/delete_user/{{$user->id}}">Delete User</a> </li>
        @endif
</nav>

<script> function update_on(){
        inputs =  document.querySelectorAll("input"); 
        adv_name =  document.querySelectorAll("input[name=adv_name]"); 
        console.log(adv_name);
        adv_name= 
        inputs.forEach( element =>  element.disabled = false   );
        update_btn = document.querySelector('#update-btn');
        update_btn.style.display="block"
     }
</script>