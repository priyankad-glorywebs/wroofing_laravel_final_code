<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
		rel="stylesheet">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('frontend-assets/css/bootstrap.min.css')}}">
	<!-- Owl Carousel CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('frontend-assets/css/owl.carousel.min.css')}}">
	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('frontend-assets/css/style.css')}}">
	<!-- jQuery JS -->
	<script src="{{ asset('frontend-assets/js/jquery-3.7.1.min.js')}}"></script>
	<style>
		.error {
			color: red;
		}
	</style>
	<title>@yield('title', 'APP TITLE')</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="{{ asset('frontend-assets/images/favicon.png') }}">
	<!--End Favicon -->
</head>
<body class="login-page">
	<div class="header-space"></div>
	<header class="site-header d-lg-none">
		<nav class="navbar navbar-expand-lg navbar-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img class="logo-img" src="{{asset('frontend-assets/images/mobile-logo.svg')}}" alt="Logo"
						width="53" height="50">
				</a>
				<div class="hamburger-menu">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</div>
				<div class="navbar-collapse header-right">
					<ul id="desktop" class="navbar-nav mainmenu align-items-start align-items-lg-center">
						@if(isset($user))
							<li class="nav-item">
								<a class="nav-link" href="{{ route('project.list') }}">Your project</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{ route('contractor.list') }}">Contractor</a>
							</li>
						@endif
					</ul>
					<div class="mobile-menu-btn-wrap">
						<div class="mobile-menu-btn">
							@if(!isset($user))
								<a class="btn btn-primary" href="{{route('login')}}">Sign In</a>
							@else
								<a class="btn btn-primary" href="{{route('logout')}}">Sign Out</a>
							@endif
						</div>
						<div class="mobile-menu-btn">
							<a class="btn btn-outline-secondary" href="{{route('contact-us')}}">Need help? (Contact
								us)</a>
						</div>
						<div class="mobile-menu-btn">
							<a class="btn btn-outline-secondary" href="{{route('about-us')}}">About Us</a>
						</div>
					</div>
				</div>
			</div>
		</nav>
	</header>
	<div class="breadcrumb-wrap d-lg-none">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item">
							{{-- <a href="#"><svg width="5" height="9" viewBox="0 0 5 9" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<path
										d="M4.13654 8L1.25522 5.11869C0.914945 4.77841 0.914945 4.22159 1.25522 3.88131L4.13654 1"
										stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10"
										stroke-linecap="round" stroke-linejoin="round" />
								</svg> Back
							</a> --}}
						</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	@yield('content')
	<!-- Bootstrap JS -->
	<script src="{{ asset('frontend-assets/js/bootstrap.bundle.min.js')}}"></script>
	<!-- Owl Carousel JS -->
	<script src="{{ asset('frontend-assets/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('frontend-assets/js/jquery.validate.min.js')}}"></script>
	<!-- Custom JS -->
	<script src="{{ asset('frontend-assets/js/public.js')}}"></script>
</body>
</html>