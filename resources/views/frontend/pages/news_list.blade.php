@foreach ($news_with_same_category as $same_category_news)
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 hover-card">
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
