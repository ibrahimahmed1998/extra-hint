<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
 
    <!-- Title Page-->
    <title>Au Register Forms by Colorlib</title>

   
    <!-- Icons font CSS-->
    <link href={{asset("vendor/mdi-font/css/material-design-iconic-font.min.css")}} rel="stylesheet" media="all">
    <link href={{asset("vendor/font-awesome-4.7/css/font-awesome.min.css")}} rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href={{("vendor/select2/select2.min.css")}}rel="stylesheet" media="all">
    <link href={{("vendor/datepicker/daterangepicker.css")}} rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href={{("regcss/main.css")}} rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Registration Form</h2>

                    <form method="POST" action="api/auth/add_user">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">first name</label>
                                    <input class="input--style-4" type="text" name="first_name">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">last name</label>
                                    <input class="input--style-4" type="text" name="last_name">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                      
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                     <div class="p-t-10">
                                         
                                     </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input class="input--style-4" type="email" name="email">
                                </div>
                                <div class="input-group">
                                    <label class="label">password</label>
                                    <input class="input--style-4" type="password" name="password">
                                </div>
                                <div class="input-group">
                                    <label class="label">National ID</label>
                                    <input class="input--style-4" type="text" name="id">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Phone Number</label>
                                    <input class="input--style-4" type="text" name="phone" >
                                </div>
                            </div>
                            
                        </div>
                        <div class="input-group">
                            <label class="label">Type is</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="type">
                                    <option disabled="disabled" selected="selected">Advisor</option>
                                    <option value="1" >Student</option>
                                    <option value="2">Advisor</option>
                                    <option value="3" >Adminstrator</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="submit">Add</button>
                        </div>
                    </form>
                    <br>
                    <button class="btn btn--radius-2 btn--blue" onclick="window.location.href='/'" >back</button>

                </div>
            </div>
        </div>
    </div>
    <script src={{("vendor/jquery/jquery.min.js")}}></script>
    <script src={{("vendor/select2/select2.min.js")}}></script>
    <script src={{("vendor/datepicker/moment.min.js")}}></script>
    <script src={{("vendor/datepicker/daterangepicker.js")}}></script>

 
    <script src={{("js/global.js")}}></script>
</body> 
</html>
