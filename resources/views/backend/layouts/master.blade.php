<!DOCTYPE html>
<html lang="en">

<head>
    <title>Transparent Hub - Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/x-icon">

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">

</head>

<body class="">

    @include('backend.layouts.sidebar')
    @include('backend.layouts.header')

    <div class="pcoded-main-container">
        <div class="pcoded-content">
           @yield('content')
        </div>
    </div>


    <!-- Required Js -->
    <script src="{{ asset('backend/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/js/pcoded.min.js') }}"></script>

    <!-- Apex Chart -->
    <script src="{{ asset('backend/js/plugins/apexcharts.min.js') }}"></script>
    <!-- custom-chart js -->
    <script src="{{ asset('backend/js/pages/dashboard-main.js') }}"></script>


    @yield('customJS')

</body>

</html>
