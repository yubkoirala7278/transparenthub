@extends('frontend.layouts.master')
@section('content')
    <section class="top-add-wrapper mt-0">
        <div class="">
            <img class="top-add-gif" src="{{asset('frontend/gif/main-2.gif')}}" alt="..." loading="lazy">
        </div>
    </section>

    <div class="blog-detail container-fluid mt-5">
        <div class="row">
            <!-- Blog Detail Section -->
            <div class="col-lg-8">
                <img src="{{asset($blog->image)}}" class="img-fluid rounded mb-4 w-100" alt="Blog Image" loading="lazy">
                <div class="mb-4">
                    <div class="page-title">
                        <h1 class="title fw-bold">{{$blog->title}}</h1>
                    </div>
                    <p class="">Published on <span class="fw-semibold">{{ $blog->created_at->format('M j, Y') }}</span></p>

                </div>
                {!!$blog->description!!}
            </div>

            <!-- Recent Blogs Section -->
            <div class="col-lg-4">
                <h3 class="fw-bold mb-4 primary-text fs-5">Recent Blogs</h3>
                 @if(count($recentBlogs)>0)
                    @foreach ($recentBlogs as $blog)
                    <div class="card mb-3 border-0 shadow">
                        <div class="row g-0">
                            <div class="col-4">
                                <a href="{{ route('blog.detail',$blog->slug) }}"><img src="{{asset($blog->image)}}" class="img-fluid h-100 rounded-start"
                                        alt="Blog Image" loading="lazy"></a>
                            </div>
                            <div class="col-8">
                                <div class="card-body">
                                    <a href="{{ route('blog.detail',$blog->slug) }}" class="text-decoration-none">
                                        <h5 class="card-title primary-text fw-bold fs-6">{{$blog->title}}</h5>
                                        <p class="card-text text-dark">{{ \Illuminate\Support\Str::limit(strip_tags($blog->description), 90) }}</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                 @endif
               
            </div>
        </div>
    </div>
@endsection
