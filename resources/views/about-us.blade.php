@extends('layouts.main')
@section('title', 'About us')
@section('content')
    <div class="container d-flex justify-content-center align-items-center vh-100 mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center about-us">
                <h2 class="text-brand page-title">About Us</h2>
                <p class="mt-4">
                    Welcome to Darjeeling Cab, your premier choice for exploring the breathtaking landscapes of Darjeeling,
                    Sikkim, and Kalimpong. Our dedicated cab service is designed to cater to the needs of both guests and
                    tourists, ensuring a comfortable and unforgettable journey.
                </p>
                <p class="mt-3">
                    Founded by a group of young entrepreneurs with a passion for travel and innovation, Darjeeling Cab aims
                    to
                    make cab booking easy and accessible, especially during the bustling tour and peak seasons in the hills.
                    We understand the unique challenges of navigating through the hilly terrains and are committed to
                    providing
                    a seamless travel experience.
                </p>
                <p class="mt-3">
                    Whether you wish to soak in the mesmerizing beauty of Darjeeling's tea gardens, embark on an adventure
                    in
                    Sikkim's snow-capped mountains, or immerse yourself in the rich cultural heritage of Kalimpong, our
                    experienced
                    and courteous drivers are here to guide you. With our convenient booking system, you can effortlessly
                    reserve a
                    cab and traverse through the scenic locales, capturing memories that will last a lifetime.
                </p>
                <p class="mt-3">
                    Trust Darjeeling Cab to make your travel experience extraordinary. Our mission is to provide top-notch
                    service
                    with a personal touch, ensuring every journey is as enjoyable as the destination itself.
                </p>
            </div>
        </div>
    </div>

    <section class="section-team">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-8 col-lg-6">
                    <div class="header-section">
                        <h2 class="title text-brand">Our Team</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="single-person">
                        <div class="person-image">
                            <img src="{{ asset('assets/images/team/lokesh.jpg') }}" alt="lokesh">
                            <span class="icon">
                                <i class="fa fa-lightbulb"></i>
                            </span>
                        </div>
                        <div class="person-info">
                            <h3 class="full-name">Lokesh Gurung</h3>
                            <p class="speciality">Founder</p>
                        </div>
                        <div class="social-links">
                            <a href="https://www.facebook.com/username" target="_blank">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                            <a href="https://twitter.com/username" target="_blank">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com/in/username" target="_blank">
                                <i class="fa-brands fa-linkedin"></i>
                            </a>
                            <a href="https://www.instagram.com/username" target="_blank">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="single-person">
                        <div class="person-image">
                            <img src="{{ asset('assets/images/team/kunsang.jpg') }}" alt="kunsang">
                            <span class="icon">
                                <i class="fa fa-code"></i>
                            </span>
                        </div>
                        <div class="person-info">
                            <h2 class="full-name">Kunsang Moktan</h3>
                            <p class="speciality">Co-Founder / Developer</p>
                        </div>
                        <div class="social-links">
                            <a href="https://www.facebook.com/username" target="_blank">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                            <a href="https://twitter.com/username" target="_blank">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com/in/username" target="_blank">
                                <i class="fa-brands fa-linkedin"></i>
                            </a>
                            <a href="https://www.instagram.com/username" target="_blank">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="single-person">
                        <div class="person-image">
                            <img src="{{ asset('assets/images/team/tshiten.jpg') }}" alt="tshiten">
                            <span class="icon">
                                <i class="fa fa-globe"></i>
                            </span>
                        </div>
                        <div class="person-info">
                            <h3 class="full-name">Tshiten Tamang</h3>
                            <p class="speciality">Co-ordinator</p>
                        </div>
                        <div class="social-links">
                            <a href="https://www.facebook.com/username" target="_blank">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                            <a href="https://twitter.com/username" target="_blank">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com/in/username" target="_blank">
                                <i class="fa-brands fa-linkedin"></i>
                            </a>
                            <a href="https://www.instagram.com/username" target="_blank">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="single-person">
                        <div class="person-image">
                            <img src="{{ asset('assets/images/team/adarsh.jpg') }}" alt="sonam">
                            <span class="icon">
                                <i class="fa fa-globe"></i>
                            </span>
                        </div>
                        <div class="person-info">
                            <h3 class="full-name">Sonam Tamang</h3>
                            <p class="speciality">Co-ordinator</p>
                        </div>
                        <div class="social-links">
                            <a href="https://www.facebook.com/username" target="_blank">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                            <a href="https://twitter.com/username" target="_blank">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com/in/username" target="_blank">
                                <i class="fa-brands fa-linkedin"></i>
                            </a>
                            <a href="https://www.instagram.com/username" target="_blank">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>

                

                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="single-person">
                        <div class="person-image">
                            <img src="{{ asset('assets/images/team/palsang.jpg') }}" alt="palsang">
                            <span class="icon">
                                <i class="fa-brands fa-instagram"></i>
                            </span>
                        </div>
                        <div class="person-info">
                            <h3 class="full-name">Palsang Moktan</h3>
                            <p class="speciality">Social Media Co-ordinator</p>
                        </div>
                        <div class="social-links">
                            <a href="https://www.facebook.com/username" target="_blank">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                            <a href="https://twitter.com/username" target="_blank">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com/in/username" target="_blank">
                                <i class="fa-brands fa-linkedin"></i>
                            </a>
                            <a href="https://www.instagram.com/username" target="_blank">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- / End Single Person -->
            </div>
        </div>
    </section>
@endsection
