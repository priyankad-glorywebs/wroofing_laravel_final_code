@extends('layouts.front.master')
@section('title', 'Register ')
@section('content')
<!-- START ADD COUNTRY CODE ON PHONE -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.0/css/intlTelInput.css">
<!-- Load intl-tel-input after jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.0/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.8/jquery.inputmask.bundle.min.js"></script>
<!-- END ADD COUNTRY CODE ON PHONE -->
    <div class="breadcrumb-wrap d-lg-none">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="stepform-sec">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="signin-notes d-lg-none">Register now</div>
                    <div class="section-title">Let us know</div>
                    <div class="step-count">
                        <div class="step-count-title">Step 1 out of 2</div>
                        <div class="step-count-progress current-step-1"></div>
                    </div>
                    <div class="section-subtitle">Let’s know a little more about you...</div>
                </div>
                <div class="col-12 customer-section">
                    <form action="{{ route('register') }}" method="post" enctype="multipart/form-data" id="register">
                        @csrf
                        <div class="step-1">
                            <div class="form-label-ques text-md-center">Are you a ...</div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <div class="field-wrap">
                                        <div class="form-label type-of-customer-item">
                                            <label for="customer">
                                                <div class="type-of-customer">
                                                    <img src="{{ asset('frontend-assets/images/customer.svg') }}"
                                                        alt="customer" width="270" height="230">
                                                </div>
                                                <div
                                                    class="customer-type-wrap d-flex align-items-center justify-content-between">
                                                    <div class="customer-type">Customer</div>
                                                    <input id="customer" type="radio" checked="checked" value="customer"
                                                        name="areyoua">
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <div class="field-wrap">
                                        <div class="form-label type-of-customer-item">
                                            <label for="contractor">
                                                <div class="type-of-customer">
                                                    <img src="{{ asset('frontend-assets/images/contractor.svg') }}"
                                                        alt="customer" width="270" height="230">
                                                </div>
                                                <div
                                                    class="customer-type-wrap d-flex align-items-center justify-content-between">
                                                    <div class="customer-type">Contractor</div>
                                                    <input id="contractor" value="contractor" type="radio" name="areyoua">
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button id="frm_next_btn" type="button"
                                        class="btn btn-primary btn-step-1">Next</button>
                                </div>
                            </div>
                        </div>
                        <div class="step-2 customer-field-wrap" style="display: none;">
                            <div class="row">
                                <div class="form-group col-12">
                                    <div class="field-wrap">
                                        <div class="form-label">
                                            <label for="name">Name<span>*</span></label>
                                        </div>
                                        <div class="form-element">
                                            <input type="text" value="{{ old('name') }}" name="name"
                                                placeholder="John doe">
                                        </div>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <div class="field-wrap">
                                        <div class="form-label">
                                            <label for="email">Email<span>*</span></label>
                                        </div>
                                        <div class="form-element">
                                            <input type="email" value="{{ old('email') }}" name="email"
                                                placeholder="john@example.com">
                                        </div>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-12">
                                    <div class="field-wrap">
                                        <div class="form-label">
                                            <label for="password">Enter new password<span>*</span></label>
                                        </div>

                                        <div class="form-element">
                                            <input type="password" id="password" name="password"
                                                placeholder="Enter new password">
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
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <div class="field-wrap">
                                        <div class="form-label">
                                            <label for="password_confirmation">Confirm new password<span>*</span></label>
                                        </div>
                                        <div class="form-element">
                                            <input type="password" id="password_confirmation"
                                                name="password_confirmation" placeholder="Confirm new password">
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
                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-12">
                                    <div class="field-wrap">
                                        <div class="form-element">
                                            <div class="upload-img-wrap">
                                                <input id="uploadimage" type="file" name="profile_image"
                                                    accept="image/jpg, image/jpeg, image/png">

                                                <label for="uploadimage" class="upload-label">
                                                    <div class="upload-img-icon preview-container">
                                                        <img id="imagePreview"
                                                            src="{{ asset('frontend-assets/images/img-icon.svg') }}"
                                                            alt="img-icon" width="30" height="30">
                                                    </div>
                                                    <div class="upload-img-text">Upload your picture</div>
                                                    <div class="upload-img-formate">(PNG or JPGE file accepted)</div>
                                                </label>
                                                <div id="removeImage" class="remove-button delete-img-btn"
                                                    style="display: none; cursor: pointer">X</div>
                                            </div>
                                            {{-- @error('profile_image')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror --}}

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-12">
                                    <div class="field-wrap">
                                        <div class="form-label">
                                            <label for="address">Address<span>*</span></label>
                                        </div>

                                        <div class="form-element">
                                            <textarea name="address" placeholder="Enter Address"></textarea>
                                        </div>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-12" id="company_name_div" style="display: none">
                                    <div class="field-wrap">
                                        <div class="form-label">
                                            <label for="company_name">Company Name <span>*</span></label>
                                        </div>
                                        <div class="form-element">
                                            <input type="text" id="company_name" name="company_name"
                                                placeholder="Enter your company name">
                                            @error('company_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-12">
                                    <div class="field-wrap">
                                        <div class="form-label">
                                            <label for="contact_number">Contact number</label>
                                        </div>
                                        <div class="form-element" style="display: grid;">
                                            <input id="country_code" type="hidden" name="country_code" value="us" />
                                            <input id="regi_contact_number" type="tel" name="contact_number" inputmode="tel" value="">
                                        </div>
                                        @error('contact_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <div class="field-wrap">
                                        <div class="form-label">
                                            <label for="zip_code">Zip code</label>
                                        </div>

                                        <div class="form-element">
                                            <input id="regi_zip_code" type="text" name="zip_code"
                                                placeholder="Enter Zip code">
                                        </div>
                                        @error('zip_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group button-wrap col-md-12">
                                    <div class="field-wrap">
                                        <input type="submit" class="btn btn-primary d-block w-100" value="Get started">
                                    </div>
                                </div>
                                <div id="back_button" class="backto-login text-center"><a href="javascript:void(0)"><svg
                                            width="5" height="9" viewBox="0 0 5 9" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M4.13654 8L1.25522 5.11869C0.914945 4.77841 0.914945 4.22159 1.25522 3.88131L4.13654 1"
                                                stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg> Back</a></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Start Form Validation CSS -->
    <style>
        span#uploadimage-error {
            color: red;
            display: block !important;
            font-size: 14px;
            fo nt-family: monospace;
        }

        .upload-img-icon.preview-container.active img {
            width: 130px;
            height: 130px;
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
    </style>
    <!-- End Form Validation CSS -->
    <script>
        // Trigger click event on label click to open file input
        document.querySelector('.upload-label').addEventListener('click', function() {
            document.getElementById('uploadimage').click();
        });

        document.getElementById('uploadimage').addEventListener('change', function() {
            const file = this.files[0];
            const previewContainer = document.querySelector('.preview-container');
            const imagePreview = document.getElementById('imagePreview');
            const removeButton = document.getElementById('removeImage');

            // Clear previous previews
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Show the preview
                    imagePreview.src = e.target.result;
                    previewContainer.style.display = 'block';
                    previewContainer.classList.add('active'); // Add dynamic class
                    removeButton.style.display = 'block'; // Show the remove button
                };

                reader.readAsDataURL(file);
            }

            // Handle the remove button click
            removeButton.onclick = function() {
                const uploadTextElements = document.getElementsByClassName('upload-img-text');
                // Reset the input
                document.getElementById('uploadimage').value = '';
                previewContainer.style.display = 'none'; // Hide preview
                previewContainer.classList.remove('active'); // Remove dynamic class
                removeButton.style.display = 'none'; // Hide remove button

                document.getElementById('uploadimage').value = '';
                imagePreview.src = '{{ asset('frontend-assets/images/img-icon.svg') }}'; // Set static URL
                previewContainer.style.display = 'block'; // Hide preview
                // Clear the upload text
                for (let i = 0; i < uploadTextElements.length; i++) {
                    uploadTextElements[i].textContent = 'Upload your picture'; // Clear the text
                }
            };
        });

//Initialize the intl-tel-input plugin 
$(function () {
	/*
	 * International Telephone Input v16.0.0
	 * https://github.com/jackocnr/intl-tel-input.git
	 * Licensed under the MIT license
	 */
	var input = document.querySelectorAll("input[name=contact_number]");
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
            $('input[name="contact_number"]').on("focus click countrychange", function () {
                var pl = $(this).attr("placeholder") + "";
                var res = pl.replace(/X/g, "9");
                if (res != "undefined") {
                    $(this).inputmask(res, { placeholder: "X", clearMaskOnLostFocus: true });
                }
            });
        }

		$('input[name="contact_number"]').on(
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
