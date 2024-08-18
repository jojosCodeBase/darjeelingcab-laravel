<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="@yield('title')" />
    @yield('meta-tags')

    @yield('blogs-seo')


    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <link href="{{ asset('assets/css/carousel.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/services.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/chooseus.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class="page-header{{ Route::is('index') ? '-home' : '' }}">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand text-light p-0" href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/white-logo.png') }}" class="scr-fit" style="object-fit: cover;"
                        height="70" width="auto" alt="">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item mx-3">
                            <a href="{{ url('/') }}" class="nav-link fs-6">Home</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a href="{{ url('blogs') }}" class="nav-link fs-6">Blogs</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a href="#services" class="nav-link fs-6">Our Services</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a href="{{ url('about-us') }}" class="nav-link fs-6">About us</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a href="{{ url('contact') }}" class="nav-link fs-6">Contact us</a>
                        </li>
                    </ul>
                </div>
                <div class="btn btn-brand mx-lg-5 mx-sm-3 btn-mob">
                    <a href="tel:+918967386612">Book Now</a>
                </div>
            </div>
        </nav>
    </div>


    <main class="mb-5">
        @yield('content')
    </main>

    <div class="bg-brand">
        <div class="container">
            <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 mt-5">
                <div class="col-md-2 ms-md-4 mb-3">
                    <h5>LINKS</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="{{ url('/') }}" class="nav-link p-0">Home</a></li>
                        <li class="nav-item mb-2"><a href="{{ url('blogs') }}" class="nav-link p-0">Blogs</a>
                        </li>
                        <li class="nav-item mb-2"><a href="{{ url('about-us') }}" class="nav-link p-0">About us</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0">FAQs</a></li>
                        <li class="nav-item mb-2"><a href="{{ url('contact') }}" class="nav-link p-0">Contact us</a></li>
                    </ul>
                </div>
    
                <div class="col-md-3 mb-3 ms-md-5">
                    <h5>ADDRESS</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-1">Peshok, Peshok Tea Garden,</li>
                        <li class="nav-item mb-1">Rangli Rangliot, Darjeeling</li>
                        <li class="nav-item mb-1">West Bengal - 734312</li>
                    </ul>
                </div>
    
                <div class="col-md-3 ms-md-4 mb-3 contact" id="contact">
                    <h5>CONTACT US</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-1">
                            <span class="p-0"><i class="fa-solid fa-phone"></i> 8967386612 / 7047089254 / 7478459652</span>
                        </li>
                        <li class="nav-item mb-1">
                            <span class="p-0"><i class="fa-brands fa-whatsapp"></i> 8967386612 / 7047089254 / 7478459652</span>
                        </li>
                        <li class="nav-item mb-2"><span class="p-0"><i class="fa-solid fa-envelope"></i>
                                <a href="mailto:info@darjeelingcab.in">info@darjeelingcab.in</a></span>
                        </li>
                    </ul>
                </div>
    
                <div class="col-md-2 ms-md-4 mb-3">
                    <h5>FOLLOW US</h5>
                    <ul class="nav">
                        <li class="nav-item me-3">
                            <a href="https://instagram.com/darjeeling.cab" target="_blank" class="nav-link p-0 fs-4"><i
                                    class="fa-brands fa-instagram"></i></a>
                        </li>
                        <li class="nav-item me-3">
                            <a href="https://www.facebook.com/profile.php?id=61552052485531" target="_blank" class="nav-link p-0 fs-4"><i
                                    class="fa-brands fa-facebook"></i></a>
                        </li>
                    </ul>
                </div>
            </footer>
            <div class="p-3">
                <p class="text-light text-center fw-bold fs-5">Visitors: {{ $visitCount }}</p>
            </div>
            <div class="row mb-5 copyright">
                <span class="text-center">© Darjeeling Cab. All rights reserved | Designed and Developed by Kunsang
                    Moktan</span>
            </div>
        </div>
    </div>

    <script>
        function book() {
            var phoneNumber = "+918967386612";
            var message = "Hello, I want to book a cab!";
            var apiLink = "https://api.whatsapp.com/send?phone=" + phoneNumber + "&text=" + encodeURIComponent(message);
            window.open(apiLink, "_blank");
        };

        window.addEventListener('scroll', function() {
            var navbar = document.querySelector('.navbar');
            if (window.scrollY > 0) {
                navbar.classList.add('sticky');
            } else {
                navbar.classList.remove('sticky');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.counter');

            const animateCounters = () => {
                counters.forEach(counter => {
                    const target = +counter.getAttribute('data-target');
                    let count = 0;
                    const speed = 2000; // Time in milliseconds for the count to reach target

                    const updateCounter = () => {
                        const increment = target / (speed / 100);
                        if (count < target) {
                            count += increment;
                            counter.innerText = Math.ceil(count);
                            setTimeout(updateCounter, 100);
                        } else {
                            counter.innerText = target + '+';
                        }
                    };

                    updateCounter();
                });
            };

            animateCounters();
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
</body>

</html>
