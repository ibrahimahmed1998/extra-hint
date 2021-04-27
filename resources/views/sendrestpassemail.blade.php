<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<div>
    Hi {{ $name }},
    <br> this is reset password page from AMS <br>

    <a href="{{ url('api/auth/reset_pass',$token)}}">click HERE to set password</a>  <br/>

</div>

</body></html>
