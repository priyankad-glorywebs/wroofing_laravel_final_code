@extends('layouts.front.master')
@section('title', 'Contractor Portfolio')
@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<link rel="stylesheet" href="{{ asset('frontend-assets/css/custom.css') }}" type="text/css">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="https://cdn.plyr.io/3.6.4/plyr.css" />
<style>
    p.p-not-found strong {
        margin-left: -146px;
    }

    p.p-not-found {
        margin: 0px;
        line-height: 0;
    }

    p.notes-pop {
        margin: 0;
        font-size: 14px;
        color: #fff;
    }

    #filterForm a#contractorportfolio {
        margin: 20px 0px 0px 0px !important;
    }
</style>
@endsection
@section('content')
{{-- <h1>Contractor Portfolio</h1> --}}
<div class="breadcrumb-title-wrap">
    <div class="container">
        <div class="row breadcrumb-title">
            <div class="col-lg-7">
                <div class="section-title">Contractor Portfolio</div>
            </div>
        </div>
    </div>
</div>

<section class="studio-stepform-sec">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form id="filterForm" action="" method="get">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label for="design-filter">From Date:</label>
                            <input type="text" id="portfolio_todate" name="design-filter" placeholder="Select Date"
                                required>
                        </div>
                        <div class="col-md-3">
                            <label for="design-filter">To Date:</label>
                            <input type="text" id="portfolio_fromdate" name="design-filter" placeholder="Select Date"
                                required>
                        </div>
                        <div class="col-md-2">
                            <br />
                            <input type="button" class="btn-primary" value="Filter" id="portfolio_filterButton">
                        </div>
                        <div class="col-md-2">
                            <br />
                            <input type="button" class="btn-primary" value="Reset Filter"
                                id="portfolio_resetFilterButton">
                        </div>
                        <div class="col-md-2 text-sm-end">
                            <a class="btn-primary" id="contractorportfolio" href="#">
                                <img class="btn-normal-icon"
                                    src="{{ asset('frontend-assets/images/upload_photos.webp') }}"
                                    style="width:30px;" />
                                <img class="btn-hover-icon"
                                    src="{{ asset('frontend-assets/images/upload_photos-ezgif.gif') }}"
                                    style="width:30px;">
                                Add</a>
                            <br />
                        </div>
                    </div>
                    <br />
                </form>
                <div>
                </div>


                <div class="studio-stepform-wrap" id="testData">
                    @if (isset($groupedData) && $groupedData->isEmpty() != true)
                        @foreach ($groupedData as $date => $mediaItems)
                            <h6>{{ \Carbon\Carbon::parse($date)->format('m-d-Y') }}</h6>
                            @foreach ($mediaItems as $mediaItem)
                                @if ($mediaItem->media_type == 'image')
                                    <div class="design-studio-img-items gallery_container">
                                        {{-- @if (Auth::user('user')->id == $mediaItem->created_by) --}}
                                        <button type="button" class="remove-img" data-media-item-id="{{ $mediaItem->id }}">X</button>
                                        {{-- @endif --}}
                                        <a class="lightbox" href="{{ asset('storage/' . $mediaItem->image) }}">
                                            <img src="{{ asset('storage/' . $mediaItem->image) }}" alt="Image">
                                        </a>
                                        <span class="image-upload-time">{{ $mediaItem->time }}</span>
                                    </div>
                                @elseif($mediaItem->media_type == 'video')
                                    <div class="design-studio-img-items video-container">
                                        <button type="button" class="remove-img" data-media-item-id="{{ $mediaItem->id }}">X</button>
                                        <a class="image-gallery-popup video_model " href="{{ asset('storage/' . $mediaItem->image) }}">
                                            <video width="150" height="150" controls>
                                                <source src="{{ asset('storage/' . $mediaItem->image) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </a>
                                        <span class="image-upload-time">{{ $mediaItem->time }}</span>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    @else
                        <p class="p-not-found"><strong style="color:black">No Data Found</strong></p>
                    @endif
                </div>
            </div>
</section>

<!-- Quote Modal -->
<div class="modal fade sendquotepopup" id="portfolio-popup" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabeltitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title" id="staticBackdropLabeltitle">Design Studio
                    <p class="notes-pop">(You can upload up to 5 files at a time)</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" id="portfolio_image_upload" class="dropzone">
                    <div class="row">
                        <div class="form-group col-12 col-md-12">
                            <input type="hidden" name="project_id" value="{{ $project_id ?? '' }}" id="project_id">
                            @csrf
                        </div>
                    </div>
                </form>
                <span id="error-message" style="color: red;"></span>
                <div id="uploaded-images">
                    <?php
// $projectData = \App\Models\Project::findOrFail(base64_decode($project_id));
// $imageArray = json_decode($projectData->project_image, true);
                    ?>
                </div>
                <div class="row justify-content-center mt-4">
                    <div class="form-group button-wrap col-md-5 mb-0">
                        <div class="field-wrap text-center">
                            <button type="submit" align="center" id="submit-all"
                                class="btn btn-primary btn-studio-step-1">Submit and continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
    Dropzone.autoDiscover = false;

    jQuery(document).ready(function ($) {
        // Define App Namespace
        var popup = {
            // Initializer
            init: function () {
                popup.popupVideo();
            },
            popupVideo: function () {
                $('.video_model').magnificPopup({
                    type: 'iframe',
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: false,
                    fixedContentPos: false,
                    gallery: {
                        enabled: true
                    }
                });
                /* Image Popup*/
                $('.gallery_container').magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: false,
                    fixedContentPos: false,
                    gallery: {
                        enabled: true
                    }
                });
            }
        };
        popup.init($);
    });

    $(document).ready(function () {
        // var project_id = $('#project_id').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        // Initialize Dropzone
        var dropzone = new Dropzone('#portfolio_image_upload', {
            thumbnailWidth: 200,
            url: "{{ route('test') }}",
            maxFilesize: 50,
            // createImageThumbnails:true,
            addRemoveLinks: true,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.mp4",
            dictRemoveFile: "Remove file",
            // uploadMultiple: true,
            chunking: true,
            chunkSize: 2000000,
            parallelChunkUploads: true,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            init: function () {
                //loadExistingImages(this);
                this.on("removedfile", function (file) {
                    var fileName = file.name;
                    removeImageFromServer(fileName);
                });
                this.on('error', function(file, message) {
                    if (file.size > (50 * 1024 * 1024)) { // 50MB in bytes
                        alert("File is too large! The maximum allowed size is 50MB.");
                        this.removeFile(file); // Optionally remove the file from Dropzone
                    }
                });
            }
        });

        $('#contractorportfolio').on("click", function () {
            $('#portfolio-popup').modal("show");
            dropzone.removeAllFiles();
            $('#error-message').text("");
        });

        $('#submit-all').click(function () {
            var files = dropzone.getAcceptedFiles();
            if (files.length === 0) {
                displayErrorMessage("Please select at least one image before submitting.");
                return;
            }
            if (files.length > 5) {
                displayErrorMessage("You can upload a maximum of 5 images.");
                return;
            }
            showLoader();
            var formData = new FormData();
            for (var i = 0; i < files.length; i++) {
                formData.append('file[]', files[i]);
            }
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                type: 'POST',
                url: "{{ route('contractor.portfolio.post')}}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $('#portfolio-popup').modal('hide');
                    $('#testData').html(response.designstudio);
                    $('#submit-continue-btn').removeClass('d-none');
                    dropzone.removeAllFiles();
                    hideLoader();
                    $('#error-message').text("")
                },
                error: function (error) {
                    hideLoader();
                    displayErrorMessage("Error uploading image. Please try again.");
                }
            });
        });

        function displayErrorMessage(message) {
            $('#error-message').text(message);
        }

        function showLoader() {
            $('#submit-all').text('Uploading...');
        }

        function hideLoader() {
            $('#submit-all').text('Submit and continue');
        }



        function removeImageFromServer(file) {
            $.ajax({
                type: 'POST',
                url: "{{ route('delete.image.contractor.portfolio', ['file' => ':file'])}}"
                    .replace(':file', file),

                data: {
                    file: file,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                },
                error: function (error) {
                }
            });
        }

        $('.remove-img').on('click', function (e) {
            e.preventDefault();
            var file = $(this).data('media-item-id');
            console.log(file);
            currentButton = $(this);
            var isConfirmed = confirm('Are you sure you want to remove this file ?');
            if (isConfirmed) {
                $.ajax({
                    url: "{{ route('delete.image.contractor.portfolio', ['file' => ':file'])}}"
                        .replace(':file', file),
                    type: 'post',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.count == 0) {
                            window.location.reload();
                        }
                        var file = $(this).closest('media-item-id');
                        currentButton.closest('.design-studio-img-items').remove();
                    },
                    error: function (error) {
                        console.error('Error deleting file:', error);
                    }
                });
            }
        });

        $('#portfolio_todate').datepicker({
            dateFormat: 'mm-dd-yy',
            onSelect: function (dateText, inst) { }
        });

        $('#portfolio_fromdate').datepicker({
            dateFormat: 'mm-dd-yy',
            onSelect: function (dateText, inst) { }
        });

        $('#portfolio_filterButton').on('click', function (e) {
            e.preventDefault();
            // alert("in");
            // var project_id = $('#project_id').val();
            var designfilter_todate = $('#portfolio_todate').datepicker('getDate');
            var designfilter_fromdate = $('#portfolio_fromdate').datepicker('getDate');
            designfilter_todate = $.datepicker.formatDate('mm-dd-yy', designfilter_todate);
            designfilter_fromdate = $.datepicker.formatDate('mm-dd-yy', designfilter_fromdate);
            $.ajax({
                url: "{{route('contractor.portfolio') }}",
                type: 'GET',
                data: {
                    designfilter_todate: designfilter_todate,
                    designfilter_fromdate: designfilter_fromdate
                },
                success: function (data) {
                    $('#testData').html(data.filterdata);
                },
                error: function (xhr, status, error) { }
            });
        });

        const filterButton = document.getElementById('portfolio_filterButton');
        $('#portfolio_resetFilterButton').on('click', function () {
            var currentDate = new Date();
            var monthStart = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
            var formattedMonthStart = (monthStart.getMonth() + 1 < 10 ? '0' : '') + (monthStart.getMonth() + 1) + '-' + (monthStart.getDate() < 10 ? '0' : '') + monthStart.getDate() + '-' + monthStart.getFullYear();
            var lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
            var lastDayOfMonth = lastDay.getDate();
            var formattedEndOfMonth = (lastDay.getMonth() + 1 < 10 ? '0' : '') + (lastDay.getMonth() + 1) + '-' + (lastDayOfMonth < 10 ? '0' : '') + lastDayOfMonth + '-' + lastDay.getFullYear();
            $('#portfolio_todate').val(formattedMonthStart);
            $('#portfolio_fromdate').val(formattedEndOfMonth);

            filterButton.click();

            $('#portfolio_todate').val('');
            $('#portfolio_fromdate').val('');
        });
    });

    var dateFormat = "mm-dd-yy";
    var dates = $("#portfolio_todate, #portfolio_fromdate").datepicker({
        dateFormat: dateFormat,
        onSelect: function (selectedDate) {
            var option = this.id == "portfolio_fromdate" ? "minDate" : "maxDate",
                instance = $(this).data("datepicker"),
                date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
            if (this.id === "portfolio_todate") {
                option = "minDate";
            } else {
                option = null;
            }
            dates.not(this).datepicker("option", option, date);
        },
        onChangeMonthYear: function (year, month, instance) {
            $(this).datepicker('setDate', new Date(year, month - 1, 1));
        }
    });

    var currentDate = new Date();
    var firstDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
    var lastDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
    var formattedFirstDay = ((firstDayOfMonth.getMonth() + 1) < 10 ? '0' : '') + (firstDayOfMonth.getMonth() + 1) + '-' + (firstDayOfMonth.getDate() < 10 ? '0' : '') + firstDayOfMonth.getDate() + '-' + firstDayOfMonth.getFullYear();
    var formattedLastDay = ((lastDayOfMonth.getMonth() + 1) < 10 ? '0' : '') + (lastDayOfMonth.getMonth() + 1) + '-' + (lastDayOfMonth.getDate() < 10 ? '0' : '') + lastDayOfMonth.getDate() + '-' + lastDayOfMonth.getFullYear();

    document.getElementById('portfolio_todate').setAttribute('placeholder', formattedFirstDay);
    document.getElementById('portfolio_fromdate').setAttribute('placeholder', formattedLastDay);
</script>

<script src="https://cdn.plyr.io/3.6.4/plyr.js"></script>

@endsection