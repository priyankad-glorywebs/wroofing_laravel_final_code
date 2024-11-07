@extends('layouts.front.master')
@section('title', 'Design Studio')
@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<link rel="stylesheet" href="{{ asset('frontend-assets/css/custom.css?v=time()') }}" type="text/css">
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
</style>
@endsection
@section('content')
<!-- Add Plyr styles and script -->
<?php
if (isset($projectId)) {
    $data = \App\Models\Project::where('id', $projectId)->first();
}

if (isset($project_id)) {
    $projectName = \App\Models\Project::where('id', base64_decode($project_id))->select('title', 'credit')->first();
}
?>
<div class="breadcrumb-title-wrap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('general.info', ['project_id' => $project_id]) }}"><svg width="5" height="9"
                                viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
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
        <div class="row d-lg-none mt-4">
            <div class="col-12">
            </div>
        </div>
        <div class="row breadcrumb-title">
            <div class="col-12 col-lg-12">
                <div class="breadcrumb-addproject-step-1">
                    <div class="section-title">{{$projectName->title ?? ''}}</div>
                    <div class="row">
                        <div class="col-md-8">
                            @if(isset($projectName->credit))
                                @if($projectName->credit > 0)
                                    <div class="col-12 mb-3 text-center d-md-none">
                                        <span class="total-credit"> Total Credit : {{$projectName->credit ?? ''}}</span>
                                    </div>
                                @endif
                            @endif
                            <div class="mt-3">
                                <a class="btn-gallery-filter"
                                    href="{{ route('general.info', ['project_id' => $project_id]) }}">General Info</a>
                                <a class="btn-gallery-filter project-list-item-link active"
                                    href="{{ route('design.studio', ['project_id' => $project_id]) }}">Design studio</a>
                                <a class="btn-gallery-filter btn-gallery-filter project-list-item-link"
                                    href="{{ route('documentation', ['project_id' => $project_id]) }}">Documents</a>
                                <a class="btn-gallery-filter project-list-item-link"
                                    href="{{ route('contractor.list', ['project_id' => $project_id]) }}">Contractor
                                    Portal</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if(isset($projectName->credit))
                                @if($projectName->credit > 0)
                                    <div class="col-12 mb-3 text-end d-none d-md-block">
                                        <span class="total-credit"> Total Credit : {{$projectName->credit ?? ''}}</span>
                                    </div>
                                @endif
                            @endif
                            <div class="step-count">
                                <div class="step-count-title">Step 2 out of 3</div>
                                @php
                                    $progress_bar_score = 00;
                                    $progress_bar_color = 'red';
                                    if (function_exists('get_progress_bar_score')) {
                                        $progress_bar_score = get_progress_bar_score(base64_decode($project_id));
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
                                        {{ $progress_bar_score }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-2 text-end">
            </div>
        </div>
    </div>
</div>
<section class="studio-stepform-sec">
    <div class="container">
        <?php

$currentMonth = \Carbon\Carbon::now()->month;
$currentYear = \Carbon\Carbon::now()->year;

$projectImageData = \App\Models\ProjectImagesData::where('project_id', base64_decode($project_id))
    ->whereMonth('date', $currentMonth)
    ->whereYear('date', $currentYear)
    ->orderBy('date', 'desc')
    ->get();

$groupedData = $projectImageData->groupBy('date');
// dd($groupedData);
// $projectImageData = \App\Models\ProjectImagesData::where('project_id', base64_decode($project_id))->orderBy('date', 'desc')->get();
// $groupedData = $projectImageData->groupBy('date');
            ?>
        <div class="row">
            <div class="col-12">
                <form id="filterForm" action="" method="get">
                    @csrf
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <label for="design-filter">From Date:</label>
                            <input type="text" id="design-filter_todate" name="design-filter" placeholder="Select Date"
                                required>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <label for="design-filter">To Date:</label>
                            <input type="text" id="design-filter_fromdate" name="design-filter"
                                placeholder="Select Date" required>
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <br />
                            <input type="button" class="btn-primary" value="Filter" id="dsfilterButton">
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <br />
                            <input type="button" class="btn-primary" value="Reset Filter" id="dsresetFilterButton">
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <br>
                            <a class="btn-primary" id="designstudio" href="#">
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
                {{-- @if ($groupedData->count() > 0) --}}
                <div class="studio-stepform-wrap" id="testData">
                    @if ($groupedData && $groupedData->isEmpty() != true)
                            @foreach ($groupedData as $date => $mediaItems)
                                    @if(isset($mediaItems[0]['project_image']) && $mediaItems[0]['project_image'] != null)
                                        <h6 class="display_date">{{ \Carbon\Carbon::parse($date)->format('m-d-Y') }}</h6>
                                    @endif
                                    @foreach ($mediaItems as $mediaItem)
                                            @if ($mediaItem->media_type == 'image')
                                                    @php 
                                                         if (Auth::user('user')->id == $mediaItem->created_by) {
                                                            $color = "design-studio-with-customer";
                                                        } else {
                                                            $color = "";
                                                        }
                                                    @endphp
                                                    <div class="design-studio-img-items  {{$color ?? ''}} img-wrapper  gallery_container" style="">
                                                        @if (Auth::user('user')->id == $mediaItem->created_by)
                                                            <button type="button" class="remove-img" data-media-item-id="{{ $mediaItem->id }}">X</button>
                                                        @endif
                                                        <a class="lightbox" href="{{ asset('storage/project_images/' . $mediaItem->project_image) }}">
                                                            <img class="inner-img"
                                                                src="{{ asset('storage/project_images/' . $mediaItem->project_image) }}" alt="Image">
                                                        </a>
                                                        <span class="image-upload-time">{{ $mediaItem->time }}</span>
                                                    </div>
                                            @elseif($mediaItem->media_type == 'video')
                                            @php 
                                            if (Auth::user('user')->id == $mediaItem->created_by) {
                                               $color = "design-studio-with-customer";
                                           } else {
                                               $color = "";
                                           }
                                       @endphp
                                                <div class="design-studio-img-items  {{$color ?? ''}} video-container">
                                                    <button type="button" class="remove-img" data-media-item-id="{{ $mediaItem->id }}">X</button>
                                                    <a class="image-gallery-popup video_model "
                                                        href="{{ asset('storage/project_images/' . $mediaItem->project_image) }}">
                                                        <video width="150" height="150" controls>
                                                            <source src="{{ asset('storage/project_images/' . $mediaItem->project_image) }}"
                                                                type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    </a>
                                                    <span class="image-upload-time">{{ $mediaItem->time }}</span>
                                                </div>
                                            @endif
                                            <!-- </div> -->
                                    @endforeach
                            @endforeach
                    @else
                        <p class="p-not-found"><strong style="color:black">No Data Found</strong></p>
                    @endif
                </div>
                {{-- @endif --}}
                @if ($groupedData->count() > 0)
                    <div class="col-12" class="submitbtn">
                        <div class="submit-continue-btn mt-4 text-center">
                            <a href="{{ URL::to('documentation/' . $project_id) }}" class="btn btn-primary">Submit and
                                Continue
                            </a>
                        </div>
                        
                    </div>
                    <div class="backto-login text-center mt-4">
                        <a href="{{ route('general.info', ['project_id' => $project_id]) }}"><svg width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.13654 8L1.25522 5.11869C0.914945 4.77841 0.914945 4.22159 1.25522 3.88131L4.13654 1" stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg> Back
                        </a>
                    </div>
                @else
                    <div class="col-12" class="submitbtn">
                        <div class="submit-continue-btn mt-4 text-center">
                            <a class="btn btn-primary d-none" id="submit-continue-btn"
                                href="{{ URL::to('documentation/' . $project_id) }}" class="btn btn-primary">
                                Submit and Continue
                            </a>
                        </div>
                        
                    </div>
                    <div class="backto-login text-center mt-4">
                        <a href="{{ route('general.info', ['project_id' => $project_id]) }}"><svg width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.13654 8L1.25522 5.11869C0.914945 4.77841 0.914945 4.22159 1.25522 3.88131L4.13654 1" stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg> Back
                        </a>
                    </div>
                @endif
            </div>
</section>
<!-- Quote Modal -->
<div class="modal fade sendquotepopup" id="designstudio-popup" data-bs-backdrop="static" data-bs-keyboard="false"
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
                <form method="post" enctype="multipart/form-data" id="image-upload" class="dropzone">
                    <!-- Other form fields... -->
                    <div class="row">
                        <div class="form-group col-12 col-md-12">
                            <input type="hidden" name="project_id" value="{{ $project_id }}" id="project_id">
                            @csrf
                        </div>
                    </div>
                </form>
                <span id="error-message" style="color: red;"></span>
                <div id="uploaded-images">
                    <?php
$projectData = \App\Models\Project::findOrFail(base64_decode($project_id));
$imageArray = json_decode($projectData->project_image, true);
                        ?>
                </div>
                <!-- Other form fields... -->
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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

    Dropzone.autoDiscover = false;
    $(document).ready(function () {
        var project_id = $('#project_id').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        // Initialize Dropzone
        var dropzone = new Dropzone('#image-upload', {
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
                loadExistingImages(this);
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

        $('#designstudio').on("click", function () {
            $('#designstudio-popup').modal("show");
            dropzone.removeAllFiles();
            $('#error-message').text("");
        });

        $('#submit-all').on("click",function () {
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
                url: "{{ route('design.studio.post', ['project_id' => '__project_id__']) }}"
                    .replace('__project_id__', project_id),
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                   // console.log(response);
                    var project_id = response.project_id;
                    $('#designstudio-popup').modal('hide');
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

        function loadExistingImages(dropzoneInstance) {
            var existingImages = <?php echo json_encode($imageArray); ?> || [];
            if (existingImages.length > 0) {
                for (var i = 0; i < existingImages.length; i++) {
                    var file = {
                        name: existingImages[i],
                        size: 12345,
                        accepted: true,
                        kind: 'image',
                        dataURL: "{{ asset('storage/project_images/') }}" + '/' + existingImages[i]
                    };
                    dropzoneInstance.emit('addedfile', file);
                    $('.dz-progress').addClass('d-none');
                    dropzoneInstance.emit('thumbnail', file, "{{ asset('storage/project_images/') }}" + '/' +
                        existingImages[i]);
                }
            }
        }

        function removeImageFromServer(fileName) {
            $.ajax({
                type: 'POST',
                url: "{{ route('remove.image') }}",
                data: {
                    file_name: fileName,
                    project_id: project_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    //alert("remove");
                    // console.log(response); 
                },
                error: function (error) {
                    // console.log(error); 
                }
            });
        }

        $('.remove-img').on('click', function (e) {
            e.preventDefault();
            var project_id = $('#project_id').val();
            var file = $(this).data('media-item-id');
            console.log(file);
            // currentButton = $(this);
            // var isConfirmed = confirm('Are you sure you want to remove this file ?');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
    $.ajax({
                    url: "{{ route('delete.image.designstudio', ['project_id' => ':project_id', 'file' => ':file']) }}"
                        .replace(':project_id', project_id)
                        .replace(':file', file),
                    type: 'post',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        // alert(response.groupedData_count)
                        if (response.count == 0 || response.customer_count === 0 || response.groupedData_count == 1 ) {
                            window.location.reload();
                        }

                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                        // if(){
                        //     currentButton.closest('.display_date').remove();
                        // }
                         

                        var file = $(this).closest('media-item-id');
                        currentButton.closest('.design-studio-img-items').remove();
                    },
                    error: function (error) {
                        console.error('Error deleting file:', error);
                    }
                });
   
  }
});
           
        });

        $('#design-filter_todate').datepicker({
            dateFormat: 'mm-dd-yy',
            onSelect: function (dateText, inst) { }
        });

        $('#design-filter_fromdate').datepicker({
            dateFormat: 'mm-dd-yy',
            onSelect: function (dateText, inst) { }
        });

        $('#dsfilterButton').on('click', function (e) {
            e.preventDefault();
            var project_id = $('#project_id').val();
            var designfilter_todate = $('#design-filter_todate').datepicker('getDate');
            var designfilter_fromdate = $('#design-filter_fromdate').datepicker('getDate');
            designfilter_todate = $.datepicker.formatDate('mm-dd-yy', designfilter_todate);
            designfilter_fromdate = $.datepicker.formatDate('mm-dd-yy', designfilter_fromdate);
            $.ajax({
                url: "{{ route('design.studio', ['project_id' => $project_id]) }}",
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

        const filterButton = document.getElementById('dsfilterButton');
        $('#dsresetFilterButton').on('click', function () {
            var currentDate = new Date();
            var monthStart = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
            var formattedMonthStart = (monthStart.getMonth() + 1 < 10 ? '0' : '') + (monthStart.getMonth() + 1) + '-' + (monthStart.getDate() < 10 ? '0' : '') + monthStart.getDate() + '-' + monthStart.getFullYear();
            var lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
            var lastDayOfMonth = lastDay.getDate();
            var formattedEndOfMonth = (lastDay.getMonth() + 1 < 10 ? '0' : '') + (lastDay.getMonth() + 1) + '-' + (lastDayOfMonth < 10 ? '0' : '') + lastDayOfMonth + '-' + lastDay.getFullYear();
            $('#design-filter_todate').val(formattedMonthStart);
            $('#design-filter_fromdate').val(formattedEndOfMonth);

            filterButton.click();

            $('#design-filter_todate').val('');
            $('#design-filter_fromdate').val('');
        });
    });

    var dateFormat = "mm-dd-yy";
    var dates = $("#design-filter_todate, #design-filter_fromdate").datepicker({
        dateFormat: dateFormat,
        onSelect: function (selectedDate) {
            var option = this.id == "design-filter_fromdate" ? "minDate" : "maxDate",
                instance = $(this).data("datepicker"),
                date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
            if (this.id === "design-filter_todate") {
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


    
    document.getElementById('design-filter_todate').setAttribute('placeholder', formattedFirstDay);

    $('#design-filter_todate').val(formattedFirstDay);
    // document.getElementById('design-filter_todate').text(formattedLastDay);
    document.getElementById('design-filter_fromdate').setAttribute('placeholder', formattedLastDay);
    $('#design-filter_fromdate').val(formattedLastDay);

    // document.getElementById('design-filter_fromdate').text(formattedLastDay);

</script>

<script src="https://cdn.plyr.io/3.6.4/plyr.js"></script>
@endsection