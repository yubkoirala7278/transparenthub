@extends('frontend.layouts.master')
@section('custom-css')
    {{-- sweet alert 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <section class="product-detail  container-fluid mt-0 mt-lg-4">
            <div class="row ">
                <div class="col-md-6">
                    <div class="row">
                        <!-- Main Product Image -->
                        <div class="col-12 mb-3">
                            <div class=" border-0 ">
                                <img src="{{ asset($product->feature_image) }}" class="card-img-top img-fluid"
                                    id="product-detail-img" alt="Product Image" loading="lazy"
                                    style="object-fit: contain; max-height: 500px;">
                            </div>
                        </div>
                        <!-- Thumbnail Slider (if extra images exist) -->
                        @if ($product->images->count() > 0)
                            <div class="col-12">
                                <div class="px-3">
                                    <div class="position-relative">
                                        <div class="product-detail-slider-container">
                                            <div class="product-detail-slider my-slider">
                                                @foreach ($product->images as $productImage)
                                                    <div class="product-slider-img p-1">
                                                        <img src="{{ asset($productImage->image) }}"
                                                            class="detail-slide-img img-fluid border rounded"
                                                            alt="Product Thumbnail"
                                                            data-large="{{ asset($productImage->image) }}"
                                                            style="cursor: pointer;">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
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

                                @if ($product->brand)
                                    |
                                    <a href="" class="text-decoration-none">More brand from
                                        {{ $product->brand->name }}</a>
                            </small>
                            @endif

                        </div>

                        @php
                            // Calculate Discount Percentage if compare_price exists
                            $discount = $product->compare_price
                                ? round((($product->compare_price - $product->price) / $product->compare_price) * 100)
                                : 0;
                        @endphp

                        <div class="d-flex align-items-center gap-2">
                            <!-- Current Price -->
                            <p class="fs-4 fw-bold text-danger mb-0">Rs. {{ number_format($product->price, 2) }}</p>

                            <!-- Compare Price (Strikethrough) -->
                            @if ($product->compare_price)
                                <p class="fs-6 fw-semibold text-muted text-decoration-line-through mb-0">Rs.
                                    {{ number_format($product->compare_price, 2) }}</p>

                                <!-- Discount Badge -->
                                <span class="badge bg-success fw-semibold px-2 py-1">
                                    -{{ $discount }}% OFF
                                </span>
                            @endif
                        </div>

                        <form id="addToCartForm">
                            @csrf
                            <!-- Product ID -->
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <!-- Hidden quantity value (updated via JS) -->
                            <input type="hidden" name="quantity" id="quantity" value="1">
                            <div class="row">
                                <div class="col-12 d-flex align-items-center flex-wrap" style="gap: 20px">
                                    @if (count($product->colors))
                                        <div>
                                            <label for="colorSelect" class="form-label fw-semibold text-muted">Color</label>
                                            <select name="color" id="colorSelect"
                                                class="form-select rounded-pill shadow-sm border-light bg-light fw-semibold text-dark"
                                                style="width: auto; min-width: 120px; padding-right: 30px;">
                                                @foreach ($product->colors as $color)
                                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    @if (count($product->sizes))
                                        <div>
                                            <label for="sizeSelect" class="form-label fw-semibold text-muted">Size</label>
                                            <select name="size" id="sizeSelect"
                                                class="form-select rounded-pill shadow-sm border-light bg-light fw-semibold text-dark"
                                                style="width: auto; min-width: 120px; padding-right: 30px;">
                                                @foreach ($product->sizes as $size)
                                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div>
                                        <label for="quantityInput"
                                            class="form-label fw-semibold text-muted">Quantity</label>
                                        <div class="d-flex align-items-center border rounded-pill overflow-hidden bg-light shadow-sm"
                                            style="max-width: 140px;">
                                            <button class="btn btn-light px-3 border-0 shadow-none" type="button"
                                                id="decreaseBtn">
                                                <i class="fa-solid fa-minus text-dark"></i>
                                            </button>
                                            <input type="text"
                                                class="form-control text-center border-0 shadow-none bg-transparent fw-bold"
                                                id="quantityInput" value="1" style="width: 50px; max-width: 60px;"
                                                readonly>
                                            <button class="btn btn-light px-3 border-0 shadow-none" type="button"
                                                id="increaseBtn">
                                                <i class="fa-solid fa-plus text-dark"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12 d-flex align-items-center gap-3">
                                    <!-- Buy Now Button -->
                                    <button class="btn btn-primary fw-semibold rounded-pill px-4 py-2 shadow-sm">
                                        <i class="fa-solid fa-bolt me-2"></i> Buy Now
                                    </button>
                                    <button type="submit"
                                        class="btn btn-danger fw-semibold rounded-pill px-4 py-2 shadow-sm">
                                        <i class="fa-solid fa-cart-plus me-2"></i> Add to Cart
                                    </button>

                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
            </div>
        </section>

        <!-- Login/Register Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="loginModalLabel">Sign In / Register</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-4 text-center">Please sign in with your Google account to continue.</p>
                        <div class="d-grid">
                            <a href="#" id="googleLoginButton" class="btn btn-danger">
                                <i class="fa-brands fa-google me-2"></i> Sign in with Google
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
        // Make lastFormData global so that afterGoogleLogin() can access it.
        window.lastFormData = null;

        $(document).ready(function() {
            // Quantity Management
            const $quantityInput = $('#quantityInput');
            const $hiddenQuantity = $('#quantity');

            $('#increaseBtn').click(function() {
                let current = parseInt($quantityInput.val());
                current++;
                $quantityInput.val(current);
                $hiddenQuantity.val(current);
            });

            $('#decreaseBtn').click(function() {
                let current = parseInt($quantityInput.val());
                if (current > 1) { // Prevent quantity less than 1
                    current--;
                    $quantityInput.val(current);
                    $hiddenQuantity.val(current);
                }
            });

            // AJAX Form Submission for "Add to Cart"
            $('#addToCartForm').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                // Save the serialized data in a globally accessible variable.
                window.lastFormData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('cart.add') }}", // Your cart-add route
                    data: window.lastFormData,
                    dataType: 'json',
                    success: function(response) {
                        // Hide the login modal if it is open
                        $('#loginModal').modal('hide');

                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                        if (response.cart_count !== undefined) {
                            $('#navCartCount').text(response.cart_count).show();
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 401) {
                            $('#loginModal').modal('show');
                        } else {
                            let error = xhr.responseJSON ? xhr.responseJSON.error :
                                'Something went wrong.';
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: error,
                            });
                        }
                    }
                });
            });

            // Handle click on the Google login button inside the modal.
            // Opens the Google login URL in a popup window.
            $('#googleLoginButton').on('click', function(e) {
                e.preventDefault();
                window.open("{{ route('google.redirect') }}", "GoogleLogin", "width=600,height=600");
            });
        });

        /**
         * Global function called by the Google callback popup.
         * It re‑submits the stored form data (thus adding the item to the cart),
         * hides the login modal, and displays a SweetAlert2 message.
         */
        function afterGoogleLogin() {
            if (window.lastFormData) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('cart.add') }}",
                    data: window.lastFormData,
                    dataType: 'json',
                    success: function(response) {
                        // Hide the login modal upon successful login
                        $('#loginModal').modal('hide');

                        Swal.fire({
                            icon: 'success',
                            title: 'Logged in!',
                            text: 'Your account is now logged in and the item has been added to your cart.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        if (response.cart_count !== undefined) {
                            $('#navCartCount').text(response.cart_count).show();
                        }
                    },
                    error: function(xhr) {
                        let error = xhr.responseJSON ? xhr.responseJSON.error : 'Something went wrong.';
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: error,
                        });
                    }
                });
                // Clear the stored form data
                window.lastFormData = null;
            } else {
                $('#loginModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Logged in!',
                    text: 'Your account has been logged in!',
                }).then(()=>{
                    window.location.reload();
                });
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const slider = new tns({
                container: '.my-slider',
                items: 2, // Default number of thumbnails visible
                slideBy: 'page',
                autoplay: false,
                controls: false, // Hide default controls
                nav: false, // Hide navigation dots
                autoplayButtonOutput: false,
                autoplayHoverPause: true,
                lazyload: false,
                touch: true,
                loop: true,
                rewind: false,
                mouseDrag: true,
                responsive: {
                    0: {
                        items: 2
                    },
                    576: {
                        items: 3
                    },
                    768: {
                        items: 4
                    },
                    992: {
                        items: 5
                    },
                    1200: {
                        items: 6
                    }
                }
            });

            // Update main image when a thumbnail is clicked
            const sliderImages = document.querySelectorAll('.detail-slide-img');
            const mainImage = document.getElementById('product-detail-img');

            sliderImages.forEach((img) => {
                img.addEventListener('click', () => {
                    mainImage.src = img.getAttribute('data-large');
                });
            });
        });
    </script>
@endpush
