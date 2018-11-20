<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title> @yield('title') </title>



    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all-themes.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" /> @stack('styles') @if(!empty($general->fav_icon))
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('uploads/general/'.$general->fav_icon) }}"> @endif
</head>

<body class="theme-red">
    <div id="app">
        @if(Route::currentRouteName() !== 'login'){
    @include('_includes/nav')
    @include('_includes/sidebar')
    @include('_includes/rightside')
        @endif @yield('main-content')
    </div>


    <!-- Jquery Core Js -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Lib Scripts Plugin Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
    <!-- Lib Scripts Plugin Js -->
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    @include('sweetalert::alert')
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <!---new-->

    @stack('scripts')
</body>

</html>