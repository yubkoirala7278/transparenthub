@foreach ($products as $product)
    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
        <div class="card" style="width: 100%">
            <div class="product-image">
                <a href="{{ route('product.detail',$product->slug) }}">
                    <img src="{{ asset($product->feature_image) }}" class="img-fluid w-100"
                        alt="{{ $product->feature_image }}" loading="lazy">
                </a>
            </div>
            <div class="card-body">
                <a href="{{ route('product.detail',$product->slug) }}" class="text-decoration-none">
                    <h5 class="card-title m-0">
                        {{ Str::limit($product->name, 45, '...') }}
                    </h5>
                </a>
                <p class="price m-0 mt-2">Rs {{ $product->price }}</p>
                @if ($product->compare_price && $product->compare_price > $product->price)
                    @php
                        $discount = round(
                            (($product->compare_price - $product->price) /
                                $product->compare_price) *
                                100,
                        );
                    @endphp
                    <small class="text-decoration-line-through text-secondary me-1">
                        Rs {{ $product->compare_price }}
                    </small>
                    <small>-{{ $discount }}% off</small>
                @endif
            </div>
        </div>
    </div>
@endforeach
