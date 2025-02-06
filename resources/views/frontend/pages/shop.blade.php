@extends('frontend.layouts.master')
@section('content')
    <section class="top-add-wrapper mt-0">
        <div class="">
            <img class="top-add-gif" src="{{ asset('frontend/gif/main-2.gif') }}" alt="..." loading="lazy">
        </div>
    </section>

    <div class="container-fluid mobile-filter-btn d-flex justify-content-end d-lg-none mt-2">
        <button class="btn p-0 text-danger" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
            aria-controls="offcanvasRight"><i class="fa-solid fa-filter  me-1"></i>Filter</button>
    </div>

    <section class="container-fluid home-shop mt-0 mt-lg-5">
        <!-- <div class="section-title">
                            <h2 class="fs-5 mb-3 title">Our Product</h2>
                        </div> -->
        <div class="row">
            <div class="col-lg-2 d-none d-lg-block">
                <div class="row product-filter">
                    <div class="price-range">
                        <h2 class="fs-6 fw-semibold text-danger">Price Range</h2>
                        <!-- Price Range Slider -->
                        <div class="row gx-1 align-items-end">
                            <div class="col-5">
                                <input type="number" id="minPrice" class="form-control" placeholder="Min">
                            </div>

                            <div class="col-5">

                                <input type="number" id="maxPrice" class="form-control" placeholder="Max">
                            </div>
                            <div class="col-2">
                                <button class="btn btn-danger" onclick="filterPrices()"><i
                                        class="fa-solid fa-chevron-right"></i></button>
                            </div>
                        </div>


                    </div>
                    <div class="hr my-3 w-100"></div>
                    <div class="category">
                        <h2 class="fs-6 fw-semibold text-danger">Category</h2>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Man Clothes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Women Clothes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Doctor Clothes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Light Bulb
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Electric Heater
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Boys' Shoes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Color Bulb
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Color Bulb
                            </label>
                        </div>
                    </div>
                    <div class="hr my-3 w-100"></div>
                    <div class="category">
                        <h2 class="fs-6 fw-semibold text-danger">Color</h2>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Red
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Blue
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Green
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Yellow
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Pink
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                White
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Orange
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Silver
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-10">
                <div class="row mt-0 g-2" id="product-list">
                    {{-- Initial 10 products will be loaded here via AJAX --}}
                </div>

                <div class="text-center mt-5">
                    <button id="load-more" class="btn w-50 fs-5" data-offset="0">LOAD MORE</button>
                    <div id="loading" class="mt-2" style="display: none;">
                        <img src="{{asset('loader.gif')}}" alt="Loading..">
                    </div>
                </div>
            </div>
        </div>

    </section>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <div class="section-title">
                <h5 class="offcanvas-title fs-5 mb-3 title" id="offcanvasRightLabel">Filter Product</h5>
            </div>

            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <div class="mobile-filter">
                <div class="row">
                    <div class="price-range">
                        <h2 class="fs-6 fw-semibold text-danger">Price Range</h2>
                        <!-- Price Range Slider -->
                        <div class="row gx-1 align-items-end">
                            <div class="col-5">
                                <input type="number" id="minPrice" class="form-control" placeholder="Min">
                            </div>

                            <div class="col-5">

                                <input type="number" id="maxPrice" class="form-control" placeholder="Max">
                            </div>
                            <div class="col-2">
                                <button class="btn btn-danger" onclick="filterPrices()"><i
                                        class="fa-solid fa-chevron-right"></i></button>
                            </div>
                        </div>


                    </div>

                    <div class="hr my-3 w-100"></div>

                    <div class="category">
                        <h2 class="fs-6 fw-semibold text-danger">Category</h2>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Man Clothes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Women Clothes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Doctor Clothes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Light Bulb
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Electric Heater
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Boys' Shoes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Color Bulb
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Color Bulb
                            </label>
                        </div>
                    </div>

                    <div class="hr my-3 w-100"></div>

                    <div class="category">
                        <h2 class="fs-6 fw-semibold text-danger">Color</h2>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Red
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Blue
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Green
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Yellow
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Pink
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                White
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Orange
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Silver
                            </label>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            function loadProducts(offset, append = false) {
                $("#loading").show();
                $("#load-more").hide();

                $.ajax({
                    url: "/load-more-products",
                    method: "GET",
                    data: {
                        offset: offset
                    },
                    success: function(response) {
                        if (response.status === "success") {
                            if (append) {
                                $("#product-list").append(response.html);
                            } else {
                                $("#product-list").html(response.html);
                            }

                            let newOffset = offset + 5;
                            $("#load-more").data("offset", newOffset);

                            if (response.hasMore) {
                                $("#load-more").show();
                            } else {
                                $("#load-more").hide();
                            }
                        }
                    },
                    error: function() {
                        alert("Error loading products. Please try again.");
                    },
                    complete: function() {
                        $("#loading").hide();
                    },
                });
            }

            // Load initial products on page load
            loadProducts(0);

            // Load more products when clicking the button
            $("#load-more").on("click", function() {
                let offset = $(this).data("offset");
                loadProducts(offset, true);
            });
        });
    </script>
@endpush
