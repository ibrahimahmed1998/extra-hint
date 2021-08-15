<!DOCTYPE html><html><head><title>Register Forms</title>
    <link href={{ 'regcss/main.css' }} rel="stylesheet" >
    <script src={{'vendor/jquery/jquery.min.js'}}></script>
    <script src={{'js/signup.js'}}></script>
</head><body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4"> <div class="card-body">
                <h2 class="title"><b>Registration Form</b></h2>
                         <div class="row row-space" style="margin-bottom:20px">
                            <div class="col-2">
                                    <label class="label">first name</label>
                                    <input class="input--style-4" type="text" name="fname">
                            </div>
                            <div class="col-2">
                                    <label class="label">last name</label>
                                    <input class="input--style-4" type="text" name="lname" >
                            </div>
                        </div>
                        <div class="row row-space"  style="margin-bottom:20px" >
                            <div class="col-2" >
                                    <label class="label" >Email</label>
                                    <input class="input--style-4" type="email" name="email" >
                                    <label class="label">password</label>
                                    <input class="input--style-4"  type="password" name="password" >
                            </div>
                            <div class="col-2">
                                    <label class="label">Phone Number</label>
                                    <input class="input--style-4" type="text" name="phone">
                            </div>
                        </div>
                        <div class="p-t-15" >
                            <button type="button" value="Submit" id="submit" class="btn btn--radius-2 btn--blue">Submit</button>
                            <button type="button" class="btn btn--radius-2 btn--blue"onclick="window.location.href='/'">back</button>
                        </div>
</div></div></div></div>
<script type="text/javascript">

    $('#submit').click(function(event){  event.preventDefault();

        let fn = $("input[name=fname]").val();        let ln = $("input[name=lname]").val();
        let phone1 = $("input[name=phone]").val();    let email1 = $("input[name=email]").val();
        let pass = $("input[name=password]").val();

        if (fn == "") { alert("Name must be filled out");  return false;    }
        if (ln == "") { alert("Name must be filled out");  return false;    }
        if (phone1 == "") { alert("Name must be filled out");  return false;    }
        if (email1 == "") { alert("Name must be filled out");  return false;    }
        if (pass == "") { alert("Name must be filled out");  return false;    }

      signup(fn,ln,phone1,email1,pass); })
</script></body></html>
