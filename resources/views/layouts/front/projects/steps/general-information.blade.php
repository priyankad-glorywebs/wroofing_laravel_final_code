@extends('layouts.front.master')
@section('title', 'General Information')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/custom.css') }}" type="text/css">
@endsection
@section('content')
    @php
        if (isset($project_id)) {
            $data = \App\Models\Project::where('id', $project_id)->first();
        }

        $country_code = 'us';
        if (isset($data) && $data->country_code) {
            $country_code = $data->country_code;
        } else {
            $country_code = \Auth::user()->country_code;
        }
        if (isset($data) && $data->phone) {
            $phone_no = $data->phone;
        } else {
            $phone_no = \Auth::user()->contact_number;
        }
    @endphp
    <div class="breadcrumb-title-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a
                                href="{{ URL::to('add/project/' . base64_encode($project_id)) }}"><svg width="5"
                                    height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.13654 8L1.25522 5.11869C0.914945 4.77841 0.914945 4.22159 1.25522 3.88131L4.13654 1"
                                        stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg> Back</a></li>
                    </ol>

                    <div class="section-title">{{ $data->title ?? '' }}</div>
                    <div class="row">
                        <div class="col-md-8">
                            @if (isset($data->credit))
                                @if ($data->credit > 0)
                                    <div class="col-12 mb-3 text-center d-md-none">
                                        <span class="total-credit"> Total Credit : {{ $data->credit ?? '' }}</span>
                                    </div>
                                @endif
                            @endif
                            <div class="mt-3">
                                <a class="btn-gallery-filter project-list-item-link active"
                                    href="{{ route('general.info', ['project_id' => base64_encode($project_id)]) }}">General
                                    Info</a>
                                <a class="project-list-item-link btn-gallery-filter"
                                    href="{{ route('design.studio', ['project_id' => base64_encode($project_id)]) }}">Design
                                    studio</a>
                                <a class="project-list-item-link btn-gallery-filter"
                                    href="{{ route('documentation', ['project_id' => base64_encode($project_id)]) }}">Documents</a>
                                <a class="project-list-item-link btn-gallery-filter"
                                    href="{{ route('contractor.list', ['project_id' => base64_encode($project_id)]) }}">Contractor
                                    Portal</a>
                            </div>
                        </div>
                        <div class="col-md-4">


                            @if (isset($data->credit))
                                @if ($data->credit > 0)
                                    <div class="col-12 mb-3 text-end d-none d-md-block">
                                        <span class="total-credit"> Total Credit : {{ $data->credit ?? '' }}</span>
                                    </div>
                                @endif
                            @endif


                            <div class="step-count">
                                <div class="step-count-title">Step 1 out of 3</div>
                                @php
                                    $progress_bar_score = 00;
                                    $progress_bar_color = 'red';
                                    if (function_exists('get_progress_bar_score')) {
                                        $progress_bar_score = get_progress_bar_score($project_id);
                                        if ($progress_bar_score <= 40) {
                                            $progress_bar_color = 'red';
                                        } elseif ($progress_bar_score > 40 && $progress_bar_score <= 90) {
                                            $progress_bar_color = 'orange';
                                        } elseif ($progress_bar_color >= 95) {
                                            $progress_bar_color = '#53B746;';
                                        }
                                    }
                                @endphp
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: {{ $progress_bar_score }}%;background-color: {{ $progress_bar_color }}"
                                        aria-valuenow="{{ $progress_bar_score }}" aria-valuemin="0" aria-valuemax="100">
                                        {{ $progress_bar_score }}%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-lg-none mt-4">
                    <div class="col-12">
                    </div>
                </div>
                <div class="row breadcrumb-title">
                    <div class="col-12 col-lg-7">
                        <div class="breadcrumb-addproject-title-wrap breadcrumb-addproject-step-2">
                            <div class="section-title">General Information</div>
                            <div class="section-subtitle d-none d-lg-block">Please fill out the below details</div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5 text-end">
                        <div class="breadcrumb-addproject-title-wrap breadcrumb-addproject-step-2">
                            <div class="section-subtitle d-lg-none">Please fill out the below details</div>
                        </div>
                        <div class="breadcrumb-addproject-title-wrap breadcrumb-addproject-step-3">
                            <div class="section-subtitle d-lg-none">Please upload all below documents</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="studio-stepform-sec">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="studio-stepform-wrap">
                        <form id="addproject" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="studio-step-2">
                                <div class="row">
                                    <div class="form-group col-12 col-md-12">
                                        <div class="field-wrap">
                                            <div class="form-label">
                                                <label for="name">Name<span>*</span></label>
                                            </div>
                                            <div class="form-element">
                                                <input id="name" type="text" name="title"
                                                    @if (isset($data)) value="{{ $data->title ?? '' }}" @endif
                                                    placeholder="John doe">
                                                @if ($errors->has('errors'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('errors') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <div class="field-wrap">
                                            <div class="form-label">
                                                <label for="address">Address<span>*</span></label>
                                            </div>
                                            <div class="form-element">
                                                @if (isset($data) && isset($data->address) && $data->address != null)
                                                    <textarea id="address" name="address" rows="4" placeholder="Enter your address">@if (isset($data)) {{ $data->address ?? '' }}@endif</textarea>
                                                @else
                                                    <textarea id="address" name="address" rows="4" placeholder="Enter your address">{{ \Auth::user()->address ?? '' }}</textarea>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <div class="field-wrap">
                                            <div class="form-label">

                                                <label for="customer_name">Customer Name<span>*</span></label>
                                            </div>
                                            @if ($data->customer_name)
                                                <div class="form-element">
                                                    <input id="customer_name" type="text"
                                                        @if (isset($data)) value="{{ $data->customer_name ?? '' }}" @endif
                                                        name="customer_name" placeholder="Enter Customer name">
                                                </div>
                                            @else
                                                <div class="form-element">
                                                    <input id="customer_name" type="text"
                                                        @if (isset($data)) value="{{ \Auth::user()->name ?? '' }}" @endif
                                                        name="customer_name" placeholder="Enter Customer name">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <div class="field-wrap">
                                            <div class="form-label">
                                                <label for="contact_number">Contact Number<span>*</span></label>
                                            </div>
                                            @if (isset($data->phone))
                                                <div class="form-element" style="display: grid;">
                                                    <input id="country_code" type="hidden" name="country_code"
                                                        value="{{ $country_code }}" />
                                                    <input id="contact_number" type="tel" name="contact_number"
                                                        @if (isset($data)) value="{{ $phone_no ?? '' }}" @endif>
                                                </div>
                                            @else
                                                <div class="form-element" style="display: grid;">
                                                    <input id="country_code" type="hidden" name="country_code"
                                                        value="{{ $country_code }}" />
                                                    <input id="contact_number" type="tel" name="contact_number"
                                                        inputmode="tel"
                                                        @if (isset($data)) value="{{ $phone_no ?? '' }}" @endif>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <div class="field-wrap">
                                            <div class="form-label">
                                                <label for="insurancecompany">Insurance company</label>
                                            </div>
                                            <div class="form-element">
                                                <input id="insurancecompany" type="text"
                                                    @if (isset($data)) value="{{ $data->insurance_company ?? '' }}" @endif
                                                    name="insurancecompany" placeholder="Enter insurance company name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <div class="field-wrap">
                                            <div class="form-label">
                                                <label for="insuranceagency">Insurance agency</label>
                                            </div>
                                            <div class="form-element">
                                                <input id="insuranceagency" type="text"
                                                    @if (isset($data)) value="{{ $data->insurance_agency ?? '' }}" @endif
                                                    name="insuranceagency" placeholder="Enter insurance agency name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <div class="field-wrap">
                                            <div class="form-label">
                                                <label for="billing">Billing</label>
                                            </div>
                                            <div class="form-element">
                                                <input id="billing" type="text"
                                                    @if (isset($data)) value="{{ $data->billing ?? '' }}" @endif
                                                    name="billing" placeholder="Enter billing info">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <div class="field-wrap">
                                            <div class="form-label">
                                                <label for="mortgagecompany">Mortgage company</label>
                                            </div>
                                            <div class="form-element">
                                                <input id="mortgagecompany" type="text"
                                                    @if (isset($data)) value="{{ $data->mortgage_company ?? '' }}" @endif
                                                    name="mortgagecompany" placeholder="Enter mortgage company name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group button-wrap col-md-12">
                                        <div class="field-wrap text-center">
                                            <button type="submit" class="btn btn-primary btn-studio-step-2">Submit and
                                                continue</button>
                                        </div>
                                    </div>
                                    <div class="backto-login text-center">
                                        <a href="{{ URL::to('add/project/' . base64_encode($project_id)) }}"><svg
                                                width="5" height="9" viewBox="0 0 5 9" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.13654 8L1.25522 5.11869C0.914945 4.77841 0.914945 4.22159 1.25522 3.88131L4.13654 1"
                                                    stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg> Back</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
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
