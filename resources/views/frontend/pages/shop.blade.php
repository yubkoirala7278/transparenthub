@extends('frontend.layouts.master')
@section('content')



    <section class="top-add-wrapper mt-0">
        <div class="">
            <img class="top-add-gif" src="{{asset('frontend/gif/main-2.gif')}}" alt="..." loading="lazy">
        </div>
    </section>

    <div class="container-fluid mobile-filter-btn d-flex justify-content-end d-lg-none mt-2">
        <button class="btn p-0 text-danger" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i
                class="fa-solid fa-filter  me-1"></i>Filter</button>
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
                <div class="row mt-0 g-2">

                    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                        <div class="card" style="width: 100%">
                            <div class="product-image">
                                <a href="">
                                    <img src="{{asset('frontend/img/product/product-1.jpg')}}" class="img-fluid w-100" alt="...">
                                </a>
                                <div class="shop-cat new">
                                    <a href="{{ route('product.detail') }}" class="text-decoration-none text-white"><span
                                            class="fw-semibold">New</span></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{route('product.detail')}}" class="text-decoration-none">
                                    <h5 class="card-title m-0">
                                        Blue Chain Brush With Durability For Bike
                                    </h5>
                                </a>
                                <p class="price m-0 mt-2">Rs 1,120</p>
                                <small class="text-decoration-line-through text-secondary me-1">Rs 1,500</small>
                                <small>-20% off</small>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                        <div class="card" style="width: 100%">
                            <div class="product-image">
                                <a href="">
                                    <img src="{{asset('frontend/img/product/product-2.jpg')}}" class="img-fluid w-100" alt="...">
                                </a>
                                <div class="shop-cat hot">
                                    <a href="" class="text-decoration-none text-white"><span
                                            class="fw-semibold">Hot</span></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{route('product.detail')}}" class="text-decoration-none">
                                    <h5 class="card-title m-0">
                                        Blue Chain Brush With Durability For Bike
                                    </h5>
                                </a>
                                <p class="price m-0 mt-2">Rs 1,120</p>
                                <small class="text-decoration-line-through text-secondary me-1">Rs 1,500</small>
                                <small>-20% off</small>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                        <div class="card" style="width: 100%">
                            <div class="product-image">
                                <a href="">
                                    <img src="{{asset('frontend/img/product/product-3.jpg')}}" class="img-fluid w-100" alt="...">
                                </a>
                                <div class="shop-cat new">
                                    <a href="" class="text-decoration-none text-white"><span
                                            class="fw-semibold">Popular</span></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{route('product.detail')}}" class="text-decoration-none">
                                    <h5 class="card-title m-0">
                                        Blue Chain Brush With Durability For Bike
                                    </h5>
                                </a>
                                <p class="price m-0 mt-2">Rs 1,120</p>
                                <small class="text-decoration-line-through text-secondary me-1">Rs 1,500</small>
                                <small>-20% off</small>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                        <div class="card" style="width: 100%">
                            <div class="product-image">
                                <a href="">
                                    <img src="{{asset('frontend/img/product/product-4.jpg')}}" class="img-fluid w-100" alt="...">
                                </a>
                                <div class="shop-cat hot">
                                    <a href="{{ route('product.detail') }}" class="text-decoration-none text-white"><span
                                            class="fw-semibold">New</span></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{route('product.detail')}}" class="text-decoration-none">
                                    <h5 class="card-title m-0">
                                        Blue Chain Brush With Durability For Bike
                                    </h5>
                                </a>
                                <p class="price m-0 mt-2">Rs 1,120</p>
                                <small class="text-decoration-line-through text-secondary me-1">Rs 1,500</small>
                                <small>-20% off</small>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                        <div class="card" style="width: 100%">
                            <div class="product-image">
                                <a href="">
                                    <img src="{{asset('frontend/img/product/product-5.jpg')}}" class="img-fluid w-100" alt="...">
                                </a>
                                <div class="shop-cat new">
                                    <a href="" class="text-decoration-none text-white"><span
                                            class="fw-semibold">Hot</span></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{route('product.detail')}}" class="text-decoration-none">
                                    <h5 class="card-title m-0">
                                        Blue Chain Brush With Durability For Bike
                                    </h5>
                                </a>
                                <p class="price m-0 mt-2">Rs 1,120</p>
                                <small class="text-decoration-line-through text-secondary me-1">Rs 1,500</small>
                                <small>-20% off</small>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                        <div class="card" style="width: 100%">
                            <div class="product-image">
                                <a href="">
                                    <img src="{{asset('frontend/img/product/product-6.jpg')}}" class="img-fluid w-100" alt="...">
                                </a>
                                <div class="shop-cat hot">
                                    <a href="" class="text-decoration-none text-white"><span
                                            class="fw-semibold">Popular</span></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{route('product.detail')}}" class="text-decoration-none">
                                    <h5 class="card-title m-0">
                                        Blue Chain Brush With Durability For Bike
                                    </h5>
                                </a>
                                <p class="price m-0 mt-2">Rs 1,120</p>
                                <small class="text-decoration-line-through text-secondary me-1">Rs 1,500</small>
                                <small>-20% off</small>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                        <div class="card" style="width: 100%">
                            <div class="product-image">
                                <a href="">
                                    <img src="{{asset('frontend/img/product/product-7.jpg')}}" class="img-fluid w-100" alt="...">
                                </a>
                                <div class="shop-cat new">
                                    <a href="" class="text-decoration-none text-white"><span
                                            class="fw-semibold">Hot</span></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{route('product.detail')}}" class="text-decoration-none">
                                    <h5 class="card-title m-0">
                                        Blue Chain Brush With Durability For Bike
                                    </h5>
                                </a>
                                <p class="price m-0 mt-2">Rs 1,120</p>
                                <small class="text-decoration-line-through text-secondary me-1">Rs 1,500</small>
                                <small>-20% off</small>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                        <div class="card" style="width: 100%">
                            <div class="product-image">
                                <a href="">
                                    <img src="{{asset('frontend/img/product/product-9.jpg')}}" class="img-fluid w-100" alt="...">
                                </a>
                                <div class="shop-cat hot">
                                    <a href="" class="text-decoration-none text-white"><span
                                            class="fw-semibold">Popular</span></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{route('product.detail')}}" class="text-decoration-none">
                                    <h5 class="card-title m-0">
                                        Blue Chain Brush With Durability For Bike
                                    </h5>
                                </a>
                                <p class="price m-0 mt-2">Rs 1,120</p>
                                <small class="text-decoration-line-through text-secondary me-1">Rs 1,500</small>
                                <small>-20% off</small>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                        <div class="card" style="width: 100%">
                            <div class="product-image">
                                <a href="">
                                    <img src="{{asset('frontend/img/product/product-10.jpg')}}" class="img-fluid w-100" alt="...">
                                </a>
                                <div class="shop-cat new">
                                    <a href="{{ route('product.detail') }}" class="text-decoration-none text-white"><span
                                            class="fw-semibold">New</span></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{route('product.detail')}}" class="text-decoration-none">
                                    <h5 class="card-title m-0">
                                        Blue Chain Brush With Durability For Bike
                                    </h5>
                                </a>
                                <p class="price m-0 mt-2">Rs 1,120</p>
                                <small class="text-decoration-line-through text-secondary me-1">Rs 1,500</small>
                                <small>-20% off</small>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                        <div class="card" style="width: 100%">
                            <div class="product-image">
                                <a href="">
                                    <img src="{{asset('frontend/img/product/product-11.jpg')}}" class="img-fluid w-100" alt="...">
                                </a>
                                <div class="shop-cat hot">
                                    <a href="" class="text-decoration-none text-white"><span
                                            class="fw-semibold">Popular</span></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{route('product.detail')}}" class="text-decoration-none">
                                    <h5 class="card-title m-0">
                                        Blue Chain Brush With Durability For Bike
                                    </h5>
                                </a>
                                <p class="price m-0 mt-2">Rs 1,120</p>
                                <small class="text-decoration-line-through text-secondary me-1">Rs 1,500</small>
                                <small>-20% off</small>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                        <div class="card" style="width: 100%">
                            <div class="product-image">
                                <a href="">
                                    <img src="{{asset('frontend/img/product/product-12.jpg')}}" class="img-fluid w-100" alt="...">
                                </a>
                                <div class="shop-cat new">
                                    <a href="" class="text-decoration-none text-white"><span
                                            class="fw-semibold">Solid</span></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{route('product.detail')}}" class="text-decoration-none">
                                    <h5 class="card-title m-0">
                                        Blue Chain Brush With Durability For Bike
                                    </h5>
                                </a>
                                <p class="price m-0 mt-2">Rs 1,120</p>
                                <small class="text-decoration-line-through text-secondary me-1">Rs 1,500</small>
                                <small>-20% off</small>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                        <div class="card" style="width: 100%">
                            <div class="product-image">
                                <a href="">
                                    <img src="{{asset('frontend/img/product/product-3.webp')}}" class="img-fluid w-100" alt="...">
                                </a>
                                <div class="shop-cat new">
                                    <a href="" class="text-decoration-none text-white"><span
                                            class="fw-semibold">Popular</span></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{route('product.detail')}}" class="text-decoration-none">
                                    <h5 class="card-title m-0">
                                        Blue Chain Brush With Durability For Bike
                                    </h5>
                                </a>
                                <p class="price m-0 mt-2">Rs 1,120</p>
                                <small class="text-decoration-line-through text-secondary me-1">Rs 1,500</small>
                                <small>-20% off</small>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                        <div class="card" style="width: 100%">
                            <div class="product-image">
                                <a href="">
                                    <img src="{{asset('frontend/img/product/product-5.jpg')}}" class="img-fluid w-100" alt="...">
                                </a>
                                <div class="shop-cat new">
                                    <a href="" class="text-decoration-none text-white"><span
                                            class="fw-semibold">Hot</span></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{route('product.detail')}}" class="text-decoration-none">
                                    <h5 class="card-title m-0">
                                        Blue Chain Brush With Durability For Bike
                                    </h5>
                                </a>
                                <p class="price m-0 mt-2">Rs 1,120</p>
                                <small class="text-decoration-line-through text-secondary me-1">Rs 1,500</small>
                                <small>-20% off</small>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                        <div class="card" style="width: 100%">
                            <div class="product-image">
                                <a href="">
                                    <img src="{{asset('frontend/img/product/product-6.jpg')}}" class="img-fluid w-100" alt="...">
                                </a>
                                <div class="shop-cat hot">
                                    <a href="" class="text-decoration-none text-white"><span
                                            class="fw-semibold">Popular</span></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{route('product.detail')}}" class="text-decoration-none">
                                    <h5 class="card-title m-0">
                                        Blue Chain Brush With Durability For Bike
                                    </h5>
                                </a>
                                <p class="price m-0 mt-2">Rs 1,120</p>
                                <small class="text-decoration-line-through text-secondary me-1">Rs 1,500</small>
                                <small>-20% off</small>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                        <div class="card" style="width: 100%">
                            <div class="product-image">
                                <a href="">
                                    <img src="{{asset('frontend/img/product/product-7.jpg')}}" class="img-fluid w-100" alt="...">
                                </a>
                                <div class="shop-cat new">
                                    <a href="" class="text-decoration-none text-white"><span
                                            class="fw-semibold">Hot</span></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{route('product.detail')}}" class="text-decoration-none">
                                    <h5 class="card-title m-0">
                                        Blue Chain Brush With Durability For Bike
                                    </h5>
                                </a>
                                <p class="price m-0 mt-2">Rs 1,120</p>
                                <small class="text-decoration-line-through text-secondary me-1">Rs 1,500</small>
                                <small>-20% off</small>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                        <div class="card" style="width: 100%">
                            <div class="product-image">
                                <a href="">
                                    <img src="{{asset('frontend/img/product/product-9.jpg')}}" class="img-fluid w-100" alt="...">
                                </a>
                                <div class="shop-cat hot">
                                    <a href="" class="text-decoration-none text-white"><span
                                            class="fw-semibold">Popular</span></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{route('product.detail')}}" class="text-decoration-none">
                                    <h5 class="card-title m-0">
                                        Blue Chain Brush With Durability For Bike
                                    </h5>
                                </a>
                                <p class="price m-0 mt-2">Rs 1,120</p>
                                <small class="text-decoration-line-through text-secondary me-1">Rs 1,500</small>
                                <small>-20% off</small>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                        <div class="card" style="width: 100%">
                            <div class="product-image">
                                <a href="">
                                    <img src="{{asset('frontend/img/product/product-10.jpg')}}" class="img-fluid w-100" alt="...">
                                </a>
                                <div class="shop-cat new">
                                    <a href="{{ route('product.detail') }}" class="text-decoration-none text-white"><span
                                            class="fw-semibold">New</span></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{route('product.detail')}}" class="text-decoration-none">
                                    <h5 class="card-title m-0">
                                        Blue Chain Brush With Durability For Bike
                                    </h5>
                                </a>
                                <p class="price m-0 mt-2">Rs 1,120</p>
                                <small class="text-decoration-line-through text-secondary me-1">Rs 1,500</small>
                                <small>-20% off</small>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                        <div class="card" style="width: 100%">
                            <div class="product-image">
                                <a href="">
                                    <img src="{{asset('frontend/img/product/product-11.jpg')}}" class="img-fluid w-100" alt="...">
                                </a>
                                <div class="shop-cat hot">
                                    <a href="" class="text-decoration-none text-white"><span
                                            class="fw-semibold">Popular</span></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{route('product.detail')}}" class="text-decoration-none">
                                    <h5 class="card-title m-0">
                                        Blue Chain Brush With Durability For Bike
                                    </h5>
                                </a>
                                <p class="price m-0 mt-2">Rs 1,120</p>
                                <small class="text-decoration-line-through text-secondary me-1">Rs 1,500</small>
                                <small>-20% off</small>

                            </div>
                        </div>
                    </div>





                </div>


                <div class="d-flex justify-content-center mt-5">
                    <div class="pagination">
                        <ul class="ps-0 pagination-menus">
                            <li class="pagination-link">
                                <a href="" class="link active"><i class="fa-solid fa-chevron-left"></i></a>
                            </li>
                            <li class="pagination-link">
                                <a href="" class="link">1</a>
                            </li>
                            <li class="pagination-link">
                                <a href="" class="link">2</a>
                            </li>
                            <li class="pagination-link">
                                <a href="" class="link">3</a>
                            </li>
                            <li class="pagination-link">
                                <a href="" class="link">...</a>
                            </li>
                            <li class="pagination-link">
                                <a href="" class="link">9</a>
                            </li>
                            <li class="pagination-link">
                                <a href="" class="link">10</a>
                            </li>
                            <li class="pagination-link">
                                <a href="" class="link"><i class="fa-solid fa-chevron-right"></i></a>
                            </li>
                        </ul>
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
