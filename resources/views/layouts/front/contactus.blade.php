@extends('layouts.front.master')
@section('title', 'Contact Us Page')
@section('content')
<!-- START ADD COUNTRY CODE ON PHONE -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.0/css/intlTelInput.css">
<!-- Load intl-tel-input after jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.0/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.8/jquery.inputmask.bundle.min.js"></script>
<!-- END ADD COUNTRY CODE ON PHONE -->
<div class="breadcrumb-title-wrap">
	<div class="container">
		<div class="row d-lg-none mt-4">
			<div class="col-12">
				<div class="signin-notes">Home / Contact</div>
			</div>
		</div>
		<div class="row breadcrumb-title">
			<div class="col-12 col-lg-7">
				<div class="section-title">Contact Us</div>
			</div>
		</div>
	</div>
</div>
<section class="studio-stepform-sec">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="studio-stepform-wrap">
					@if(session('success'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							{{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif
					<form id="contactus" action="{{route('contact.submit')}}" method="post"
						enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="form-group col-12 col-md-12">
								<div class="field-wrap">
									<div class="form-label">
										<label for="name">Name<span>*</span></label>
									</div>
									<div class="form-element">
										<input id="name" type="text" name="name" placeholder="John doe">
										@error('name')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-12 col-md-6">
								<div class="field-wrap">
									<div class="form-label">
										<label for="email">Email address<span>*</span></label>
									</div>
									<div class="form-element">
										<input id="email" type="email" name="email" placeholder="Enter email address">
									</div>
								</div>
							</div>
							<div class="form-group col-12 col-md-6">
								<div class="field-wrap">
									<div class="form-label">
										<label for="phoneno">Phone number<span>*</span></label>
									</div>
									<div class="form-element" style="display: grid;">
										<input id="country_code" type="hidden" name="country_code" value="us" />
										<input id="phoneno"inputmode="tel" type="tel" name="phoneno" placeholder="Enter phone number">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-12 col-md-6">
								<div class="field-wrap">
									<div class="form-label">
										<label for="address">Address<span>*</span></label>
									</div>
									<div class="form-element">
										<textarea id="address" type="text" name="address"
											placeholder="Enter your address"></textarea>
										@error('address')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
							<div class="form-group col-12 col-md-6">
								<div class="field-wrap">
									<div class="form-label">
										<label for="yourcomments">Comments<span>*</span></label>
									</div>
									<div class="form-element">
										<textarea id="yourcomments" type="text" name="yourcomments"
											placeholder="Your comments"></textarea>
										@error('address')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group button-wrap col-md-12">
								<div class="field-wrap text-center">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</div>
					</form>
					<div class="row">
						<div class="col-12 col-md-6">
							<div class="social-contactus-item text-center">
								<div class="social-contactus-item-title">Problems or Suggestions</div>
								<div class="social-contactus-item-detail">Run into any problems?<br> Click here to
									contact us directly</div>
								<div class="social-contactus-btn-wrap">
									<a class="btn-outline-secondary w-100 d-block mb-3" href="tel:8525625112"><svg
											class="me-2" width="13" height="13" viewBox="0 0 13 13" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M12.1004 10.0454C12.1004 10.247 12.0555 10.4543 11.9602 10.6559C11.8648 10.8575 11.7415 11.048 11.5788 11.2272C11.304 11.5296 11.0011 11.7481 10.659 11.8881C10.3225 12.0281 9.95798 12.1009 9.56539 12.1009C8.99333 12.1009 8.38201 11.9665 7.73705 11.6921C7.09208 11.4176 6.44711 11.048 5.80775 10.5831C5.16278 10.1126 4.55147 9.59171 3.96819 9.01482C3.39053 8.43232 2.86894 7.82182 2.40345 7.18331C1.94356 6.5448 1.5734 5.90629 1.3042 5.27339C1.03499 4.63488 0.900391 4.02438 0.900391 3.44188C0.900391 3.06101 0.967692 2.69695 1.10229 2.36089C1.2369 2.01924 1.45002 1.70558 1.74726 1.42554C2.1062 1.07268 2.49879 0.899048 2.91381 0.899048C3.07085 0.899048 3.22788 0.932654 3.36809 0.999865C3.51391 1.06708 3.6429 1.16789 3.74386 1.31352L5.04501 3.14503C5.14596 3.28505 5.21887 3.41387 5.26934 3.53709C5.31982 3.65471 5.34786 3.77233 5.34786 3.87875C5.34786 4.01317 5.3086 4.1476 5.23009 4.27642C5.15718 4.40524 5.05062 4.53966 4.91601 4.67408L4.48977 5.11656C4.42808 5.17817 4.40004 5.25098 4.40004 5.3406C4.40004 5.38541 4.40565 5.42461 4.41687 5.46942C4.43369 5.51423 4.45052 5.54783 4.46173 5.58144C4.56268 5.76627 4.73655 6.00711 4.98332 6.29836C5.23569 6.58961 5.5049 6.88646 5.79654 7.18331C6.09939 7.48016 6.39103 7.7546 6.68827 8.00665C6.97991 8.25309 7.22107 8.42112 7.41176 8.52193C7.4398 8.53314 7.47345 8.54994 7.51271 8.56674C7.55758 8.58354 7.60244 8.58915 7.65292 8.58915C7.74826 8.58915 7.82117 8.55554 7.88286 8.49393L8.3091 8.07386C8.44931 7.93384 8.58392 7.82742 8.71291 7.76021C8.8419 7.68179 8.9709 7.64259 9.11111 7.64259C9.21767 7.64259 9.32984 7.66499 9.45322 7.7154C9.57661 7.76581 9.7056 7.83862 9.84581 7.93384L11.7022 9.25006C11.848 9.35087 11.949 9.46849 12.0107 9.60852C12.0667 9.74854 12.1004 9.88857 12.1004 10.0454Z"
												stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10"></path>
										</svg> 852 - 562 - 5112</a>
									<a class="btn-outline-secondary w-100 d-block" href="mailto:jon.doe4@gmail.com"><svg
											class="me-2" width="17" height="17" viewBox="0 0 17 17" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M11.6996 14.101H5.29961C3.37961 14.101 2.09961 13.1832 2.09961 11.0416V6.75856C2.09961 4.61702 3.37961 3.69922 5.29961 3.69922H11.6996C13.6196 3.69922 14.8996 4.61702 14.8996 6.75856V11.0416C14.8996 13.1832 13.6196 14.101 11.6996 14.101Z"
												stroke="#0A84FF" stroke-width="1.22673" stroke-miterlimit="10"
												stroke-linecap="round" stroke-linejoin="round"></path>
											<path
												d="M11.7008 7.06445L9.69758 8.59412C9.03838 9.09585 7.95678 9.09585 7.29758 8.59412L5.30078 7.06445"
												stroke="#0A84FF" stroke-width="1.22673" stroke-miterlimit="10"
												stroke-linecap="round" stroke-linejoin="round"></path>
										</svg> jon.doe4@gmail.com</a>
								</div>

							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="social-contactus-item text-center">
								<div class="social-contactus-item-title">Social Media</div>
								<div class="social-contactus-item-detail">Tell your friend’s how DYOR made getting a new
									roof easy!</div>
								<div class="social-contactus-btn-wrap">
									<a class="btn-outline-secondary btn-social" href="#"><svg width="18" height="18"
											viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path
												d="M1.79964 17.7502C1.29464 17.7502 0.791463 17.7502 0.286462 17.7502C0.2737 17.7502 0.262762 17.7448 0.25 17.7412C0.260939 17.7305 0.271877 17.7216 0.282816 17.7109C1.36209 16.4854 2.43955 15.258 3.51883 14.0307C4.69473 12.6946 5.87064 11.3566 7.04654 10.0205C7.07571 9.98836 7.07753 9.96696 7.05201 9.93128C6.88064 9.69045 6.71291 9.44962 6.54336 9.20879C5.87064 8.24905 5.19609 7.29109 4.52336 6.33135C3.8634 5.39123 3.20343 4.45289 2.54347 3.51277C1.83793 2.51021 1.13421 1.50766 0.428664 0.505099C0.370325 0.421255 0.310163 0.340979 0.25 0.25892C0.251823 0.255352 0.253646 0.25 0.255469 0.25C0.268231 0.25 0.27917 0.25 0.291931 0.25C2.01477 0.25 3.73943 0.25 5.46408 0.25C5.4732 0.264271 5.48049 0.278543 5.49143 0.29103C6.06571 1.10984 6.63999 1.92687 7.21427 2.74569C8.0693 3.96232 8.92434 5.18073 9.77938 6.39735C9.84501 6.4919 9.91247 6.58466 9.97992 6.68278C10.0091 6.65067 10.0346 6.62034 10.0601 6.5918C11.4493 5.01304 12.8386 3.43428 14.2259 1.85552C14.6963 1.32035 15.1667 0.785173 15.637 0.25C16.1511 0.25 16.6634 0.25 17.1775 0.25C17.059 0.385577 16.9424 0.521154 16.8239 0.656731C15.4656 2.2016 14.1074 3.74468 12.7492 5.28954C12.0656 6.06733 11.3801 6.8469 10.6946 7.6229C10.6691 7.65144 10.6709 7.66928 10.6909 7.69782C10.804 7.85481 10.9134 8.01357 11.0246 8.17056C12.1604 9.78856 13.298 11.4066 14.4338 13.0246C15.4675 14.4963 16.4993 15.9662 17.5331 17.438C17.6042 17.5396 17.6771 17.6395 17.75 17.7394C17.7482 17.743 17.7464 17.7484 17.7445 17.7484C17.7318 17.7484 17.7208 17.7484 17.7081 17.7484C15.9834 17.7484 14.2588 17.7484 12.5341 17.7484C12.5232 17.7305 12.5122 17.7127 12.5013 17.6949C12.3864 17.5307 12.2697 17.3666 12.1549 17.2025C11.4548 16.2035 10.7529 15.2063 10.0528 14.2073C9.30902 13.1477 8.56337 12.0845 7.81589 11.0212C7.80131 10.9998 7.7849 10.9784 7.76849 10.9552C7.75391 10.9713 7.74479 10.9802 7.73568 10.9909C6.96268 11.8686 6.1915 12.7481 5.41851 13.6258C4.25354 14.9494 3.08858 16.2749 1.92543 17.5985C1.88168 17.6485 1.84157 17.7002 1.79964 17.7502ZM15.6352 16.6637C15.6224 16.6441 15.6151 16.6316 15.6079 16.6192C14.6179 15.2348 13.6298 13.8523 12.6417 12.468C11.4493 10.8018 10.257 9.13387 9.06654 7.4677C7.62629 5.45366 6.18786 3.43963 4.74943 1.42381C4.72937 1.39527 4.70932 1.38635 4.67468 1.38635C3.91991 1.38635 3.16515 1.38635 2.41038 1.38635C2.39397 1.38635 2.37757 1.38635 2.35387 1.38635C2.36663 1.40597 2.37392 1.41846 2.38303 1.43095C3.60816 3.14528 4.83147 4.85784 6.05659 6.57218C7.37105 8.41317 8.68916 10.2577 10.0054 12.0987C11.0829 13.6061 12.1604 15.1135 13.2378 16.6227C13.2597 16.653 13.2816 16.6637 13.3199 16.6637C14.0728 16.662 14.8276 16.6637 15.5805 16.6637C15.5951 16.6637 15.6115 16.6637 15.6352 16.6637Z"
												fill="black"></path>
										</svg></a>
									<a class="btn-outline-secondary btn-social" href="#"><svg width="15" height="18"
											viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path
												d="M10.1254 11.7144V5.83969C11.2943 6.67885 12.6975 7.12863 14.1362 7.12531V4.88949C13.2863 4.70988 12.5177 4.25867 11.9465 3.60387C11.4902 3.30854 11.0988 2.92327 10.7963 2.47158C10.4937 2.01988 10.2863 1.51124 10.1868 0.976685H8.07532V12.5475C8.05476 13.0511 7.87792 13.5359 7.56937 13.9343C7.26082 14.3328 6.83589 14.6252 6.35362 14.7708C5.87136 14.9165 5.35572 14.9083 4.87837 14.7472C4.40101 14.5861 3.98565 14.2803 3.69001 13.8722C3.2115 13.6201 2.83095 13.2152 2.60886 12.7218C2.38677 12.2285 2.3359 11.675 2.46433 11.1494C2.59277 10.6238 2.89314 10.1562 3.31767 9.82104C3.74221 9.48588 4.26654 9.30237 4.8073 9.29968C5.04982 9.30185 5.29071 9.33952 5.52233 9.41151V7.17561C4.49482 7.19305 3.49457 7.50925 2.64355 8.08568C1.79253 8.66211 1.12751 9.47384 0.729568 10.4219C0.331625 11.37 0.217957 12.4135 0.402422 13.4251C0.586887 14.4367 1.06152 15.3727 1.76844 16.119C2.66633 16.7258 3.72967 17.0402 4.81294 17.019C7.74252 17.019 10.1192 14.6458 10.1254 11.7144Z"
												fill="black"></path>
										</svg></a>
									<a class="btn-outline-secondary btn-social" href="#"><svg width="20" height="20"
											viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path
												d="M1.25 8.80855C1.25 6.16281 1.25 4.83994 1.76489 3.8294C2.2178 2.94051 2.94049 2.21781 3.82938 1.7649C4.83991 1.25 6.16277 1.25 8.80849 1.25H11.1915C13.8372 1.25 15.1601 1.25 16.1706 1.7649C17.0595 2.21781 17.7822 2.94051 18.2351 3.8294C18.75 4.83994 18.75 6.16281 18.75 8.80855V11.1916C18.75 13.8373 18.75 15.1602 18.2351 16.1708C17.7822 17.0596 17.0595 17.7823 16.1706 18.2353C15.1601 18.7502 13.8372 18.7502 11.1915 18.7502H8.80848C6.16277 18.7502 4.83991 18.7502 3.82938 18.2353C2.94049 17.7823 2.2178 17.0596 1.76489 16.1708C1.25 15.1602 1.25 13.8373 1.25 11.1916V8.80855Z"
												fill="url(#paint0_radial_85_1987)"></path>
											<path
												d="M1.25 8.80855C1.25 6.16281 1.25 4.83994 1.76489 3.8294C2.2178 2.94051 2.94049 2.21781 3.82938 1.7649C4.83991 1.25 6.16277 1.25 8.80849 1.25H11.1915C13.8372 1.25 15.1601 1.25 16.1706 1.7649C17.0595 2.21781 17.7822 2.94051 18.2351 3.8294C18.75 4.83994 18.75 6.16281 18.75 8.80855V11.1916C18.75 13.8373 18.75 15.1602 18.2351 16.1708C17.7822 17.0596 17.0595 17.7823 16.1706 18.2353C15.1601 18.7502 13.8372 18.7502 11.1915 18.7502H8.80848C6.16277 18.7502 4.83991 18.7502 3.82938 18.2353C2.94049 17.7823 2.2178 17.0596 1.76489 16.1708C1.25 15.1602 1.25 13.8373 1.25 11.1916V8.80855Z"
												fill="url(#paint1_radial_85_1987)"></path>
											<path
												d="M9.99349 3.87091C8.33036 3.87091 8.12164 3.87818 7.46843 3.90791C6.81649 3.93776 6.3715 4.04097 5.98212 4.19241C5.57935 4.34882 5.23769 4.55806 4.89731 4.89857C4.55667 5.23895 4.34744 5.58061 4.19051 5.98325C4.03869 6.37275 3.93535 6.81788 3.90601 7.46955C3.8768 8.12276 3.86914 8.33161 3.86914 9.99474C3.86914 11.6579 3.87654 11.866 3.90614 12.5192C3.93612 13.1711 4.03933 13.6161 4.19064 14.0055C4.34718 14.4082 4.55641 14.7499 4.89693 15.0903C5.23718 15.4309 5.57884 15.6407 5.98136 15.7971C6.37098 15.9485 6.81611 16.0517 7.46792 16.0816C8.12113 16.1113 8.32972 16.1186 9.99273 16.1186C11.656 16.1186 11.8641 16.1113 12.5173 16.0816C13.1692 16.0517 13.6147 15.9485 14.0044 15.7971C14.407 15.6407 14.7481 15.4309 15.0884 15.0903C15.429 14.7499 15.6383 14.4082 15.7952 14.0056C15.9457 13.6161 16.0491 13.171 16.0797 12.5193C16.109 11.8661 16.1167 11.6579 16.1167 9.99474C16.1167 8.33161 16.109 8.12289 16.0797 7.46968C16.0491 6.81775 15.9457 6.37275 15.7952 5.98338C15.6383 5.58061 15.429 5.23895 15.0884 4.89857C14.7478 4.55793 14.4071 4.3487 14.004 4.19241C13.6136 4.04097 13.1683 3.93776 12.5164 3.90791C11.8632 3.87818 11.6552 3.87091 9.99158 3.87091H9.99349ZM9.44413 4.97448C9.60718 4.97422 9.78911 4.97448 9.99349 4.97448C11.6286 4.97448 11.8224 4.98034 12.468 5.00969C13.0651 5.03699 13.3892 5.13676 13.605 5.22058C13.8908 5.33157 14.0946 5.46425 14.3088 5.67859C14.5231 5.89292 14.6558 6.09705 14.767 6.38283C14.8508 6.59844 14.9507 6.92249 14.9779 7.51956C15.0073 8.16512 15.0136 8.35904 15.0136 9.99334C15.0136 11.6276 15.0073 11.8216 14.9779 12.4671C14.9506 13.0642 14.8508 13.3882 14.767 13.6038C14.656 13.8896 14.5231 14.0931 14.3088 14.3073C14.0944 14.5217 13.8909 14.6543 13.605 14.7653C13.3894 14.8495 13.0651 14.949 12.468 14.9763C11.8225 15.0057 11.6286 15.0121 9.99349 15.0121C8.3583 15.0121 8.16451 15.0057 7.51895 14.9763C6.92188 14.9488 6.59782 14.849 6.38183 14.7652C6.09605 14.6542 5.89192 14.5215 5.67759 14.3072C5.46325 14.0929 5.33057 13.8892 5.21932 13.6033C5.1355 13.3877 5.0356 13.0637 5.00843 12.4666C4.97909 11.821 4.97322 11.6271 4.97322 9.99181C4.97322 8.35649 4.97909 8.16359 5.00843 7.51803C5.03573 6.92096 5.1355 6.59691 5.21932 6.38104C5.33031 6.09526 5.46325 5.89114 5.67759 5.6768C5.89192 5.46247 6.09605 5.32979 6.38183 5.21854C6.59769 5.13433 6.92188 5.03482 7.51895 5.00739C8.08387 4.98188 8.3028 4.97422 9.44413 4.97294V4.97448ZM13.2623 5.99129C12.8566 5.99129 12.5275 6.32006 12.5275 6.72589C12.5275 7.13159 12.8566 7.46075 13.2623 7.46075C13.6681 7.46075 13.9972 7.13159 13.9972 6.72589C13.9972 6.32019 13.6681 5.99103 13.2623 5.99103V5.99129ZM9.99349 6.8499C8.25674 6.8499 6.84864 8.258 6.84864 9.99474C6.84864 11.7315 8.25674 13.1389 9.99349 13.1389C11.7302 13.1389 13.1378 11.7315 13.1378 9.99474C13.1378 8.258 11.7301 6.8499 9.99336 6.8499H9.99349ZM9.99349 7.95346C11.1208 7.95346 12.0348 8.86732 12.0348 9.99474C12.0348 11.122 11.1208 12.036 9.99349 12.036C8.86607 12.036 7.95221 11.122 7.95221 9.99474C7.95221 8.86732 8.86607 7.95346 9.99349 7.95346Z"
												fill="white"></path>
											<defs>
												<radialGradient id="paint0_radial_85_1987" cx="0" cy="0" r="1"
													gradientUnits="userSpaceOnUse"
													gradientTransform="translate(5.89846 20.098) rotate(-90) scale(17.3439 16.1311)">
													<stop stop-color="#FFDD55"></stop>
													<stop offset="0.1" stop-color="#FFDD55"></stop>
													<stop offset="0.5" stop-color="#FF543E"></stop>
													<stop offset="1" stop-color="#C837AB"></stop>
												</radialGradient>
												<radialGradient id="paint1_radial_85_1987" cx="0" cy="0" r="1"
													gradientUnits="userSpaceOnUse"
													gradientTransform="translate(-1.68134 2.51068) rotate(78.6807) scale(7.75281 31.9572)">
													<stop stop-color="#3771C8"></stop>
													<stop offset="0.128" stop-color="#3771C8"></stop>
													<stop offset="1" stop-color="#6600FF" stop-opacity="0"></stop>
												</radialGradient>
											</defs>
										</svg></a>
									<a class="btn-outline-secondary btn-social" href="#"><svg width="20" height="20"
											viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path
												d="M20 10.0609C20 4.50485 15.5224 0 10 0C4.47757 0 0 4.50485 0 10.0609C0 15.0822 3.65631 19.2446 8.43763 20.0002V12.9698H5.8979V10.0609H8.43763V7.84387C8.43763 5.32263 9.93109 3.92901 12.2149 3.92901C13.309 3.92901 14.4537 4.12567 14.4537 4.12567V6.60164H13.1922C11.9505 6.60164 11.5624 7.37697 11.5624 8.17353V10.0609H14.3355L13.8926 12.9698H11.5624V20.0002C16.3437 19.2461 20 15.0836 20 10.0609Z"
												fill="#1977F3"></path>
										</svg></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
//Initialize the intl-tel-input plugin 
$(function () {
	/*
	* International Telephone Input v16.0.0
	* https://github.com/jackocnr/intl-tel-input.git
	* Licensed under the MIT license
	*/
	var input = document.querySelectorAll("input[name=phoneno]");
	var iti_el = $(".iti.iti--allow-dropdown.iti--separate-dial-code");
	if (iti_el.length) {
		iti.destroy();

		// Get the current number in the given format
	}
	for (var i = 0; i < input.length; i++) {
		iti = intlTelInput(input[i], {
			autoHideDialCode: false,
			autoPlaceholder: "aggressive",
			initialCountry: "us",
			separateDialCode: true,
			preferredCountries: ["us","ca","mx"],
			customPlaceholder: function (
				selectedCountryPlaceholder,
				selectedCountryData
			) {
				return "" + selectedCountryPlaceholder.replace(/[0-9]/g, "X");
			},
			geoIpLookup: function (callback) {
				$.get("https://ipinfo.io", function () {}, "jsonp").always(function (resp) {
					var countryCode = resp && resp.country ? resp.country : "";
					callback(countryCode);
				});
			},
			utilsScript:
				"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.0/js/utils.js" // just for
		});

		// Set the hidden country code input when the country changes
		input[i].addEventListener("countrychange", function(e) {
			var selectedCountryData = iti.getSelectedCountryData();
			document.getElementById("country_code").value = selectedCountryData.iso2; // Set the country ISO code
		});

		// Check if the device is mobile
		var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

		// Apply input mask only if not mobile
		if (!isMobile) {
			$('input[name="phoneno"]').on("focus click countrychange", function () {
				var pl = $(this).attr("placeholder") + "";
				var res = pl.replace(/X/g, "9");
				if (res != "undefined") {
					$(this).inputmask(res, { placeholder: "X", clearMaskOnLostFocus: true });
				}
			});
		}

		$('input[name="phoneno"]').on(
			"focusout",
			function (e, countryData) {
				var intlNumber = iti.getNumber();
				console.log(intlNumber);
			}
		);
	}
});
</script>
@endsection