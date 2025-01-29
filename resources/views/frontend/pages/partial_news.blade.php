@foreach ($news as $newsItem)
    <div class="news">
        <div class="row g-0 align-items-center justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('news.view', ['slug' => $newsItem->slug]) }}" class="text-decoration-none text-dark">
                    <h3 class="fs-5 fw-bold m-0 p-0">
                        {{ $newsItem->title }}
                    </h3>
                    <p class="mt-2"> {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($newsItem->description)), 200, '...') }}</p>
                </a>
                <div class="d-flex align-items-center" style="column-gap: 20px">
                    <p class="text-muted small mb-0">
                        {{ $newsItem->created_at->format('M d, Y') }}
                    </p>
                    <button class="btn btn-transparent p-0 btn-sm share-button"
                        onclick="shareOnFacebook('{{ route('news.view', ['slug' => $newsItem->slug]) }}')">
                        <i class="fa-regular fa-share-from-square"></i> सेयर
                    </button>
                   
                </div>
            </div>
            <div class="col-md-4">
                <a href="{{ route('news.view', ['slug' => $newsItem->slug]) }}">
                    <img src="{{ asset($newsItem->image) }}" class="tab-news-image" alt="">
                </a>
            </div>
           
        </div>
    </div>
@endforeach
<a href="{{ route('news.with.category', 'all_news') }}" class="btn rounded-pill btn-sm  text-white mt-2" style="background-color: #1B6CB3">Explore More</a>

<script>
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
