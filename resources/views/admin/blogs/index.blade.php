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
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    <button type="button" onclick="toggleCategoryModal()"
                        class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-lg font-medium transition-all shadow-lg hover:shadow-xl flex items-center justify-center space-x-2">
                        <i class="fa-regular fa-square-plus mr-2"></i> Manage Categories
                    </button>

                    <a href="{{ route('blogs.create') }}">
                        <button
                            class="bg-gradient-to-r from-pink-600 to-pink-700 hover:from-pink-700 hover:to-pink-800 text-white px-6 py-3 rounded-lg font-medium transition-all shadow-lg hover:shadow-xl flex items-center justify-center space-x-2">
                            <i class="fas fa-pen"></i>
                            <span>Write New Post</span>
                        </button>
                    </a>
                </div>
            </div>

            @include('include.alerts')

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
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Blogs Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($blogs as $blog)
                    <div
                        class="blog-card bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-shadow flex flex-col">
                        <div class="h-48 bg-gray-100 overflow-hidden relative">
                            @if (is_null($blog->thumbnail))
                                <img src="https://via.placeholder.com/400x250?text=No+Thumbnail" alt="placeholder"
                                    class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset($blog->thumbnail) }}" alt="{{ $blog->title }}"
                                    class="w-full h-full object-cover">
                            @endif

                            <div class="absolute top-3 right-3">
                                <span
                                    class="card-status-badge px-3 py-1 rounded-full text-xs font-bold shadow-sm {{ $blog->status == 'published' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($blog->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-center justify-between mb-3">
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                                    {{ $blog->categoryDetails->name ?? 'NA' }}
                                </span>

                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer changeStatusBtn"
                                        data-blog-id="{{ $blog->id }}"
                                        {{ $blog->status == 'published' ? 'checked' : '' }}>

                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer 
                                        peer-checked:after:translate-x-full peer-checked:after:border-white 
                                        after:content-[''] after:absolute after:top-[2px] after:left-[2px] 
                                        after:bg-white after:border-gray-300 after:border after:rounded-full 
                                        after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600">
                                    </div>
                                </label>

                            </div>

                            <h3 class="text-gray-900 font-bold text-lg mb-2 line-clamp-2">
                                {{ Str::limit($blog->title, 35) }}
                            </h3>

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
                                    <a href="{{ route('view-blog', ['slug' => $blog->slugged_title]) }}" target="_blank"
                                        class="flex-1">
                                        <button
                                            class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                            <i class="fas fa-eye mr-2"></i>View
                                        </button>
                                    </a>

                                    <a href="{{ route('blogs.edit', $blog->id) }}" class="flex-1">
                                        <button type="button"
                                            class="w-full bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                            <i class="fas fa-edit mr-2"></i>Edit
                                        </button>
                                    </a>

                                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST"
                                        class="inline flex-none">
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
    </main>

    <div id="categoryModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
                class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">

                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-b">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-900" id="modal-title">Manage Categories</h3>
                        <button type="button" onclick="toggleCategoryModal()" class="text-gray-400 hover:text-gray-500">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>

                <div class="bg-white px-4 py-6 sm:p-6">
                    <div class="mb-6 bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Add New Category</label>
                        <div class="flex gap-2">
                            <input type="text" id="newCategoryName" placeholder="Category Name"
                                class="flex-1 px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none">
                            <button type="button" onclick="addCategory()"
                                class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded-lg font-medium transition-all">
                                Add
                            </button>
                        </div>
                    </div>

                    <div class="max-h-60 overflow-y-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-xs font-bold text-gray-500 uppercase tracking-wider border-b">
                                    <th class="pb-2">Name</th>
                                    <th class="pb-2 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="categoryList" class="divide-y divide-gray-100">
                                @foreach ($categories as $category)
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button" onclick="toggleCategoryModal()"
                        class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('change', '.changeStatusBtn', function() {
            let checkbox = $(this);
            let blogId = checkbox.data('blog-id');
            let label = checkbox.closest('label').find('.status-label');

            // Find the badge related to THIS specific card
            let card = checkbox.closest('.blog-card');
            let badge = card.find('.card-status-badge');

            $.ajax({
                url: "{{ route('blogs.update-status') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    blog_id: blogId,
                },
                success: function(response) {
                    if (response.new_status === 'published') {
                        // Update to Green Badge
                        badge.text('Published')
                            .removeClass('bg-yellow-100 text-yellow-700')
                            .addClass('bg-green-100 text-green-700');
                    } else {
                        // Update to Yellow Badge
                        badge.text('Draft')
                            .removeClass('bg-green-100 text-green-700')
                            .addClass('bg-yellow-100 text-yellow-700');
                    }
                },
                error: function(xhr) {
                    // If error, revert the checkbox state so the UI stays accurate
                    checkbox.prop('checked', !checkbox.prop('checked'));
                    alert('Something went wrong. Please try again.');
                }
            });
        });

        const modal = document.getElementById('categoryModal');

        // --- Helper: CSRF Token for Laravel ---
        const getCsrf = () => document.querySelector('input[name="_token"]').value;

        // --- API: Load/Render Categories ---
        async function renderCategories() {
            const list = document.getElementById('categoryList');

            try {
                const response = await fetch("{{ route('categories') }}");
                const categories = await response.json();

                list.innerHTML = ''; // Clear current list
                categories.forEach(cat => {
                    list.innerHTML += `
                <tr class="group" id="cat-row-${cat.id}">
                    <td class="py-3 text-sm text-gray-700 font-medium category-name">${cat.name}</td>
                    <td class="py-3 text-right space-x-2">
                        <button type="button" onclick="editCategory(${cat.id}, '${cat.name}')" class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" onclick="deleteCategory(${cat.id})" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>`;
                });
                updateDropdown(categories);
            } catch (error) {
                console.error('Error fetching categories:', error);
            }
        }

        // --- API: Add Category ---
        async function addCategory() {
            const input = document.getElementById('newCategoryName');
            const name = input.value.trim();
            if (!name) return;

            try {
                const response = await fetch("{{ route('categories.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': getCsrf()
                    },
                    body: JSON.stringify({
                        name: name
                    })
                });

                if (response.ok) {
                    input.value = '';
                    renderCategories(); // Refresh list
                } else {
                    const errorData = await response.json();
                    alert(errorData);
                }
            } catch (error) {
                console.error('Error adding category:', error);
            }
        }

        // --- API: Edit (Update) Category ---
        async function editCategory(id, oldName) {
            const newName = prompt("Edit Category Name:", oldName);
            if (!newName || newName === oldName) return;

            try {
                const response = await fetch(`/admin/categories/${id}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': getCsrf()
                    },
                    body: JSON.stringify({
                        name: newName
                    })
                });

                if (response.ok) {
                    renderCategories();
                } else {
                    const errorData = await response.json();
                    alert(errorData);
                }
            } catch (error) {
                console.error('Error updating category:', error);
            }
        }

        // --- API: Delete Category ---
        async function deleteCategory(id) {
            if (!confirm('Are you sure? This may affect blogs using this category.')) return;

            try {
                const response = await fetch(`/admin/categories/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': getCsrf()
                    }
                });

                if (response.ok) {
                    renderCategories();
                } else {
                    const errorData = await response.json();
                    alert(errorData);
                };
            } catch (error) {
                console.error('Error deleting category:', error);
            }
        }

        function updateDropdown(categories) {
            const select = document.querySelector('select[name="category"]');
            if (!select) return;

            const currentValue = select.value;
            select.innerHTML = '<option value="">Select category</option>';
            categories.forEach(cat => {
                const opt = new Option(cat.name, cat.id);
                if (cat.id == currentValue) opt.selected = true;
                select.add(opt);
            });
        }

        function toggleCategoryModal() {
            modal.classList.toggle('hidden');
            if (!modal.classList.contains('hidden')) renderCategories();
        }
    </script>
@endsection
