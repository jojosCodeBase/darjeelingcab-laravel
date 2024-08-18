@extends('layouts.main')
@section('title', 'Blogs')
@section('content')
    <div class="container blogs-container">
        <div class="row">
            <h3 class="mb-4 page-title text-brand">Our Blogs</h3>
            @foreach ($blogs as $blog)
                <div class="col-md-4 mb-3">
                    <a href="{{ route('view-blog', ['slug' => Str::slug($blog->title)]) }}">
                        <div class="card shadow">
                            <img src="{{ asset($blog['thumbnail']) }}"
                                height="200" width="350" class="card-img-top" alt="Tea Gardens of Darjeeling">
                            <div class="card-body">
                                <h5 class="card-title">{{ $blog->title }}</h5>
                                <p class="card-text">{!! $blog->content !!}</p>
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
