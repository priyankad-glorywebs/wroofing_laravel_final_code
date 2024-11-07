@extends('layouts.front.Auth.materlogin')
@section('title', 'Customer Login')

@section('content')
<section class="login-sec ">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 col-lg-6 d-flex login-form-wrap align-items-lg-center min-height-100vh">
				<div class="login-wrap">
					<div class="logo-img-wrap text-center d-none d-lg-block">
						<img src="{{asset('frontend-assets/images/logo.png')}}" alt="logo" width="400" height="86">
					</div>

					<div class="signin-notes d-lg-none">Sign in to get started</div>

					<div class="login-form-title text-center">Welcome to StructR Customer</div>
					<div class="form-wrp">
						@if ($message = Session::get('error'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>{{$message}}</strong>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif
						@if(session('success'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								{{ session('success') }}
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif
						<form id="loginform" method="POST" action="{{route('login')}}" enctype="multipart/form-data">
							@csrf
							<div class="row">
								<div class="form-group col-12">
									<div class="field-wrap">
										<div class="form-label">
											<label for="uname">Email<span>*</span></label>
										</div>
										<div class="form-element">
											<input type="email" name="email" @if(isset($_COOKIE["email"]))
											value="{{ $_COOKIE['email'] }}" @endif
												placeholder="Enter your email address" id="login-email">
											@error('email')
												<p class="error">{{ $message }}</p>
											@enderror
											<span class="input-icon"><svg width="20" height="20" viewBox="0 0 20 20"
													fill="none" xmlns="http://www.w3.org/2000/svg">
													<path
														d="M14 17H6C3.6 17 2 15.8529 2 13.1765V7.82353C2 5.14706 3.6 4 6 4H14C16.4 4 18 5.14706 18 7.82353V13.1765C18 15.8529 16.4 17 14 17Z"
														stroke="#2C2C2E" stroke-width="1.22673" stroke-miterlimit="10"
														stroke-linecap="round" stroke-linejoin="round" />
													<path
														d="M14 8.20587L11.496 10.1176C10.672 10.7447 9.32 10.7447 8.496 10.1176L6 8.20587"
														stroke="#2C2C2E" stroke-width="1.22673" stroke-miterlimit="10"
														stroke-linecap="round" stroke-linejoin="round" />
												</svg></span>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-12">
									<div class="field-wrap">
										<div class="form-label">
											<label for="uname">Password<span>*</span></label>
										</div>
										<div class="form-element">
											<input type="password" name="password" placeholder="Enter your password"
												@if(isset($_COOKIE["password"])) value="{{ $_COOKIE['password'] }}"
												@endif>
											@error('password')
												<p class="error">{{ $message }}</p>
											@enderror
											<span class="input-icon password-icon">
												<div class="password-icon-view"><svg width="20" height="20"
														viewBox="0 0 20 20" fill="none"
														xmlns="http://www.w3.org/2000/svg">
														<path
															d="M12.9271 9.74097C12.9271 11.3529 11.619 12.6555 10.0002 12.6555C8.38137 12.6555 7.07324 11.3529 7.07324 9.74097C7.07324 8.12901 8.38137 6.82642 10.0002 6.82642C11.619 6.82642 12.9271 8.12901 12.9271 9.74097Z"
															stroke="#2C2C2E" stroke-linecap="round"
															stroke-linejoin="round" />
														<path
															d="M10 16.4737C12.8861 16.4737 15.5759 14.7803 17.4481 11.8495C18.184 10.7016 18.184 8.77211 17.4481 7.6242C15.5759 4.69337 12.8861 3 10 3C7.11395 3 4.42412 4.69337 2.55187 7.6242C1.81604 8.77211 1.81604 10.7016 2.55187 11.8495C4.42412 14.7803 7.11395 16.4737 10 16.4737Z"
															stroke="#2C2C2E" stroke-linecap="round"
															stroke-linejoin="round" />
													</svg></div>
												<div class="password-icon-hide"><svg width="20" height="20"
														viewBox="0 0 20 20" fill="none"
														xmlns="http://www.w3.org/2000/svg">
														<path
															d="M12.024 7.97605L7.97599 12.024C7.45599 11.504 7.13599 10.792 7.13599 10C7.13599 8.41605 8.416 7.13605 10 7.13605C10.792 7.13605 11.504 7.45605 12.024 7.97605Z"
															stroke="#2C2C2E" stroke-linecap="round"
															stroke-linejoin="round" />
														<path
															d="M14.656 5.01597C13.256 3.95997 11.656 3.38397 9.99995 3.38397C7.17592 3.38397 4.5439 5.04797 2.71188 7.92797C1.99187 9.05597 1.99187 10.952 2.71188 12.08C3.34389 13.072 4.07989 13.928 4.8799 14.616"
															stroke="#2C2C2E" stroke-linecap="round"
															stroke-linejoin="round" />
														<path
															d="M7.13599 16.024C8.048 16.408 9.016 16.616 10 16.616C12.824 16.616 15.4561 14.952 17.2881 12.072C18.0081 10.944 18.0081 9.04805 17.2881 7.92005C17.0241 7.50405 16.7361 7.11205 16.4401 6.74405"
															stroke="#2C2C2E" stroke-linecap="round"
															stroke-linejoin="round" />
														<path d="M12.808 10.56C12.6 11.688 11.68 12.608 10.552 12.816"
															stroke="#2C2C2E" stroke-linecap="round"
															stroke-linejoin="round" />
														<path d="M7.97606 12.024L2 18" stroke="#2C2C2E"
															stroke-linecap="round" stroke-linejoin="round" />
														<path d="M18 2L12.0239 7.976" stroke="#2C2C2E"
															stroke-linecap="round" stroke-linejoin="round" />
													</svg></div>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="row align-items-center">
								<div class="form-group col-6">
									<div class="checkbox-wrap">
										<label for="rememberme" class="checked-item mb-0">Remember me
											<input id="rememberme" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} />
											<span class="checkmark"></span>
										</label>
									</div>
								</div>
								<div class="form-group col-6 text-end">
									<div class="forgotten-password">
										<a href="{{route('forgot.password')}}" class="forgot-password-link" id="forgot-password-link">Forgot Password?</a>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group button-wrap col-md-12 mt-0">
									<div class="field-wrap">
										<button type="submit" class="btn btn-primary">Login</button>
									</div>
								</div>
							</div>
						</form>


						<div class="register-now-wrap text-center">You don't have an account then <a
								href="{{route('register.one')}}">Register</a> now</div>
						<div class="register-now-wrap text-center">Login As a <a
								href="{{route('contractor.login')}}">Contractor </a> </div>

						<div class="ordivider-wrap"><span>or sign in with</span></div>

						<div class="login-with-other-way">
							<div class="login-with-other-way-item">
								<a id="google_login" href="{{ url('login/google?type=customer') }}"
									class="btn btn-outline-secondary"><span class="btn-icon"><svg width="17" height="17"
											viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path
												d="M4.0459 10.167L3.48897 12.2461L1.4534 12.2891C0.845059 11.1608 0.5 9.86985 0.5 8.49799C0.5 7.17141 0.822621 5.92043 1.39449 4.81891H1.39493L3.20716 5.15115L4.00102 6.95251C3.83487 7.43691 3.74431 7.9569 3.74431 8.49799C3.74437 9.08523 3.85074 9.64788 4.0459 10.167Z"
												fill="#FBBB00" />
											<path
												d="M16.3603 7.00641C16.4522 7.49034 16.5001 7.99012 16.5001 8.50089C16.5001 9.07363 16.4398 9.63231 16.3251 10.1712C15.9357 12.005 14.9181 13.6063 13.5085 14.7395L13.508 14.7391L11.2254 14.6226L10.9024 12.6059C11.8377 12.0573 12.5687 11.1989 12.9538 10.1712H8.67603V7.00641H13.0162H16.3603Z"
												fill="#518EF8" />
											<path
												d="M13.5078 14.7396L13.5082 14.7401C12.1373 15.842 10.3957 16.5014 8.49994 16.5014C5.45338 16.5014 2.80463 14.7985 1.45343 12.2926L4.04593 10.1705C4.72152 11.9735 6.46084 13.257 8.49994 13.257C9.3764 13.257 10.1975 13.0201 10.9021 12.6065L13.5078 14.7396Z"
												fill="#28B446" />
											<path
												d="M13.6063 2.34039L11.0147 4.46211C10.2855 4.0063 9.4235 3.74299 8.50001 3.74299C6.41475 3.74299 4.6429 5.08538 4.00116 6.95308L1.39503 4.81948H1.39459C2.72601 2.25248 5.40817 0.498657 8.50001 0.498657C10.4411 0.498657 12.2208 1.19009 13.6063 2.34039Z"
												fill="#F14336" />
										</svg></span> Sign in with Google</a>
							</div>
							<div class="login-with-other-way-item">
								<a id="facebook_login" href="{{ url('login/facebook?type=customer') }}"
									class="btn btn-outline-secondary"><span class="btn-icon"><svg width="16" height="17"
											viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path
												d="M16 8.54869C16 4.10311 12.4179 0.498657 8 0.498657C3.58206 0.498657 0 4.10311 0 8.54869C0 12.5663 2.92505 15.8968 6.75011 16.5014V10.8762H4.71832V8.54869H6.75011V6.77476C6.75011 4.75744 7.94487 3.64237 9.7719 3.64237C10.6472 3.64237 11.5629 3.79972 11.5629 3.79972V5.78082H10.5538C9.5604 5.78082 9.24989 6.40118 9.24989 7.03853V8.54869H11.4684L11.114 10.8762H9.24989V16.5014C13.075 15.898 16 12.5675 16 8.54869Z"
												fill="#1977F3" />
										</svg></span> Sign in with Facebook</a>
							</div>
							<div class="login-with-other-way-item">
								<a id="apple_login" href="#" class="btn btn-outline-secondary"><span
										class="btn-icon"><svg width="16" height="17" viewBox="0 0 16 17" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M11.8572 9.00039C11.8796 11.4221 13.9768 12.228 14 12.2383C13.9823 12.2951 13.6649 13.3867 12.8951 14.5143C12.2297 15.4892 11.5391 16.4604 10.4511 16.4805C9.38206 16.5003 9.0383 15.8451 7.8161 15.8451C6.59426 15.8451 6.21234 16.4604 5.20038 16.5003C4.15022 16.5402 3.3505 15.4462 2.67956 14.4749C1.30851 12.4881 0.260746 8.86069 1.66763 6.41214C2.36654 5.19618 3.61554 4.42619 4.97123 4.40644C6.00246 4.38673 6.97579 5.10183 7.60622 5.10183C8.23625 5.10183 9.41906 4.24185 10.6625 4.36815C11.1831 4.38987 12.6443 4.57892 13.5826 5.95552C13.507 6.0025 11.8391 6.97574 11.8572 9.00039ZM9.84808 3.05373C10.4056 2.37729 10.7809 1.43561 10.6785 0.498657C9.87485 0.531032 8.90306 1.03543 8.32662 1.7115C7.81002 2.31019 7.3576 3.26844 7.47967 4.18685C8.37543 4.25631 9.29052 3.7306 9.84808 3.05373Z"
												fill="black" />
										</svg></span> Sign in with Apple</a>
							</div>
						</div>
						<div class="create-account text-center"><a href="{{route('term.and.condition')}}">Terms</a> | <a
								href="{{route('contact-us')}}">Contact Us</a></div>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-6 login-content-wrap d-flex align-items-center min-height-100vh">
				<div class="login-content-slider-wrap">
					<div class="login-content-slider owl-carousel">
						<div class="login-content-slider-item">
							<div class="login-content-title title-divider">The Total Roofing Company. Serving DFW.</div>
							<div class="login-content-detail"> 100% customer satisfaction rating combined with a
								<strong>perfect A+ rating with the BBB.</strong></div>
						</div>
						<div class="login-content-slider-item">
							<div class="login-content-title title-divider">The Total Roofing Company. Serving DFW.</div>
							<div class="login-content-detail"> 100% customer satisfaction rating combined with a
								<strong>perfect A+ rating with the BBB.</strong></div>
						</div>
						<div class="login-content-slider-item">
							<div class="login-content-title title-divider">The Total Roofing Company. Serving DFW.</div>
							<div class="login-content-detail"> 100% customer satisfaction rating combined with a
								<strong>perfect A+ rating with the BBB.</strong></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
    const emailInput = document.getElementById('login-email');
    const forgotPasswordLink = document.getElementById('forgot-password-link');

    // Update the link to include the email in the query string
    emailInput.addEventListener('input', function() {
        const email = encodeURIComponent(emailInput.value);
        forgotPasswordLink.href = `{{route('forgot.password')}}?email=${email}`;
    });
</script>
@endsection