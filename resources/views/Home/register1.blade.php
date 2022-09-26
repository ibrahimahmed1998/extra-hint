<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>
    <script src="reg_form/js/global.js"></script>
    <link href="reg_form/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="reg_form/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="reg_form/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="reg_form/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="reg_form/css/main.css" media="all">
 </head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Student Registration Form <sub style="font-size: 50%">Free-Trail</sub> </h2>
                  
                    <form method="POST" action="{{ route('add_user')}}">
                        @csrf
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Full Name</label>
                                    <input required class="input--style-4" type="text" placeholder="Ahmed Mohamed" name="full_name">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">email</label>
                                    <input required class="input--style-4" type="email" placeholder="test@gmail.com" name="email">
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Phone</label>
                                    <div class="input-group-icon">
                                        <input required class="input--style-4" placeholder="0123456789" type="number" name="phone">
                                     </div>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Password</label>
                                    <div class="input-group-icon">
                                        <input required class="input--style-4" type="password" name="password">
                                     </div>
                                </div>
                             </div>
                        </div>
                 
                        <input required readonly class="input--style-4" type="text" name="type" value='student'>
                      
                
                        <div class="p-t-15">
                            <button style="width:102%;" class="btn btn--radius-2 btn--blue" type="submit">Submit</button>
                        </div>
                        <div class="p-t-10">
                            <a  style="width:102%;text-align:center;text-decoration:none" href="/" class="btn btn--radius-2 btn--blue" type="submit">Back to Home Page</a>
                        </div>
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
</body></html>

 