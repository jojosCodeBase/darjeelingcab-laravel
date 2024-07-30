@extends('layouts.main')
@section('title', 'Client Testimonials')
<style>
    h3 {
        font-family: 'Roboto', sans-serif;
        font-weight: 700;
        color: #2c3e50;
    }

    .testimonial-section {
        padding: 40px 0;
    }

    .testimonial-card {
        background-color: #d3f069;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        position: relative;
        text-align: center;
        height: 200px; /* Fixed height for uniform cards */
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .testimonial-card::before {
        content: '';
        position: absolute;
        top: -30px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 0;
        border-width: 30px;
        border-style: solid;
        border-color: #fff transparent transparent transparent;
    }

    .testimonial-card .quote-icon {
        font-size: 40px;
        color: #2c3e50;
        margin-bottom: 20px;
    }

    .testimonial-card p {
        font-family: 'Open Sans', sans-serif;
        font-size: 16px;
        color: #34495e;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .testimonial-card h5 {
        font-family: 'Open Sans', sans-serif;
        font-weight: 600;
        color: #2c3e50;
    }

    .testimonial-card .author {
        font-family: 'Open Sans', sans-serif;
        font-size: 14px;
        color: #7f8c8d;
    }

    .testimonial-card .position {
        font-family: 'Open Sans', sans-serif;
        font-size: 14px;
        color: #95a5a6;
    }

    .carousel-indicators li {
        background-color: #2c3e50;
    }
</style>
@section('content')
    <div class="container mt-5 testimonial-section">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-4 text-center">What Our Clients Say</h3>
                <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="testimonial-card">
                                <div class="quote-icon">“</div>
                                <p>"The service provided by Darjeeling Cab was exceptional. The driver was knowledgeable and friendly, making our trip memorable. Highly recommend!"</p>
                                <h5>John Doe</h5>
                                <p class="author">Tourist</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="testimonial-card">
                                <div class="quote-icon">“</div>
                                <p>"Excellent experience! The cab was comfortable and the driver was punctual. It made exploring the hills a breeze. Thank you for the wonderful service!"</p>
                                <h5>Jane Smith</h5>
                                <p class="author">Traveler</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="testimonial-card">
                                <div class="quote-icon">“</div>
                                <p>"Darjeeling Cab provided top-notch service during our visit. The attention to detail and customer care were outstanding. Would definitely use them again."</p>
                                <h5>Emily Johnson</h5>
                                <p class="author">Adventurer</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
