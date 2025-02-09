<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Nepali Datepicker CSS -->
    <link rel="stylesheet" href="https://unpkg.com/nepali-date-picker@2.0.1/dist/nepaliDatePicker.min.css"
        crossorigin="anonymous" />


    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">

    <script src="{{ asset('frontend/js/nepali.js') }}" type="text/javascript"></script>
    <script src="{{ asset('frontend/js/sound.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- toastify css --}}
    @toastifyCss
    @yield('custom-css')
    <style>
        body{
            background-color: #fff2f224;
        }
    </style>
</head>

<body onload=updateClock();>

    @include('frontend.layouts.header')
    <main class="wrapper-contain">
        @yield('content')
    </main>
    @yield('modal')
    @include('frontend.layouts.footer')
    {{-- canvas --}}
    <!-- Modal -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images,
                lists,
                etc.
            </div>
            <div class="dropdown mt-3">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Dropdown button
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </div>
        </div>
    </div>
    {{-- end of canvas --}}

    <!-- End of nepali calendar widget -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/svg-with-js.min.css"
        integrity="sha512-vtbctC7BecZMHWPWej78RfcB9RmGpIx+G4+1IT2/Z9P7SIXApaI1XLOCrzpSKgNyTiw1VCmg/EkJXGo+LJYcpw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        AOS.init();
    </script>


    @stack('script')
    {{-- toastify --}}
    @if (session()->has('success') || session()->has('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if (session()->has('success'))
                    toastify().success({!! json_encode(session('success')) !!});
                @endif
                @if (session()->has('error'))
                    toastify().error({!! json_encode(session('error')) !!});
                @endif
            });
        </script>
    @endif
    {{-- toastify js --}}
    @toastifyJs


    <script src="{{ asset('frontend/js/script.js') }}"></script>
</body>

</html>
