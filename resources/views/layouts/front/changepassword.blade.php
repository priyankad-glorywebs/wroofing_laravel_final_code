@extends('layouts.front.master')
@section('title', 'Change Password Page')

@section('content')
<div class="breadcrumb-title-wrap">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<ol class="breadcrumb m-0">
				</ol>
			</div>
		</div>
		<div class="row d-lg-none mt-4">
			<div class="col-12">
				<div class="signin-notes">Home / Change Password</div>
			</div>
		</div>
		<div class="row breadcrumb-title">
			<div class="col-12 col-lg-7">
				<div class="section-title">Change Password</div>
			</div>
		</div>
	</div>
</div>

<section class="studio-stepform-sec">
	<div class="container">
		<div class="row">
			<div class="col-12">
				@if(session('success'))
					<div class="alert alert-success">
						{{ session('success') }}
					</div>
				@elseif(session('error'))
					<div class="alert alert-danger">
						{{ session('error') }}
					</div>
				@endif
				<div class="studio-stepform-wrap">
					<form id="changepassword" action="{{route('front.password.update')}}" method="post">
						@csrf
						<div class="row">

							<div class="form-group col-12">
								<div class="field-wrap">
									<div class="form-label">
										<label for="cpassword">Current Password<span>*</span></label>
									</div>
									<div class="form-element">
										<input id="cpassword" type="password" name="cpassword"
											placeholder="Current Password*" required>
										<span class="input-icon password-icon">
											<div class="password-icon-view"><svg width="20" height="20"
													viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
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
													viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
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
							<div class="form-group col-12">
								<div class="field-wrap">
									<div class="form-label">
										<label for="mpassword">Enter new password<span>*</span></label>
									</div>
									<div class="form-element">
										<input id="mpassword" type="password" name="mpassword"
											placeholder="Enter new password" required>
										<span class="input-icon password-icon">
											<div class="password-icon-view"><svg width="20" height="20"
													viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
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
													viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
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
							<div class="form-group col-12">
								<div class="field-wrap">
									<div class="form-label">
										<label for="cfmpassword">Confirm new password<span>*</span></label>
									</div>
									<div class="form-element">
										<input id="cfmpassword" type="password" name="cfmpassword"
											placeholder="Confirm new password" required>
										<span class="input-icon password-icon">
											<div class="password-icon-view"><svg width="20" height="20"
													viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
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
													viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
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

							<div class="form-group button-wrap col-md-12">
								<div class="field-wrap">
									<button type="submit" class="btn btn-primary d-block w-100">Submit</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection