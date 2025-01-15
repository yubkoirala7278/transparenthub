@extends('frontend.layouts.master')
@section('content')
    <section class="top-add-wrapper mt-0">
        <div class="">
            <img class="top-add-gif" src="{{ asset('frontend/gif/main-2.gif') }}" alt="..." loading="lazy">
        </div>
    </section>
    
    <section class="contact-us container-fluid">
        <div class="contact-form">
            <div class="page-title">
                <h2 class="mb-1 title text-center">Contact US</h2>
                <p class="text-center">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nam, a enim autem
                    excepturi iure
                    dignissimos adipisci impedit ipsam sunt similique suscipit officiis debitis iusto illum
                    temporibus
                    odit repudiandae obcaecati! Nobis?</p>
            </div>

            <div class="contact-detail mt-5 shadow p-5 border border-danger border-2">
                <div class="row gy-4">
                    <div class="col-md-6">

                        <div class="row gy-4">
                            <!-- Address Section -->
                            <div class="col-12 d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-home fa-2x bg-danger text-white p-3 rounded-circle"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Address</h6>
                                    <p class="mb-0">Kathmandu, Nepal</p>
                                </div>
                            </div>
                            <!-- Phone Section -->
                            <div class="col-12 d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-phone fa-2x bg-danger text-white p-3 rounded-circle"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Phone</h6>
                                    <p class="mb-0">+977 9803324568</p>
                                </div>
                            </div>
                            <!-- Email Section -->
                            <div class="col-12 d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-envelope fa-2x bg-danger text-white p-3 rounded-circle"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Email</h6>
                                    <p class="mb-0">info@example.com</p>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-6 shadow-lg" style="padding: 30px 40px;">
                        <h3 class="text-danger mb-3 lh-1 font-bold fs-4">Send Message</h3>
                        <form action="">
                            <div class="row gy-4 gx-0">
                                <input type="text"
                                    class="no-focus-outline form-control border-0 border-bottom border-dark rounded-0 p-0 styled-placeholder"
                                    placeholder="Full Name">
                                <input type="email"
                                    class="no-focus-outline form-control border-0 border-bottom border-dark rounded-0 p-0 styled-placeholder"
                                    placeholder="Email">
                                <textarea name="" id=""
                                    class="no-focus-outline form-control border-0 border-bottom border-dark rounded-0 p-0 styled-placeholder"
                                    placeholder="Type your message..."></textarea>
                                <button class="btn btn-danger rounded-0">Send Message</button>
                            </div>





                        </form>
                    </div>
                </div>
            </div>

        </div>



    </section>
@endsection
