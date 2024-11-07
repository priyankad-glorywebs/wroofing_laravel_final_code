@extends('layouts.front.master')
@section('title', 'View Profile Page')
@section('content')

    <div class="breadcrumb-wrap d-lg-none">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('project.list') }}"><svg width="5" height="9" viewBox="0 0 5 9"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.13654 8L1.25522 5.11869C0.914945 4.77841 0.914945 4.22159 1.25522 3.88131L4.13654 1"
                                        stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg> Back
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="stepform-sec">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="section-title">View Profile</div>
                    <div class="step-count">
                    </div>
                    <div class="section-subtitle">Let’s know a little more about you...</div>
                </div>
                <div class="col-12">

                    <form id="updateprofile-customerform" action="{{ route('customer.profile.update') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @php
                            $user = auth()->user();
                            $country_code   = $user->country_code ? $user->country_code : 'us';
                            $phone_no       = $user->contact_number ? $user->contact_number : '';
                        @endphp
                        <input type="hidden" id="user_id" name="user_id" value="{{ $user->id ?? '' }}">
                        <div class="step-2" style="">
                            <div class="row">
                                @if (session('success'))
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
                                            <input id="name" type="text"
                                                value="{{ old('name', $user->name ?? '') }}" name="name"
                                                placeholder="John doe">
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
                                                value="{{ old('email', $user->email ?? '') }}"
                                                placeholder="Enter your email address" readonly>
                                            @error('uemail')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    {{-- <div class="field-wrap"> --}}
                                    <div class="form-element">
                                        <div class="upload-img-wrap">
                                            <input id="uploadimage" type="file" name="customer_profile"
                                                accept="image/jpg, image/jpeg, image/png">
                                            <label for="uploadimage" class="upload-label">
                                                
                                                @if ($user->profile_image == null)
                                                    <div class="upload-img-icon preview-container">
                                                        <img id="imagePreview"
                                                            src="{{ asset('frontend-assets/images/img-icon.svg') }}"
                                                            alt="img-icon" width="30" height="30">
                                                    </div>
                                                @endif
                                                @if (isset($user->profile_image) && $user->profile_image !== null && $user->profile_image !== '')
                                                    <div class="upload-img-icon preview-container active">
                                                        <img id="imagePreview"
                                                            src="{{ asset($user->profile_image) }}"
                                                            alt="img-icon" width="30" height="30">
                                                    </div>
                                                    <div class="upload-img-text">{{ $user->profile_image }}</div>
                                                    {{-- <img src="{{ asset($user->profile_image)}}" alt="img-icon" > --}}
                                                @else
                                                    <div class="upload-img-text">Upload your picture</div>
                                                @endif
                                                <div class="upload-img-formate">(PNG or JPEG file accepted)</div>
                                            </label>
                                            @if (isset($user->profile_image) && $user->profile_image !== null && $user->profile_image !== '')
                                                <div id="removeImage" class="delete-img-btn remove-button" style="cursor: pointer"
                                                    onclick="deleteImage('{{ $user->profile_image }}')">X</div>
                                            @else
                                            <div id="removeImage" class="remove-button delete-img-btn"
                                                    style="display: none; cursor: pointer">X</div>
                                            @endif
                                        </div>
                                        {{-- </div> --}}
                                    </div>
                                </div>


                                <div class="form-group col-12">
                                    <div class="field-wrap">
                                        <div class="form-label">
                                            <label for="address">Address<span>*</span></label>
                                        </div>
                                        <div class="form-element">
                                            <textarea id="address" name="address" rows="4" placeholder="Enter your address">{{ $user->address ?? '' }}</textarea>
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <div class="field-wrap">
                                        <div class="form-label">
                                            <label for="contact_number">Contact number{{-- <span>*</span> --}}</label>
                                        </div>
                                        <div class="form-element" style="display: grid;">
                                            <input id="country_code" type="hidden" name="country_code"
                                            value="{{ $country_code }}" />
                                            <input type="text"
                                                value="{{ old('contact_number', $user->contact_number ?? '') }}"
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
                                            <label for="zipcode">Zip code{{-- <span>*</span> --}}</label>
                                        </div>
                                        <div class="form-element">
                                            <input id="zipcode" type="text"
                                                value="{{ old('zipcode', $user->zip_code ?? '') }}" name="zipcode"
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

        .upload-img-wrap {
            position: relative;
            /* display: inline-block; */
        }

        .delete-img-btn {
            /* display: none; */
            position: absolute;
            top: -10px;
            right: -10px;
            height: 30px;
            width: 30px;
            border-radius: 10em;
            padding: 2px 6px 3px;
            text-align: center;
            line-height: 25px;
            text-decoration: none;
            font: 700 14px/25px sans-serif;
            background: #0A84FF;
            color: #FFF;
            s -webkit-transition: background 0.5s;
            transition: background 0.5s;
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

    <script>
        function deleteImage(imageName) {
            if (confirm("Are you sure you want to delete this image?")) {
                // Ajax call to delete image
                $.ajax({
                    url: "{{ route('delete.image') }}",
                    type: 'POST',
                    data: {
                        image_name: imageName,
                        "_token": "{{ csrf_token() }}",

                    },
                    success: function(response) {
                        // Handle success, e.g., remove UI elements
                        console.log('Image deleted successfully');
                        $('.upload-img-text').text('');
                        $('.upload-img-text').text('Upload your picture');
                        $('.delete-img-btn').hide();
                        const imagePreview = document.getElementById('imagePreview');
                        const previewContainer = document.querySelector('.preview-container');
                        previewContainer.classList.remove('active');
                        imagePreview.src = '{{ asset('frontend-assets/images/img-icon.svg') }}'; // Set static URL
                        $('.profile-image').html(
                            `<img src="{{ asset('/frontend-assets/images/defaultimage.jpg') }}" onerror="this.onerror=null;callfun(this);" height="50" width="50">`
                            );
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error('Error deleting image:', error);
                    }
                });
            }
        }
    </script>
    <style>
        /* Start jQuery Validation CSS */
        .stepform-sec .upload-img-wrap.field-error label {
            border-color: red;
        }
        span#uploadimage-error {
            color: red;
            display: block !important;
            font-size: 14px;
            font-family: monospace;
        }
        /*  End jQuery Validation CSS */
    </style>
    <script>
        /* start image priview */
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
