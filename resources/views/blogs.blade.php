@extends('layouts.main')
@section('title', 'Darjeeling Cab Blogs - Your Guide to Exploring Darjeeling')
@section('meta-tags')
    <meta name="description"
        content="Stay updated with the latest travel tips, local insights, and scenic routes in Darjeeling. Read our blogs for expert advice on making the most of your journey with Darjeeling Cab." />
    <meta name="keywords"
        content="Darjeeling Cab blogs, travel tips, Darjeeling travel guide, scenic routes, local insights, tourist information, taxi services blog" />
    <meta name="author" content="Darjeeling Cab" />
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
    <meta property="og:title" content="Darjeeling Cab Blogs - Your Guide to Exploring Darjeeling">
    <meta property="og:description"
        content="Explore our blog for travel inspiration, tips, and insider knowledge about Darjeeling. Learn how to enhance your journey with our reliable taxi services." />
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Darjeeling Cab">
    <meta property=og:image content="{{ asset('assets/images/favicon.ico') }}">
@endsection
@section('content')
    <div class="container blogs-container">
        <div class="row">
            <h3 class="mb-4 page-title text-brand">Our Blogs</h3>
            @foreach ($blogs as $blog)
                <div class="col-md-4 mb-3">
                    <a href="{{ route('view-blog', ['slug' => Str::slug($blog->title)]) }}">
                        <div class="card shadow">
                            <img src="{{ asset($blog['thumbnail']) }}" height="200" width="350" class="card-img-top"
                                alt="Tea Gardens of Darjeeling">
                            <div class="card-body">
                                <h5 class="card-title">{{ $blog->title }}</h5>
                                <p class="card-text">{{ Str::limit(strip_tags($blog->content), 140, '...') }}</p>
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">Published on
                                        {{ \Carbon\Carbon::parse($blog->created_at)->format('d F, Y') }}</small>
                                    <a href="{{ route('view-blog', ['slug' => Str::slug($blog->title)]) }}"
                                        class="text-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
