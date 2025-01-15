@foreach ($blogs as $blog)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card border-0 shadow">
            <img src="{{ asset($blog->image) }}" class="card-img-top blog-list-image" alt="Blog Image" loading="lazy">
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