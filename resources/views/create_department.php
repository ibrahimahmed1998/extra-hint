<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<div>
    Hi {{ $user->firstname }},
    <br>
    Thank you for creating an account with us. Don't forget to complete your registration!
    <br>
    Please click on the link below or copy it into the address bar of your browser to confirm your email address:
    <br>

    <a href="{{ url('api/auth/verify', $user->vcode)}}">Confirm my email address </a>

    <br/>
</div>

</body>
</html>
