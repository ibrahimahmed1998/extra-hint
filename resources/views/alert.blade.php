@if (session('msg'))
    <style>
        #pop_div {
            background-color: rgb(121, 207, 125);
            height: 45px;
            width: 100%;
            text-align: center;
            position: absolute;
            z-index: 10;
            display: block;
            font-weight: bold;

        }
        
        #pop_div b {
            position: relative;
            color: black;
            top: 25%;
        }
    </style>
    <div id="pop_div"><b> {{ session('msg') }} </b></div>
    <script>
        setTimeout(function() {
            var x = document.querySelector('#pop_div').style.display = "none";
        }, 1500);
    </script>
@endif
