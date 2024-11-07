@extends('layouts.front.master')
@section('title', 'Contractor List')
@section('css')
<link rel="stylesheet" href="{{ asset('frontend-assets/css/custom.css') }}" type="text/css">

<style>
    #requested-btn {
        color: '#ED8105' !important,
            backgroundColor: '#FFF9F2' !important,
            border: '1px solid #FFF9F2' !important
    }

    .rejected-status {
        background: #FFF9F2;
        font-size: 13px;
        font-weight: 700;
        color: #F14336;
        padding: 3px 6px;
        border-radius: 5px;
        display: inline-block;
    }

    .approved-status {
        background: #D9F1D6;
        font-size: 13px;
        font-weight: 700;
        color: #53B746;
        padding: 3px 6px;
        border-radius: 5px;
        display: inline-block;
    }
</style>
<script>
    function callfundata(obj) {
        var noimg = '{{ asset('frontend-assets/images/defaultimage.jpg') }}';
        obj.src = noimg;
    }
</script>
@endsection

@section('content')
    <div class="breadcrumb-title-wrap pb-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ol class="breadcrumb m-0">
                    @php
                        if (isset($project_id)) {
                            $projectName = \App\Models\Project::where('id', base64_decode($project_id))
                                ->select('title', 'credit')
                                ->first();
                        }
                    @endphp

                    <li class="breadcrumb-item"><a
                            href="{{ route('documentation', ['project_id' => $project_id]) }}"><svg width="5" height="9"
                                viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4.13654 8L1.25522 5.11869C0.914945 4.77841 0.914945 4.22159 1.25522 3.88131L4.13654 1"
                                    stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg> Back</a></li>
                </ol>
                <div class="section-title"> {{ $projectName->title ?? '' }}</div>
                <div class="row align-items-center">
                    <div class="col-md-8">
                        
                    @if(isset($projectName->credit))
                    @if($projectName->credit > 0)
                        <div class="col-md-4">
                            <div class="col-12 mb-3 text-center d-md-none">
                                <span class="total-credit"> Total Credit : {{$projectName->credit ?? ''}}</span>
                            </div>
                        </div>
                    @endif
                      @endif
                        <div class="mt-3">
                            <a class="btn-gallery-filter project-list-item-link"
                                href="{{ route('general.info', ['project_id' => $project_id]) }}">General Info</a>
                            <a class="btn-gallery-filter project-list-item-link"
                                href="{{ route('design.studio', ['project_id' => $project_id]) }}">Design studio</a>
                            <a class="btn-gallery-filter project-list-item-link"
                                href="{{ route('documentation', ['project_id' => $project_id]) }}">Documents</a>
                            <a id="contractor_portal_tab" class="btn-gallery-filter project-list-item-link active"
                                href="{{ route('contractor.list', ['project_id' => $project_id]) }}">Contractor
                                Portal</a>
                        </div>
                    </div>

                    @if(isset($projectName->credit))
                        @if($projectName->credit > 0)
                            <div class="col-md-4">
                                <div class="col-12 mb-3 text-end d-none d-md-block">
                                    <span class="total-credit"> Total Credit : {{$projectName->credit ?? ''}}</span>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        {{--
    </div> --}}
    {{-- <div class="row d-lg-none mt-4">
        <div class="col-12">
        </div>
    </div> --}}
    <div class="row breadcrumb-title">
        <div class="col-12 col-lg-7">
            <div class="breadcrumb-addproject-title-wrap breadcrumb-addproject-step-3">
                <div class="section-title">Documentation</div>

                <div class="section-subtitle d-none d-lg-block">Please upload all below documents</div>
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
    <div class="row mt-3">
        <div class="col-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="contractor-list-tab" data-bs-toggle="tab"
                        data-bs-target="#contractor-list-tab-pane" type="button" role="tab"
                        aria-controls="contractor-list-tab-pane" aria-selected="true">Contractor list</button>
                </li>
                <li id="checkquotes" class="nav-item @if ($quotations->isEmpty()) {{ 'd-none' }} @endif"
                    role="presentation">
                    <button class="nav-link" id="view-quotes-tab" data-bs-toggle="tab"
                        data-bs-target="#view-quotes-tab-pane" type="button" role="tab"
                        aria-controls="view-quotes-tab-pane" aria-selected="false">View quotes</button>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>




<div class="breadcrumb-title-wrap d-none">
    <div class="container">
        <div class="row d-lg-none mt-4">
            <div class="col-12">
                <div class="signin-notes">Request a quote</div>
            </div>
        </div>
        <div class="row breadcrumb-title">
            <div class="col-12 col-lg-8">
            </div>

            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="contractor-list-tab" data-bs-toggle="tab"
                                data-bs-target="#contractor-list-tab-pane" type="button" role="tab"
                                aria-controls="contractor-list-tab-pane" aria-selected="true">Contractor list</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="view-quotes-tab" data-bs-toggle="tab"
                                data-bs-target="#view-quotes-tab-pane" type="button" role="tab"
                                aria-controls="view-quotes-tab-pane" aria-selected="false">View quotes</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="contractor-sec">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="contractor-list-tab-pane" role="tabpanel"
                        aria-labelledby="contractor-list-tab" tabindex="0">
                        <div class="row">
                            <!--contractor list  -->
                            <div class="tab-pane fade show active" id="contractor-list-tab-pane" role="tabpanel"
                                aria-labelledby="contractor-list-tab" tabindex="0">

                                <div class="row">
                                    <div class="col-12">

                                        <form id="contractorListFilter"
                                            action="{{ route('contractor.list', ['project_id' => $project_id ?? '']) }}"
                                            method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 col-lg-4">
                                                    <label for="design-filter">Search:</label>
                                                    <input type="text" id="contractor_search"
                                                        value="{{ old('contractor_search') }}" name="contractor_search"
                                                        placeholder="Search" required>
                                                </div>
                                                <div class="col-md-3 col-lg-2">
                                                    <br />
                                                    <input type="button" class="btn-primary" value="Filter"
                                                        id="contractorfilterButton">
                                                </div>
                                                <div class="col-md-3 col-lg-2">
                                                    <br />
                                                    <input type="button" class="btn-primary" value="Reset Filter"
                                                        id="contractorresetFilterButton">
                                                </div>
                                            </div>
                                            <br />
                                        </form>


                                    </div>
                                </div>
                                <div class="row" id="contractorList-container">
                                    @include('layouts.front.contractor-lists', [
    'contractorList' => $contractorList,
])
                                </div>
                            </div>
                            <!--end contractor list  -->
                        </div>
                    </div>
                    <!-- view quote data start -->
                    <div class="tab-pane fade" id="view-quotes-tab-pane" role="tabpanel"
                        aria-labelledby="view-quotes-tab" tabindex="0">
                        <div class="row">
                            <div class="col-12">
                                <div class="btn-gallery-filter-wrap">
                                    <button class="btn-gallery-filter active" data-category="all">All</button>
                                    <button class="btn-gallery-filter" data-category="approved">Approved</button>
                                    <button class="btn-gallery-filter" data-category="Requested">Requested</button>
                                    <button class="btn-gallery-filter" data-category="Responded">Responded</button>

                                    <button class="btn-gallery-filter" data-category="rejected">Rejected</button>
                                </div>
                            </div>
                        </div>
                        <div class="row viewquotation">

                            @if (isset($quotations))
                                                    @foreach ($quotations as $quotation)
                                                                                                                                                                                        @php
                                                                                                                                                                                            $contractor = \App\Models\Contractor::where(
                                                                                                                                                                                                'id',
                                                                                                                                                                                                $quotation->contractor_id,
                                                                                                                                                                                            )->first();
                                                                                                                                                                                        @endphp
                                                                            <div class="col-12 col-md-6 col-lg-4 item" data-category="{{ $quotation->status ?? '' }}">
                                                                                <div class="contractor-list-item">
                                                                                    <div class="contractor-detail-wrap">
                                                                                        <div class="accordion" id="accordionExample{{ $quotation->id ?? '' }}">
                                                                                            <div class="accordion-item">
                                                                                                <div class="		-header" id="heading{{ $quotation->id ?? '' }}">
                                                                                                    <button class="accordion-button" type="button"
                                                                                                        data-bs-toggle="collapse"
                                                                                                        data-bs-target="#collapse{{ $quotation->id ?? '' }}"
                                                                                                        aria-expanded="true"
                                                                                                        aria-controls="collapse{{ $quotation->id ?? '' }}">
                                                                                                        <div class="contractor-detail-title-wrap d-flex">
                                                                                                            <div class="contractor-title-img">
                                                                                                                {{-- @if (isset($contractor->profile_image))
                                                                                                                <img src="{{asset($contractor->profile_image)}}"
                                                                                                                    onerror="this.onerror=null;callfundata(this);"
                                                                                                                    alt="contractor-img" width="55" height="">
                                                                                                                @else
                                                                                                                <img src="{{asset('frontend-assets/images/Ellipse 15.svg')}}"
                                                                                                                    alt="contractor-img" width="55" height="">
                                                                                                                @endif --}}
                                                                                                                @if (isset($contractor->profile_image) && imageExists($contractor->profile_image))
                                                                                                                    <img src="{{ asset($contractor->profile_image) }}"
                                                                                                                        onerror="this.onerror=null;this.src='{{ asset('frontend-assets/images/Ellipse 15.svg') }}';"
                                                                                                                        alt="contractor-img" width="55" height="">
                                                                                                                @else



                                                                                                                    <img src="{{ asset('frontend-assets/images/Ellipse 15.svg') }}"
                                                                                                                        alt="contractor-img" width="55" height="">
                                                                                                                @endif



                                                                                                            </div>
                                                                                                            <div class="contractor-title-main">
                                                                                                                <div class="contractor-title">
                                                                                                                    {{ $contractor->name ?? '' }}’s Roofing
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </button>
                                                                                                </div>
                                                                                                <div id="collapse{{ $quotation->id ?? '' }}"
                                                                                                    class="accordion-collapse collapse show"
                                                                                                    aria-labelledby="headingOne-{{ $quotation->id ?? '' }}"
                                                                                                    data-bs-parent="#accordionExample{{ $quotation->id ?? '' }}">
                                                                                                    <div class="accordion-body">

                                                                                                        <input type="hidden" name="project_details_id"
                                                                                                            id="project_details_id"
                                                                                                            value="{{$quotation->project_id ?? ''}}">

                                                                                                        <input type="hidden" name="project_details_user_id"
                                                                                                            id="project_details_user_id"
                                                                                                            value="{{$contractor['id'] ?? ''}}">

                                                                                                        <div class="quotes-detail">


                                                                                                            @if(isset($contractor['contact_number']))
                                                                                                            <div
                                                                                                                class="quotes-detail-item d-flex align-items-center justify-content-between">
                                                                                                                <div class="quotes-detail-item-title">Call:
                                                                                                                </div>
                                                                                                                <div class="quotes-detail-item-content">
                                                                                                                    {{ $contractor['contact_number'] ?? '' }}
                                                                                                                </div>

                                                                                                            </div>
                                                                                                            @endif
                                                                                                            @if(isset($contractor['email']))
                                                                                                            <div
                                                                                                                class="quotes-detail-item d-flex align-items-center justify-content-between">
                                                                                                                <div class="quotes-detail-item-title">Email:
                                                                                                                </div>
                                                                                                                <div class="quotes-detail-item-content">{{ $contractor['email'] ?? '' }}
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            @endif
                                                                                                            <div
                                                                                                                class="quotes-detail-item d-flex align-items-center justify-content-between">
                                                                                                                <div class="quotes-detail-item-title">Date:
                                                                                                                </div>
                                                                                                                <div class="quotes-detail-item-content">
                                                                                                                    {{ \Carbon\Carbon::parse($quotation->created_at ?? '')->format('d M Y, D') }}
                                                                                                                </div>
                                                                                                            </div>

                                                                                                            <div
                                                                                                                class="quotes-detail-item d-flex align-items-center justify-content-between">
                                                                                                                <div class="quotes-detail-item-title">Status:
                                                                                                                </div>
                                                                                                                @if ($quotation->status == 'Requested')
                                                                                                                    <div class="quotes-detail-item-content">
                                                                                                                        {{ $quotation->status ?? '' }}
                                                                                                                    </div>
                                                                                                                @elseif($quotation->status == 'approved')
                                                                                                                                                                                                                                            <div><span
                                                                                                                            class="approved-status">{{ $quotation->status ?? '' }}</span>
                                                                                                                    </div>
                                                                                                                @elseif($quotation->status == 'Responded')
                                                                                                                                                                                                                                            <div><span
                                                                                                                            class="approved-status">{{ $quotation->status ?? '' }}</span>
                                                                                                                    </div>
                                                                                                                @elseif($quotation->status == 'rejected')
                                                                                                                                                                                                                                            <div><span
                                                                                                                            class="rejected-status">{{ $quotation->status ?? '' }}</span>
                                                                                                                    </div>
                                                                                                                @endif



                                                                                                            </div>

                                                                                                            @php
                                                                                                                $messageCount = \App\Models\Message::where('project_id', $quotation->project_id)
                                                                                                                    ->where('role', 'contractor')
                                                                                                                    ->where('contractor_id', $contractor['id'])
                                                                                                                    ->where('is_read', 0)
                                                                                                                    ->get()
                                                                                                                    ->count();
                                                                                                            @endphp
                                                                                                            <div class="quotes-request-btn-wrap"
                                                                                                                style="text-align:right;font-size:14px">
                                                                                                                <span class="position-relative"
                                                                                                                    id="chat-now-{{$contractor['id'] ?? ''}}">
                                                                                                                    <a
                                                                                                                        href="{{URL('contractor/chat-board/' . base64_encode($quotation->project_id) . '/' . base64_encode($contractor['id']))}}">
                                                                                                                        <span class="position-relative">
                                                                                                                            <img class="chat-icon"
                                                                                                                                src="{{asset('frontend-assets/images/chat_icon.svg')}}">
                                                                                                                            @if($messageCount > 0)
                                                                                                                                <span class="chat-notification"
                                                                                                                                    id="chat-notification-customerside-projectdetails-{{$contractor['id'] ?? ''}}">{{ $messageCount }}</span>
                                                                                                                            @endif



                                                                                                                        </span>
                                                                                                                        Chat now
                                                                                                                    </a>
                                                                                                                </span>
                                                                                                            </div>

                                                                                                            <div class="quotes-request-btn-wrap">
                                                                                                                @if ($quotation->status == 'Requested')
                                                                                                                    <a class="btn-primary d-block btn-requested"
                                                                                                                        disabled>Requested for quote</a>
                                                                                                                @elseif($quotation->status == 'Responded')
                                                                                                                                                                                                                                <a class="btn-primary d-block btn-approved"
                                                                                                                    href="{{ route('view.quote', ['quote_id' => base64_encode($quotation->id)]) }}">View
                                                                                                                    quote</a>
                                                                                                                @elseif($quotation->status == 'approved')
                                                                                                                                                                                                                                <a class="btn-primary d-block btn-approved"
                                                                                                                    href="{{ route('view.quote', ['quote_id' => base64_encode($quotation->id)]) }}">View
                                                                                                                    quote</a>
                                                                                                                @elseif($quotation->status == 'rejected')
                                                                                                                                                                                                                                <a class="btn-primary d-block btn-rejected"
                                                                                                                    disbaled>Rejected quote</a>
                                                                                                                @endif



                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                    @endforeach
                            @endif



                        </div>
                    </div>
                    <!-- end view quote -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade gallerypopup" id="gallerypopup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title" id="staticBackdropLabel">Work gallery </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>


            <div class="modal-body">
                <div class="contractor-title-detail d-sm-flex">

                </div>
                <div class="gallery-wrap">
                    <div class="btn-gallery-filter-wrap">
                        <button class="btn-gallery-filter active" data-category="all">All</button>
                        <button class="btn-gallery-filter" data-category="images">Images</button>
                        <button class="btn-gallery-filter" data-category="video">Video</button>
                    </div>

                    <div class="display-gallery-portfolio">
                        @include('layouts.front.projects.gallery-portfolio', [
    'portfolio' => $portfolio ?? '',
])
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterButton = document.getElementById('contractorfilterButton');
        if (filterButton) {
            filterButton.click();
        }
    });



    $(document).ready(function () {
        $(document).on('click','.contractor-img-icon',function () {
            var contractor_id = $(this).attr('data-id');
            $('#gallerypopup').modal('show');

            $('#gallerypopup').find('#c_id').val(contractor_id);

            $.ajax({
                url: '{{ route('contractor.list', ['project_id' => $project_id]) }}',
                method: 'GET',
                data: {
                    c_id: contractor_id
                },
                success: function (response) {
                    $('.display-gallery-portfolio').html(response);
                },
                error: function (xhr) {
                    console.log('Error:', xhr);
                }
            });
        });
    });
</script>

<script>
    jQuery(document).ready(function () {
        jQuery('#view-quotes-tab-pane').find('.btn-gallery-filter').on('click', function () {
            jQuery('#contractor_portal_tab').addClass('active');
        });
    });

    function callfuncontractor(obj) {
        var noimg = '{{ asset('frontend-assets/images/contractor-1.png') }}';
        obj.src = noimg;
    }

    // $('.request-quote-btn').click(function () {
    //     alert("sdfsfs");
    // });

    $(document).one("click",".request-quote-btn",function(e) {
        // alert("in");
        var upadtestatus = $(this);
        e.preventDefault();
        var project_id = $('#project_id').val();
        var contractor_id = $(this).attr("data-id");
        var clickedButton = $(this);

        var checkquotes = $('#checkquotes').hasClass('d-none');
        if (checkquotes == true) {
            $('#checkquotes').removeClass('d-none');
        }


        $.ajax({
            url: "{{ route('send.quote.contractor') }}",
            type: 'post',
            data: {
                _token: '{{ csrf_token() }}',
                project_id: project_id,
                contractor_id: contractor_id
            },
            success: function (response) {
                if (response.success) {
                    // alert(response.status);
                    $(upadtestatus).closest(".quotes-detail").find('#quote_status').html("");
                    $(upadtestatus).closest(".quotes-detail").find('#quote_status').append(response
                        .status);

                    $('.viewquotation').html("");
                    $('.viewquotation').html(response.html);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                    });
                }
                clickedButton.addClass('disabled').css({
                    color: '#ED8105',
                    backgroundColor: '#FFF9F2',
                    border: '1px solid #FFF9F2'
                });
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });



    });
</script>
<script type="text/javascript">
    // $('#contractorfilterButton').click(function () {
    //     var search = $('#contractor_search').val();
    //     var project_id = $('#project_id').val();

    //     $.ajax({
    //         url: "{{-- route('contractor.list', ['project_id' => $project_id]) --}}",
    //         method: 'POST',
    //         data: {
    //             _token: "{{ csrf_token() }}",
    //             contractor_search: search
    //         },
    //         success: function (response) {
    //             // $('#contractorList-container').val("");
    //             $('#contractorList-container').html(response.html);

    //             $(document).on('click', '.pagination a', function (event) {
    //                 event.preventDefault();
    //                 var url = $(this).attr('href');
    //                 $.get(url, function (response) {
    //                     // $('#contractorList-container').html("");

    //                     $('#contractorList-container').html(response.html);
    //                     $('html, body').animate({
    //                         scrollTop: $('#contractorList-container')
    //                             .offset().top
    //                     }, 'slow');
    //                 });
    //             });
    //         }
    //     });
    // });

    // $('#contractorresetFilterButton').click(function () {
    //     $('#contractor_search').val('');
    //     var project_id = $('#project_id').val();

    //     $.ajax({
    //         url: "{{-- route('contractor.list', ['project_id' => $project_id]) --}}",
    //         method: 'POST',
    //         data: {
    //             _token: "{{ csrf_token() }}"
    //         },
    //         success: function (response) {
    //             $('#contractorList-container').html(response.html);
    //         }
    //     });
    // });
</script>
@endsection