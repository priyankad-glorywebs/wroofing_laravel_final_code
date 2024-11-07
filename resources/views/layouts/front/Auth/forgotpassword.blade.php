

@extends('layouts.front.Auth.materlogin')
@section('title', 'Forgot Password | Customer')
 
@section('content')

<section class="login-sec">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 col-lg-6 d-flex login-form-wrap align-items-lg-center min-height-100vh">
					<div class="login-wrap">
						<div class="logo-img-wrap text-center d-none d-lg-block">
							<img src="{{asset('frontend-assets/images/logo.png')}}" alt="logo" width="400" height="86">
						</div>

						<div class="signin-notes d-lg-none">Reset your password</div>
						@if (Session::has('message'))
                         <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    	@endif

						<div class="login-form-title text-center">Forgot Password</div>
						<div class="form-wrp">
							<div class="login-form-subname-inner text-lg-center">Please login using your email address and password.</div>
							<form id="forgotpassword" method="POST" action="{{ route('send.reset.link') }}" enctype="multipart/form-data">
								@csrf
	

								<div class="row">
									<div class="form-group col-12">
										<div class="field-wrap">
											<div class="form-label">
												<label for="uname">Email<span>*</span></label>
											</div>
											<div class="form-element">
												<input type="email" name="email" required autofocus placeholder="Enter your email address" value="{{ request()->query('email') }}">
												<span class="input-icon"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 17H6C3.6 17 2 15.8529 2 13.1765V7.82353C2 5.14706 3.6 4 6 4H14C16.4 4 18 5.14706 18 7.82353V13.1765C18 15.8529 16.4 17 14 17Z" stroke="#2C2C2E" stroke-width="1.22673" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M14 8.20587L11.496 10.1176C10.672 10.7447 9.32 10.7447 8.496 10.1176L6 8.20587" stroke="#2C2C2E" stroke-width="1.22673" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
											</div>
											@if ($errors->has('email'))
                        			              <span class="text-danger">{{ $errors->first('email') }}</span>
            			                    @endif
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group button-wrap col-md-12">
										<div class="field-wrap">
											<button type="submit" class="btn btn-primary">Submit</button>
										</div>
									</div>
								</div>
							</form>

							<div class="backto-login text-center"><a href="{{route('login')}}"><svg width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.13654 8L1.25522 5.11869C0.914945 4.77841 0.914945 4.22159 1.25522 3.88131L4.13654 1" stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg> Back to login</a></div>

							<div class="create-account text-center"><a href="{{route('term.and.condition')}}">Terms</a> | <a href="{{route('contact-us')}}">Contact Us</a></div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-6 login-content-wrap d-flex align-items-center min-height-100vh">
					<div class="login-content-slider-wrap">
						<div class="login-content-slider owl-carousel">
							<div class="login-content-slider-item">
								<div class="login-content-title title-divider">The Total Roofing Company. Serving DFW.</div>
								<div class="login-content-detail"> 100% customer satisfaction rating combined with a <strong>perfect A+ rating with the BBB.</strong></div>
							</div>
							<div class="login-content-slider-item">
								<div class="login-content-title title-divider">The Total Roofing Company. Serving DFW.</div>
								<div class="login-content-detail"> 100% customer satisfaction rating combined with a <strong>perfect A+ rating with the BBB.</strong></div>
							</div>
							<div class="login-content-slider-item">
								<div class="login-content-title title-divider">The Total Roofing Company. Serving DFW.</div>
								<div class="login-content-detail"> 100% customer satisfaction rating combined with a <strong>perfect A+ rating with the BBB.</strong></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
@section('scripts')
{{-- Validation JS  --}}
	<script src="{{asset('frontend-assets/js/jquery.validate.min.js')}}"></script>

@endsection