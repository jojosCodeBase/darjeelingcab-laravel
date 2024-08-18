@extends('layouts.main')
@section('meta-tags')
    <meta name="description"
        content="Explore the scenic beauty of Darjeeling with Darjeeling Cab – your trusted partner for comfortable and reliable taxi services. Discover top-notch transportation solutions for tourists and locals alike. Book your cab today for a memorable journey!" />
    <meta name="keywords"
        content="Darjeeling Cab, taxi services, Darjeeling transportation, reliable cabs, scenic tours, tourist transport, local commuting" />
    <meta name="author" content="Darjeeling Cab" />
    <meta property=og:locale content=en_US>
    <meta property=og:type content=website>
    <meta property=og:title content="Your premier choice for exploring Darjeeling">
    <meta property=og:description
        content="Explore the scenic beauty of Darjeeling with Darjeeling Cab – your trusted partner for comfortable and reliable taxi services. Discover top-notch transportation solutions for tourists and locals alike. Book your cab today for a memorable journey!">
    <meta property=og:url content=https://www.darjeelingcab.in>
    <link rel="canonical" href="https://www.darjeelingcab.in">
    <meta property=og:site_name content="Darjeeling Cab">
    <meta property=og:image content="{{ asset('assets/images/favicon.ico') }}">
@endsection
@section('title', 'Your premier choice for exploring Darjeeling')
@section('content')
    <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class=""
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class="active"
                aria-current="true"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"
                class=""></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Slide 4"
                class=""></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/images/Kangchenjunga.jpg') }}" alt="Kangchenjunga"
                    class="w-100 h-100 object-fit-cover" />
                <div class="container">
                    <div class="carousel-caption text-center test-card">
                        <h1 class="carousel-title text-warning">Journey into Serenity</h1>
                        <p class="opacity-75">Explore Darjeeling's breathtaking vistas with Darjeeling Cab. Your
                            gateway to scenic beauty and unmatched comfort.
                        </p>
                        <div class="buttons">
                            <button class="btn btn-whatsapp cBtn"><i class="fa-solid fa-phone"></i><a
                                    href="tel:+917478459652"> Call Now</a></button>
                            <button class="btn btn-brand cBtn" onclick="book()"><i class="fa fa-paper-plane"
                                    aria-hidden="true"></i> Book Now</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/images/sandakphu.jpg') }}" alt="sandakphu"
                    class="w-100 h-100 object-fit-cover" />
                <div class="container">
                    <div class="carousel-caption text-end test-card">
                        <h1 class="carousel-title text-warning">Beyond Roads, Memories Awaits</h1>
                        <p>Hop on with Darjeeling Cab and let every turn become a story, every mile a cherished
                            memory.
                        </p>
                        <div class="buttons">
                            <button class="btn btn-whatsapp cBtn"><i class="fa-solid fa-phone"></i><a
                                    href="tel:+917478459652"> Call Now</a></button>
                            <button class="btn btn-brand cBtn" onclick="book()"><i class="fa fa-paper-plane"
                                    aria-hidden="true"></i> Book Now</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/images/darjeeling.jpg') }}" alt=""
                    class="w-100 h-100 object-fit-cover" />
                <div class="container">
                    <div class="carousel-caption text-end">
                        <h1 class="carousel-title text-warning">Exploring Made Effortless</h1>
                        <p>Let the winding roads of Darjeeling unfold before you, with Darjeeling Cab making each
                            journey as enjoyable as the destination.</p>
                        <div class="buttons">
                            <button class="btn btn-whatsapp cBtn"><i class="fa-solid fa-phone"></i><a
                                    href="tel:+917478459652"> Call Now</a></button>
                            <button class="btn btn-brand cBtn" onclick="book()"><i class="fa fa-paper-plane"
                                    aria-hidden="true"></i> Book Now</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/images/sikkim.jpg') }}" alt="" class="w-100 h-100 object-fit-cover" />
                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1 class="carousel-title text-warning">Scenic Routes, Seamless Rides.</h1>
                        <p>Your adventure starts the moment you step into our cabs.</p>
                        <div class="buttons">
                            <button class="btn btn-whatsapp cBtn"><i class="fa-solid fa-phone"></i><a
                                    href="tel:+917478459652"> Call Now</a></button>
                            <button class="btn btn-brand cBtn" onclick="book()"><i class="fa fa-paper-plane"
                                    aria-hidden="true"></i> Book Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container">
        <div class="about" id="about">
            <div class="row mb-5">
                <div class="col-md-6 col-lg-6 ms-md-3 mb-3">
                    <span class="text-brand mb-5 brand">ABOUT</span>
                    <h1 class="mt-3">Welcome to Darjeeling Cab</h1>
                    <p class="justify">
                        Discover Darjeeling Cab, your premier choice for exploring Darjeeling, Sikkim, and Kalimpong.
                        Book
                        our comfortable cabs to traverse these stunning destinations. Experience the tea gardens of
                        Darjeeling, the snow-capped mountains of Sikkim, and the rich heritage of Kalimpong. Trust our
                        experienced drivers to make your journey unforgettable. Reserve your cab now and embark on an
                        extraordinary travel adventure with Darjeeling Cab.

                    </p>
                    <button class="btn btn-brand mt-3"><a href="{{ url('about-us') }}" class="text-light"
                            target="_blank">Read
                            more</a></button>
                </div>

                <div class="col-md-5 col-lg-5 ms-md-3 mb-3 d-flex justify-content-center align-items-center">
                    <div class="image-container">
                        <img src="{{ asset('assets/images/slider-img.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <section class="stats-section text-center my-5 bg-brand">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-item">
                        <h2 class="counter" data-target="100">0</h2>
                        <p>Rides</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <h2 class="counter" data-target="100">0</h2>
                        <p>Happy Customers</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <h2 class="counter" data-target="50">0</h2>
                        <p>Destinations</p>
                    </div>
                </div>
            </div>
        </div>
        <span id="services"></span>
    </section>

    <div class="container">
        <div class="services">
            <div class="row">
                <div class="col mt-5">
                    <div class="title">
                        <h2>OUR<strong class="text-brand"> services</strong></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow">
                        <img src="{{ asset('assets/images/bagdogra.jpg') }}" alt="Sightseeing" class="card-img-top"
                            height="220" width="auto">
                        <div class="card-body">
                            <h3 class="fw-bold mb-2">Airport Taxi</h3>
                            <p>Ensure a smooth and timely journey to or from the airport with our reliable taxi service.
                                Experience comfort and convenience at competitive rates, eliminating the stress of travel.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow">
                        <img src="{{ asset('assets/images/local-taxi.jpg') }}" alt="Sightseeing" class="card-img-top"
                            height="220" width="auto">
                        <div class="card-body">
                            <h3 class="fw-bold mb-2">Shared Taxi</h3>
                            <p>Enjoy affordable and eco-friendly travel options with our shared taxi service. Perfect for
                                those looking to save costs while still receiving professional and punctual service.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow">
                        <img src="{{ asset('assets/images/driver-hire.jpg') }}" alt="Sightseeing" class="card-img-top"
                            height="220" width="auto">
                        <div class="card-body">
                            <h3 class="fw-bold mb-2">Driver Hiring</h3>
                            <p>Hire professional and experienced drivers for your personal or business needs. Our drivers
                                are committed to providing safe and courteous service, ensuring your journey is both
                                pleasant and secure.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow">
                        <img src="{{ asset('assets/images/sightseeing.jpg') }}" alt="Sightseeing" class="card-img-top"
                            height="220" width="auto">
                        <div class="card-body">
                            <h3 class="fw-bold mb-2">Sightseeing</h3>
                            <p>Explore the stunning beauty of the region with our customized sightseeing tours.
                                Ideal for both first-time visitors and seasoned travelers,
                                we offer personalized experiences that highlight the top attractions.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow">
                        <img src="{{ asset('assets/images/tour-planning.png') }}" alt="Sightseeing" class="card-img-top"
                            height="220" width="auto">
                        <div class="card-body">
                            <h3 class="fw-bold mb-2">Tour Package</h3>
                            <p>Plan your perfect getaway with our expertly crafted tour packages. From adventure-filled
                                itineraries to relaxing retreats, we handle all the details so you can enjoy a stress-free
                                vacation.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow">
                        <img src="{{ asset('assets/images/hotel-booking.jpeg') }}" alt="Sightseeing"
                            class="card-img-top" height="220" width="auto">
                        <div class="card-body">
                            <h3 class="fw-bold mb-2">Hotel Booking</h3>
                            <p>Secure comfortable and well-located accommodations with our hotel booking service. We offer a
                                range of options to suit every budget, ensuring you find the perfect place to stay during
                                your travels.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Why choose us -->
        <section class="why_section layout_padding-bottom mt-5">
            <div class="container">
                <div class="heading_container heading_center">
                    <h2 class="header-title text-brand">Why Choose Us</h2>
                </div>
                <div class="why_container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="box b1">
                                <div class="img-box">
                                    <img src="{{ asset('assets/images/w1.png') }}" alt="" class="" />
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        Fast & Easy Booking
                                    </h5>
                                    <p>
                                        Our platform offers seamless online reservations, ensuring swift confirmation,
                                        secure payment options, and a versatile fleet of vehicles. Embrace the
                                        simplicity of Darjeeling cab booking and focus on making the most of your
                                        journey. Say goodbye to travel
                                        worries – your effortless ride awaits, just a click away!
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="box b2">
                                <div class="img-box">
                                    <img src="{{ asset('assets/images/w2.png') }}" alt="" class="" />
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        Driving safety
                                    </h5>
                                    <p>
                                        Darjeeling Cab guarantees your safety with dependable drivers. Each driver is
                                        carefully chosen for their skills and commitment to secure travel. Experienced
                                        and knowledgeable about local conditions, they prioritize professionalism and
                                        road safety. Travel confidently, knowing you're in capable hands with Darjeeling
                                        Cab
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="box b3">
                                <div class="img-box">
                                    <img src="{{ asset('assets/images/w3.png') }}" alt="" class="" />
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        Full Satisfaction
                                    </h5>
                                    <p>
                                        Experience complete satisfaction when choosing Darjeeling Cab for your
                                        transportation needs. With a range of vehicle options, transparent pricing, and
                                        a track record of excellence,
                                        we guarantee your contentment from the moment you book until you reach your
                                        destination.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Why choose us end-->

        <!-- product start -->
        <div id="product" class="product mt-5">
            <div class="row">
                <div class="col">
                    <div class="title">
                        <h2>OUR<strong class="text-brand"> vehicles</strong></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="product_box ">
                                <figure><img src="{{ asset('assets/images/tata-sumo.jpg') }}" class="fit-screen"
                                        alt="#" />
                                    <h3>TATA SUMO</h3>
                                </figure>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="product_box">
                                <figure><img src="{{ asset('assets/images/innvoa.jpg') }}" alt="#"
                                        class="fit-screen car-fit" />
                                    <h3>TOYOTA INNOVA</h3>
                                </figure>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="product_box">
                                <figure><img src="{{ asset('assets/images/wagonr.jpg') }}" class="car-fit fit-screen"
                                        alt="#" />
                                    <h3>WAGON R</h3>
                                </figure>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="product_box">
                                <figure><img src="{{ asset('assets/images/swift-dzire.jpg') }}"
                                        class="car-fit fit-screen" alt="#" />
                                    <h3>SWIFT DZIRE </h3>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="product_box">
                                <figure><img src="{{ asset('assets/images/bolero.jpg') }}" class="fir-screen car-fit"
                                        alt="#" />
                                    <h3>BOLERO </h3>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end product -->

        <style>
            .enquiry-form {
                background-color: #f8f9fa;
                padding: 50px;
                border-radius: 10px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            }

            .enquiry-form h2 {
                color: #009688;
                margin-bottom: 30px;
                font-weight: 700;
            }

            .enquiry-form .form-control,
            .enquiry-form .form-select {
                border-color: #009688;
            }

            .enquiry-form .btn-primary {
                background-color: #009688;
                border-color: #009688;
            }

            .enquiry-form .btn-primary:hover {
                background-color: #00796b;
                border-color: #00796b;
            }
        </style>

        <!-- Enquiry Form Start -->
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="enquiry-form">
                        <h2 class="text-center mb-3 text-brand">Tour Enquiry</h2>
                        <p class="text-center mb-4">Fill out the form below to inquire about our tour packages. We'll get
                            back to you shortly with all the details.</p>

                        <form action="your-form-processing-url" method="post">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="E.g. John Doe" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="E.g. example@example.com" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone"
                                        placeholder="E.g. +91 9876543210" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="from" class="form-label">From</label>
                                    <input type="text" class="form-control" id="from" name="from"
                                        placeholder="E.g. Siliguri" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="to" class="form-label">To</label>
                                    <input type="text" class="form-control" id="to" name="to"
                                        placeholder="E.g. Darjeeling" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="number-of-people" class="form-label">Number of People</label>
                                    <input type="number" class="form-control" id="number-of-people"
                                        name="number-of-people" placeholder="E.g. 2" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="vehicle-type" class="form-label">Vehicle Type</label>
                                    <select class="form-select" id="vehicle-type" name="vehicle-type" required>
                                        <option value="" disabled selected>Select Vehicle Type</option>
                                        <option value="TATA SUMO">TATA SUMO</option>
                                        <option value="TOYOTA INNOVA">TOYOTA INNOVA</option>
                                        <option value="WAGON R">WAGON R</option>
                                        <option value="SWIFT DZIRE">SWIFT DZIRE</option>
                                        <option value="BOLERO">BOLERO</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="start-date" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" id="start-date" name="start-date"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="end-date" class="form-label">End Date</label>
                                    <input type="date" class="form-control" id="end-date" name="end-date" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="message" class="form-label">Additional Requests/Message</label>
                                    <textarea class="form-control" id="message" name="message" rows="5"
                                        placeholder="Any special requests or details"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block">Submit Enquiry</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Enquiry Form End -->
    </div>

@endsection
