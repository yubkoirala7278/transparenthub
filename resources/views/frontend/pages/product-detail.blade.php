@extends('frontend.layouts.master')
@section('custom-css')
    <style>
        figure {
            text-align: center;
        }

        figure img {
            max-height: 200px;
        }
    </style>
@endsection
@section('content')
    <main class="wrapper-contain">

        <section class="top-add-wrapper mt-0">
            <div class="">
                <img class="top-add-gif" src="{{ asset('frontend/gif/main-2.gif') }}" alt="..." loading="lazy">
            </div>
        </section>

        <section class="product-detail  container-fluid mt-5">
            <div class="row gy-4">
                <div class="col-md-6">
                    <div class="row">
                        <div class="product-detail-img">
                            <img src="{{ asset($product->feature_image) }}" class="img-fluid" id="product-detail-img"
                                alt="Product Image" loading="lazy" style="object-fit: contain">
                        </div>
                        <div class="container" style="overflow-x: hidden;">
                            @if ($product->images->count() > 0)
                                <div class="mt-4 px-4 position-relative">
                                    <div class="product-detail-slider-container">
                                        <div class="product-detail-slider my-slider">
                                            @foreach ($product->images as $productImage)
                                                <div class="product-slider-img">
                                                    <img src="{{ asset($productImage->image) }}" class="detail-slide-img"
                                                        alt="Product Image" data-large="{{ asset($productImage->image) }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="product-contain d-flex flex-column gap-2">
                        <h2 class="product-title m-0">{{ $product->name }}</h2>

                        <div class="d-flex gap-2 rating-box">
                            <div class="rating">
                                <i class="fa-solid fa-star" style="color: #ffce1d;"></i>
                                <i class="fa-solid fa-star" style="color: #ffce1d;"></i>
                                <i class="fa-solid fa-star" style="color: #ffce1d;"></i>
                                <i class="fa-solid fa-star" style="color: #ffce1d;"></i>
                                <i class="fa-regular fa-star" style="color: #ffce1d;"></i>
                            </div>
                            <div class="fw-semibold">
                                / <small>(21 rating)</small>
                            </div>
                        </div>

                        <div class="hr w-100 bg-danger"></div>

                        <div class="brand">
                            <small class="fw-bold text-secondary">Brand: <a href=""
                                    class="text-decoration-none">{{ $product->brand ? $product->brand->name : 'No Brand' }}</a>
                                |
                                @if ($product->brand)
                                    <a href="" class="text-decoration-none">More brand from
                                        {{ $product->brand->name }}</a>
                            </small>
                            @endif

                        </div>

                        <div class="price d-flex align-items-end align-items-lg-center gap-5">
                            <p class="m-0">Price <strong class="fs-4">Rs. {{ $product->price }}</strong>
                                @if ($product->compare_price)
                                    <span
                                        class="ms-lg-2 d-block d-lg-inline fw-semibold text-secondary text-decoration-line-through">Rs.
                                        {{ $product->compare_price }} </span>
                                @endif
                            </p>
                        </div>

                        <div class="stock d-flex gap-3 align-items-center">
                            <i class="fa-solid fa-check text-success"></i> In Stock
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label for="">Color</label>
                                <select name="" id="" class="form-select" style="width: fit-content;">
                                    <option value="">Black</option>
                                    <option value="">Black Blue</option>
                                    <option value="">White</option>
                                    <option value="">Green</option>
                                </select>
                            </div>

                            <div class="col-6">
                                <label for="">Quantity</label>
                                <div class="d-flex align-items-center gap-0">
                                    <button class="btn btn-outline-secondary rounded-0" type="button" id="decreaseBtn"
                                        style="border-color: rgb(226, 226, 226);">
                                        +
                                    </button>
                                    <input type="text" class="form-control text-center rounded-0" id="quantityInput"
                                        value="1" style="width: 60px;" readonly>
                                    <button class="btn btn-outline-secondary rounded-0" type="button" id="increaseBtn"
                                        style="border-color: rgb(226, 226, 226);">
                                        -
                                    </button>
                                </div>

                            </div>
                        </div>

                        <div class="product-share d-flex gap-2 align-items-center my-1">
                            <span>Share:</span>
                            <a href="" class="btn btn-sm btn-primary"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="" class="btn btn-sm btn-success"><i class="fa-brands fa-viber"></i></a>
                            <a href="" class="btn btn-sm btn-danger"><i class="fa-brands fa-instagram"></i></a>
                            <a href="" class="btn btn-sm btn-warning"><i class="fa-brands fa-whatsapp"></i></a>
                        </div>

                        <div class="all-btn row gy-4">
                            <div class="col-md-6"><a href="" class="btn w-100 p-2">Add To Cart</a></div>
                            <div class="col-md-6"><a href="" class="btn w-100 p-2">Shop Now</a></div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section class="hr mt-5 w-100"></section>

        <section class="product-description container-fluid">

            <div class="row description">
                <div class="col-12">
                    {!! $product->description !!}
                </div>
            </div>
        </section>
    </main>
@endsection

@push('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const slider = new tns({
                container: '.my-slider',
                items: 1, // Show 1 image at a time
                slideBy: 'page',
                autoplay: false,
                controls: false, // Disable the default controls
                nav: false, // Disable the default navigation
                autoplayButtonOutput: false,
                autoplayHoverPause: true,
                Lazyload: true,
                touch: true,
                loop: true,
                rewind: false,
                mouseDrag: true,
                responsive: {
                    0: {
                        items: 2
                    },
                    320: {
                        items: 3
                    },
                    500: {
                        items: 3
                    },
                    730: {
                        items: 4
                    },
                    900: {
                        items: 5
                    },
                    1350: {
                        items: 6
                    },
                }
            });

            // Add click event to each image in the slider
            const sliderImages = document.querySelectorAll('.detail-slide-img');
            const mainImage = document.getElementById('product-detail-img');

            sliderImages.forEach((img) => {
                img.addEventListener('click', () => {
                    // Update the main image src
                    mainImage.src = img.getAttribute('data-large');
                });
            });
        });
    </script>
@endpush
