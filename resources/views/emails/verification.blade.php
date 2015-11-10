<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Verify Your E-mail Address</title>
</head>
<body>
    <h1>Verify Your E-mail Address</h1>
    <p>We just need you to <a href="{{ url("auth/register/verify/{$user->token}") }}">verify your email address</a> real quick!</p>
    <p><small>If you cannot click on the link, please copy and paste this into your browser: {{ url("auth/register/verify/{$user->token}") }}</small></p>
</body>
</html>