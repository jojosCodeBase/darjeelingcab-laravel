<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="Explore the scenic beauty of Darjeeling with Darjeeling Cab – your trusted partner for comfortable and reliable taxi services. Discover top-notch transportation solutions for tourists and locals alike. Book your cab today for a memorable journey!" />
    <meta name="keywords"
        content="Darjeeling Cab, taxi services, Darjeeling transportation, reliable cabs, scenic tours, tourist transport, local commuting" />
    <meta name="author" content="Darjeeling Cab" />
    <title>@yield('title') | Darjeeling Cab</title>
    <link rel="icon" href="{{ asset('assets/images/darjeelingcab-logo.png') }}" type="image/x-icon">
    <link href="{{ asset('assets/css/carousel.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/services.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/chooseus.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            padding: 0px;
        }

        .btn-danger {
            border-radius: 0px;
        }

        .cBtn {
            border-radius: 100px;
            padding: 5px;
            height: 50px;
            width: 150px;
            font-size: 1rem;
            margin-right: 10px;
        }

        .btn-whatsapp:hover {
            border: 2px solid #25D366;
            color: #25D366;
        }

        .btn-warning:hover {
            border: 2px solid #ffc107;
            color: #FFC107;
            background-color: transparent;
        }

        .page-header {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            z-index: 120;
            width: 100%;
        }

        .page-header .sticky {
            position: fixed;
            background-color: rgba(255, 255, 255, 1);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            -webkit-backdrop-filter: blur(10px);
            backdrop-filter: blur(10px);
            -webkit-animation: slideDown 0.35s ease-out;
            animation: slideDown 0.35s ease-out;
            width: 100%;
        }

        .page-header .sticky .fs-6 {
            color: black;
        }

        .carousel {
            position: relative;
            z-index: 1;
        }

        .fs-6 {
            color: #fff;
        }

        @media (max-width: 576px) {
            .buttons {
                display: flex;
            }

            .cBtn {
                border-radius: 100px;
                padding: 5px;
                font-size: 1rem;
            }

            .buttons .btn-warning {
                width: 10rem;
            }

            .navbar-nav {
                background-color: #fff;
            }

            .navbar-toggler {
                border: none;
            }

            .navbar-toggler:focus {
                box-shadow: none;
                border-color: #ced4da;
                outline: none;
            }

            .btn-mob {
                display: none;
            }

            .fs-6 {
                color: black;
            }
        }
    </style>
</head>

<body>

    <div class="page-header">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand text-light p-0" href="#">
                    <img src="{{ asset('assets/images/test-logo2.png') }}" class="scr-fit"
                        style="object-fit: cover;" height="80" width="80" alt="">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item mx-3">
                            <a href="#" class="nav-link fs-6">Home</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a href="travel-distance.html" class="nav-link fs-6">Travel Distances</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a href="#" class="nav-link dropdown-toggle fs-6" id="othersDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Destinations</a>
                            <div class="dropdown-menu" aria-labelledby="othersDropdown">
                                <a class="dropdown-item" href="./darjeeling.html">Darjeeling</a>
                                <a class="dropdown-item" href="./kalimpong.html">Kalimpong</a>
                                <a class="dropdown-item" href="./sikkim.html">Sikkim</a>
                                <a class="dropdown-item" href="./kurseong.html">Kurseong</a>
                            </div>
                        </li>
                        <li class="nav-item mx-3">
                            <a href="#product" class="nav-link fs-6">Our Services</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a href="#about" class="nav-link fs-6">About us</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a href="#contact" class="nav-link fs-6">Contact us</a>
                        </li>
                    </ul>
                    <div class="btn btn-warning mx-lg-5 mx-sm-3 btn-mob">
                        <a href="tel:+917478459652">Book Now</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>


    <main>
        @yield('content')
    </main>

    <div class="container-fluid mb-0 mt-0">
        <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 mt-5 mb-4">
            <div class="col-md-1 ms-md-4 mb-3">
                <h5>LINKS</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="index.html" class="nav-link p-0">Home</a>
                    </li>
                    <li class="nav-item mb-2"><a href="travel-distance.html" class="nav-link p-0">Distances</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0">Places to visit</a>
                    </li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0">FAQs</a></li>
                    <li class="nav-item mb-2"><a href="about-us.html" class="nav-link p-0">About</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-3 mb-3 ms-md-5">
                <h5>ADDRESS</h5>
                <ul class="nav flex-column text-primary">
                    <li class="nav-item mb-1">C/O Lokesh Gurung, Peshok, </li>
                    <li class="nav-item mb-1">Peshok Tea Garden,</li>
                    <li class="nav-item mb-1">Rangli Rangliot,</li>
                    <li class="nav-item mb-1">Darjeeling - 734312</li>
                </ul>
            </div>

            <div class="col-md-3 ms-md-4 mb-3" id="contact">
                <h5>CONTACT US</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-1">
                        <span class="p-0 text-primary"><i class="fa-solid fa-phone"></i> 7478459652</span>
                    </li>
                    <li class="nav-item mb-1">
                        <span class="p-0 text-primary"><i class="fa-brands fa-whatsapp"></i> 7478459652</span>
                    </li>
                    <li class="nav-item mb-2"><span class="p-0 text-primary"><i class="fa-solid fa-envelope"></i>
                            <a href="mailto:info@darjeelingcab.in"
                                class="text-primary">info@darjeelingcab.in</a></span>
                    </li>
                    <li class="nav-item">
                        <div class="row mt-4">
                            <button class="col-5 mx-2 btn btn-green"><a href="tel:+917478459652"><i
                                        class="fa-solid fa-phone"></i> Call Now</a></button>

                            <button class="col-5 mx-2 btn btn-whatsapp" onclick="book()"><i
                                    class="fa-brands fa-whatsapp"></i>
                                Whatsapp</button>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="col-md-3 ms-md-4 mb-3" id="contact">
                <h5>REACH US</h5>
                <form class="form-group" action="">
                    <input type="email" class="form-control mt-3" placeholder="Email">
                    <input type="submit" class="btn btn-warning mt-3" value="Submit">
                </form>
            </div>
        </footer>
        <div class="row mb-5">
            <span class="text-center">© Darjeeling Cab. All rights reserved | Designed and Developed by Kunsang
                Moktan</span>
        </div>
    </div>

    <script>
        function book() {
            var phoneNumber = "+917478459652";
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
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
</body>

</html>
