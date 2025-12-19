@extends('layouts/admin-main')
@section('title', 'Manage Blogs')
@section('content')
    <div class="container-fluid p-0">

        <div class="row mb-3 d-flex justify-content-between">
            <div class="col">
                <h1 class="h3 d-inline align-middle">Manage Blogs</h1>
            </div>
            <div class="col-auto">
                <a type="button" class="btn btn-primary" href="{{ route('blogs.create') }}">
                    Create New Blog
                </a>
            </div>
        </div>

        <!-- List of Blog Posts -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Thumbnail</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Views</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogs as $blog)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if (is_null($blog->thumbnail))
                                                    <img src="https://via.placeholder.com/100x80" alt="case_study_thumbnail">
                                                @else
                                                    <img src="{{ asset($blog->thumbnail) }}" alt="thumbnail" width="120"
                                                        height="80">
                                                @endif
                                            </td>
                                            <td>{{ $blog->title }}</td>
                                            <td>{{ $blog->author }}</td>
                                            <td>{{ $blog->views }}</td>
                                            <td>{{ $blog->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <button class="btn-toggle changeStatusBtn {{ $blog->status == 1 ? 'active' : ''}}" data-blog-id="{{ $blog->id }}">
                                                    <span class="toggle-icon"></span>
                                                </button>
                                            </td>
                                            <td>
                                                <a href="{{ route('blogs.edit', $blog->id) }}"
                                                    class="btn btn-primary btn-sm"><i data-feather="edit"></i></a>
                                                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure? You want to delete this blog.')"><i
                                                            data-feather="trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
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
