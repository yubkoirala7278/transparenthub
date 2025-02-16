<div class="top-nav-bar">
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
            <p class="date"><span class="me-2">आजको मिति :</span><span id="DATE_IN_NEPALI"></span> / <span
                    id="TIME_IN_NEPALI"></span></p>

            <!-- Header Section -->
            <div id="auth-container" class="d-flex gap-2">
                @if (Auth::user())
                    <div class="dropdown position-relative" style="z-index: 1050 !important;">
                        <button
                            class="btn btn-transparent p-0 rounded-0 text-white d-flex align-items-center custom-dropdown-btn"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false"
                            style="word-break: break-all; border: none; box-shadow: none;">
                            {{ strtoupper(Auth::user()->name) }}'s ACCOUNT
                        </button>
                        <ul class="dropdown-menu shadow-sm bg-white">
                            <li><a class="dropdown-item text-dark dropdown-hover" href="#">Manage My Account</a>
                            </li>
                            <li><a class="dropdown-item text-dark dropdown-hover" href="{{route('my-order')}}">My Orders</a></li>
                            <li><a class="dropdown-item text-dark dropdown-hover" href="#">My WishList</a></li>
                            <li>
                                <a class="dropdown-item text-dark dropdown-hover" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Hidden Logout Form -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @else
                    <button type="button" class="btn btn-transparent p-0 rounded-0 text-white" data-bs-toggle="modal"
                        data-bs-target="#loginModal">
                        Login
                    </button>
                @endif
            </div>

        </div>
    </div>
</div>
<!-- Login/Register Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="loginModalLabel">Sign In / Register</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-4 text-center">Please sign in with your Google account to continue.</p>
                <div class="d-grid">
                    <a href="#" id="googleLoginButton" class="btn btn-danger">
                        <i class="fa-brands fa-google me-2"></i> Sign in with Google
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<header>
    <div class="my-navbar" style="background-color: #fef8f8;">
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
                                <img src="{{ asset('frontend/img/logo.png') }}" style="height: 50px;" alt="Header Image"
                                    loading="lazy">
                            </a>
                        </div>
                    </div>


                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <div class="d-flex justify-content-center justify-content-lg-between align-items-center  w-100">
                            <div class="top-logo d-none d-lg-block">
                                <div class="my-logo-design">
                                    <a href="/" class="text-decoration-none">
                                        <img src="{{ asset('frontend/img/logo.png') }}" style="height: 70px;"
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
                                        href="{{ route('news.with.category', 'all_news') }}">News</a>
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
                                <li class="nav-item position-relative">
                                    <a class="nav-link d-flex align-items-center" href="{{ route('cart.view') }}">
                                        <i class="fa-solid fa-cart-shopping fs-5"></i>
                                        <!-- The badge is shown only if there is at least one item in the cart -->
                                        <span id="navCartCount"
                                            class="position-absolute top-0 translate-middle badge bg-danger"
                                            style="clip-path: circle(); right: -14px; {{ $cartCount > 0 ? '' : 'display:none;' }}">
                                            {{ $cartCount }}
                                            <span class="visually-hidden">items in cart</span>
                                        </span>
                                    </a>
                                </li>
                                {{-- @if (Route::has('login'))
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
                                @endif --}}
                                {{-- <li class="nav-item">
                                    <a class="btn btn-success" data-bs-toggle="offcanvas" href="#offcanvasExample"
                                        role="button" aria-controls="offcanvasExample">
                                        News Category
                                    </a>
                                </li> --}}

                            </ul>

                        </div>
                    </div>

                </div>
            </nav>
        </div>
    </div>



</header>
{{-- sweet alert 2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $('#googleLoginButton').on('click', function(e) {
        e.preventDefault();
        window.open("{{ route('google.redirect') }}", "GoogleLogin", "width=600,height=600");
    });

    function afterGoogleLogin() {
        $.ajax({
            url: "{{ route('auth.header') }}",
            type: 'GET',
            success: function(response) {
                // Replace the content of the auth container with the new HTML
                $('#auth-container').html(response);
            },
            error: function() {
                console.error('Failed to update the header.');
            }
        });
        Swal.fire({
            icon: 'success',
            title: 'Logged in!',
            text: 'Your account has been logged in!',
            timer: 2000,
            showConfirmButton: false
        });
        $('#loginModal').modal('hide');
    }
</script>
