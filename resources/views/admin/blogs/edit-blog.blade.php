@extends('layouts/admin-main')
@section('title', 'Edit Blog')
@section('content')
    <main class="p-4 sm:p-6 lg:p-8">
        <div id="blogFormSection">
            <div class="mb-6">
                <a href="{{ route('blogs') }}" class="text-gray-600 hover:text-gray-900 flex items-center space-x-2 mb-4">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Blogs</span>
                </a>
                <h2 class="text-gray-900 text-2xl font-bold mb-1">Edit Blog Post</h2>
                <p class="text-gray-500 text-sm">Update your content for your readers</p>
            </div>

            @include('include.alerts')

            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4 sm:p-6 lg:p-8">
                <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data"
                    id="blogForm">
                    @csrf
                    @method('PATCH') <div class="mb-8">
                        <h3 class="text-gray-900 text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-pen mr-2 text-pink-600"></i>
                            Blog Details
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block font-semibold">Blog Title *</label>
                                <input type="text" name="title" required value="{{ old('title', $blog->title) }}"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="Enter blog title">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="text-gray-700 text-sm mb-2 block font-semibold">Author (Optional)</label>
                                    <input type="text" name="author" value="{{ old('author', $blog->author) }}"
                                        class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                        placeholder="Author Name">
                                </div>
                                <div>
                                    <label class="text-gray-700 text-sm mb-2 block font-semibold">Category *</label>
                                    <select name="category" required
                                        class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                        <option value="" disabled>Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @selected(old('category', $blog->category) == $category->id)>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="text-gray-700 text-sm mb-2 block font-semibold">Status *</label>
                                    <select name="status" required
                                        class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                        <option value="published" @selected(old('status', $blog->status) == 'published')>Published</option>
                                        <option value="draft" @selected(old('status', $blog->status) == 'draft')>Draft</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                                <div>
                                    <label class="text-gray-700 text-sm mb-2 block font-semibold">Featured Thumbnail (Leave
                                        blank to keep current)</label>
                                    <input type="file" name="thumbnail" id="thumbnailInput" accept="image/*"
                                        class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">

                                    <img id="previewThumbnail" src="{{ $blog->thumbnail ? asset($blog->thumbnail) : '' }}"
                                        alt="Preview"
                                        class="mt-3 rounded-lg max-h-64 border {{ $blog->thumbnail ? '' : 'hidden' }}">
                                </div>
                            </div>

                            <div>
                                <label class="text-gray-700 text-sm mb-2 block"><span class="font-semibold">Excerpt*</span>
                                    <i>(Brief detail of the blog to show in card)</i></label>
                                <textarea rows="3" name="excerpt"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="Brief description...">{{ old('excerpt', $blog->excerpt) }}</textarea>
                            </div>

                            <div>
                                <label class="text-gray-700 text-sm mb-2 block font-semibold">Content *</label>
                                <textarea name="content" id="content-editor" rows="12"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">{{ old('content', $blog->content) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-gray-900 text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-search mr-2 text-blue-600"></i>
                            SEO Settings
                        </h3>
                        <div class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-gray-700 text-sm mb-2 block font-semibold">Meta Keywords</label>
                                    <input type="text" name="meta_keywords"
                                        value="{{ old('meta_keywords', $blog->meta_keywords) }}"
                                        class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                </div>
                                <div>
                                    <label class="text-gray-700 text-sm mb-2 block font-semibold">Meta Description</label>
                                    <input type="text" name="meta_description"
                                        value="{{ old('meta_description', $blog->meta_description) }}"
                                        class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-gray-700 text-sm mb-2 block font-semibold">Meta Image (OG)</label>
                                    <input type="file" name="og_image" id="og_image" accept="image/*"
                                        onchange="previewImage('og_image', 'og_image_preview')"
                                        class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">

                                    <img id="og_image_preview" src="{{ $blog->og_image ? asset($blog->og_image) : '' }}"
                                        class="mt-2 rounded-md max-h-32 {{ $blog->og_image ? '' : 'hidden' }}">
                                </div>
                                <div>
                                    <label class="text-gray-700 text-sm mb-2 block font-semibold">Twitter Image</label>
                                    <input type="file" name="twitter_image" id="twitter_image" accept="image/*"
                                        onchange="previewImage('twitter_image', 'twitter_image_preview')"
                                        class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">

                                    <img id="twitter_image_preview"
                                        src="{{ $blog->twitter_image ? asset($blog->twitter_image) : '' }}"
                                        class="mt-2 rounded-md max-h-32 {{ $blog->twitter_image ? '' : 'hidden' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="submit" id="submitBtn"
                            class="flex-1 bg-gradient-to-r from-pink-600 to-pink-700 hover:from-pink-700 hover:to-pink-800 text-white px-6 py-3 rounded-lg font-bold transition-all shadow-lg hover:shadow-xl">
                            <i class="fas fa-save mr-2"></i>Update Blog
                        </button>
                        <button type="button" onclick="window.history.back()"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-900 px-6 py-3 rounded-lg font-medium transition-all">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        // Unified Preview Logic
        function previewImage(inputId, previewId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Event listener for main thumbnail
        document.getElementById('thumbnailInput').addEventListener('change', function() {
            previewImage('thumbnailInput', 'previewThumbnail');
        });
    </script>
@endsection
