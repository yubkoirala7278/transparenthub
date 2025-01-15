@extends('frontend.layouts.master')
@section('content')
    <section class="top-add-wrapper mt-0">
        <div class="">
            <img class="top-add-gif" src="{{ asset('frontend/gif/main-2.gif') }}" alt="..." loading="lazy">
        </div>
    </section>


    <section class="container-fluid home-tab-news mt-5">
        <div class="row gy-3">
            <div class="col-md-12" style="position: sticky !important; top: 0; z-index: 9;">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <!-- <span class="navbar-toggler-icon"></span> -->
                            <i class="fa-solid fa-bars text-danger"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav gap-2">
                                <li class="nav-item">
                                    <button class="nav-link active news-nav-btn" aria-current="page" data-id="1">ताजा
                                        समाचार</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link news-nav-btn" data-id="8">लोकप्रिय</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link news-nav-btn" data-id="1">देश</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link news-nav-btn" data-id="8">साहित्य</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link news-nav-btn" data-id="1"> स्वास्थ्य</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link news-nav-btn" data-id="8"> प्रविधि</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link news-nav-btn" data-id="1"> अर्थ</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link news-nav-btn" data-id="8"> विश्व</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link news-nav-btn" data-id="1"> मनोरञ्जन </button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link news-nav-btn" data-id="8"> खेलकुद</button>
                                </li>

                            </ul>
                        </div>
                    </div>
                </nav>

            </div>

            <div class="col-md-8">
                <div class="row gy-5">


                    <div class="col-md-12">



                        <div class="home-news-box" id="news-1">

                            <div class="news">
                                <div class="row g-0 align-items-center justify-content-between">
                                    <div class="col-md-9">
                                        <a href="" class="text-decoration-none text-dark">
                                            <h3 class=" fs-5 fw-bold  m-0 p-0">
                                                शिलान्यासको ८ वर्षपछि राष्ट्रिय प्राणी उद्यानको डीपीआर वन
                                                मन्त्रालयमा
                                            </h3>
                                            <p class="mt-2">काठमाडौँ — शिलान्यासको ८ वर्षपछि राष्ट्रिय प्राणी
                                                उद्यानको
                                                विस्तृत परियोजना
                                                प्रतिवेदन (डीपीआर) स्वीकृतिका लागि वन तथा वातावरण मन्त्रालयमा पेस
                                                भएको छ ।
                                                भक्तपुरको सूर्यविनायक जंगलमा अन्तर्राष्ट्रिय मापदण्डको खुला
                                                चिडियाखाना
                                                बनाउने
                                                गरी राष्ट्रिय निकुञ्ज तथा वन्यजन्तु संरक्षण विभागले डीपीआर पेस गरेको
                                                हो ।
                                            </p>
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="">
                                            <img src="{{ asset('frontend/img/news/news.jpg') }}" class="tab-news-image"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="news">
                                <div class="row g-0 align-items-center justify-content-between">
                                    <div class="col-md-9">
                                        <a href="" class="text-decoration-none text-dark">
                                            <h3 class=" fs-5 fw-bold  m-0 p-0">
                                                शिलान्यासको ८ वर्षपछि राष्ट्रिय प्राणी उद्यानको डीपीआर वन
                                                मन्त्रालयमा
                                            </h3>
                                            <p class="mt-2">काठमाडौँ — शिलान्यासको ८ वर्षपछि राष्ट्रिय प्राणी
                                                उद्यानको
                                                विस्तृत परियोजना
                                                प्रतिवेदन (डीपीआर) स्वीकृतिका लागि वन तथा वातावरण मन्त्रालयमा पेस
                                                भएको छ ।
                                                भक्तपुरको सूर्यविनायक जंगलमा अन्तर्राष्ट्रिय मापदण्डको खुला
                                                चिडियाखाना
                                                बनाउने
                                                गरी राष्ट्रिय निकुञ्ज तथा वन्यजन्तु संरक्षण विभागले डीपीआर पेस गरेको
                                                हो ।
                                            </p>
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="">
                                            <img src="{{ asset('frontend/img/news/news.jpg') }}" class="tab-news-image"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="news">
                                <div class="row g-0 align-items-center justify-content-between">
                                    <div class="col-md-9">
                                        <a href="" class="text-decoration-none text-dark">
                                            <h3 class=" fs-5 fw-bold  m-0 p-0">
                                                शिलान्यासको ८ वर्षपछि राष्ट्रिय प्राणी उद्यानको डीपीआर वन
                                                मन्त्रालयमा
                                            </h3>
                                            <p class="mt-2">काठमाडौँ — शिलान्यासको ८ वर्षपछि राष्ट्रिय प्राणी
                                                उद्यानको
                                                विस्तृत परियोजना
                                                प्रतिवेदन (डीपीआर) स्वीकृतिका लागि वन तथा वातावरण मन्त्रालयमा पेस
                                                भएको छ ।
                                                भक्तपुरको सूर्यविनायक जंगलमा अन्तर्राष्ट्रिय मापदण्डको खुला
                                                चिडियाखाना
                                                बनाउने
                                                गरी राष्ट्रिय निकुञ्ज तथा वन्यजन्तु संरक्षण विभागले डीपीआर पेस गरेको
                                                हो ।
                                            </p>
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="">
                                            <img src="{{ asset('frontend/img/news/news.jpg') }}" class="tab-news-image"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="news">
                                <div class="row g-0 align-items-center justify-content-between">
                                    <div class="col-md-9">
                                        <a href="" class="text-decoration-none text-dark">
                                            <h3 class=" fs-5 fw-bold  m-0 p-0">
                                                शिलान्यासको ८ वर्षपछि राष्ट्रिय प्राणी उद्यानको डीपीआर वन
                                                मन्त्रालयमा
                                            </h3>
                                            <p class="mt-2">काठमाडौँ — शिलान्यासको ८ वर्षपछि राष्ट्रिय प्राणी
                                                उद्यानको
                                                विस्तृत परियोजना
                                                प्रतिवेदन (डीपीआर) स्वीकृतिका लागि वन तथा वातावरण मन्त्रालयमा पेस
                                                भएको छ ।
                                                भक्तपुरको सूर्यविनायक जंगलमा अन्तर्राष्ट्रिय मापदण्डको खुला
                                                चिडियाखाना
                                                बनाउने
                                                गरी राष्ट्रिय निकुञ्ज तथा वन्यजन्तु संरक्षण विभागले डीपीआर पेस गरेको
                                                हो ।
                                            </p>
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="">
                                            <img src="{{ asset('frontend/img/news/news.jpg') }}" class="tab-news-image"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="home-news-box d-none" id="news-8">

                            <div class="news">
                                <div class="row g-0 align-items-center justify-content-center">
                                    <div class="col-md-9">
                                        <a href="" class="text-decoration-none text-dark">
                                            <h3 class=" fs-5 fw-bold  m-0 p-0">
                                                सहकारीसम्बन्धी अध्यादेश जारी, बचत फिर्ता गर्न सरकारसँग छैन तथ्यांक
                                            </h3>
                                            <p class="mt-2">काठमाडौँ — सहकारी संस्थाको नियमन र बचतकर्ताको डुबेको रकम
                                                फिर्ता
                                                गर्ने
                                                उद्देश्यले
                                                ल्याइएको अध्यादेश राष्ट्रपति रामचन्द्र पौडेलले प्रमाणीकरण गरेका
                                                छन् ।
                                                राष्ट्रपति
                                                पौडेलले आइतबार अध्यादेश स्वीकृतसहित जारी गरेका हुन । यससँगै अब
                                                सरकारलाई
                                                अध्यादेश
                                                कार्यान्वयनको बाटो खुलेको छ ।
                                            </p>
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="">
                                            <img src="{{ asset('frontend/img/about/about-1.png') }}"
                                                class="tab-news-image" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>


                            <div class="news">
                                <div class="row g-0 align-items-center justify-content-center">
                                    <div class="col-md-9">
                                        <a href="" class="text-decoration-none text-dark">
                                            <h3 class=" fs-5 fw-bold  m-0 p-0">
                                                सहकारीसम्बन्धी अध्यादेश जारी, बचत फिर्ता गर्न सरकारसँग छैन तथ्यांक
                                            </h3>
                                            <p class="mt-2">काठमाडौँ — सहकारी संस्थाको नियमन र बचतकर्ताको डुबेको रकम
                                                फिर्ता
                                                गर्ने
                                                उद्देश्यले
                                                ल्याइएको अध्यादेश राष्ट्रपति रामचन्द्र पौडेलले प्रमाणीकरण गरेका
                                                छन् ।
                                                राष्ट्रपति
                                                पौडेलले आइतबार अध्यादेश स्वीकृतसहित जारी गरेका हुन । यससँगै अब
                                                सरकारलाई
                                                अध्यादेश
                                                कार्यान्वयनको बाटो खुलेको छ ।
                                            </p>
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="">
                                            <img src="{{ asset('frontend/img/about/about-1.png') }}"
                                                class="tab-news-image" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>


                            <div class="news">
                                <div class="row g-0 align-items-center justify-content-center">
                                    <div class="col-md-9">
                                        <a href="" class="text-decoration-none text-dark">
                                            <h3 class=" fs-5 fw-bold  m-0 p-0">
                                                सहकारीसम्बन्धी अध्यादेश जारी, बचत फिर्ता गर्न सरकारसँग छैन तथ्यांक
                                            </h3>
                                            <p class="mt-2">काठमाडौँ — सहकारी संस्थाको नियमन र बचतकर्ताको डुबेको रकम
                                                फिर्ता
                                                गर्ने
                                                उद्देश्यले
                                                ल्याइएको अध्यादेश राष्ट्रपति रामचन्द्र पौडेलले प्रमाणीकरण गरेका
                                                छन् ।
                                                राष्ट्रपति
                                                पौडेलले आइतबार अध्यादेश स्वीकृतसहित जारी गरेका हुन । यससँगै अब
                                                सरकारलाई
                                                अध्यादेश
                                                कार्यान्वयनको बाटो खुलेको छ ।
                                            </p>
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="">
                                            <img src="{{ asset('frontend/img/about/about-1.png') }}"
                                                class="tab-news-image" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>



                            <div class="news">
                                <div class="row g-0 align-items-center justify-content-center">
                                    <div class="col-md-9">
                                        <a href="" class="text-decoration-none text-dark">
                                            <h3 class=" fs-5 fw-bold  m-0 p-0">
                                                सहकारीसम्बन्धी अध्यादेश जारी, बचत फिर्ता गर्न सरकारसँग छैन तथ्यांक
                                            </h3>
                                            <p class="mt-2">काठमाडौँ — सहकारी संस्थाको नियमन र बचतकर्ताको डुबेको रकम
                                                फिर्ता
                                                गर्ने
                                                उद्देश्यले
                                                ल्याइएको अध्यादेश राष्ट्रपति रामचन्द्र पौडेलले प्रमाणीकरण गरेका
                                                छन् ।
                                                राष्ट्रपति
                                                पौडेलले आइतबार अध्यादेश स्वीकृतसहित जारी गरेका हुन । यससँगै अब
                                                सरकारलाई
                                                अध्यादेश
                                                कार्यान्वयनको बाटो खुलेको छ ।
                                            </p>
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="">
                                            <img src="{{ asset('frontend/img/about/about-1.png') }}"
                                                class="tab-news-image" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>



                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-4">
                <div class="section-title">
                    <h2 class="fs-5 mb-3 title">ट्रेन्डिङ न्यूज</h2>
                </div>
                <div class="row g-2" data-masonry='{"percentPosition": true }'>

                    <div class="col-6">
                        <div class="news-tag-box">
                            <a href="" class="text-dark">
                                अजरबैजानमा विमान दुर्घटना
                            </a>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="news-tag-box">
                            <a href="" class="text-dark">
                                यसरी सुरू भयो पोखरामा सडक महोत्सव
                            </a>
                        </div>
                    </div>


                    <div class="col-6">
                        <div class="news-tag-box">
                            <a href="" class="text-dark">
                                एमालेका तीन नेतामाथि कारबाही
                            </a>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="news-tag-box">
                            <a href="" class="text-dark">
                                ताली वा गाली
                            </a>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="news-tag-box">
                            <a href="" class="text-dark">
                                सन् २०२४ मा विश्वभर भएका. विश्वभर भएका
                            </a>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="news-tag-box">
                            <a href="" class="text-dark">
                                अजरबैजानमा विमान दुर्घटना
                            </a>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="news-tag-box">
                            <a href="" class="text-dark">
                                यसरी सुरू भयो पोखरामा सडक महोत्सव
                            </a>
                        </div>
                    </div>


                    <div class="col-6">
                        <div class="news-tag-box">
                            <a href="" class="text-dark">
                                एमालेका तीन नेतामाथि कारबाही
                            </a>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="news-tag-box">
                            <a href="" class="text-dark">
                                ताली वा गाली
                            </a>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="news-tag-box">
                            <a href="" class="text-dark">
                                सन् २०२४ मा विश्वभर भएका. विश्वभर भएका
                            </a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
@endsection


@push('script')
    <script>
        $(document).ready(function() {
            $('.news-nav-btn').on('click', function() {
                const dataId = $(this).data('id');

                // Remove active class from all buttons
                $('.news-nav-btn').removeClass('active');

                // Add active class to the clicked button
                $(this).addClass('active');

                // Hide all news boxes
                $('.home-news-box').addClass('d-none');

                // Show the corresponding news box
                $(`#news-${dataId}`).removeClass('d-none');
            });
        });
    </script>
@endpush
