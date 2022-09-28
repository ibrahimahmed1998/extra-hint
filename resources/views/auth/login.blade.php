<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <script src="popper.min.js"></script>
    <script src="jquery-3.6.1.min.js"></script>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="bjs/bootstrap.min.js" defer></script>
    <link rel="stylesheet" href="bcss/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">

    <script src="reg_form/js/global.js" defer></script>
    <link href="reg_form/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="reg_form/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="reg_form/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="reg_form/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="reg_form/css/main.css" media="all">
</head>

<body >
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins" style="background-color:black!important;" >
        <div class="wrapper wrapper--w680" >
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Login</h2>

                    <form style="margin: 10%" action="/login" method="POST">
                        @csrf

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form2Example1">Email address</label>
                            <input type="email" name="email" id="form2Example1" class="form-control" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form2Example2">Password</label>
                            <input type="password" name="password" id="form2Example2" class="form-control" />
                        </div>

                        <br><button type="submit" class="btn btn-primary btn-block mb-4">Login in</button>

                        <div class="row mb-4">

                            <a style="margin-right: 202px" href="#!">Forgot password?</a>

                            <p>Not a member? <a href="/register1">Register</a></p> <br><br>
                           <a href="/"> <b>Back To Home Page</b></a>

                    </form>
                    <br><br>
                    @include('error')
                </div>
            </div>
        </div>
    </div>
    <script src="reg_form/vendor/jquery/jquery.min.js"></script>
    <script src="reg_form/vendor/select2/select2.min.js"></script>
    <script src="reg_form/vendor/datepicker/moment.min.js"></script>
    <script src="reg_form/vendor/datepicker/daterangepicker.js"></script>
    <script src="reg_form/js/global.js"></script>
</body>

</html>
