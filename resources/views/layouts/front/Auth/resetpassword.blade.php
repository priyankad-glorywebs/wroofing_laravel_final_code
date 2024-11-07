
@extends('layouts.front.Auth.materlogin')
@section('title', 'Reset Password | Customer')
 
@section('content')
<section class="login-sec">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-6 d-flex login-form-wrap align-items-lg-center min-height-100vh">
                <div class="login-wrap">
                    <div class="logo-img-wrap text-center d-none d-lg-block">
                        <img src="{{asset('frontend-assets/images/logo.png')}}" alt="logo" width="400" height="86">
                    </div>

                    <div class="signin-notes d-lg-none">Reset now</div>
                    @if ($message = Session::get('error'))
							<div class="alert alert-danger alert-block">
								<strong>{{ $message }}</strong>
							</div>
						@endif
                    <div class="login-form-title text-center">Reset your Password</div>
                    <div class="form-wrp">
                        <div class="login-form-subname-inner text-lg-center">Please reset your password now</div>
                            <form id="resetpasswordform" method="POST" action="{{ route('reset.password.post') }}" enctype="multipart/form-data">
                        
                            @csrf
                            <input type="hidden" name="token" value="{{ $data->token??'' }}">
                            <input type="hidden" name="email" value="{{ $data->email??'' }}">

                            
                            <div class="row">
                                <div class="form-group col-12">
                                    <div class="field-wrap">
                                        <div class="form-label">
                                            <label for="uname">Enter new password<span>*</span></label>
                                        </div>
                                        <div class="form-element">
                                            <input type="password" id="password" name="password" placeholder="Enter new password"  required autofocus>
                                            @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                            <span class="input-icon password-icon">
                                                <div class="password-icon-view"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.9271 9.74097C12.9271 11.3529 11.619 12.6555 10.0002 12.6555C8.38137 12.6555 7.07324 11.3529 7.07324 9.74097C7.07324 8.12901 8.38137 6.82642 10.0002 6.82642C11.619 6.82642 12.9271 8.12901 12.9271 9.74097Z" stroke="#2C2C2E" stroke-linecap="round" stroke-linejoin="round"/><path d="M10 16.4737C12.8861 16.4737 15.5759 14.7803 17.4481 11.8495C18.184 10.7016 18.184 8.77211 17.4481 7.6242C15.5759 4.69337 12.8861 3 10 3C7.11395 3 4.42412 4.69337 2.55187 7.6242C1.81604 8.77211 1.81604 10.7016 2.55187 11.8495C4.42412 14.7803 7.11395 16.4737 10 16.4737Z" stroke="#2C2C2E" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
                                                <div class="password-icon-hide"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.024 7.97605L7.97599 12.024C7.45599 11.504 7.13599 10.792 7.13599 10C7.13599 8.41605 8.416 7.13605 10 7.13605C10.792 7.13605 11.504 7.45605 12.024 7.97605Z" stroke="#2C2C2E" stroke-linecap="round" stroke-linejoin="round"/><path d="M14.656 5.01597C13.256 3.95997 11.656 3.38397 9.99995 3.38397C7.17592 3.38397 4.5439 5.04797 2.71188 7.92797C1.99187 9.05597 1.99187 10.952 2.71188 12.08C3.34389 13.072 4.07989 13.928 4.8799 14.616" stroke="#2C2C2E" stroke-linecap="round" stroke-linejoin="round"/><path d="M7.13599 16.024C8.048 16.408 9.016 16.616 10 16.616C12.824 16.616 15.4561 14.952 17.2881 12.072C18.0081 10.944 18.0081 9.04805 17.2881 7.92005C17.0241 7.50405 16.7361 7.11205 16.4401 6.74405" stroke="#2C2C2E" stroke-linecap="round" stroke-linejoin="round"/><path d="M12.808 10.56C12.6 11.688 11.68 12.608 10.552 12.816" stroke="#2C2C2E" stroke-linecap="round" stroke-linejoin="round"/><path d="M7.97606 12.024L2 18" stroke="#2C2C2E" stroke-linecap="round" stroke-linejoin="round"/><path d="M18 2L12.0239 7.976" stroke="#2C2C2E" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <div class="field-wrap">
                                        <div class="form-label">
                                            <label for="uname">Confirm new password<span>*</span></label>
                                        </div>
                                        <div class="form-element">
                                            <input type="password" id="password-confirm" name="password_confirmation" placeholder="Confirm new password">
                                            @if ($errors->has('password_confirmation'))
                                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                            @endif
                                            <span class="input-icon password-icon">
                                                <div class="password-icon-view"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.9271 9.74097C12.9271 11.3529 11.619 12.6555 10.0002 12.6555C8.38137 12.6555 7.07324 11.3529 7.07324 9.74097C7.07324 8.12901 8.38137 6.82642 10.0002 6.82642C11.619 6.82642 12.9271 8.12901 12.9271 9.74097Z" stroke="#2C2C2E" stroke-linecap="round" stroke-linejoin="round"/><path d="M10 16.4737C12.8861 16.4737 15.5759 14.7803 17.4481 11.8495C18.184 10.7016 18.184 8.77211 17.4481 7.6242C15.5759 4.69337 12.8861 3 10 3C7.11395 3 4.42412 4.69337 2.55187 7.6242C1.81604 8.77211 1.81604 10.7016 2.55187 11.8495C4.42412 14.7803 7.11395 16.4737 10 16.4737Z" stroke="#2C2C2E" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
                                                <div class="password-icon-hide"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.024 7.97605L7.97599 12.024C7.45599 11.504 7.13599 10.792 7.13599 10C7.13599 8.41605 8.416 7.13605 10 7.13605C10.792 7.13605 11.504 7.45605 12.024 7.97605Z" stroke="#2C2C2E" stroke-linecap="round" stroke-linejoin="round"/><path d="M14.656 5.01597C13.256 3.95997 11.656 3.38397 9.99995 3.38397C7.17592 3.38397 4.5439 5.04797 2.71188 7.92797C1.99187 9.05597 1.99187 10.952 2.71188 12.08C3.34389 13.072 4.07989 13.928 4.8799 14.616" stroke="#2C2C2E" stroke-linecap="round" stroke-linejoin="round"/><path d="M7.13599 16.024C8.048 16.408 9.016 16.616 10 16.616C12.824 16.616 15.4561 14.952 17.2881 12.072C18.0081 10.944 18.0081 9.04805 17.2881 7.92005C17.0241 7.50405 16.7361 7.11205 16.4401 6.74405" stroke="#2C2C2E" stroke-linecap="round" stroke-linejoin="round"/><path d="M12.808 10.56C12.6 11.688 11.68 12.608 10.552 12.816" stroke="#2C2C2E" stroke-linecap="round" stroke-linejoin="round"/><path d="M7.97606 12.024L2 18" stroke="#2C2C2E" stroke-linecap="round" stroke-linejoin="round"/><path d="M18 2L12.0239 7.976" stroke="#2C2C2E" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group button-wrap col-md-12">
                                    <div class="field-wrap">
                                        <button type="submit" class="btn btn-primary">Reset now</button>
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