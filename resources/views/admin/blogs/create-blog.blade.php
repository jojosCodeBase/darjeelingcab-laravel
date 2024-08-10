@extends('layouts/admin-main')
@section('title', 'Create Blog')
@section('content')
    <div class="container-fluid p-0">

        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Create Blog</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data" id="form">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" placeholder="Blog Title"
                                        value="{{ old('title') }}" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Author <span class="text-danger">*</span></label>
                                    <input type="text" name="author" class="form-control" placeholder="Author Name"
                                        value="{{ old('author') }}" required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="meta_keywords">Meta Keywords</label>
                                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                        placeholder="Enter keywords"
                                        value="{{ old('meta_keywords') }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="meta_description">Meta Description</label>
                                    <input type="text" class="form-control" id="meta_description" name="meta_description"
                                        placeholder="Enter description"
                                        value="{{ old('meta_description') }}">
                                </div>

                                <span class="text-danger fw-bold mb-2">Note: If an Meta Image or Social Sharing Image is not
                                    uploaded, the blog's main image will be used instead</span>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="og_image">Meta Image</label>
                                    <input type="file" class="form-control" id="og_image" name="og_image"
                                        accept="image/*" onchange="previewImage('og_image', 'og_image_preview')">
                                    <img id="og_image_preview" alt="Preview Open Graph Image" width="auto" height="250"
                                        class="mt-3" hidden>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="twitter_image">Social Sharing Image</label>
                                    <input type="file" class="form-control" id="twitter_image" name="twitter_image"
                                        accept="image/*" onchange="previewImage('twitter_image', 'twitter_image_preview')">
                                    <img id="twitter_image_preview" alt="Preview Twitter Image" width="auto"
                                        height="250" class="mt-3" hidden>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Thumbnail <span class="text-danger">*</span></label>
                                    <input type="file" name="thumbnail" class="form-control" id="thumbnailInput"
                                        accept="image/*" required>
                                        <img id="previewThumbnail" alt="Preview Thumbnail" width="auto" height="250" class="mt-3"
                                            hidden>
                                </div>

                                {{-- <div class="col mb-3">
                                    <label class="form-label">Image <span class="text-danger">*</span></label>
                                    <input type="file" name="image" class="form-control" id="imageInput"
                                        accept="image/*" required>
                                        <img id="previewImage" alt="Preview Image" width="auto" height="250" class="mt-3"
                                            hidden>
                                </div> --}}
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Content <span class="text-danger">*</span></label>
                                <textarea name="content" id="content-editor" class="form-control" rows="5">{{ old('content') }}</textarea>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-lg btn-primary" id="submitBtn">Submit</button>
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

            // For Thumbnail
            $('#thumbnailInput').change(function() {
                previewImage('thumbnailInput', 'previewThumbnail');
            });
        });
    </script>
@endsection
