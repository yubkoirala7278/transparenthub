@extends('frontend.layouts.master')
@section('content')

    <section class="top-add-wrapper mt-0">
        <div class="">
            <img class="top-add-gif" src="{{asset('frontend/gif/main-2.gif')}}" alt="..." loading="lazy">
        </div>
    </section>

    <div class="blog container-fluid">
        <div class="row justify-content-center py-5">
            <div class="col-lg-8 text-center">
                <div class="page-title">
                    <h1 class="title">Our Blog</h1>
                </div>
                <p class="">Discover the latest news, insights, and stories from our team. Stay informed and inspired.</p>
            </div>
        </div>

        <div class="row py-4">

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card border-0 shadow">
                    <img src="{{asset('frontend/img/about/about-1.png')}}" class="card-img-top blog-list-image" alt="Blog Image">
                    <div class="card-body">
                        <h5 class="card-title primary-text font-bold">Blog Post Title</h5>
                        <p class="card-text">A brief overview of the blog post content to engage readers and entice them to learn more.</p>
                        <a href="{{ route('blog.detail') }}" class="btn btn-danger">Read More</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card border-0 shadow">
                    <img src="{{asset('frontend/img/about/about-2.jpg')}}" class="card-img-top blog-list-image" alt="Blog Image">
                    <div class="card-body">
                        <h5 class="card-title primary-text fw-bold">Another Blog Post</h5>
                        <p class="card-text">Explore this insightful article to gain a deeper understanding of the topic.</p>
                        <a href="{{ route('blog.detail') }}" class="btn btn-danger">Read More</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card border-0 shadow">
                    <img src="{{asset('frontend/img/news/news.jpg')}}" class="card-img-top blog-list-image" alt="Blog Image">
                    <div class="card-body">
                        <h5 class="card-title primary-text fw-bold">Another Blog Post</h5>
                        <p class="card-text">Explore this insightful article to gain a deeper understanding of the topic.</p>
                        <a href="{{ route('blog.detail') }}" class="btn btn-danger">Read More</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card border-0 shadow">
                    <img src="{{asset('frontend/img/news/news.jpg')}}" class="card-img-top blog-list-image" alt="Blog Image">
                    <div class="card-body">
                        <h5 class="card-title primary-text fw-bold">Another Blog Post</h5>
                        <p class="card-text">Explore this insightful article to gain a deeper understanding of the topic.</p>
                        <a href="{{ route('blog.detail') }}" class="btn btn-danger">Read More</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card border-0 shadow">
                    <img src="{{asset('frontend/img/about/about-2.jpg')}}" class="card-img-top blog-list-image" alt="Blog Image">
                    <div class="card-body">
                        <h5 class="card-title primary-text fw-bold">Another Blog Post</h5>
                        <p class="card-text">Explore this insightful article to gain a deeper understanding of the topic.</p>
                        <a href="{{ route('blog.detail') }}" class="btn btn-danger">Read More</a>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card border-0 shadow">
                    <img src="{{asset('frontend/img/about/about-1.png')}}" class="card-img-top blog-list-image" alt="Blog Image">
                    <div class="card-body">
                        <h5 class="card-title primary-text font-bold">Blog Post Title</h5>
                        <p class="card-text">A brief overview of the blog post content to engage readers and entice them to learn more.</p>
                        <a href="{{ route('blog.detail') }}" class="btn btn-danger">Read More</a>
                    </div>
                </div>
            </div>

        </div>


        <div class="d-flex justify-content-center mt-5">
            <div class="pagination">
                <ul class="ps-0 pagination-menus">
                    <li class="pagination-link">
                        <a href="" class="link active"><i class="fa-solid fa-chevron-left"></i></a>
                    </li>
                    <li class="pagination-link">
                        <a href="" class="link">1</a>
                    </li>
                    <li class="pagination-link">
                        <a href="" class="link">2</a>
                    </li>
                    <li class="pagination-link">
                        <a href="" class="link">3</a>
                    </li>
                    <li class="pagination-link">
                        <a href="" class="link">...</a>
                    </li>
                    <li class="pagination-link">
                        <a href="" class="link">9</a>
                    </li>
                    <li class="pagination-link">
                        <a href="" class="link">10</a>
                    </li>
                    <li class="pagination-link">
                        <a href="" class="link"><i class="fa-solid fa-chevron-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>


@endsection
