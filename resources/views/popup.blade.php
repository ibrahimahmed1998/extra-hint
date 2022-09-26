@isset($msg)
    <style>
        #pop_div {
            background-color: rgb(121, 207, 125);
            height: 45px;
            width: 100%;
            text-align: center;
            position: absolute;
            z-index: 10;
            display: block;
        }

        #pop_div b {
            position: relative;
            color: black;
            top: 25%;
        }
    </style>

    <div id="pop_div"> <b>{{ $msg }}</b> </div>

    

    <script>
        setTimeout(
            function() {
                document.querySelector('#pop_div').style.display="none"; },1500);
    </script>

@endisset
