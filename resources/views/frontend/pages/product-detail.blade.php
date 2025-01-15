@extends('frontend.layouts.master')
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
                            <img src="{{ asset('frontend/img/product/product-10.jpg') }}" class=""
                                id="product-detail-img" alt="">
                        </div>

                        <div class="mt-4 px-4">
                            <div class="product-detail-slider scroll-none-container">
                                <div class="product-slider-img">
                                    <img src="{{ asset('frontend/img/product/product-10.jpg') }}" class="detail-slide-img"
                                        alt="">
                                </div>
                                <div class="product-slider-img">
                                    <img src="{{ asset('frontend/img/product/product-7.jpg') }}" class="detail-slide-img"
                                        alt="">
                                </div>
                                <div class="product-slider-img">
                                    <img src="{{ asset('frontend/img/product/product-9.jpg') }}" class=" detail-slide-img"
                                        alt="">
                                </div>

                                <div class="product-slider-img">
                                    <img src="{{ asset('frontend/img/product/product-3.jpg') }}" class=" detail-slide-img"
                                        alt="">
                                </div>

                                <div class="product-slider-img">
                                    <img src="{{ asset('frontend/img/product/product-8.jpg') }}" class=" detail-slide-img"
                                        alt="">
                                </div>

                                <div class="product-slider-img">
                                    <img src="{{ asset('frontend/img/product/product-11.jpg') }}" class=" detail-slide-img"
                                        alt="">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="product-contain d-flex flex-column gap-2">
                        <h2 class="product-title m-0">Winter Beanie Hat Scarf Set Warm Knit Hat.</h2>

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
                            <small class="fw-bold text-secondary">Brand: <a href="" class="text-decoration-none">No
                                    Brand</a> | <a href="" class="text-decoration-none">More brand from No
                                    Brand</a></small>
                        </div>

                        <div class="price d-flex align-items-end align-items-lg-center gap-5">
                            <p class="m-0">Price <strong class="fs-4">Rs. 12560</strong> <span
                                    class="ms-lg-2 d-block d-lg-inline fw-semibold text-secondary text-decoration-line-through">Rs.
                                    20,000</span> </p>

                            <small class="fw-bold text-secondary">as per today's price</small>
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
                <div class="col-md-8">
                    <h3 class="fs-4 fw-bold">Product details of Winter Beanie Hat Scarf Set Warm Knit Hat Thick Fleece
                        Lined Skull Cap for Men/Women</h3>
                    <p class="desc-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis quia,
                        numquam sapiente
                        temporibus
                        rerum, ratione omnis minus est eligendi magni facere dolor, debitis quo totam sit cum! Dolorum
                        nobis
                        non exercitationem repudiandae a adipisci natus ex temporibus earum totam dolores unde nulla
                        nisi ea
                        repellat ratione voluptatem eaque, saepe ipsum. Lorem ipsum dolor sit, amet consectetur
                        adipisicing elit. Excepturi magnam enim, totam mollitia possimus eius, placeat veritatis aperiam
                        quidem cum, officiis dolorem iure! Dolores quos id delectus sequi, at tempora dolorem facere
                        necessitatibus veniam itaque, vel quasi totam velit. Cumque, dolorem nisi perspiciatis sed qui
                        illum id aliquid deserunt vero.</p>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('frontend/img/about/about-1.png') }}" class="w-100 img-fluid" alt="">
                </div>
            </div>
        </section>





    </main>
@endsection

@push('script')
    <script>
        const slideImages = document.querySelectorAll(".detail-slide-img");
        const mainImg = document.getElementById("product-detail-img");

        slideImages.forEach((slideImg) => {
            slideImg.addEventListener('click', () => {
                // Update the main image's src
                mainImg.src = slideImg.src;

                // Reset the scale of all slide images
                slideImages.forEach((img) => {
                    img.style.transform = "scale(1)"; // Reset scale to default
                });

                // Scale only the selected image
                slideImg.style.transform = "scale(1.03)";
            });
        });
    </script>
@endpush
