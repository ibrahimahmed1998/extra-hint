<!DOCTYPE html>
<head id="head"> <title>AMS</title>  
    <link rel="icon" href="image/Sign-check-icon.png" type="image/icon type">
     @include('Home.layout')   
</head>
<body>
    
    {{-- <script>
        stored_data = localStorage.getItem("user_data")
         if(stored_data)
        { 
             console.log(stored_data)
        }
    </script> --}}
   
    @include('Home.nav')
    @include('Home.slider')
    @include('Home.login')
 
</body></html>
