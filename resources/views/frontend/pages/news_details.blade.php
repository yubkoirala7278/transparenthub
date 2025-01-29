@extends('frontend.layouts.master')
@section('custom-css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Mukta:wght@200;300;400;500;600;700;800&display=swap');

        figure,
        h2,
        .card-body .card-text p:first-of-type {
            text-align: center;
        }

        .news-description {
            font-size: 20px;
            line-height: 1.75;
            color: #2a2a2a !important;
            font-family: "Mukta", serif !important;
            max-width: 100%;
            word-wrap: break-word;
            margin: 0;
            padding: 0;
            font-weight: normal;
            font-style: normal;
        }

        /* Responsive font size for smaller devices */
        @media (max-width: 768px) {
            .news-description {
                font-size: 18px;
                /* Slightly smaller font size for tablets and mobile */
            }
        }

        @media (max-width: 480px) {
            .news-description {
                font-size: 16px;
                /* Even smaller font size for small devices */
            }
        }

        figure img:first-of-type {
            width: 100%;
        }

        .news-category {
            position: relative;
        }

        .news-category div {
            position: absolute;
            left: 0;
        }

        .card {
            overflow: hidden;
            /* Prevents the image from overflowing the card */
        }

        .card-img-top {
            transition: transform 0.3s ease-in-out;
            /* Smooth transition */
            object-fit: cover;
            /* Ensure image covers the area */
            width: 100%;
            height: 200px;
        }

        .card-img-top:hover {
            transform: scale(1.1);
            /* Zoom in the image */
        }

        .share-button {
            color: #4267B2;
            font-size: 1rem;
            font-weight: bold;
            background: none;
            border: none;
            cursor: pointer;
        }

        .text-muted {
            font-size: 0.875rem;
        }
        .card-text{
            color:rgb(24, 21, 21);
        }
    </style>
@endsection
@section('content')
    <div>
        <div class="news-category">
            <a class="btn btn-danger rounded-0" data-bs-toggle="offcanvas" href="#newsCategory" role="button"
                aria-controls="newsCategory" title="Choose Category">
                <i class="fa-solid fa-bars text-white fs-4"></i>
            </a>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9">
                <div class="text-center">
                    <h1 class="fw-bold text-dark">{{ $news->title }}</h1>
                    <p class=""><small class="text-secondary">{{ $news->created_at->format('M j, Y') }} | </small> <a
                            href="{{ route('news.with.category', $news->news_categories->name) }}"
                            class="text-decoration-none" style="color: #1169B3">{{ $news->news_categories->name }}</a>
                    </p>
                </div>
                <div class="container news-description">
                    {!! $news->description !!}
                </div>
                <div class="d-flex align-items-center justify-content-between mt-3">
                    <button class="btn btn-transparent p-0 btn-sm share-button"
                        onclick="shareOnFacebook('{{ route('news.view', ['slug' => $news->slug]) }}')">
                        <i class="fa-regular fa-share-from-square"></i> सेयर
                    </button>
                    <p class="text-muted small mb-0">
                        {{ $news->created_at->format('M d, Y') }}
                    </p>
                </div>
                @if (count($news_with_same_category) > 0)
                    <div class="mt-5">
                        <h2 class="text-start fw-bold" style="color: #1169B3">सम्बन्धित खबर</h2>
                        <div class="row gy-4" data-masonry='{"percentPosition": true }'>
                            @foreach ($news_with_same_category as $key => $same_category_news)
                                <div class="col-md-6 col-lg-4 ">
                                    <div class="card border-0 hover-card">
                                        <a href="{{ route('news.view', ['slug' => $same_category_news->slug]) }}">
                                        <img src="{{ asset($same_category_news->image) }}" class="card-img-top img-fluid"
                                            alt="News Image"
                                            style="object-fit: cover; height: 200px; width: 100%; border-radius: 8px 8px 0 0;">
                                        </a>
                                        <div class="card-body border border-1 rounded-bottom-2">
                                            <a class="card-text fw-semibold text-center news-title fs-5 text-decoration-none" href="{{ route('news.view', ['slug' => $same_category_news->slug]) }}">
                                                {{ $same_category_news->title }}
                                            </a>
                                            <div class="d-flex align-items-center justify-content-between mt-2">
                                                <p class="text-muted small mb-0">
                                                    {{ $same_category_news->created_at->format('M d, Y') }}
                                                </p>
                                                <button class="btn btn-transparent p-0 btn-sm share-button"
                                                    onclick="shareOnFacebook('{{ route('news.view', ['slug' => $same_category_news->slug]) }}')">
                                                    <i class="fa-regular fa-share-from-square"></i> सेयर
                                                </button>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-12 text-center">
                                <a href="{{ route('news.with.category', $same_category_news->news_categories->name) }}"
                                    class="btn text-white" style="background-color: #1169B3">Explore More</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-3">
                <div class="d-flex flex-column">
                    <img src="{{ asset('ad/300-200_1.gif') }}" alt="">
                    <hr>
                    <img src="{{ asset('ad/300-x-250.gif') }}" alt="">
                    <hr>
                    <img src="{{ asset('ad/300x150.gif') }}" alt="">
                    <hr>
                    <img src="{{ asset('ad/300x200.gif') }}" alt="">
                    <hr>
                    <img src="{{ asset('ad/IMG_6045.jpeg') }}" alt="">
                    <hr>
                    <img src="{{ asset('ad/MIT_social-media-for-Gif-file.gif') }}" alt="">
                    <hr>
                    <img src="{{ asset('ad/Online-Khabar-Story-1021x1280-1.jpg') }}" alt="">
                    <hr>
                    <img src="{{ asset('ad/onlinekhabar-300-125.gif') }}" alt="">
                    <hr>
                    <img src="{{ asset('ad/WhatsApp-GIF-2024-03-03-at-17.41.00.gif') }}" alt="">
                    <hr>
                    <img src="{{ asset('ad/onlinekhabar-300-125.gif') }}" alt="">
                    <hr>
                    <img src="{{ asset('ad/MIT_social-media-for-Gif-file.gif') }}" alt="">
                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <!-- Modal -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="newsCategory" aria-labelledby="newsCategoryLabel">
        <div class="offcanvas-header text-white" style="background-color: #B61C1C">
            <h5 class="offcanvas-title" id="newsCategoryLabel">News Categories</h5>
            <button type="button" class="btn-close text-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row" style="row-gap: 15px">
                <div class="col-12 mb-4">
                    <form action="{{ route('news.view') }}" method="GET" id="news-search-form">
                        <div class="input-group position-relative">
                            <input type="text" class="form-control" id="keyword" name="keyword"
                                placeholder="शीर्षक वा स्तम्भ खोज्नुहोस" aria-label="Search by keyword" autocomplete="off">
                            <button type="submit" class="btn btn-danger text-white">
                                <i class="fa-solid fa-magnifying-glass"></i> Search
                            </button>

                            <!-- Suggestions dropdown -->
                            <div id="suggestions-box" class="list-group position-absolute w-100"
                                style="z-index: 1000; display: none;">
                                <!-- Suggestions will be dynamically inserted here -->
                            </div>
                        </div>
                    </form>


                </div>
                @if (count($categories) > 0)
                    @foreach ($categories as $category)
                        <div class="col-lg-4">
                            <a href="{{ route('news.with.category', $category->name) }}"
                                class="text-decoration-none text-success">{{ $category->name }}</a>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const keywordInput = document.getElementById('keyword');
            const suggestionsBox = document.getElementById('suggestions-box');

            keywordInput.addEventListener('input', function() {
                const keyword = this.value.trim();

                if (keyword.length > 2) {
                    // Fetch suggestions via AJAX
                    fetch(`/news-suggestions?keyword=${encodeURIComponent(keyword)}`)
                        .then(response => response.json())
                        .then(data => {
                            suggestionsBox.innerHTML = '';
                            Object.entries(data).forEach(([slug, title]) => {
                                const suggestionItem = document.createElement('a');
                                suggestionItem.href = `/news-detail/${slug}`;
                                suggestionItem.className =
                                    'list-group-item list-group-item-action';
                                suggestionItem.textContent = title;
                                suggestionsBox.appendChild(suggestionItem);
                            });
                            suggestionsBox.style.display = 'block';
                        });

                } else {
                    // Hide the suggestions box if input is too short
                    suggestionsBox.style.display = 'none';
                }
            });

            // Hide suggestions when clicking outside
            document.addEventListener('click', function(e) {
                if (!suggestionsBox.contains(e.target) && e.target !== keywordInput) {
                    suggestionsBox.style.display = 'none';
                }
            });
        });
        // share on facebook
        function shareOnFacebook(url) {
            const shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
            const popupWidth = 600;
            const popupHeight = 400;
            const popupLeft = (window.innerWidth - popupWidth) / 2;
            const popupTop = (window.innerHeight - popupHeight) / 2;
            window.open(
                shareUrl,
                'facebook-share-dialog',
                `width=${popupWidth},height=${popupHeight},top=${popupTop},left=${popupLeft}`
            );
        }
    </script>
@endpush
