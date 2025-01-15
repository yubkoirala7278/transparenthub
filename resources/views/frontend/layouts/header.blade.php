<header>
    <div class="top-nav-bar">
        <div class="container-fluid">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                <p class="date"><span class="me-2">आजको मिति :</span><span id="DATE_IN_NEPALI"></span> / <span id="TIME_IN_NEPALI"></span></p>

                <div class="d-flex gap-2">
                    <a href="">Forex</a>
                    <a href="">Nepali Unicode</a>
                    <a href="" class="d-none d-sm-block">Calender</a>
                    <a href="" style="word-break: break-all;">Gold/Silver</a>
                </div>
            </div>
        </div>
    </div>

    <div class="my-navbar">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid px-0">
                    <div class="d-flex d-lg-none justify-content-between w-100">
                        <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="my-logo-design">
                            <a href="/" class="text-decoration-none d-block d-lg-none">
                                <img src="{{ asset('frontend/img/logo.jpg') }}" style="height: 50px;" alt="">
                            </a>
                        </div>
                    </div>


                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <div class="d-flex justify-content-center justify-content-lg-between align-items-center  w-100">
                            <div class="top-logo d-none d-lg-block">
                                <div class="my-logo-design">
                                    <a href="/" class="text-decoration-none">
                                        <img src="{{ asset('frontend/img/logo.jpg') }}" style="height: 70px;"
                                            alt="">
                                    </a>
                                </div>
                            </div>

                            <div class="d-none d-lg-block"></div>

                            <ul class="navbar-nav d-flex align-items-center gap-2">

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('frontend.home') ? 'active' : '' }}"
                                        href="{{ route('frontend.home') }}">Home</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                                        href="{{ route('about') }}">About</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('news') ? 'active' : '' }}"
                                        href="{{ route('news') }}">News</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('shop') ? 'active' : '' }}"
                                        href="{{ route('shop') }}">Shop</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('professional') ? 'active' : '' }}"
                                        href="{{ route('professional') }}">Professional Services</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('palika') ? 'active' : '' }}"
                                        href="{{ route('palika') }}">Palika</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('blog') ? 'active' : '' }}"
                                        href="{{ route('blog') }}">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                                        href="{{ route('contact') }}">Contact</a>
                                </li>
                                @if (Route::has('login'))
                                    @auth
                                        <li class="nav-item">
                                            <a class="btn btn-success" href="{{ url('/admin/home') }}">Dashboard</a>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a class="btn btn-success" href="{{ route('login') }}">Login</a>
                                        </li>

                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="btn btn-secondary" href="{{ route('register') }}">Register</a>
                                            </li>
                                        @endif
                                    @endauth
                                @endif

                            </ul>

                        </div>
                    </div>

                </div>
            </nav>
        </div>
    </div>



</header>
