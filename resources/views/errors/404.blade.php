<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Page Not Found | Darjeeling Cab</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }
        .error-page {
            position: relative;
            height: 100vh;
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6); /* Dark overlay */
        }
        .content {
            position: relative;
            z-index: 1;
        }
        h1 {
            font-size: 100px;
            margin: 0;
        }
        h2 {
            font-size: 36px;
            margin: 10px 0;
        }
        p {
            font-size: 18px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #009688;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        a:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="error-page" style="background-image: url('{{ asset('assets/images/Kangchenjunga.jpg') }}')">
        <div class="overlay"></div>
        <div class="content">
            <h1>404</h1>
            <h2>Page Not Found</h2>
            <p>Sorry, the page you are looking for does not exist.</p>
            <a href="{{ url('/') }}">Go back to Home</a>
        </div>
    </div>
</body>
</html>

