@php
    $blog['title'] = 'Exploring the Tea Gardens of Darjeeling';
    $blog['image'] = 'https://via.placeholder.com/800x400'; // Replace with actual image URL
    $recentBlogs = [
        [
            'id' => 2,
            'title' => 'Adventure in Sikkim\'s Snow-Capped Mountains',
            'image' => 'https://via.placeholder.com/800x400',
            'published_date' => 'July 10, 2024',
        ],
        [
            'id' => 3,
            'title' => 'Cultural Heritage of Kalimpong',
            'image' => 'https://via.placeholder.com/800x400',
            'published_date' => 'July 5, 2024',
        ]
    ];
@endphp
@extends('layouts.main')
@section('title', $blog['title'])
<style>
    h3 {
        font-family: 'Roboto', sans-serif;
        font-weight: 700;
        color: #2c3e50;
    }

    .blog-content {
        font-family: 'Open Sans', sans-serif;
        font-size: 16px;
        color: #34495e;
        line-height: 1.6;
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
    }

    .blog-content img {
        width: 100%;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: #2c3e50;
        border-color: #2c3e50;
    }

    .recent-blogs {
        margin-top: 40px;
    }

    .recent-blogs .card {
        margin-bottom: 15px;
    }

    .recent-blogs img {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .recent-blogs .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
</style>
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-4">{{ $blog['title'] }}</h3>
                <p><small>Published on July 15, 2024</small></p>
                <div class="blog-content">
                    <img src="{{ $blog['image'] }}" alt="{{ $blog['title'] }}">
                    <p>Discover the lush green tea gardens of Darjeeling with our premium cab service. Our experienced drivers will guide you through the serene landscapes, offering insights into the rich history and culture of the region. From the moment you step into our cab, you'll experience unparalleled comfort and convenience. Whether you're a solo traveler or with family, our service is designed to make your journey memorable.</p>
                    <p>We understand the importance of flexibility and offer customizable tour packages to suit your preferences. Enjoy stops at popular viewpoints, visit local tea estates, and immerse yourself in the natural beauty of Darjeeling. Book your cab today and embark on an unforgettable adventure.</p>
                </div>
                <a href="{{ route('blogs') }}" class="btn btn-primary mt-4">Back to Blogs</a>
            </div>
        </div>
        <!-- Recent Blogs Section -->
        <div class="row recent-blogs">
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ $recentBlogs[0]['image'] }}" class="card-img-top" alt="{{ $recentBlogs[0]['title'] }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $recentBlogs[0]['title'] }}</h5>
                        <p class="card-text">Published on {{ $recentBlogs[0]['published_date'] }}</p>
                        <a href="{{ route('blog-info', ['id' => $recentBlogs[0]['id']]) }}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ $recentBlogs[1]['image'] }}" class="card-img-top" alt="{{ $recentBlogs[1]['title'] }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $recentBlogs[1]['title'] }}</h5>
                        <p class="card-text">Published on {{ $recentBlogs[1]['published_date'] }}</p>
                        <a href="{{ route('blog-info', ['id' => $recentBlogs[1]['id']]) }}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
