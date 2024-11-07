@extends('layouts.front.master')
@section('title', 'View Profile Page')

@section('content')

<div class="breadcrumb-wrap d-lg-none">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<ol class="breadcrumb m-0">
					<li class="breadcrumb-item"><a href="{{route('contractor.dashboard')}}"><svg width="5" height="9"
								viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path
									d="M4.13654 8L1.25522 5.11869C0.914945 4.77841 0.914945 4.22159 1.25522 3.88131L4.13654 1"
									stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
									stroke-linejoin="round" />
							</svg> Back</a></li>
				</ol>
			</div>
		</div>
	</div>
</div>
<section class="stepform-sec">
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				{{-- <div class="signin-notes d-lg-none">View Profile</div> --}}
				<div class="section-title">View Profile</div>
				<div class="step-count">
				</div>
				<div class="section-subtitle">Let’s know a little more about you...</div>
			</div>
			<div class="col-12">
				<form id="updateprofile-contarctorform" action="{{route('contractor.profile.update')}}" method="post"
					enctype="multipart/form-data">
					@csrf
					@php
						$contractor = auth()->guard('contractor')->user();
						$country_code   = $contractor->country_code ? $contractor->country_code : 'us';
                    	$phone_no       = $contractor->contact_number ? $contractor->contact_number : '';
					@endphp
					<input type="hidden" id="contarctorId" name="contarctorId" value="{{$contractor->id ?? ''}}">
					<div class="step-2" style="">
						<div class="row">
							@if(session('success'))
								<div class="alert alert-success alert-dismissible fade show">
									{{ session('success') }}
									<button type="button" class="btn-close" data-bs-dismiss="alert"
										aria-label="Close"></button>
								</div>
							@endif
							<div class="form-group col-12">
								<div class="field-wrap">
									<div class="form-label">
										<label for="uname">Name<span>*</span></label>
									</div>
									<div class="form-element">
										<input id="name" type="text" value="{{ old('name', $contractor->name ?? '') }}"
											name="name" placeholder="John doe">
										@error('name')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
							<div class="form-group col-12">
								<div class="field-wrap">
									<div class="form-label">
										<label for="email">Email</label>
									</div>
									<div class="form-element">
										<input id="email" type="email" name="email"
											value="{{ old('email', $contractor->email ?? '') }}"
											placeholder="Enter your email address" readonly>
										@error('uemail')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>


							<div class="form-group col-12">
								<div class="field-wrap">
									<div class="form-element">
										<div class="upload-img-wrap" data-image-type="profile">
											<input id="uploadimage" type="file" name="customer_profile"
												accept="image/jpg, image/jpeg, image/png">
											<label for="uploadimage" class="upload-label">
												@if ($contractor->profile_image == null)
												<div class="upload-img-icon preview-container">
													<img class="image-preview" src="{{asset('frontend-assets/images/img-icon.svg')}}"
														alt="img-icon" width="30" height="30">
												</div>
												@endif
												@if(isset($contractor->profile_image) && $contractor->profile_image !== NULL && $contractor->profile_image !== '')
													<div class="upload-img-icon preview-container active">
														<img class="image-preview" id="imagePreview"
															src="{{ asset($contractor->profile_image) }}"
															alt="img-icon" width="30" height="30">
													</div>
													<div class="upload-img-text">{{$contractor->profile_image ?? ''}}</div>
													<div class="upload-img-formate">
														<small>Update your picture</small><br>
														(PNG or JPGE file accepted)
													</div>
												@else
													<div class="upload-img-text">Upload your picture</div>
													<div class="upload-img-formate">(PNG or JPGE file accepted)</div>
												@endif
											</label>
											@if (isset($contractor->profile_image) && $contractor->profile_image !== null && $contractor->profile_image !== '')
												<div id="removeImage" class="remove-button" style="cursor: pointer"
													onclick="deleteImage(this)">X</div>
											@else
											<div id="removeImage" class="remove-button delete-img-btn"
													style="display: none; cursor: pointer">X</div>
											@endif
										</div>
									</div>
								</div>
							</div>



							<!-- Banner Image Input -->


							<div class="form-group col-12">
								<div class="field-wrap">
									<div class="form-element">
										<div class="upload-img-wrap" data-image-type="banner">
											<input id="banner_image" type="file" name="banner_image"
												accept="image/jpg, image/jpeg, image/png">
											<label for="banner_image" class="upload-label">
												@if ($contractor->banner_image == null)
												<div class="upload-img-icon preview-container">
													<img class="image-preview" src="{{asset('frontend-assets/images/img-icon.svg')}}"
														alt="img-icon" width="30" height="30">
												</div>
												@endif
												@if(isset($contractor->banner_image) && $contractor->banner_image !== NULL && $contractor->banner_image !== '')
													<div class="upload-img-icon preview-container active">
														<img class="image-preview" src="{{ asset($contractor->banner_image) }}" alt="img-icon" width="30" height="30">
													</div>
													<div class="upload-img-text">{{$contractor->banner_image ?? ''}}</div>
													<div class="upload-img-formate">
														<small>Update your banner image</small><br>(PNG or JPGE file accepted)
													</div>
												@else
													<div class="upload-img-text">Upload your banner image</div>
													<div class="upload-img-formate">(PNG or JPGE file accepted)</div>
												@endif
											</label>
											@if (isset($contractor->banner_image) && $contractor->banner_image !== null && $contractor->banner_image !== '')
												<div id="removeImage" class="remove-button" style="cursor: pointer"
													onclick="deleteImage(this)">X</div>
											@else
											<div id="removeImage" class="remove-button delete-img-btn"
													style="display: none; cursor: pointer">X</div>
											@endif
										</div>
									</div>
								</div>
							</div>
							<!-- end banner image  -->


							<!-- Company logo  -->

							<!-- Banner Image Input -->
							<div class="form-group col-12">
								<div class="field-wrap">
									<div class="form-element">
										<div class="upload-img-wrap" data-image-type="logo">
											<input id="company_logo" type="file" name="company_logo"
												accept="image/jpg, image/jpeg, image/png">
											<label for="company_logo">
												@if ($contractor->company_logo == null)
												<div class="upload-img-icon preview-container">
													<img class="image-preview" src="{{asset('frontend-assets/images/img-icon.svg')}}"
														alt="img-icon" width="30" height="30">
												</div>
												@endif
												@if(isset($contractor->company_logo) && $contractor->company_logo !== NULL && $contractor->company_logo !== '')
													<div class="upload-img-icon preview-container active">
														<img class="image-preview" src="{{ asset($contractor->company_logo) }}"
															alt="img-icon" width="30" height="30">
													</div>
													<div class="upload-img-text">{{$contractor->company_logo ?? ''}}</div>
													<div class="upload-img-formate">
														<small>Update your company logo</small><br>
														(PNG or JPGE file accepted)
													</div>
												@else
													<div class="upload-img-text">Upload your company logo</div>
													<div class="upload-img-formate">(PNG or JPGE file accepted)</div>
												@endif
											</label>
											@if (isset($contractor->company_logo) && $contractor->company_logo !== null && $contractor->company_logo !== '')
												<div id="removeImage" class="remove-button" style="cursor: pointer"
													onclick="deleteImage(this)">X</div>
											@else
											<div id="removeImage" class="remove-button delete-img-btn"
													style="display: none; cursor: pointer">X</div>
											@endif
										</div>
									</div>
								</div>
							</div>
							<!-- Company logo  -->


							<div class="form-group col-12">
								<div class="field-wrap">
									<div class="form-label">
										<label for="company_name">Company Name <span>*</span></label>
									</div>
									<div class="form-element">
										<input type="text"
											value="{{ old('company_name', $contractor->company_name ?? '') }}"
											id="company_name" name="company_name" placeholder="Enter your company name">
										@error('company_name')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>

							<div class="form-group col-12">
								<div class="field-wrap">
									<div class="form-label">
										<label for="address">Address<span>*</span></label>
									</div>
									<div class="form-element">
										<textarea id="address" name="address" rows="4"
											placeholder="Enter your address">{{$contractor->address ?? ''}}</textarea>
										@error('address')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
							<div class="form-group col-12">
								<div class="field-wrap">
									<div class="form-label">
										<label for="contact_number">Contact number <!-- <span>*</span> --></label>
									</div>
									<div class="form-element" style="display: grid;">
										<input id="country_code" type="hidden" name="country_code"
										value="{{ $country_code }}" />
										<input type="text"
											value="{{ old('contact_number', $contractor->contact_number ?? '') }}"
											id="contact_number" name="contact_number"
											placeholder="Enter your contact number">
										@error('contact_number')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
							<div class="form-group col-12">
								<div class="field-wrap">
									<div class="form-label">
										<label for="zipcode">Zip code <!--<span>*</span> --></label>
									</div>
									<div class="form-element">
										<input id="zipcode" type="text"
											value="{{ old('zipcode', $contractor->zip_code ?? '') }}" name="zipcode"
											placeholder="Enter zip code">
										@error('zipcode')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
							<div class="form-group button-wrap col-md-12">
								<div class="field-wrap">
									<button type="submit" class="btn btn-primary d-block w-100">Get started</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<style>
	input[type=email]:read-only {
		color: #78909C;
		text-shadow: 0px -1px 0 #f9f9f9;
		background: #F5F5F5;
		cursor: not-allowed;
	}
	/* Start jQuery Validation CSS */
	.stepform-sec .upload-img-wrap.field-error label {
		border-color: red;
	}
	span#uploadimage-error, span#banner_image-error, span#company_logo-error {
		color: red;
		display: block !important;
		font-size: 14px;
		font-family: monospace;
	}
	.upload-img-wrap:hover .delete-img-btn {
            display: block;
            background: #E54E4E;
            /* padding: 3px 7px 5px;
            top: -11px;
            right: -11px; */
        }
        .field-error .delete-img-btn{
            top: 8px;
            right: -12px;
        }

        .upload-img-icon.preview-container.active img {
            width: 130px;
            height: 130px;
        }
		.field-error div#removeImage {
			top: 5px;
		}
        div#removeImage {
            /* display: none; */
            position: absolute;
            top: -10px;
            right: -10px;
            height: 30px;
            width: 30px;
            text-align: center;
            color: rgb(255, 255, 255);
            border-radius: 10em;
            padding: 2px 6px 3px;
            text-decoration: none;
            font: 700 14px / 25px sans-serif;
            background: rgb(10, 132, 255);
        }

        .upload-img-wrap:hover #removeImage {
            background: #E54E4E !important;
        } 
	/*  End jQuery Validation CSS */
</style>
<script>
	function deleteImage(button) {
		if (confirm("Are you sure you want to delete this image?")) {
			const uploadContainer 	= button.closest('.upload-img-wrap');
			const dataImageType 	= uploadContainer.getAttribute('data-image-type')
			if(dataImageType){
				//Ajax call to delete image
				$.ajax({
					url: "{{ route('contractor.delete.image') }}", // Define the route
					type: 'POST',
					data: {
						contarctorId : "{{$contractor->id}}",
						remove_image: uploadContainer.getAttribute('data-image-type'), // Pass the image type (e.g., profile, banner, logo)
						"_token": "{{ csrf_token() }}", // CSRF token for security
					},
					success: function(response) {
						// Handle successful response here
						const imagePreview = uploadContainer.querySelector('.image-preview'); // Get the image preview element
						const previewContainer = uploadContainer.querySelector('.preview-container'); // Get the preview container
						const uploadText = uploadContainer.querySelector('.upload-img-text'); // Get the upload text element
						// Reset the image and text based on the image type
						imagePreview.src = '{{ asset("frontend-assets/images/img-icon.svg") }}'; // Set to static placeholder image
						// previewContainer.classList.remove('active');
						previewContainer.style.display = 'none';

						const removeButton 		= uploadContainer.querySelector('#removeImage');
						if (!removeButton.classList.contains('delete-img-btn')) {
							removeButton.classList.add('delete-img-btn');
						}
						// Update upload text based on the data-image-type attribute
						switch (uploadContainer.getAttribute('data-image-type')) {
							case 'profile':
								uploadText.textContent = 'Upload your picture';
								break;
							case 'banner':
								uploadText.textContent = 'Upload your banner image';
								break;
							case 'logo':
								uploadText.textContent = 'Upload your company logo';
								break;
							default:
								uploadText.textContent = 'Upload your image'; // Fallback text
						}

						// Remove active class from the preview container
						previewContainer.classList.add('active');

						// Hide the delete button
						button.style.display = 'none';
						location.reload();
					},
					error: function(xhr, status, error) {
						// Handle error
						console.error('Error deleting image:', error);
						alert('An error occurred while deleting the image. Please try again.'); // User-friendly error message
					}
				});
			}else{
				alert('something is wrong');
			}
		}else{
			console.log("User canceled deletion");
		}
	}

	/* start image priview */
	// Attach event listeners to all file inputs with the 'upload-img-wrap' class
	document.querySelectorAll('.upload-img-wrap').forEach((uploadWrap) => {
		const fileInput 		= uploadWrap.querySelector('input[type="file"]');
		const imagePreview 		= uploadWrap.querySelector('.image-preview');
		const uploadText 		= uploadWrap.querySelector('.upload-img-text');
		const removeButton 		= uploadWrap.querySelector('.delete-img-btn');
		const previewContainer 	= uploadWrap.querySelector('.upload-img-icon');

		// Handle file selection for preview
		fileInput.addEventListener('change', function() {
			const file = this.files[0];
			if (file) {
				const reader = new FileReader();
				reader.onload = function(e) {
					// Display preview image
					imagePreview.src = e.target.result;
					const fileName = file.name;
					previewContainer.classList.add('active');
					if ($(removeButton).length) {
						$(removeButton).removeAttr('onclick').css('display', 'block'); // Remove onclick and set display to block
					} else {
						console.warn("Button not found!");
					} 
					//uploadText.textContent = `Update your ${uploadWrap.getAttribute('data-image-type')}`;
					uploadText.textContent = fileName;
				};
				reader.readAsDataURL(file);
			}
		});

		// Handle image removal
		if (removeButton) {
			removeButton.addEventListener('click', function() {
				// Reset file input and preview elements
				fileInput.value = '';
				imagePreview.src = '{{ asset("frontend-assets/images/img-icon.svg") }}'; // Static placeholder image
				uploadText.textContent = `Upload your ${uploadWrap.getAttribute('data-image-type')}`;
				removeButton.style.display = 'none'; // Hide the remove button
				previewContainer.classList.remove('active');
			});
		}
	});        
	/* end image priview */

	$(function () {
		const countryCode = "{{ $country_code ?? 'us' }}"; // Dynamic country code
		const phoneNumber = "{{ $phone_no ?? '' }}"; // Dynamic phone number

		// Check if intlTelInput plugin exists
		if (typeof intlTelInput !== 'undefined') {
			// Select all inputs with the name 'contact_number'
			const inputs = document.querySelectorAll("input[name=contact_number]");

			inputs.forEach(function (input) {
				// Initialize intl-tel-input
				const iti = intlTelInput(input, {
					autoHideDialCode: false,
					autoPlaceholder: "aggressive",
					initialCountry: countryCode, // Use dynamic country code
					separateDialCode: true,
					preferredCountries: ["us", "ca", "mx"],
					customPlaceholder: function (selectedCountryPlaceholder) {
						return selectedCountryPlaceholder.replace(/[0-9]/g, "X");
					},
					geoIpLookup: function (callback) {
						$.get("https://ipinfo.io", function () {}, "jsonp").always(function (resp) {
							const detectedCountryCode = resp && resp.country ? resp.country : countryCode;
							callback(detectedCountryCode);
						});
					},
					utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.0/js/utils.js"
				});

				// Set dynamic phone number value
				input.value = phoneNumber;

				// Update hidden input when country changes
				input.addEventListener("countrychange", function () {
					const selectedCountryData = iti.getSelectedCountryData();
					document.getElementById("country_code").value = selectedCountryData.iso2;
				});

				// Initialize input mask on focus, click, and country change
				$(input).on("focus click countrychange", function () {
					const placeholder = $(this).attr("placeholder") || "";
					const maskedPlaceholder = placeholder.replace(/X/g, "9");
					if (maskedPlaceholder) {
						$(this).inputmask(maskedPlaceholder, { placeholder: "X", clearMaskOnLostFocus: true });
					}
				});

				// Log international number on focus out
				$(input).on("focusout", function () {
					const intlNumber = iti.getNumber();
					console.log(intlNumber);
				});
			});
		} else {
			console.warn("intlTelInput plugin is not loaded.");
		}
	});
</script>
<!-- START ADD COUNTRY CODE ON PHONE -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.0/css/intlTelInput.css">
<!-- Load intl-tel-input after jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.0/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.8/jquery.inputmask.bundle.min.js"></script>
<!-- END ADD COUNTRY CODE ON PHONE -->	
@endsection