@extends('frontend.layouts.master')
@section('content')
    {{-- <section class="top-add-wrapper mt-0">
        <div class="">
            <img class="top-add-gif" src="{{ asset('frontend/gif/main-2.gif') }}" alt="..." loading="lazy">
        </div>
    </section> --}}

    <div class="container-fluid mobile-filter-btn d-flex justify-content-end d-lg-none mt-2">
        <button class="btn p-0 text-danger" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
            aria-controls="offcanvasRight"><i class="fa-solid fa-filter  me-1"></i>Filter</button>
    </div>

    <section class="container-fluid home-shop mt-0 mt-lg-4">
        <!-- <div class="section-title">
                                                                                                                                                                                            <h2 class="fs-5 mb-3 title">Our Product</h2>
                                                                                                                                                                                        </div> -->
        <div class="row">
            <div class="col-lg-2 d-none d-lg-block">
                <div class="row product-filter">
                    <div class="price-range">
                        <h2 class="fs-6 fw-semibold text-danger">Price Ranges</h2>
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
                    <div class="brands">
                        <h2 class="fs-6 fw-semibold text-danger">Brands</h2>
                        @if (count($brands) > 0)
                            @foreach ($brands as $brand)
                                <div class="form-check">
                                    <input class="form-check-input brand-filter" type="checkbox"
                                        value="{{ $brand->id }}" id="brand{{ $brand->id }}">
                                    <label class="form-check-label" for="brand{{ $brand->id }}">
                                        {{ $brand->name }}
                                    </label>
                                </div>
                            @endforeach
                        @endif

                    </div>
                    <div class="hr my-3 w-100"></div>
                    <div class="category">
                        <h2 class="fs-6 fw-semibold text-danger">Category</h2>
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
                        <h2 class="fs-6 fw-semibold text-danger">Colors</h2>
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
                <div class="d-flex align-items-center justify-content-between">
                    <!-- Search Box -->
                    <div class="search-box me-2 position-relative">
                        <input type="text" id="searchQuery" class="form-control" placeholder="Search Products...">
                        <i class="fas fa-search position-absolute top-50 end-0 translate-middle-y pe-3"></i>
                    </div>
                    
                    <!-- Sort Order -->
                    <div class="d-flex align-items-center">
                        <label for="sortOrder">Sort By:</label>
                        <select id="sortOrder" class="form-select w-auto ms-1">
                            <option value="">Best Match</option>
                            <option value="low-high">Price: Low to High</option>
                            <option value="high-low">Price: High to Low</option>
                        </select>
                    </div>
                </div>

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
            let searchTimeout;

            // Clear filter fields on page load
            $("#minPrice").val('');
            $("#maxPrice").val('');
            $("#searchQuery").val('');
            $(".category-filter,.brand-filter, .color-filter").prop("checked", false);
            $("#sortOrder").val('');

            // Show Load More button if initial products exist
            if (offset > 0) {
                $("#load-more").data("offset", offset).show();
            }

            // When filter checkboxes or sort field change
            $(".category-filter,.brand-filter, .color-filter, #sortOrder").on("change", function() {
                offset = 0; // Reset offset on filter change
                loadFilteredProducts();
            });

            // Price filter button click
            $("#filterPriceBtn").on("click", function() {
                offset = 0;
                loadFilteredProducts();
            });

            // Listen for keyup on search input with a 1-second debounce
            $("#searchQuery").on("keyup", function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    offset = 0;
                    loadFilteredProducts();
                }, 1000);
            });

            // Helper: Get selected checkbox values
            function getSelectedValues(selector) {
                let selected = [];
                $(selector + ":checked").each(function() {
                    selected.push($(this).val());
                });
                return selected;
            }

            // Load (or reload) products using the filter-products endpoint
            function loadFilteredProducts() {
                const minPrice = $("#minPrice").val() || 0;
                const maxPrice = $("#maxPrice").val() || null;
                let selectedCategories = getSelectedValues(".category-filter");
                let selectedBrands = getSelectedValues(".brand-filter");
                let selectedColors = getSelectedValues(".color-filter");
                const search = $("#searchQuery").val();
                const sort = $("#sortOrder").val();

                // If all checkboxes are selected for a filter, clear that filter
                if (selectedCategories.length === $(".category-filter").length) {
                    selectedCategories = [];
                }
                if (selectedBrands.length === $(".brand-filter").length) {
                    selectedBrands = [];
                }
                if (selectedColors.length === $(".color-filter").length) {
                    selectedColors = [];
                }

                loadProducts("/filter-products", minPrice, maxPrice, selectedCategories,selectedBrands, selectedColors, search,
                    sort, 0);
            }

            // Load more products on Load More button click (using load-more-products endpoint)
            $("#load-more").on("click", function() {
                const minPrice = $("#minPrice").val() || 0;
                const maxPrice = $("#maxPrice").val() || null;
                let selectedCategories = getSelectedValues(".category-filter");
                let selectedBrands = getSelectedValues(".brand-filter");
                let selectedColors = getSelectedValues(".color-filter");
                const search = $("#searchQuery").val();
                const sort = $("#sortOrder").val();

                if (selectedCategories.length === $(".category-filter").length) {
                    selectedCategories = [];
                }
                if (selectedBrands.length === $(".brand-filter").length) {
                    selectedBrands = [];
                }
                if (selectedColors.length === $(".color-filter").length) {
                    selectedColors = [];
                }

                loadProducts("/load-more-products", minPrice, maxPrice, selectedCategories,selectedBrands, selectedColors,
                    search, sort, offset);
            });

            // Generic function to load products from a given endpoint
            function loadProducts(url, minPrice, maxPrice, categories,brands, colors, search, sort, currentOffset) {
                $("#loading").show();
                $("#load-more").hide();

                $.ajax({
                    url: url,
                    method: "GET",
                    data: {
                        minPrice: minPrice,
                        maxPrice: maxPrice,
                        categories: categories,
                        brands: brands,
                        colors: colors,
                        search: search,
                        sort: sort,
                        offset: currentOffset
                    },
                    success: function(response) {
                        if (response.status === "success") {
                            if (response.noProducts) {
                                $("#product-list").html(
                                    "<div class='no-products'>No products to display</div>");
                                $("#load-more").hide();
                            } else {
                                if (currentOffset === 0) {
                                    $("#product-list").html(response.html);
                                } else {
                                    $("#product-list").append(response.html);
                                }
                                if (response.hasMore) {
                                    offset = currentOffset + limit;
                                    $("#load-more").data("offset", offset).show();
                                } else {
                                    $("#load-more").hide();
                                }
                            }
                        } else {
                            console.log("Error loading products. Please try again.");
                        }
                    },
                    error: function() {
                        console.log("Error loading products. Please try again.");
                    },
                    complete: function() {
                        $("#loading").hide();
                    }
                });
            }
        });
    </script>
@endpush
