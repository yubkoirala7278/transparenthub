@extends('frontend.layouts.master')
@section('custom-css')
<style>
    .box-title{
        color: black;
    }
    .box-title:hover{
        color: #0059AB;
    }
</style>
@endsection
@section('content')
    <section class="top-add-wrapper mt-0">
        <div class="">
            <img class="top-add-gif" src="{{ asset('frontend/gif/main-2.gif') }}" alt="..." loading="lazy">
        </div>
    </section>

    @if (count($bulletin_news) > 0)
        <section class="news-wrapper container-fluid">
            <div class="news-start">
                <div class="section-title">
                    <h2 class="fs-4 mb-3 title">समाचार बुलेटिन</h2>
                </div>
                <div id="top-news-slider">
                    <div class="top-news-slider">
                        @foreach ($bulletin_news as $key => $news)
                            <div class="item">
                                <div class="my-card mb-3 mx-2">
                                    <div class="row g-0">
                                        <div class="col-md-6">
                                            <a href="{{ route('news.view', ['slug' => $news->slug]) }}">
                                                <img src="{{ asset($news->image) }}" class="img-fluid h-100 news-image"
                                                    alt="News Image">
                                            </a>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-body">
                                                <a href="{{ route('news.view', ['slug' => $news->slug]) }}"
                                                    class="text-decoration-none">
                                                    <h5 class="card-title fs-5 fw-semibold">{{ $news->title }}</h5>
                                                </a>
                                                <a href="{{ route('news.view', ['slug' => $news->slug]) }}"
                                                    class="text-decoration-none">
                                                    <p class="card-text m-0 fs-6">
                                                        {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($news->description)), 70, '...') }}
                                                    </p>
                                                </a>

                                                <p class="card-text m-0 mt-2 mb-1">
                                                    <small>{{ $news->created_at->format('M d, Y') }}</small>
                                                </p>
                                                @if ($news->rss)
                                                    <div class="mt-1">
                                                        <div class="flex gap-1">
                                                            <p class="card-text m-0 mt-2 mb-1">RSS: {{ $news->rss }}</p>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif


    <section class="sort-news container-fluid">
        <div class="row gy-4">
            <div class="col-md-4">
                <div class="section-title">
                    <h2 class="fs-5 mb-3 title">ट्रेन्डिङ न्यूज</h2>
                </div>
                <div class="row g-2" data-masonry='{"percentPosition": true }'>
                    @if (count($trendingNews) > 0)
                        @foreach ($trendingNews as $news)
                            <div class="col-6">
                                <div class="news-tag-box px-2">
                                    <a href="{{ route('news.view', ['slug' => $news->slug]) }}" class="text-dark fs-5">
                                        {{ $news->title }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>

            <div class="col-md-4 literature">

                <div class="section-title">
                    <h2 class="fs-5 mb-3 title">साहित्य / ब्लग</h2>
                </div>

                <div class="row gy-1 gx-2">
                    @if(count($sahitya_blog_news)>0)
                        @foreach ($sahitya_blog_news as $sahitya_blog)
                        <div class="box">
                            <div class="row gx-2 align-items-center">
                                <div class="col-3">
                                    <a href="{{ route('news.view', ['slug' => $sahitya_blog->slug]) }}" class="news-link">
                                        <img src="{{ asset($sahitya_blog->image) }}" class="w-100 img-fluid"
                                            alt="{{$sahitya_blog->title}}">
                                    </a>
                                </div>
                                <div class="col-9">
                                    <a href="{{ route('news.view', ['slug' => $sahitya_blog->slug]) }}" class="news-link">
                                        <p class="box-title m-0 p-0 fs-5">
                                            {{$sahitya_blog->title}}
                                        </p>
                                       
                                    </a>
                                    <div class="d-flex align-items-center" style="column-gap: 20px">
                                        <p class="text-muted small mb-0">
                                            {{ $sahitya_blog->created_at->format('M d, Y') }}
                                        </p>
                                        <button class="btn btn-transparent p-0 btn-sm share-button"
                                            onclick="shareOnFacebook('{{ route('news.view', ['slug' => $sahitya_blog->slug]) }}')">
                                            <i class="fa-regular fa-share-from-square"></i> सेयर
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>

            </div>

            <div class="col-md-4 popular">

                <div class="section-title">
                    <h2 class="fs-5 mb-3 title">लोकप्रिय</h2>
                </div>

                <div class="row gy-1 gx-2">
                    @if(count($lokPriyaNews)>0)
                        @foreach ($lokPriyaNews as $lokPriya)
                        <div class="box">
                            <div class="row gx-2 align-items-center">
                                <div class="col-md-12">
                                    <div href="{{ route('news.view', ['slug' => $lokPriya->slug]) }}" class="news-link">
                                        <a href="{{ route('news.view', ['slug' => $lokPriya->slug]) }}" class="box-title m-0 p-0 text-decoration-none fs-5">
                                            {{$lokPriya->title}}
                                        </a>
                                        <div class="d-flex align-items-center" style="column-gap: 20px">
                                            <p class="text-muted small mb-0">
                                                {{ $lokPriya->created_at->format('M d, Y') }}
                                            </p>
                                            <button class="btn btn-transparent p-0 btn-sm share-button"
                                                onclick="shareOnFacebook('{{ route('news.view', ['slug' => $lokPriya->slug]) }}')">
                                                <i class="fa-regular fa-share-from-square"></i> सेयर
                                            </button>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>

            </div>
        </div>

    </section>

    <section class="mt-5 hr w-100"></section>

    <section class="container-fluid professionalist" id="home-professional">
        <div class="section-title">
            <h2 class="fs-5 mb-3 title">हाम्रो विशेषज्ञहरु</h2>
        </div>


        <div class="professional-slider g-3 mt-4">

            <div class="item px-2">
                <div class="box shadow">
                    <img src="{{ asset('frontend/img/professional/team-1.jpg') }}" class="w-100" alt="Dr. John Doe">
                    <div class="box-body">
                        <p class="m-0"><strong>Dr. John Doe</strong></p>
                        <small>MBBS, MD (Professional)</small>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                style="font-size: 13px;">View</a>
                            <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="item px-2">
                <div class="box shadow">
                    <img src="{{ asset('frontend/img/professional/team-2.jpg') }}" class="w-100" alt="Dr. John Doe">
                    <div class="box-body">
                        <p class="m-0"><strong>Dr. John Doe</strong></p>
                        <small>MBBS, MD (Professional)</small>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                style="font-size: 13px;">View</a>
                            <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="item px-2">
                <div class="box shadow">
                    <img src="{{ asset('frontend/img/professional/team-1.jpg') }}" class="w-100" alt="Dr. John Doe">
                    <div class="box-body">
                        <p class="m-0"><strong>Dr. John Doe</strong></p>
                        <small>MBBS, MD (Professional)</small>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                style="font-size: 13px;">View</a>
                            <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="item px-2">
                <div class="box shadow">
                    <img src="{{ asset('frontend/img/professional/team-3.jpg') }}" class="w-100" alt="Dr. John Doe">
                    <div class="box-body">
                        <p class="m-0"><strong>Dr. John Doe</strong></p>
                        <small>MBBS, MD (Professional)</small>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                style="font-size: 13px;">View</a>
                            <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="item px-2">
                <div class="box shadow">
                    <img src="{{ asset('frontend/img/professional/team-4.jpg') }}" class="w-100" alt="Dr. John Doe">
                    <div class="box-body">
                        <p class="m-0"><strong>Dr. John Doe</strong></p>
                        <small>MBBS, MD (Professional)</small>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                style="font-size: 13px;">View</a>
                            <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="item px-2">
                <div class="box shadow">
                    <img src="{{ asset('frontend/img/professional/team-4.jpg') }}" class="w-100" alt="Dr. John Doe">
                    <div class="box-body">
                        <p class="m-0"><strong>Dr. John Doe</strong></p>
                        <small>MBBS, MD (Professional)</small>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                style="font-size: 13px;">View</a>
                            <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="item px-2">
                <div class="box shadow">
                    <img src="{{ asset('frontend/img/professional/team-4.jpg') }}" class="w-100" alt="Dr. John Doe">
                    <div class="box-body">
                        <p class="m-0"><strong>Dr. John Doe</strong></p>
                        <small>MBBS, MD (Professional)</small>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                style="font-size: 13px;">View</a>
                            <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="item px-2">
                <div class="box shadow">
                    <img src="{{ asset('frontend/img/professional/team-3.jpg') }}" class="w-100" alt="Dr. John Doe">
                    <div class="box-body">
                        <p class="m-0"><strong>Dr. John Doe</strong></p>
                        <small>MBBS, MD (Professional)</small>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                style="font-size: 13px;">View</a>
                            <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="item px-2">
                <div class="box shadow">
                    <img src="{{ asset('frontend/img/professional/team-2.jpg') }}" class="w-100" alt="Dr. John Doe">
                    <div class="box-body">
                        <p class="m-0"><strong>Dr. John Doe</strong></p>
                        <small>MBBS, MD (Professional)</small>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                style="font-size: 13px;">View</a>
                            <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="item px-2">
                <div class="box shadow">
                    <img src="{{ asset('frontend/img/professional/team-1.jpg') }}" class="w-100" alt="Dr. John Doe">
                    <div class="box-body">
                        <p class="m-0"><strong>Dr. John Doe</strong></p>
                        <small>MBBS, MD (Professional)</small>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                style="font-size: 13px;">View</a>
                            <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="item px-2">
                <div class="box shadow">
                    <img src="{{ asset('frontend/img/professional/team-2.jpg') }}" class="w-100" alt="Dr. John Doe">
                    <div class="box-body">
                        <p class="m-0"><strong>Dr. John Doe</strong></p>
                        <small>MBBS, MD (Professional)</small>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                style="font-size: 13px;">View</a>
                            <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="item px-2">
                <div class="box shadow">
                    <img src="{{ asset('frontend/img/professional/team-1.jpg') }}" class="w-100" alt="Dr. John Doe">
                    <div class="box-body">
                        <p class="m-0"><strong>Dr. John Doe</strong></p>
                        <small>MBBS, MD (Professional)</small>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                style="font-size: 13px;">View</a>
                            <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>


    <section class="container-fluid">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6">
                <div class="section-title">
                    <h2 class="fs-5 mb-3 title">Weather Forecast</h2>
                </div>
                <div class="forex" style="max-height: 278px;">
                    <div class="weather-box">
                        <div class="forecast">
                            <span class="icon">🌥️</span>
                            <p class="temp">20°C</p>
                            <p class="condition">Mostly Cloudy</p>
                        </div>
                        <div class="forecast">
                            <span class="icon">🌧️</span>
                            <p class="temp">22°C</p>
                            <p class="condition">Mostly Rainy</p>
                        </div>
                        <div class="forecast">
                            <span class="icon">☀️</span>
                            <p class="temp">29°C</p>
                            <p class="condition">Mostly Sunny</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="section-title">
                    <h2 class="fs-5 mb-3 title">Gold & Silver Rates</h2>
                </div>
                <div class="gold-silver-box" style="max-height: 278px;">
                    <div class="rate">
                        <span class="icon">🥇</span>
                        <div>
                            <p class="metal">Gold</p>
                            <p class="value">Rs1,52,000 / tola</p>
                        </div>
                    </div>
                    <div class="rate">
                        <span class="icon">🥈</span>
                        <div>
                            <p class="metal">Silver</p>
                            <p class="value">Rs 1,500 / tola</p>
                        </div>
                    </div>
                    <div class="rate">
                        <span class="icon">💎</span>
                        <div>
                            <p class="metal">Diamond</p>
                            <p class="value">Rs 21,500 / tola</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="section-title">
                    <h2 class="fs-5 mb-3 title">Currency Rates</h2>
                </div>
                <div class="currency-box" style="max-height: 278px;">
                    <div class="rate">
                        <span class="currency">USD</span>
                        <span class="value">Rs 134</span>
                    </div>
                    <div class="rate">
                        <span class="currency">EUR</span>
                        <span class="value">Rs 154</span>
                    </div>
                    <div class="rate">
                        <span class="currency">AUS</span>
                        <span class="value">Rs 90</span>
                    </div>
                    <div class="rate">
                        <span class="currency">CA</span>
                        <span class="value">Rs 95</span>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <section class="top-add-wrapper">
        <div class="">
            <img class="top-add-gif" src="{{ asset('frontend/gif/main-2.gif') }}" alt="..." loading="lazy">
        </div>
    </section>


    <section class="container-fluid tab-news">
        <div class="row gy-5">
            <div class="col-md-3">
                <div class="row gy-2 gx-4 px-1">
                    @if (count($news_sources) > 0)
                        @foreach ($news_sources as $source)
                            <button class="col-12 title-button" data-id="{{ $source->id }}">
                                {{ $source->name }}
                            </button>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-md-9">
                <div class="news-box scroll-container" id="news-1">
                    <!-- News items will be loaded dynamically here -->
                </div>
            </div>
        </div>
    </section>


    <section class="top-add-wrapper">
        <div class="">
            <img class="top-add-gif" src="{{ asset('frontend/gif/main-2.gif') }}" alt="..." loading="lazy">
        </div>
    </section>

    @if(count($product_categories)>0)
    <section class="container-fluid home-product-category" id="product-category">
        <div class="section-title">
            <h2 class="fs-5 mb-3 title">Product Category</h2>
        </div>

        <div class="product-category-slider mt-4 g-3">
            @foreach ($product_categories as $product_category)
            <div class="item">
                <div class="card" style="width: 100%">
                    <div class="product-image">
                        <a href="">
                            <img src="{{ asset($product_category->image) }}" class="img-fluid w-100"
                                alt="Product Category Image" loading="lazy">
                        </a>
                    </div>
                    <div class="card-body">
                        <a href="productdetail.html" class="text-decoration-none">
                            <h5 class="card-title m-0">
                                {{$product_category->name}}
                            </h5>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <section class="mt-5 hr w-100"></section>


    <section class="container-fluid nepali-calender">

        <div class="row gy-4">
            <div class="col-lg-4">
                <div class="box">
                    <h2 class="title">Nepali Calender 2081</h2>
                    <div class="day-detail">
                        <p class="date m-0">१५ पुष २०८१, सोमवार</p>

                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="calender row g-4">
                    <div class="col-6 col-lg-2 col-md-4">
                        <button class="month-popup">
                            वैशाख
                        </button>
                    </div>
                    <div class="col-6 col-lg-2 col-md-4">
                        <button class="month-popup">
                            जेठ
                        </button>
                    </div>
                    <div class="col-6 col-lg-2 col-md-4">
                        <button class="month-popup">
                            असार
                        </button>
                    </div>
                    <div class="col-6 col-lg-2 col-md-4">
                        <button class="month-popup">
                            साउन
                        </button>
                    </div>
                    <div class="col-6 col-lg-2 col-md-4">
                        <button class="month-popup">
                            भदौ
                        </button>
                    </div>
                    <div class="col-6 col-lg-2 col-md-4">
                        <button class="month-popup">
                            आश्विन
                        </button>
                    </div>
                    <div class="col-6 col-lg-2 col-md-4">
                        <button class="month-popup">
                            कार्तिक
                        </button>
                    </div>
                    <div class="col-6 col-lg-2 col-md-4">
                        <button class="month-popup">
                            मंसिर
                        </button>
                    </div>
                    <div class="col-6 col-lg-2 col-md-4">
                        <button class="month-popup">
                            पुष
                        </button>
                    </div>
                    <div class="col-6 col-lg-2 col-md-4">
                        <button class="month-popup">
                            माघ
                        </button>
                    </div>
                    <div class="col-6 col-lg-2 col-md-4">
                        <button class="month-popup">
                            फागुन
                        </button>
                    </div>
                    <div class="col-6 col-lg-2 col-md-4">
                        <button class="month-popup">
                            चैत्र
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            // Fetch news when a news source button is clicked
            $(".title-button").click(function() {
                var sourceId = $(this).data("id");

                // Add active class to the clicked button and remove from others
                $(".title-button").removeClass("active");
                $(this).addClass("active");

                // Send AJAX request to fetch news for the selected source
                $.ajax({
                    url: "{{ route('news.load') }}", // Define this route in web.php
                    method: "GET",
                    data: {
                        source_id: sourceId
                    },
                    success: function(response) {
                        // Update the news section with the fetched data
                        $("#news-1").html(response);
                    },
                    error: function() {
                        alert("Error loading news.");
                    }
                });
            });

            // Trigger click on the first news source button when the page loads
            if ($(".title-button").length > 0) {
                $(".title-button").first().click(); // Click the first button
                $(".title-button").first().addClass("active"); // Mark it as active
            }
        });
    </script>
@endpush
