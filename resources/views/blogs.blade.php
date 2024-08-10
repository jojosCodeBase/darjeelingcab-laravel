@extends('layouts.main')
@section('title', 'Blogs')
@section('content')
    <div class="container blogs-container mt-5 d-flex align-items-center vh-100">
        <div class="row">
            <h3 class="mb-4 text-brand page-title">Our Blogs</h3>
            <div class="col-md-4 mb-3">
                <a href="">
                    <div class="card shadow">
                        <img src="https://media.tripinvites.com/places/darjeeling/tea-plantations/golpahar-tea-plantation-in-darjeeling-featured.jpg"
                            height="200" width="350" class="card-img-top" alt="Tea Gardens of Darjeeling">
                        <div class="card-body">
                            <h5 class="card-title">Exploring the Tea Gardens of Darjeeling</h5>
                            <p class="card-text">
                                Discover the lush green tea gardens of Darjeeling with our premium cab service.
                                Our experienced drivers...
                            </p>
                            <div class="d-flex justify-content-between">
                                <small class="text-muted">Published on July 15, 2024</small>
                                <a href="{{ route('view-blog', ['slug' => 'hello']) }}" class="text-primary">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow">
                    <img src="https://i.pinimg.com/originals/3a/70/e5/3a70e5d5b68d27b2c5f14dc6018828d3.jpg"
                        class="card-img-top" height="200" width="350" alt="Snow-Capped Mountains of Sikkim">
                    <div class="card-body">
                        <h5 class="card-title">Adventure in Sikkim's Snow-Capped Mountains</h5>
                        <p class="card-text">
                            Ready for an adventure? Our cabs can take you to the heart of Sikkim's majestic
                            mountains. Learn more about our...
                        </p>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">Published on July 10, 2024</small>
                            <a href="{{ route('view-blog', ['slug' => 2]) }}" class="text-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow">
                    <img src="https://i.cdn.newsbytesapp.com/images/l99020211231103855.jpeg" class="card-img-top"
                        height="200" width="350" alt="Cultural Heritage of Kalimpong">
                    <div class="card-body">
                        <h5 class="card-title">Cultural Heritage of Kalimpong</h5>
                        <p class="card-text">
                            Immerse yourself in the rich cultural heritage of Kalimpong with our reliable cab
                            services. From historical sites to...
                        </p>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">Published on July 5, 2024</small>
                            <a href="{{ route('view-blog', ['slug' => 3]) }}" class="text-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container blogs-container">
        <div class="row">
            @foreach ($blogs as $blog)
                <div class="col-md-4 mb-3">
                    <a href="">
                        <div class="card shadow">
                            <img src="https://media.tripinvites.com/places/darjeeling/tea-plantations/golpahar-tea-plantation-in-darjeeling-featured.jpg"
                                height="200" width="350" class="card-img-top" alt="Tea Gardens of Darjeeling">
                            <div class="card-body">
                                <h5 class="card-title">{{ $blog->title }}</h5>
                                <p class="card-text">{{ $blog->content }}</p>
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">Published on {{ \Carbon\Carbon::parse($blog->created_at)->format('d F, Y') }}</small>
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
