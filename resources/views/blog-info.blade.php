@extends('layouts.main')
@section('title', $blog['title'])
<style>
    h3 {
        font-weight: 700;
        color: #2c3e50;
    }

    .blog-content {
        font-size: 16px;
        color: #34495e;
        line-height: 1.6;
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        text-align: justify;
    }

    .blog-content img {
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
        background-color: #f8f9fa;
        border: none;
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
    <div class="blogs-container container">
        <div class="row">
            <div class="col-md-8">
                <h3 class="mb-4 text-center text-md-start">{{ $blog['title'] }}</h3>
                <div class="blog-content">
                    <img src="{{ asset($blog['thumbnail']) }}" alt="{{ $blog['title'] }}" class="img-fluid">
                    <p class="fw-bold my-2"><small>Published on {{ \Carbon\Carbon::parse($blog->created_at)->format('d F, Y') }}</small></p>
                    <p>{!! $blog['content'] !!}</p>
                </div>
            </div>
            <div class="col-md-4 mt-lg-0 mt-xl-0 mt-4">
                <h3 class="mb-4 text-center text-md-start">Other Blogs</h3>
                <div class="row recent-blogs">
                    @foreach ($recentBlogs as $recentBlog)
                    <a href="{{ route('view-blog', ['slug' => Str::slug($recentBlog->title)]) }}">
                        <div class="col-md-12 mb-4">
                            <div class="card shadow">
                                <img src="{{ asset($recentBlog['thumbnail']) }}" class="card-img-top"
                                    alt="{{ $recentBlog['title'] }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $recentBlog['title'] }}</h5>
                                    <p class="card-text">Published on {{ \Carbon\Carbon::parse($recentBlog->created_at)->format('d F, Y') }}</p>
                                    <a href="{{ route('view-blog', ['slug' => Str::slug($recentBlog->title)]) }}" class="text-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
