@extends('frontend.layouts.master')
@section('content')
    <section class="top-add-wrapper mt-0">
        <div class="">
            <img class="top-add-gif" src="{{asset('frontend/gif/main-2.gif')}}" alt="..." loading="lazy">
        </div>
    </section>


    <section class="professional-detail  container-fluid mt-5">
        <div class="row gy-4">
            <div class="col-lg-6">
                <div class="row">
                    <div class="professional-detail-img">
                        <img src="{{asset('frontend/img/professional/professional-2.jpg')}}" class="w-100 img-fluid" id=""
                            alt="">
                    </div>

                </div>
            </div>

            <div class="col-lg-6">
                <div class="professional-contain d-flex flex-column gap-2">
                    <h2 class="professional-title m-0">Dr. John Doe</h2>

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


                    <div class="position d-flex align-items-end align-items-lg-center gap-5">
                        <p class="m-0">Position: <strong class="fs-4">MBBS, MD (Professional)</strong></p>
                    </div>


                    <div class="product-share d-flex gap-2 align-items-center my-1">
                        <span>Share:</span>
                        <a href="" class="btn btn-sm btn-primary"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="" class="btn btn-sm btn-success"><i class="fa-brands fa-viber"></i></a>
                        <a href="" class="btn btn-sm btn-danger"><i class="fa-brands fa-instagram"></i></a>
                        <a href="" class="btn btn-sm btn-warning"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>

                    <div class="description">
                        <h3 class="fs-5 fw-bold">About John Doe</h3>
                        <p> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ea, tempora quia vero alias
                            maiores, culpa architecto earum eaque modi quibusdam possimus ratione ipsam sapiente,
                            quam porro tenetur ad sint excepturi. </p>
                    </div>

                    <div class="all-btn row gy-4">
                        <div class="col-md-12"><a href="" class="btn w-100 p-2">Appoinment</a></div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

