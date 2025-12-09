<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
    content="Explore the scenic beauty of Darjeeling with Darjeeling Cab – your trusted partner for comfortable and reliable taxi services. Discover top-notch transportation solutions for tourists and locals alike. Book your cab today for a memorable journey!" />
    <meta name="keywords"
    content="Darjeeling Cab, taxi services, Darjeeling transportation, reliable cabs, scenic tours, tourist transport, local commuting" />
    <meta name="author" content="Darjeeling Cab" />
    <meta property="og:locale" content=en_US>
    <meta property="og:type" content=website>
    <meta property="og:title" content="Your premier choice for exploring Darjeeling">
    <meta property="og:description"
    content="Explore the scenic beauty of Darjeeling with Darjeeling Cab – your trusted partner for comfortable and reliable taxi services. Discover top-notch transportation solutions for tourists and locals alike. Book your cab today for a memorable journey!">
    <meta property="og:url" content=https://www.darjeelingcab.in>
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:site_name" content="Darjeeling Cab">
    <meta property="og:image" content="{{ asset('assets/images/favicon.ico') }}">
    <title>404 Page Not Found | Darjeeling Cab</title>
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/error-page-style.css') }}">
</head>

<body>
    <div class="error-page" style="background-image: url('{{ asset('assets/images/error-page-background.jpg') }}')">
        <div class="overlay"></div>
        <div class="content">
            <h1 class="fw-bold">404</h1>
            <h2 class="fw-bold">Oops! Page Not Found</h2>
            <p>It seems the page you were looking for at <strong>Darjeeling Cab</strong> doesn't exist.</p>
            <p>Don’t worry, we’ll help you find your way back!</p>
            <a href="{{ url('/') }}">Go back to Home</a>
        </div>
    </div>
</body>

</html>
