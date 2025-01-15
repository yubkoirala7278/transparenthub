@extends('frontend.layouts.master')
@section('content')

    <section class="top-add-wrapper mt-0">
        <div class="">
            <img class="top-add-gif" src="{{ asset('frontend/gif/main-2.gif') }}" alt="..." loading="lazy">
        </div>
    </section>

    <div class="about container-fluid">
        <div class="row justify-content-center py-5">
            <div class="col-lg-8 text-center">
                <div class="page-title">
                    <h1 class="title">About Us</h1>
                </div>
                <p class="">We are passionate about delivering exceptional solutions to meet your needs. Our team is
                    dedicated to creating value and making a difference in the world.</p>
            </div>
        </div>

        <div class="row pb-5 gy-4">
            <div class="col-md-6 col-lg-4 text-center">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x text-primary mb-3"></i>
                        <h5 class="card-title primary-text fw-bold">Our Team</h5>
                        <p class="card-text">A diverse group of skilled professionals ready to bring your ideas to
                            life.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 text-center">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <i class="fas fa-lightbulb fa-3x text-warning mb-3"></i>
                        <h5 class="card-title primary-text fw-bold">Our Mission</h5>
                        <p class="card-text">Innovating and transforming challenges into meaningful opportunities.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 text-center">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <i class="fas fa-globe fa-3x text-success mb-3"></i>
                        <h5 class="card-title primary-text fw-bold">Our Vision</h5>
                        <p class="card-text">Empowering a sustainable future through creativity and technology.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="row py-5 bg-light">
            <div class="col-md-6">
                <h3 class="fw-bold primary-text">Our Story</h3>
                <p class="desc-justify">Founded with a belief in creating impactful solutions, our journey has been
                    one of dedication, innovation, and growth. We strive to exceed expectations and deliver
                    excellence in every project. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam nulla
                    dignissimos et, velit unde accusantium aliquid, sapiente porro repudiandae voluptatem odio
                    laboriosam in maxime nihil iste debitis. Doloremque repellendus inventore explicabo facilis
                    earum. Voluptates sapiente distinctio nemo fugit exercitationem? Commodi ipsam optio aliquid,
                    nesciunt, voluptas earum sint debitis, quod omnis neque explicabo blanditiis amet adipisci
                    dolore aperiam. Iste, vitae officia.</p>
                <p class="desc-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor eius
                    reiciendis vel, molestiae
                    quisquam maxime eaque asperiores, quod aliquid doloribus, voluptatem quis obcaecati ipsum modi
                    doloremque consequuntur quos quo! Vel odio incidunt voluptatibus mollitia ut eaque, atque eum
                    dignissimos numquam!</p>
                <p class="desc-justify">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad sequi facilis
                    quisquam facere necessitatibus dolor cum dolores corrupti fugit tenetur?</p>
            </div>
            <div class="col-md-6 text-center">
                <img src="img/slider/japan-2.jpg" class="img-fluid rounded" alt="Our Story">
            </div>
        </div> -->

        <div class="row py-5">
            <div class="col text-center">
                <h3 class="fw-bold primary-text">Get in Touch</h3>
                <p class="">Have questions or want to work with us? Reach out, and let's make something
                    great together!</p>
                <a href="{{ route('contact') }}" class="btn btn-danger btn-lg mt-3"><i class="fas fa-envelope"></i> Contact
                    Us</a>
            </div>
        </div>

    </div>


@endsection
