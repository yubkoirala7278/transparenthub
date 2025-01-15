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
                <img src="{{asset('frontend/img/about/about-2.jpg')}}" class="img-fluid rounded mb-4" alt="Blog Image">
                <div class="mb-4">
                    <div class="page-title">
                        <h1 class="title fw-bold">Blog Title Here</h1>
                    </div>
                    <p class="">By <span class="fw-semibold">Author Name</span> | Published on <span
                            class="fw-semibold">Jan 3, 2025</span></p>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nunc ut bibendum tincidunt,
                    nulla purus facilisis nisi, in accumsan odio orci quis turpis. Suspendisse potenti.</p>
                <p>Phasellus a augue eget nulla feugiat interdum. Duis vitae justo nec erat blandit tincidunt sit
                    amet in tortor. Vivamus hendrerit ex et leo sagittis, a viverra turpis interdum.</p>

            </div>

            <!-- Recent Blogs Section -->
            <div class="col-lg-4">
                <h3 class="fw-bold mb-4 primary-text fs-5">Recent Blogs</h3>

                <div class="card mb-3 border-0 shadow">
                    <div class="row g-0">
                        <div class="col-4">
                            <a href=""><img src="{{asset('frontend/img/about/about-1.png')}}" class="img-fluid h-100 rounded-start"
                                    alt="Blog Image"></a>
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <a href="" class="text-decoration-none">
                                    <h5 class="card-title primary-text fw-bold fs-6">Recent Blog Title</h5>
                                    <p class="card-text text-dark">A short snippet of the recent blog.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3 border-0 shadow">
                    <div class="row g-0">
                        <div class="col-4">
                            <a href=""><img src="{{asset('frontend/img/about/about-2.jpg')}}" class="img-fluid h-100 rounded-start"
                                    alt="Blog Image"></a>
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <a href="" class="text-decoration-none">
                                    <h5 class="card-title primary-text fw-bold fs-6">Recent Blog Title</h5>
                                    <p class="card-text text-dark">A short snippet of the recent blog.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3 border-0 shadow">
                    <div class="row g-0">
                        <div class="col-4">
                            <a href=""><img src="{{asset('frontend/img/about/about-1.png')}}" class="img-fluid h-100 rounded-start"
                                    alt="Blog Image"></a>
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <a href="" class="text-decoration-none">
                                    <h5 class="card-title primary-text fw-bold fs-6">Recent Blog Title</h5>
                                    <p class="card-text text-dark">A short snippet of the recent blog.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
