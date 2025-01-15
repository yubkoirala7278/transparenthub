@extends('frontend.layouts.master')
@section('content')
    <section class="top-add-wrapper mt-0">
        <div class="">
            <img class="top-add-gif" src="{{asset('frontend/gif/main-2.gif')}}" alt="..." loading="lazy">
        </div>
    </section>

    <div class="container-fluid mobile-filter-btn d-flex justify-content-end d-lg-none mt-2">
        <button class="btn p-0 text-danger" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
            aria-controls="offcanvasRight"><i class="fa-solid fa-filter  me-1"></i>Filter</button>
    </div>

    <section class="container-fluid professionalist mt-2 mt-lg-5">
        <!-- <div class="section-title">
                <h2 class="fs-5 mb-3 title">हाम्रो विशेषज्ञहरु</h2>
            </div> -->


        <div class="row">
            <div class="col-lg-2 d-none d-lg-block">
                <div class="row product-filter">

                    <div class="category">
                        <h2 class="fs-6 fw-semibold text-danger">Category</h2>

                        <!-- Parent Checkboxes with Sub-Checkbox Lists -->
                        <div class="professional-box px-2">
                            <div class="form-check">
                                <input class="form-check-input parent-checkbox" type="checkbox" id="doctorCheckbox"
                                    data-target="doctorSubList">
                                <label class="form-check-label" for="doctorCheckbox">
                                    Doctor
                                </label>
                            </div>

                            <div id="doctorSubList" class="sub-checkbox-list ms-4 mt-2 d-none">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="doctorSubOne">
                                    <label class="form-check-label" for="doctorSubOne">Child Specialist</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="doctorSubTwo">
                                    <label class="form-check-label" for="doctorSubTwo">Dentist</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="doctorSubThree">
                                    <label class="form-check-label" for="doctorSubThree">Eye Specialist</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="doctorSubFour">
                                    <label class="form-check-label" for="doctorSubFour">Brain Specialist</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="doctorSubFive">
                                    <label class="form-check-label" for="doctorSubFive">Heart Specialist</label>
                                </div>
                            </div>
                        </div>

                        <div class="professional-box px-2">
                            <div class="form-check">
                                <input class="form-check-input parent-checkbox" type="checkbox" id="engineerCheckbox"
                                    data-target="engineerSubList">
                                <label class="form-check-label" for="engineerCheckbox">
                                    Engineers
                                </label>
                            </div>

                            <div id="engineerSubList" class="sub-checkbox-list ms-4 mt-2 d-none">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="engineerSubOne">
                                    <label class="form-check-label" for="engineerSubOne">Civil</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="engineerSubTwo">
                                    <label class="form-check-label" for="engineerSubTwo">Mechanical</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="engineerSubThree">
                                    <label class="form-check-label" for="engineerSubThree">Computer</label>
                                </div>
                            </div>
                        </div>

                        <div class="professional-box px-2">
                            <div class="form-check">
                                <input class="form-check-input parent-checkbox" type="checkbox" id="painterCheckbox"
                                    data-target="painterSubList">
                                <label class="form-check-label" for="painterCheckbox">
                                    Painter
                                </label>
                            </div>

                            <div id="painterSubList" class="sub-checkbox-list ms-4 mt-2 d-none">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="painterSubOne">
                                    <label class="form-check-label" for="painterSubOne">House Painter</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="painterSubTwo">
                                    <label class="form-check-label" for="painterSubTwo">Wall panter</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="painterSubThree">
                                    <label class="form-check-label" for="painterSubThree">Statue Panter</label>
                                </div>
                            </div>
                        </div>

                        <div class="professional-box px-2">
                            <div class="form-check">
                                <input class="form-check-input parent-checkbox" type="checkbox" id="cookCheckbox"
                                    data-target="cookSubList">
                                <label class="form-check-label" for="cookCheckbox">
                                    Cook
                                </label>
                            </div>

                            <div id="cookSubList" class="sub-checkbox-list ms-4 mt-2 d-none">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="cookSubOne">
                                    <label class="form-check-label" for="cookSubOne">One</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="cookSubTwo">
                                    <label class="form-check-label" for="cookSubTwo">Two</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="cookSubThree">
                                    <label class="form-check-label" for="cookSubThree">Three</label>
                                </div>
                            </div>
                        </div>

                        <div class="professional-box px-2">
                            <div class="form-check">
                                <input class="form-check-input parent-checkbox" type="checkbox" id="porterCheckbox"
                                    data-target="porterSubList">
                                <label class="form-check-label" for="porterCheckbox">
                                    Porter
                                </label>
                            </div>
                        </div>

                        <div class="professional-box px-2">
                            <div class="form-check">
                                <input class="form-check-input parent-checkbox" type="checkbox" id="driverCheckbox"
                                    data-target="driverSubList">
                                <label class="form-check-label" for="driverCheckbox">
                                    Driver
                                </label>
                            </div>
                        </div>

                    </div>


                </div>
            </div>

            <div class="col-lg-10">
                <div class="row g-3">

                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="box shadow">
                            <img src="{{asset('frontend/img/professional/team-1.jpg')}}" class="w-100" alt="Dr. John Doe">
                            <div class="box-body">
                                <p class="m-0"><strong>Dr. John Doe</strong></p>
                                <small>MBBS, MD (Professional)</small>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                        style="font-size: 13px;">View</a>
                                    <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="box shadow">
                            <img src="{{asset('frontend/img/professional/team-2.jpg')}}" class="w-100" alt="Dr. John Doe">
                            <div class="box-body">
                                <p class="m-0"><strong>Dr. John Doe</strong></p>
                                <small>MBBS, MD (Professional)</small>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                        style="font-size: 13px;">View</a>
                                    <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="box shadow">
                            <img src="{{asset('frontend/img/professional/team-1.jpg')}}" class="w-100" alt="Dr. John Doe">
                            <div class="box-body">
                                <p class="m-0"><strong>Dr. John Doe</strong></p>
                                <small>MBBS, MD (Professional)</small>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                        style="font-size: 13px;">View</a>
                                    <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="box shadow">
                            <img src="{{asset('frontend/img/professional/team-3.jpg')}}" class="w-100" alt="Dr. John Doe">
                            <div class="box-body">
                                <p class="m-0"><strong>Dr. John Doe</strong></p>
                                <small>MBBS, MD (Professional)</small>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                        style="font-size: 13px;">View</a>
                                    <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="box shadow">
                            <img src="{{asset('frontend/img/professional/team-4.jpg')}}" class="w-100" alt="Dr. John Doe">
                            <div class="box-body">
                                <p class="m-0"><strong>Dr. John Doe</strong></p>
                                <small>MBBS, MD (Professional)</small>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                        style="font-size: 13px;">View</a>
                                    <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="box shadow">
                            <img src="{{asset('frontend/img/professional/team-4.jpg')}}" class="w-100" alt="Dr. John Doe">
                            <div class="box-body">
                                <p class="m-0"><strong>Dr. John Doe</strong></p>
                                <small>MBBS, MD (Professional)</small>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                        style="font-size: 13px;">View</a>
                                    <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="box shadow">
                            <img src="{{asset('frontend/img/professional/team-4.jpg')}}" class="w-100" alt="Dr. John Doe">
                            <div class="box-body">
                                <p class="m-0"><strong>Dr. John Doe</strong></p>
                                <small>MBBS, MD (Professional)</small>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                        style="font-size: 13px;">View</a>
                                    <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="box shadow">
                            <img src="{{asset('frontend/img/professional/team-3.jpg')}}" class="w-100" alt="Dr. John Doe">
                            <div class="box-body">
                                <p class="m-0"><strong>Dr. John Doe</strong></p>
                                <small>MBBS, MD (Professional)</small>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                        style="font-size: 13px;">View</a>
                                    <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="box shadow">
                            <img src="{{asset('frontend/img/professional/team-2.jpg')}}" class="w-100" alt="Dr. John Doe">
                            <div class="box-body">
                                <p class="m-0"><strong>Dr. John Doe</strong></p>
                                <small>MBBS, MD (Professional)</small>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                        style="font-size: 13px;">View</a>
                                    <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="box shadow">
                            <img src="{{asset('frontend/img/professional/team-1.jpg')}}" class="w-100" alt="Dr. John Doe">
                            <div class="box-body">
                                <p class="m-0"><strong>Dr. John Doe</strong></p>
                                <small>MBBS, MD (Professional)</small>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                        style="font-size: 13px;">View</a>
                                    <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="box shadow">
                            <img src="{{asset('frontend/img/professional/team-2.jpg')}}" class="w-100" alt="Dr. John Doe">
                            <div class="box-body">
                                <p class="m-0"><strong>Dr. John Doe</strong></p>
                                <small>MBBS, MD (Professional)</small>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                        style="font-size: 13px;">View</a>
                                    <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="box shadow">
                            <img src="{{asset('frontend/img/professional/team-1.jpg')}}" class="w-100" alt="Dr. John Doe">
                            <div class="box-body">
                                <p class="m-0"><strong>Dr. John Doe</strong></p>
                                <small>MBBS, MD (Professional)</small>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('professional.detail') }}" class="btn btn-primary p-2"
                                        style="font-size: 13px;">View</a>
                                    <button class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>


    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <div class="section-title">
                <h5 class="offcanvas-title fs-5 mb-3 title" id="offcanvasRightLabel">Filter Proffesionalist</h5>
            </div>

            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <div class="mobile-filter">
                <div class="category">
                    <h2 class="fs-6 fw-semibold text-danger">Category</h2>

                    <!-- Parent Checkboxes with Sub-Checkbox Lists -->
                    <div class="professional-box px-2">
                        <div class="form-check">
                            <input class="form-check-input parent-checkbox" type="checkbox" id="doctorMobileCheckbox"
                                data-target="doctorMobileSubList">
                            <label class="form-check-label" for="doctorMobileCheckbox">
                                Doctor
                            </label>
                        </div>

                        <div id="doctorMobileSubList" class="sub-checkbox-list ms-4 mt-2 d-none">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="doctorMobileSubOne">
                                <label class="form-check-label" for="doctorMobileSubOne">Child Specialist</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="doctorMobileSubTwo">
                                <label class="form-check-label" for="doctorMobileSubTwo">Dentist</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="doctorMobileSubThree">
                                <label class="form-check-label" for="doctorMobileSubThree">Eye Specialist</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="doctorMobileSubFour">
                                <label class="form-check-label" for="doctorMobileSubFour">Brain Specialist</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="doctorMobileSubFive">
                                <label class="form-check-label" for="doctorMobileSubFive">Heart Specialist</label>
                            </div>
                        </div>
                    </div>

                    <div class="professional-box px-2">
                        <div class="form-check">
                            <input class="form-check-input parent-checkbox" type="checkbox" id="engineerMobileCheckbox"
                                data-target="engineerMobileSubList">
                            <label class="form-check-label" for="engineerMobileCheckbox">
                                Engineers
                            </label>
                        </div>

                        <div id="engineerMobileSubList" class="sub-checkbox-list ms-4 mt-2 d-none">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="engineerMobileSubOne">
                                <label class="form-check-label" for="engineerMobileSubOne">Civil</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="engineerMobileSubTwo">
                                <label class="form-check-label" for="engineerMobileSubTwo">Mechanical</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="engineerMobileSubThree">
                                <label class="form-check-label" for="engineerMobileSubThree">Computer</label>
                            </div>
                        </div>
                    </div>

                    <div class="professional-box px-2">
                        <div class="form-check">
                            <input class="form-check-input parent-checkbox" type="checkbox" id="painterMobileCheckbox"
                                data-target="painterMobileSubList">
                            <label class="form-check-label" for="painterMobileCheckbox">
                                Painter
                            </label>
                        </div>

                        <div id="painterMobileSubList" class="sub-checkbox-list ms-4 mt-2 d-none">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="painterMobileSubOne">
                                <label class="form-check-label" for="painterMobileSubOne">House PainterMobile</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="painterMobileSubTwo">
                                <label class="form-check-label" for="painterMobileSubTwo">Wall Painter</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="painterMobileSubThree">
                                <label class="form-check-label" for="painterMobileSubThree">Statue Painter</label>
                            </div>
                        </div>
                    </div>

                    <div class="professional-box px-2">
                        <div class="form-check">
                            <input class="form-check-input parent-checkbox" type="checkbox" id="cookMobileCheckbox"
                                data-target="cookMobileSubList">
                            <label class="form-check-label" for="cookMobileCheckbox">
                                Cook
                            </label>
                        </div>

                        <div id="cookMobileSubList" class="sub-checkbox-list ms-4 mt-2 d-none">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="cookMobileSubOne">
                                <label class="form-check-label" for="cookMobileSubOne">One</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="cookMobileSubTwo">
                                <label class="form-check-label" for="cookMobileSubTwo">Two</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="cookMobileSubFour">
                                <label class="form-check-label" for="cookMobileSubFour">Three</label>
                            </div>
                        </div>
                    </div>

                    <div class="professional-box px-2">
                        <div class="form-check">
                            <input class="form-check-input parent-checkbox" type="checkbox" id="porterMobileCheckbox"
                                data-target="porterMobileSubList">
                            <label class="form-check-label" for="porterMobileCheckbox">
                                Porter
                            </label>
                        </div>
                    </div>

                    <div class="professional-box px-2">
                        <div class="form-check">
                            <input class="form-check-input parent-checkbox" type="checkbox" id="driverMobileCheckbox"
                                data-target="driverMobileSubList">
                            <label class="form-check-label" for="driverMobileCheckbox">
                                Driver
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
    // Add event listener to all parent checkboxes
    document.querySelectorAll('.parent-checkbox').forEach((checkbox) => {
        checkbox.addEventListener('change', function () {
            const targetId = this.getAttribute('data-target');
            const targetList = document.getElementById(targetId);
            if (targetList) {
                targetList.classList.toggle('d-none', !this.checked);
            }
        });
    });
</script>
@endpush

