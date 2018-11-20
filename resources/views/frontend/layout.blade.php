<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<title> Gridboard @yield('title')</title>
	<link href="https://fonts.googleapis.com/css?family=Libre+Franklin" rel="stylesheet">
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
	 crossorigin="anonymous">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/style.css') }}" /> @stack('styles')
	<!-- Favicons -->
	<link rel="shortcut icon" href="{{ asset('uploads/general/'.$general->fav_icon) }}">
</head>

<body>

	<div id="app">
		<div class="gridwatch-overlay" id="overlay_main">
		</div>
	@include('frontend/_includes/header')
	@include('frontend/_includes/sidebar')
		<div id="preloader">
		</div>
		<!-- Container -->
		<div class="wrapper">
			<div class="container-fluid">
				@yield('main-content')
			</div>
		</div>
	</div>
	<!--end app -->
	<!-- ========================================
			jQuery Scripts 
		=======================================-->
	<script src="{{ asset('js/app.js') }}"></script>
	@stack('scripts')
	<script src="{{ asset('js/custom.js') }}"></script>

	<script>
		$(function(){
		   $("#preloader").fadeOut(1000,function(){
        $(this).remove();
   		 });
		});
	</script>
</body>

</html>