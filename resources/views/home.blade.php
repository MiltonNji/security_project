<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
</head>
<body>
<h1>Welcome to the Homepage</h1>
<a href="{{ route('random-page') }}">Go to Random Page</a>
</body>
</html>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
