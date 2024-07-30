@extends('layouts.main')
@section('title', 'Blogs')
<style>
    h3 {
        font-weight: 700;
        color: #2c3e50;
    }

    .card {
        margin-bottom: 20px;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .card-img-top {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .card-title {
        font-weight: bold;
        color: #2c3e50;
    }
</style>
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-4">Our Blogs</h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Tea Gardens of Darjeeling">
                            <div class="card-body">
                                <h5 class="card-title">Exploring the Tea Gardens of Darjeeling</h5>
                                <p class="card-text">
                                    Discover the lush green tea gardens of Darjeeling with our premium cab service. Our experienced drivers...
                                </p>
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">Published on July 15, 2024</small>
                                    <a href="{{ route('blog-info', ['id' => 1]) }}" class="text-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Snow-Capped Mountains of Sikkim">
                            <div class="card-body">
                                <h5 class="card-title">Adventure in Sikkim's Snow-Capped Mountains</h5>
                                <p class="card-text">
                                    Ready for an adventure? Our cabs can take you to the heart of Sikkim's majestic mountains. Learn more about our...
                                </p>
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">Published on July 10, 2024</small>
                                    <a href="{{ route('blog-info', ['id' => 2]) }}" class="text-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Cultural Heritage of Kalimpong">
                            <div class="card-body">
                                <h5 class="card-title">Cultural Heritage of Kalimpong</h5>
                                <p class="card-text">
                                    Immerse yourself in the rich cultural heritage of Kalimpong with our reliable cab services. From historical sites to...
                                </p>
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">Published on July 5, 2024</small>
                                    <a href="{{ route('blog-info', ['id' => 3]) }}" class="text-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
