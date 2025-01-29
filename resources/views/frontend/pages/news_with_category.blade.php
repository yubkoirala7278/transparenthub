@extends('frontend.layouts.master')
@section('content')
    <style>
        .cat-nav-menu {
            display: flex;
            flex-wrap: nowrap;
            gap: 10px;

            overflow: scroll;
            scrollbar-width: none;
            /* Firefox */
        }

        .cat-nav-menu::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, and Edge */
        }

        .cat-link {
            list-style-type: none;
        }

        .cat-link .link {
            text-decoration: none;
            color: black;
        }

        .cat-link .link {
            border-bottom: 1px solid rgba(236, 236, 236, .3);
            border-radius: 12px;
            padding: 10px 16px;
            font-size: .95rem;
            color: rgb(36, 36, 36);
            transition: all .2s ease-in-out;
        }

        .cat-link .link:hover {
            background-color: var(--primary);
            color: white;
            border-radius: 0;


        }

        .cat-link .link:hover.active {
            color: white;
            box-shadow: 3px 3px 0px 0px #f59b9b;
        }

        .cat-link .link:active {
            box-shadow: 0px 0px 10px 1px var(--primary);

        }

        .cat-link .link.active {
            transform: translateX(2px);
            color: var(--primary);
            box-shadow: 3px 3px 0px 0px #f59b9b;
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

        .top-news-title {
            color: white;
            /* Initial white color */
            transition: color 0.3s ease;
            /* Smooth transition */
        }

        .top-news-title:hover {
            color: #ffcc00;
            /* A professional gold shade */
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

    <section class="container mt-2">
        <div class="category-nav">
            <ul class="cat-nav-menu border-secondary border-top border-bottom py-3">
                <li class="cat-link">
                    <a href="{{ route('news.with.category', 'all_news') }}"
                        class="link {{ Route::is('news.with.category') && request('category') === 'all_news' ? 'active' : '' }}">
                        समाचार
                    </a>
                </li>
                @foreach ($categories as $category)
                    <li class="cat-link">
                        <a href="{{ route('news.with.category', $category->name) }}"
                            class="link {{ Route::is('news.with.category') && request('category') === $category->name ? 'active' : '' }}" style="white-space: nowrap">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    @if ($news_with_same_category_top_news)
        <section class="container mt-2">
            @if ($news_with_same_category_top_news)
                <div class="row g-0">
                    <div class="col-lg-8">
                        <a href="{{ route('news.view', ['slug' => $news_with_same_category_top_news->slug]) }}"
                            class="d-block">
                            <img src="{{ asset($news_with_same_category_top_news->image) }}" class="w-100" alt="">
                        </a>
                    </div>

                    <div class="col-lg-4">
                        <div class="d-flex flex-column p-4 justify-content-center h-100" style="background-color: #1f639f;">
                            <div class="section-title-1">
                                <a class="title fw-bold mb-1 fs-3 text-decoration-none top-news-title"
                                    href="{{ route('news.view', ['slug' => $news_with_same_category_top_news->slug]) }}">{{ $news_with_same_category_top_news->title }}
                                </a>
                            </div>
                            <small
                                class="text-white fw-semibold mt-1 mb-3">{{ $news_with_same_category_top_news->created_at->diffForHumans() }}</small>
                            <p class="text-white fs-5">
                                {{ \Illuminate\Support\Str::limit(
                                    html_entity_decode(strip_tags($news_with_same_category_top_news->description)),
                                    190,
                                    '...',
                                ) }}
                            </p>
                            <div class="d-flex align-items-center justify-content-between mt-3 ">
                                <button class="btn btn-transparent p-0 btn-sm share-button text-white"
                                    onclick="shareOnFacebook('{{ route('news.view', ['slug' => $news_with_same_category_top_news->slug]) }}')">
                                    <i class="fa-regular fa-share-from-square"></i> सेयर
                                </button>
                                <p class="small mb-0 text-white">
                                    {{ $news_with_same_category_top_news->created_at->format('M d, Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($news_with_same_category->isNotEmpty())
                <div class="mt-5">
                    <div class="row gy-4"   data-masonry='{"percentPosition": true }'>
                        @foreach ($news_with_same_category as $key => $same_category_news)
                            <div class=" col-md-6 col-lg-3">
                                <div class="card border-0 hover-card ">
                                    <a href="{{ route('news.view', ['slug' => $same_category_news->slug]) }}">
                                        <img src="{{ asset($same_category_news->image) }}" class="card-img-top img-fluid"
                                            alt="News Image"
                                            style="object-fit: cover; height: 170px; width: 100%; border-radius: 8px 8px 0 0;">
                                    </a>
                                    <div class="card-body border border-1 rounded-bottom-2">
                                        <a class="card-text fw-semibold text-center news-title fs-5 text-decoration-none"
                                            href="{{ route('news.view', ['slug' => $same_category_news->slug]) }}">
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
                    </div>

                    <!-- Read More Button and Loader -->
                    @if ($hasMorePages)
                        <div class="col-12 text-center">
                            <button id="load-more" class="btn text-white" style="background-color: #1169B3"
                                onclick="loadMoreNews()">Read More</button>
                            <div id="loader" style="display:none;">Loading...</div>
                        </div>
                    @endif
                </div>
            @endif
        </section>
    @else
        <section class="container mt-2 text-center">
            <p>No news to display..</p>
        </section>
    @endif

@endsection

@push('script')
    <script>
        // ============infinity scroll=========
        let page = 2; // Start with the second page since the first is already loaded

        function loadMoreNews() {
            var category = {!! json_encode($categoryName) !!};
            var url = '{{ route('news.load.more', ['category' => ':category']) }}';
            url = url.replace(':category', category); // Replace placeholder with the category

            $('#loader').show(); // Show loading spinner
            $('#load-more').prop('disabled', true); // Disable button to prevent multiple clicks

            $.ajax({
                url: url, // Use the dynamically constructed URL
                type: 'GET',
                data: {
                    page: page
                },
                success: function(response) {
                    if (response.html) {
                        $('#news-list').append(response.html); // Append new items to the list
                        page++; // Increment page for the next request
                    }

                    if (!response.hasMorePages) {
                        $('#load-more').hide(); // Hide the 'Load More' button if no more pages
                    }

                    $('#loader').hide(); // Hide loading spinner
                    $('#load-more').prop('disabled', false); // Re-enable button
                },
                error: function() {
                    alert('Something went wrong. Please try again.');
                    $('#loader').hide();
                    $('#load-more').prop('disabled', false);
                }
            });
        }
        // =========share on facebook==========
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
