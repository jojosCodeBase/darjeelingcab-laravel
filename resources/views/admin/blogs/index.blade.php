@extends('layouts/admin-main')
@section('title', 'Manage Blogs')
@section('content')
    <!-- Main Content -->
    <main class="p-4 sm:p-6 lg:p-8">
        <!-- BLOGS SECTION -->
        <div id="blogsSection">
            <!-- Header with Actions -->
            <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h3 class="text-gray-900 text-xl font-bold mb-1">All Blog Posts</h3>
                    <p class="text-gray-500 text-sm">Write and publish blog articles</p>
                </div>
                <button id="createBlogBtn"
                    class="bg-gradient-to-r from-pink-600 to-pink-700 hover:from-pink-700 hover:to-pink-800 text-white px-6 py-3 rounded-lg font-medium transition-all shadow-lg hover:shadow-xl flex items-center justify-center space-x-2">
                    <i class="fas fa-pen"></i>
                    <span>Write New Post</span>
                </button>
            </div>

            <!-- Filters and Search -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4 sm:p-6 mb-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="lg:col-span-2">
                        <label class="text-gray-600 text-sm mb-2 block">Search Blogs</label>
                        <div class="flex items-center bg-gray-100 rounded-lg px-4 py-2">
                            <i class="fas fa-search text-gray-400 mr-2"></i>
                            <input type="text" id="searchBlog" placeholder="Title, content..."
                                class="bg-transparent text-gray-900 outline-none text-sm w-full">
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label class="text-gray-600 text-sm mb-2 block">Status</label>
                        <select id="statusFilter"
                            class="w-full bg-gray-100 text-gray-900 rounded-lg px-4 py-2 outline-none border border-gray-200 focus:border-blue-500">
                            <option value="all">All Status</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>

                    <!-- Category Filter -->
                    <div>
                        <label class="text-gray-600 text-sm mb-2 block">Category</label>
                        <select id="categoryFilter"
                            class="w-full bg-gray-100 text-gray-900 rounded-lg px-4 py-2 outline-none border border-gray-200 focus:border-blue-500">
                            <option value="all">All Categories</option>
                            <option value="travel">Travel Tips</option>
                            <option value="destinations">Destinations</option>
                            <option value="guides">Guides</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Blogs Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($blogs as $blog)
                    <div
                        class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-shadow flex flex-col">
                        <div class="h-48 bg-gray-100 overflow-hidden relative">
                            @if (is_null($blog->thumbnail))
                                <img src="https://via.placeholder.com/400x250?text=No+Thumbnail" alt="placeholder"
                                    class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset($blog->thumbnail) }}" alt="{{ $blog->title }}"
                                    class="w-full h-full object-cover">
                            @endif

                            <div class="absolute top-3 right-3">
                                @if ($blog->status == 1)
                                    <span
                                        class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold shadow-sm">Published</span>
                                @else
                                    <span
                                        class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold shadow-sm">Draft</span>
                                @endif
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-center justify-between mb-3">
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                                    <i class="fas fa-user mr-1"></i> {{ $blog->author ?? 'NA' }}
                                </span>

                                <button
                                    class="changeStatusBtn flex items-center {{ $blog->status == 1 ? 'text-green-600' : 'text-gray-400' }}"
                                    data-blog-id="{{ $blog->id }}" title="Toggle Status">
                                    <i class="fas {{ $blog->status == 1 ? 'fa-toggle-on' : 'fa-toggle-off' }} text-xl"></i>
                                </button>
                            </div>

                            <h3 class="text-gray-900 font-bold text-lg mb-2 line-clamp-2">{{ Str::limit($blog->title, 35) }}</h3>

                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ strip_tags($blog->content) ?? 'No description available for this post...' }}
                            </p>

                            <div class="mt-auto">
                                <div class="flex items-center justify-between text-sm text-gray-500 mb-4 border-t pt-4">
                                    <span><i class="fas fa-calendar-alt mr-1"></i>
                                        {{ $blog->created_at->format('M d, Y') }}</span>
                                    <span><i class="fas fa-eye mr-1"></i> {{ number_format($blog->views) }} views</span>
                                </div>

                                <div class="flex items-center space-x-2">
                                    <button
                                        class="viewBlogBtn flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                        <i class="fas fa-eye mr-2"></i>View
                                    </button>

                                    <button
                                        class="editBlogBtn flex-1 bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                        <a href="{{ route('blogs.edit', $blog->id) }}">
                                            <i class="fas fa-edit mr-2"></i>Edit
                                        </a>
                                    </button>

                                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-50 text-red-600 border border-red-100 hover:bg-red-600 hover:text-white rounded-lg text-sm transition-all"
                                            onclick="return confirm('Are you sure? You want to delete this blog.')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- CREATE/EDIT BLOG FORM -->
        <div id="blogFormSection" class="hidden">
            <div class="mb-6">
                <button id="backToListBtn" class="text-gray-600 hover:text-gray-900 flex items-center space-x-2 mb-4">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Blogs</span>
                </button>
                <h2 class="text-gray-900 text-2xl font-bold mb-1" id="formTitle">Write New Blog Post</h2>
                <p class="text-gray-500 text-sm">Create engaging content for your readers</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4 sm:p-6 lg:p-8">
                <form id="blogForm">
                    <!-- Blog Details -->
                    <div class="mb-8">
                        <h3 class="text-gray-900 text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-pen mr-2 text-pink-600"></i>
                            Blog Details
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Blog Title *</label>
                                <input type="text" required
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="Enter blog title">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-gray-700 text-sm mb-2 block">Category *</label>
                                    <select required
                                        class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                        <option value="">Select category</option>
                                        <option value="travel">Travel Tips</option>
                                        <option value="destinations">Destinations</option>
                                        <option value="guides">Guides</option>
                                        <option value="news">News</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="text-gray-700 text-sm mb-2 block">Status *</label>
                                    <select required
                                        class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                        <option value="draft">Draft</option>
                                        <option value="published">Published</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Featured Image URL</label>
                                <input type="url"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="https://example.com/image.jpg">
                            </div>
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Excerpt</label>
                                <textarea rows="3"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="Brief description of the blog post..."></textarea>
                            </div>
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Content *</label>
                                <textarea rows="12" required
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="Write your blog content here..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- SEO Settings -->
                    <div class="mb-8">
                        <h3 class="text-gray-900 text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-search mr-2 text-blue-600"></i>
                            SEO Settings
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Meta Title</label>
                                <input type="text"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="SEO optimized title">
                            </div>
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Meta Description</label>
                                <textarea rows="2"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="SEO meta description..."></textarea>
                            </div>
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Keywords (comma separated)</label>
                                <input type="text"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="darjeeling, travel, tourism">
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-pink-600 to-pink-700 hover:from-pink-700 hover:to-pink-800 text-white px-6 py-3 rounded-lg font-medium transition-all shadow-lg hover:shadow-xl">
                            <i class="fas fa-save mr-2"></i>Publish Blog
                        </button>
                        <button type="button" id="saveDraftBtn"
                            class="flex-1 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white px-6 py-3 rounded-lg font-medium transition-all shadow-lg hover:shadow-xl">
                            <i class="fas fa-file mr-2"></i>Save as Draft
                        </button>
                        <button type="button" id="cancelFormBtn"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-900 px-6 py-3 rounded-lg font-medium transition-all">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Mobile menu toggle
        const sidebar = document.getElementById('sidebar');
        const openSidebar = document.getElementById('openSidebar');
        const closeSidebar = document.getElementById('closeSidebar');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');

        openSidebar.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            mobileMenuOverlay.classList.remove('hidden');
        });

        closeSidebar.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            mobileMenuOverlay.classList.add('hidden');
        });

        mobileMenuOverlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            mobileMenuOverlay.classList.add('hidden');
        });

        // Create Blog Button
        document.getElementById('createBlogBtn').addEventListener('click', () => {
            document.getElementById('blogsSection').classList.add('hidden');
            document.getElementById('blogFormSection').classList.remove('hidden');
            document.getElementById('formTitle').textContent = 'Write New Blog Post';
            document.getElementById('blogForm').reset();
        });

        // Back to List Button
        document.getElementById('backToListBtn').addEventListener('click', () => {
            document.getElementById('blogFormSection').classList.add('hidden');
            document.getElementById('blogsSection').classList.remove('hidden');
        });

        // Cancel Form Button
        document.getElementById('cancelFormBtn').addEventListener('click', () => {
            document.getElementById('blogFormSection').classList.add('hidden');
            document.getElementById('blogsSection').classList.remove('hidden');
        });

        // Save Draft Button
        document.getElementById('saveDraftBtn').addEventListener('click', () => {
            alert('Blog saved as draft!');
            document.getElementById('blogFormSection').classList.add('hidden');
            document.getElementById('blogsSection').classList.remove('hidden');
        });

        // Edit Blog Buttons
        document.querySelectorAll('.editBlogBtn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('blogsSection').classList.add('hidden');
                document.getElementById('blogFormSection').classList.remove('hidden');
                document.getElementById('formTitle').textContent = 'Edit Blog Post';
            });
        });

        // View Blog Buttons
        document.querySelectorAll('.viewBlogBtn').forEach(btn => {
            btn.addEventListener('click', () => {
                alert('View blog post (to be implemented)');
            });
        });

        // Delete Blog
        document.querySelectorAll('.deleteBlogBtn').forEach(btn => {
            btn.addEventListener('click', () => {
                if (confirm('Are you sure you want to delete this blog post?')) {
                    alert('Blog post deleted successfully!');
                }
            });
        });

        // Form Submission
        document.getElementById('blogForm').addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Blog post published successfully!');
            document.getElementById('blogFormSection').classList.add('hidden');
            document.getElementById('blogsSection').classList.remove('hidden');
        });
    </script>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.changeStatusBtn').on('click', function() {

                var button = $(this);
                let newStatus = 1;

                let blogId = $(this).data('blog-id');

                $.ajax({
                    url: "{{ route('blogs.update-status') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        blog_id: blogId,
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.success == 'published') {
                            button.addClass('active');
                        } else {
                            button.removeClass('active');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating status:', error);
                        // Handle error appropriately
                    }
                });
            });
        });
    </script>
@endsection
