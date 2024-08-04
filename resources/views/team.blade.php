@extends('layouts.main')
@section('title', 'Our Team')
@section('content')
    <section class="section-team">
        <div class="container">
            <!-- Start Header Section -->
            <div class="row justify-content-center text-center">
                <div class="col-md-8 col-lg-6">
                    <div class="header-section">
                        <h3 class="small-title">Our Team</h3>
                        <h2 class="title">Meet Our Team Members</h2>
                    </div>
                </div>
            </div>
            <!-- / End Header Section -->
            <div class="row">
                <!-- Start Single Person -->
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="single-person">
                        <div class="person-image">
                            <img src="https://i.ibb.co/G2CBWvb/person1.jpg" alt="">
                            <span class="icon">
                                <i class="fab fa-html5"></i>
                            </span>
                        </div>
                        <div class="person-info">
                            <h3 class="full-name">John Doe</h3>
                            <span class="speciality">Web Developer</span>
                        </div>
                    </div>
                </div>
                <!-- / End Single Person -->
                <!-- Start Single Person -->
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="single-person">
                        <div class="person-image">
                            <img src="https://i.ibb.co/nbpNr4r/person2.jpg" alt="">
                            <span class="icon">
                                <i class="fab fa-wordpress-simple"></i>
                            </span>
                        </div>
                        <div class="person-info">
                            <h3 class="full-name">Robert Smith</h3>
                            <span class="speciality">WordPress Developer</span>
                        </div>
                    </div>
                </div>
                <!-- / End Single Person -->
                <!-- Start Single Person -->
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="single-person">
                        <div class="person-image">
                            <img src="https://i.ibb.co/25zdRMr/person3.jpg" alt="">
                            <span class="icon">
                                <i class="fab fa-angular"></i>
                            </span>
                        </div>
                        <div class="person-info">
                            <h3 class="full-name">John Doe</h3>
                            <span class="speciality">Angular Developer</span>
                        </div>
                    </div>
                </div>
                <!-- / End Single Person -->
                <!-- Start Single Person -->
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="single-person">
                        <div class="person-image">
                            <img src="https://i.ibb.co/w0ynr2Q/person4.jpg" alt="">
                            <span class="icon">
                                <i class="fab fa-js"></i>
                            </span>
                        </div>
                        <div class="person-info">
                            <h3 class="full-name">John Smith</h3>
                            <span class="speciality">Javascript Developer</span>
                        </div>
                    </div>
                </div>
                <!-- / End Single Person -->
            </div>
        </div>
    </section>
@endsection
