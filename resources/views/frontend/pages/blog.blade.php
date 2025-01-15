@extends('frontend.layouts.master')
@section('content')
    <section class="top-add-wrapper mt-0">
        <div class="">
            <img class="top-add-gif" src="{{ asset('frontend/gif/main-2.gif') }}" alt="..." loading="lazy">
        </div>
    </section>

    <div class="blog container-fluid">
        <div class="row justify-content-center py-5">
            <div class="col-lg-8 text-center">
                <div class="page-title">
                    <h1 class="title">Our Blog</h1>
                </div>
                <p class="">Discover the latest news, insights, and stories from our team. Stay informed and inspired.
                </p>
            </div>
        </div>

        <div class="row" id="blog-list">
            @if (count($blogs) > 0)
                @foreach ($blogs as $blog)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card border-0 shadow">
                            <img src="{{ asset($blog->image) }}" class="card-img-top blog-list-image" alt="Blog Image"
                                loading="lazy">
                            <div class="card-body">
                                <h5 class="card-title primary-text font-bold">{{ $blog->title }}</h5>
                                <p class="card-text">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($blog->description), 90) }}
                                </p>
                                <a href="{{ route('blog.detail', $blog->slug) }}" class="btn btn-danger">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <!-- Custom Pagination -->
        <div id="pagination-container" class="d-flex justify-content-center">
            {{ $blogs->links('pagination::custom-pagination') }}
        </div>
    </div>
@endsection

@push('script')
    <script>
        // Handle AJAX Pagination
        $(document).on('click', '.page-link', function(e) {
            e.preventDefault();

            var page = $(this).attr('href').split('page=')[1];
            fetchBlogs(page);
        });

        function fetchBlogs(page) {
            $.ajax({
                url: '/blog?page=' + page,
                type: 'GET',
                success: function(data) {
                    $('#blog-list').html(data.blogs);
                    $('#pagination-container').html(data.pagination);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        }
    </script>
@endpush
