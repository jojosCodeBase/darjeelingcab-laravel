@extends('layouts/admin-main')
@section('title', 'Edit Blog')
@section('content')
    <div class="container-fluid p-0">

        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Edit Blog</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Edit Blog Post</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data"
                            id="form">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" value="{{ $blog->title }}"
                                        placeholder="Blog Title" required>
                                </div>

                                <div class="col-6 mb-3">
                                    <label class="form-label">Author <span class="text-danger">*</span></label>
                                    <input type="text" name="author" class="form-control" value="{{ $blog->author }}"
                                        placeholder="Author Name">
                                </div>

                                <div class="mb-3 col-6">
                                    <label class="form-label" for="meta_keywords">Meta Keywords</label>
                                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                        placeholder="Enter keywords"
                                        value="{{ old('meta_keywords', $blog->meta_keywords ?? '') }}">
                                </div>

                                <div class="mb-3 col-6">
                                    <label class="form-label" for="meta_description">Meta Description</label>
                                    <input type="text" class="form-control" id="meta_description" name="meta_description"
                                        placeholder="Enter description"
                                        value="{{ old('meta_description', $blog->meta_description ?? '') }}">
                                </div>

                                <span class="text-danger fw-bold mb-2">Note: If an Meta Image and Social Sharing Image is not
                                    uploaded, the blog's main image will be used instead</span>

                                <div class="mb-3 col-6">
                                    <label class="form-label" for="og_image">Meta Image</label>
                                    <input type="file" class="form-control" id="og_image" name="og_image"
                                        accept="image/*" onchange="previewImage('og_image', 'og_image_preview')">
                                    <img src="{{ asset($blog->og_image ?? '') }}" id="og_image_preview"
                                        alt="Preview Open Graph Image" width="auto" height="200" class="mt-3">
                                </div>

                                <div class="mb-3 col-6">
                                    <label class="form-label" for="twitter_image">Social Sharing Image</label>
                                    <input type="file" class="form-control" id="twitter_image" name="twitter_image"
                                        accept="image/*" onchange="previewImage('twitter_image', 'twitter_image_preview')">
                                    <img src="{{ asset($blog->twitter_image ?? '') }}" id="twitter_image_preview"
                                        alt="Preview Twitter Image" width="auto" height="200" class="mt-3">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Blog Thumbnail <span class="text-danger">*</span></label>
                                    <input type="file" name="thumbnail" class="form-control" id="thumbnailInput"
                                        accept="image/*">
                                    <img id="previewThumbnail" src="{{ asset($blog->thumbnail) }}" alt="Preview Image"
                                        width="auto" height="200" class="mt-3">
                                </div>
                                <div class="col">
                                    <label class="form-label">Blog Image <span class="text-danger">*</span></label>
                                    <input type="file" name="image" class="form-control" id="imageInput"
                                        accept="image/*">
                                    <img id="previewImage" src="{{ asset($blog->image) }}" alt="Preview Image"
                                        width="auto" height="200" class="mt-3">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <label class="form-label">Content <span class="text-danger">*</span></label>
                                    <textarea name="content" id="content-editor" class="form-control" required>{{ $blog->content }}</textarea>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-lg btn-primary" id="submitBtn">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // Define the function outside of the document ready function
        function previewImage(inputId, previewId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.hidden = false;
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '';
                preview.hidden = true;
            }
        }

        // Use jQuery to wait for the document to be ready
        $(document).ready(function() {
            // For Open Graph Image
            $('#og_image').change(function() {
                previewImage('og_image', 'og_image_preview');
            });

            // For Twitter Image
            $('#twitter_image').change(function() {
                previewImage('twitter_image', 'twitter_image_preview');
            });
        });
    </script>
@endsection
