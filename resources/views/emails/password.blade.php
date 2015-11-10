<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reset Your Password</title>
</head>
<body>
    <h1>Reset Your Password</h1>
    <p>Click here to reset your password: <a href="{{ url("password/reset/{$token}") }}">{{ url("password/reset/{$token}") }}</a></p>
</body>
</html>