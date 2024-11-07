@extends('layouts.front.master')
@section('title', 'Select Your style')
@section('content')
    <style>
        .card,
        .checkmark {
            background-color: #fff
        }
        .cards-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, .1);
            width: 30%;
            margin-bottom: 20px;
            padding: 15px;
            box-sizing: border-box;
            text-align: center
        }
        .radio-button {
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            position: relative;
            display: inline-block;
            width: 24px;
            height: 24px
        }
        .radio-button input[type=radio] {
            margin-right: 10px;
            appearance: none;
            border: 2px solid #53B746;
            border-radius: 50%;
            outline: 0;
            position: absolute;
            opacity: 0;
            cursor: pointer;
            width: 0;
            height: 0
        }
        .radio-button input[type=radio]:checked::before {
            content: '';
            width: 8px;
            height: 8px;
            background-color: #53B746;
            border-radius: 50%;
            position: absolute;
            top: 4px;
            left: 4px
        }
        .card img {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px
        }
        .card a {
            text-decoration: none;
            color: #53B746;
            font-weight: 700
        }
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 24px;
            width: 24px;
            border-radius: 50%;
            border: 2px solid #53B746
        }
        .radio-button input[type=radio]:checked~.checkmark {
            background-color: #53B746
        }
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
            top: 50%;
            left: 50%;
            width: 12px;
            height: 12px;
            background: #fff;
            border-radius: 50%;
            transform: translate(-50%, -50%)
        }
        .radio-button input[type=radio]:checked~.checkmark:after {
            display: block
        }
        .radio-button label {
            font-weight: 700;
            cursor: pointer;
            width: 115px
        }
        /*==================================================
                Model Popup CSS
            ==================================================*/
        #PublicBookTourPopUp .modal-dialog {
            max-width: 100% !important;
            margin: 0px;
            padding: 0px;
        }
        #PublicBookTourPopUp .modal-dialog .modal-body {
            padding: 0 0 !important;
            overflow: hidden !important;
            border-radius: 5px !important;
            position: relative !important;
        }
        #PublicBookTourPopUp .modal-dialog .modal-body .btn-close {
            position: absolute !important;
            right: 15px;
            top: 15px !important;
        }
        .modal-body iframe{
            padding-top: 65px;
        }
        .modal-body button.btn-close {
            border: 1px solid #e1e8ed!important;
            padding: 10px;
        }
        div#viewerContainerMain {
            padding: 0px 24px 20px;
            height: 100vh;
        }
        .loader-box {
            margin: 20px 0px 0px 0px;
        }
    </style>
    @php
        $contractor = auth()->guard('contractor')->user();
        $selectedStyle = 1;
        if (isset($contractor->template_style)) {
            $selectedStyle = $contractor->template_style;
        }
    @endphp
    <div class="breadcrumb-title-wrap pb-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('branding.page')}}"><svg width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.13654 8L1.25522 5.11869C0.914945 4.77841 0.914945 4.22159 1.25522 3.88131L4.13654 1" stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path></svg> 
                            Previous</a>
                        </li>
                    </ol>
                </div>
            </div>
            
            <div class="row breadcrumb-title">
                <div class="col-12 col-lg-7">
                    <div class="section-title">Your style</div>
                    <p>Select a professionally designed quote theme. You can change this later.</p>
                </div>
            </div>
        </div>
    </div>
    <section class="studio-stepform-sec">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="studio-stepform-wrap">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <span class="text-danger">{{ $error }}</span>
                                @endforeach
                            </div>
                        @endif
                        <form id="updateprofile-contarctorform" action="{{ route('branding.theme.add') }}" method="post"
                            enctype="multipart/form-data">
                            <input type="hidden" id="contarctorId" name="contarctorId"
                                value="{{ $contractor->id ?? '' }}" />
                            @csrf
                            <div class="cards-container">
                                <div class="card">
                                    <div class="radio-button">
                                        <input type="radio" name="style" id="style1" value="1"
                                            @if ($selectedStyle == 1) checked @endif>
                                        <span class="checkmark"></span>
                                        <label for="style1">Select</label>
                                    </div>
                                    <img src="{{ asset('report_style/style-1.png') }}" alt="Style 1">
                                    {{-- <a class="booktour" data-style="1" href="javascript:void(0)" data-bs-toggle="modal"
                                        data-bs-target="#PublicBookTourPopUp"
                                        data-src="{{ asset('report_style/style-1.pdf') }}">Preview</a> --}}
                                </div>
                                <div class="card">
                                    <div class="radio-button">
                                        <input type="radio" name="style" id="style2" value="2"
                                            @if ($selectedStyle == 2) checked @endif>
                                        <span class="checkmark"></span>
                                        <label for="style2">Select</label>
                                    </div>
                                    <img src="{{ asset('report_style/style-2.png') }}" alt="Style 2">
                                    {{-- <a class="booktour" data-style="2" href="javascript:void(0)" data-bs-toggle="modal"
                                        data-bs-target="#PublicBookTourPopUp"
                                        data-src="{{ asset('report_style/style-2.pdf') }}">Preview</a> --}}
                                </div>
                                <div class="card">
                                    <div class="radio-button">
                                        <input type="radio" name="style" id="style3" value="3"
                                            @if ($selectedStyle == 3) checked @endif>
                                        <span class="checkmark"></span>
                                        <label for="style3">Select</label>
                                    </div>
                                    <img src="{{ asset('report_style/style-3.png') }}" alt="Style 3">
                                    {{-- <a class="booktour" data-style="3" href="javascript:void(0)" data-bs-toggle="modal"
                                        data-bs-target="#PublicBookTourPopUp"
                                        data-src="{{ asset('report_style/style-3.pdf') }}">Preview</a> --}}
                                </div>
                                <div class="card">
                                    <div class="radio-button">
                                        <input type="radio" name="style" id="style4" value="4"
                                            @if ($selectedStyle == 4) checked @endif>
                                        <span class="checkmark"></span>
                                        <label for="style4">Select</label>
                                    </div>
                                    <img src="{{ asset('report_style/style-4.png') }}" alt="Style 4">
                                    {{-- <a class="booktour" data-style="4" href="javascript:void(0)" data-bs-toggle="modal"
                                        data-bs-target="#PublicBookTourPopUp"
                                        data-src="{{ asset('report_style/style-4.pdf') }}">Preview</a> --}}
                                </div>
                                <div class="card">
                                    <div class="radio-button">
                                        <input type="radio" name="style" id="style5" value="5"
                                            @if ($selectedStyle == 5) checked @endif>
                                        <span class="checkmark"></span>
                                        <label for="style5">Select</label>
                                    </div>
                                    <img src="{{ asset('report_style/style-5.png') }}" alt="Style 5">
                                    {{-- <a class="booktour" data-style="5" href="javascript:void(0)" data-bs-toggle="modal"
                                        data-bs-target="#PublicBookTourPopUp"
                                        data-src="{{ asset('report_style/style-5.pdf') }}">Preview</a> --}}
                                </div>
                                <div class="card">
                                    <div class="radio-button">
                                        <input type="radio" name="style" id="style6" value="6"
                                            @if ($selectedStyle == 6) checked @endif>
                                        <span class="checkmark"></span>
                                        <label for="style6">Select</label>
                                    </div>
                                    <img src="{{ asset('report_style/style-6.png') }}" alt="Style 6">
                                    {{-- <a class="booktour" data-style="6" href="javascript:void(0)" data-bs-toggle="modal"
                                        data-bs-target="#PublicBookTourPopUp"
                                        data-src="{{ asset('report_style/style-6.pdf') }}">Preview</a> --}}
                                </div>
                            </div>
                            <button class="btn btn-primary d-block w-100">Done</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- START POPUP MODEL -->
       
        <div class="modal fade" id="PublicBookTourPopUp" tabindex="-1" aria-labelledby="BookTourPopUpLabel"
            aria-hidden="true">    
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="d-flex justify-content-end">
                            <div class="flex-grow-1 d-flex align-items-center">
                                <!-- Bootstrap Close Button -->
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>                        
                        <div id="viewerContainerMain">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END POPUP MODEL -->
    </section>
@endsection
@section('scripts')
    <script>
        jQuery(document).ready(function($) {
            $('.booktour').on('click', function(e) {
                e.preventDefault();

                var selected_style = jQuery(this).data('style');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                if(selected_style){
                    $.ajax({
                        url: '{{ route('branding.gen.pdf') }}',
                        type: 'POST',
                        data: {
                            style        : selected_style,
                            contarctorId : "{{ $contractor->id ?? '' }}",
                        },
                        beforeSend: function() {
                            $('#viewerContainerMain').html('<div class="loader-box"><div class="spinner-border mx-2" role="status" style="width: 20px; height: 20px;"><span class="visually-hidden">Loading...</span></div><span>Loading...</span></div>');
                        },
                        success: function(data) {
                            $('#viewerContainerMain').html('');
                            var pdfUrl = data.pdf_url
                            var viewerUrl = '{{route('branding.viewer')}}?file=' + encodeURIComponent(pdfUrl);
                            $('#viewerContainerMain').html('<iframe width="100%" height="600px" src="' + viewerUrl + '"></iframe>');
                        },error: function(xhr, status, error) {
                            $('#viewerContainerMain').html('');
                            $('#viewerContainerMain').html('<div class="loader-box text-denger"><span class="text-danger">'+error+'</span></div>');
                        },
                    });
                }else{
                    alert('something is wrong');
                }
            });
        });
    </script>
@endsection