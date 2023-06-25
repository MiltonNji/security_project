<!DOCTYPE html>
<html>
<head>
    <title>404 Not Found</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        .container {
            max-width: 600px;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 32px;
            color: #333333;
            margin-top: 0;
        }

        p {
            font-size: 18px;
            color: #666666;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #337ab7;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #23527c;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>404 Not Found</h1>
    <p>The page you are looking for does not exist.</p>
    <p> Please <a href="{{ route('home') }}">Go Back</a> To the Homepage </p>
    <p>Or Try checking the if the URL you inserted was correct</p>
</div>
</body>
</html>
