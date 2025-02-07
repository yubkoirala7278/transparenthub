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
                        <h2 class="fs-6 fw-semibold text-danger">Price Rangess</h2>
                        <!-- Price Range Slider -->
                        <div class="row gx-1 align-items-end">
                            <div class="col-5">
                                <input type="number" id="minPrice" class="form-control" placeholder="Min">
                            </div>
                            <div class="col-5">
                                <input type="number" id="maxPrice" class="form-control" placeholder="Max">
                            </div>
                            <div class="col-2">
                                <button class="btn btn-danger" id="filterPriceBtn"><i
                                        class="fa-solid fa-chevron-right"></i></button>
                            </div>
                        </div>


                    </div>
                    <div class="hr my-3 w-100"></div>
                    <div class="category">
                        <h2 class="fs-6 fw-semibold text-danger">Categorysss</h2>
                        @if (count($categories) > 0)
                            @foreach ($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input category-filter" type="checkbox"
                                        value="{{ $category->id }}" id="category_{{ $category->id }}">
                                    <label class="form-check-label" for="category_{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        @endif

                    </div>
                    <div class="hr my-3 w-100"></div>
                    <div class="category">
                        <h2 class="fs-6 fw-semibold text-danger">Colorsss</h2>
                        @if (count($colors) > 0)
                            @foreach ($colors as $color)
                                <div class="form-check">
                                    <input class="form-check-input color-filter" type="checkbox" value="{{ $color->id }}"
                                        id="color_{{ $color->id }}">
                                    <label class="form-check-label" for="color_{{ $color->id }}">
                                        {{ $color->name }}
                                    </label>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-10">
                <div class="row mt-0 g-2" id="product-list" data-initial-offset="{{ $initialProducts->count() }}">
                    @if ($initialProducts->isEmpty())
                        <div class="no-products">No products to display</div>
                    @else
                        @foreach ($initialProducts as $product)
                            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                                <div class="card" style="width: 100%">
                                    <div class="product-image">
                                        <a href="{{ route('product.detail', $product->slug) }}">
                                            <img src="{{ asset($product->feature_image) }}" class="img-fluid w-100"
                                                alt="{{ $product->feature_image }}" loading="lazy">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <a href="{{ route('product.detail', $product->slug) }}"
                                            class="text-decoration-none">
                                            <h5 class="card-title m-0">{{ Str::limit($product->name, 45, '...') }}</h5>
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
                                            <small class="text-decoration-line-through text-secondary me-1">Rs
                                                {{ $product->compare_price }}</small>
                                            <small>-{{ $discount }}% off</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="text-center mt-5">
                    <button id="load-more" class="btn w-50 fs-5" data-offset="0">LOAD MORE</button>
                    <div id="loading" class="mt-2" style="display: none;">
                        <img src="{{ asset('loader.gif') }}" alt="Loading..">
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
            const limit = 6; // Number of products per page
            let offset = parseInt($("#product-list").data("initial-offset")) || 0;

            // Clear filter fields on page load
            $("#minPrice").val('');
            $("#maxPrice").val('');
            $(".category-filter, .color-filter").prop("checked", false);

            // Show Load More button if initial products exist and there might be more
            if (offset > 0) {
                $("#load-more").data("offset", offset).show();
            }

            // When any filter changes or the price filter button is clicked:
            $(".category-filter, .color-filter").on("change", function() {
                offset = 0; // Reset offset on filter change
                loadFilteredProducts();
            });

            $("#filterPriceBtn").on("click", function() {
                offset = 0; // Reset offset when price filter is applied
                loadFilteredProducts();
            });

            // Helper: Get selected values for a given checkbox group
            function getSelectedValues(selector) {
                let selected = [];
                $(selector + ":checked").each(function() {
                    selected.push($(this).val());
                });
                return selected;
            }

            // Load (or reload) filtered products using the filter-products endpoint
            function loadFilteredProducts() {
                const minPrice = $("#minPrice").val() || 0;
                const maxPrice = $("#maxPrice").val() || null;
                let selectedCategories = getSelectedValues(".category-filter");
                let selectedColors = getSelectedValues(".color-filter");

                // If all checkboxes are selected for a filter, clear that filter (ignore it)
                if (selectedCategories.length === $(".category-filter").length) {
                    selectedCategories = [];
                }
                if (selectedColors.length === $(".color-filter").length) {
                    selectedColors = [];
                }

                // Use the filter-products endpoint for a fresh load (offset = 0)
                loadProducts("/filter-products", minPrice, maxPrice, selectedCategories, selectedColors, 0);
            }

            // Load more products when the "Load More" button is clicked (using the load-more-products endpoint)
            $("#load-more").on("click", function() {
                const minPrice = $("#minPrice").val() || 0;
                const maxPrice = $("#maxPrice").val() || null;
                let selectedCategories = getSelectedValues(".category-filter");
                let selectedColors = getSelectedValues(".color-filter");

                if (selectedCategories.length === $(".category-filter").length) {
                    selectedCategories = [];
                }
                if (selectedColors.length === $(".color-filter").length) {
                    selectedColors = [];
                }

                loadProducts("/load-more-products", minPrice, maxPrice, selectedCategories, selectedColors,
                    offset);
            });

            // Generic function to load products from a given URL (endpoint)
            function loadProducts(url, minPrice, maxPrice, categories, colors, currentOffset) {
                $("#loading").show();
                $("#load-more").hide();

                $.ajax({
                    url: url,
                    method: "GET",
                    data: {
                        minPrice: minPrice,
                        maxPrice: maxPrice,
                        categories: categories,
                        colors: colors,
                        offset: currentOffset
                    },
                    success: function(response) {
                        if (response.status === "success") {
                            // Check if no products were returned
                            if (response.noProducts) {
                                $("#product-list").html(
                                    "<div class='no-products text-center'>No products to display..</div>"
                                    );
                                $("#load-more").hide();
                            } else {
                                // On a fresh load (currentOffset === 0), replace the list; otherwise, append
                                if (currentOffset === 0) {
                                    $("#product-list").html(response.html);
                                } else {
                                    $("#product-list").append(response.html);
                                }
                                // Update offset and show Load More button if more products exist
                                if (response.hasMore) {
                                    offset = currentOffset + limit;
                                    $("#load-more").data("offset", offset).show();
                                } else {
                                    $("#load-more").hide();
                                }
                            }
                        } else {
                            alert("Error loading products. Please try again.");
                        }
                    },
                    error: function() {
                        alert("Error loading products. Please try again.");
                    },
                    complete: function() {
                        $("#loading").hide();
                    }
                });
            }
        });
    </script>
@endpush
