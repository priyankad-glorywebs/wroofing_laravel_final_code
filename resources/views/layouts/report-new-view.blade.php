@extends('layouts.front.master')
@section('title', 'Report')
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ asset('frontend-assets/css/report.css') }}" type="text/css">

<style type="text/css">
.pos_num {
        display: inline-block;
        padding: 2px 5px;
        height: 20px;
        line-height: 17px;
        background: rgb(6, 160, 65);
        color: #fff;
        text-align: center;
        border-radius: 5px;
        position: absolute;
        left: -5px;
        top: 18px;
    }

    .ui-state-highlight {
        padding: 20px;
        background-color: #eaecec;
        border: 1px dotted #ccc;
        cursor: move;
        margin-top: 12px;
    }
    .removeBtn{
        cursor: pointer;
    }

    
    /*==================================================
                Model Popup CSS
     ==================================================*/
            #PublicBookTourPopUp-report .modal-dialog {
            max-width: 100% !important;
            margin: 0px;
            padding: 0px;
        }
        #PublicBookTourPopUp-report .modal-dialog .modal-body {
            padding: 0 0 !important;
            overflow: hidden !important;
            border-radius: 5px !important;
            position: relative !important;
        }
        #PublicBookTourPopUp-report .modal-dialog .modal-body .btn-close {
            position: absolute !important;
            right: 15px;
            top: 15px !important;
        }
        #PublicBookTourPopUp-report .modal-dialog .modal-body .btn-sendmail {
            position: absolute !important;
            right: 65px;
            top: 15px !important;
            border: 1px solid #e1e8ed!important;
            padding: 6px;
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

        .pdf-report-model span.msg-success {
            position: absolute !important;
            right: 215px;
            top: 15px !important;
            padding: 6px;
            display: inline;
            font-size: 12px;
            font-weight: 600;
        }
        #senquoteBox .loader-box {
            margin: 0px !important;
        }
        /* Target devices with a max width of 480px (mobile) */
        @media only screen and (min-width: 380px) and (max-width: 580px) {
            /* Your CSS styles for tablets go here */
            span#senquoteBox {
                font-size: 10px;
                margin-left: 20px;
                line-height: 1;
            }

        }
    </style>
@section('content')
    <div class="breadcrumb-title-wrap">
        <div class="container">
            <div class="row d-lg-none mt-4">
                <div class="col-12">
                    <div class="signin-notes">Home / Report</div>
                </div>
            </div>
            <div class="row breadcrumb-title">
                <div class="col-12">
                    <div class="section-title lh-1 mb-3">Quotation</div>
                    <div class="row">
                        <div class="col-5">
                            <h5>{{ $report->title }}</h5>
                            {{-- <span>Contractor ID: {{ $report->contractor_id }}</span>
                            <span>Project ID: {{ $report->project_id }}</span>
                            <span>Report Id : {{ $report->id }}</span> --}}
                            <input type="hidden" name="report_id" id="report_id" value="{{ $report->id }}">
                        </div>

                        @php
                        $preview = \App\Models\ReportSection::where('report_id', '=', $report->id)->get();
                        // dd($preview);
                        foreach ($preview as $key => $value) {
                            if($value->content !== '') {
                                $display = true;
                            }else{
                                $display = false;
                            }
                        }
                        @endphp
                        @if($display == true)
                        <div class="col-7 text-end">
                            <a class="booktourReport btn-primary" data-style="2" href="javascript:void(0)" data-bs-toggle="modal"
                            data-bs-target="#PublicBookTourPopUp-report"  data-report-id="{{ $report->id }}"
                            data-src="{{ asset('report_style/style-2.pdf') }}">Preview</a>
                            {{-- <button id="generate-pdf" class="btn btn-primary" data-report-id="{{ $report->id }}">View PDF</button> --}}
                               {{-- <button id="generate-pdf" class="btn btn-primary">View PDF</button> --}}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

<section class="studio-stepform-sec">
        <div class="container">
         <div class="row">
                @php
                    $sections = \DB::table('report_sections')
                        ->join('section_types', 'report_sections.section_type_id', '=', 'section_types.id')
                        ->where('report_sections.report_id', $report->id)
                        ->orderBy('report_sections.order', 'asc')
                        ->select('report_sections.*', 'section_types.name')
                        ->get();
                    $reportId = $report->id;



            $reportData = \App\Models\Report::where('id', $reportId)->first();
            $data = \App\Models\Project::where('id',$reportData['project_id'])->first();
            $customerName = \App\Models\User::find($data['user_id']);

                @endphp
                <input type="hidden" name="user_id" id="user_id" value="{{$customerName['id']??''}}" />
                {{-- Display a draggable menu  --}}
                <div class="col-md-3">
                    <x-draggable-menu :sections="$sections" :reportId="$reportId" />
                </div>
                {{-- End  Display a draggable menu  --}}
                <div class="col-md-9">
                    <div class="tab-content" id="pills-tabContent">
                        @foreach ($sections as $index => $section)
                            <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                                id="pills-{{ $section->name }}" role="tabpanel"
                                aria-labelledby="pills-{{ $section->name }}-tab">

                                @if ($section->name == 'Title')
                                @if (isset($sectionContents[$section->id]))
                                @php
                                    $content = $sectionContents[$section->id];
                                @endphp
                                @endif
                                    {{-- title section component --}}
                                    <x-report-title-section :section="$section" :content="$sectionContents[$section->id] ?? []" />
                                    {{-- End title section compoenet  --}}

                                 @elseif($section->name === 'Introduction')
                                    @if (isset($sectionContents[$section->id]))
                                        @php
                                            $content = $sectionContents[$section->id];
                                        @endphp
                                    @endif

                                    <x-introduction-section :content="$sectionContents[$section->id] ?? []" :section="$section" :tokens="[
                                            // $salesPersonToken => 'SALES PERSON NAME',
                                            // $accountNameToken => 'ACCOUNT NAME',
                                            // $salesPersonFirstNameToken => 'SALES PERSON FIRST NAME',
                                            // $salesPersonLastName => 'SALES PERSON LAST NAME',
                                            $salesPersonFullName => 'SALES PERSON FULL NAME',
                                            // $salesPersonTitle => 'SALES PERSON TITLE',
                                            $salesPersonPhone => 'SALES PERSON PHONE',
                                            $salesPersonEmail => 'SALES PERSON EMAIL',
                                            // $customerFirstName => 'CUSTOMER FIRST NAME',
                                            // $customerLastName => 'CUSTOMER LAST NAME',
                                            $customerFullName => 'CUSTOMER FULL NAME',
                                            // $customerAddress => 'CUSTOMER ADDRESS',
                                            $companyNameToken => 'COMPANY NAME'
                                        ]" />

                                   
                                @elseif($section->name === 'QuoteDetails')
                                    @if (isset($sectionContents[$section->id]))
                                        @php
                                            $content = $sectionContents[$section->id];
                                        @endphp
                                    @endif
                                   @php
                                    @endphp
                            <x-quotation-section  :section="$section" :content="$sectionContents[$section->id] ?? []" />
                          @elseif($section->name == 'InspectionPage')

                          @if (isset($sectionContents[$section->id]))
                          @php
                              $content = $sectionContents[$section->id];
                              $contentData = null;
                              if(isset($content['content'])){
                                  $contentData = $content['content'];
                              }

                              $imagesData = null;
                              if(isset($imagesData)){
                                $imagesData = $content['images'];
                              }
                          @endphp
                      @endif
                          <x-inspection-section :section="$section" :content="$sectionContents[$section->id] ?? []" />

                                @elseif($section->name === 'InspectionPage47638673')
                                                    {{-- Inspection page  --}}

                                        @if (isset($sectionContents[$section->id]))
                                            @php
                                                $content = $sectionContents[$section->id];
                                                $contentData = $content['content'];

                                                $imagesData = $content['images'];
                                            @endphp
                                        @endif
                                        <div class="row">
                                            <i class="far ml-2 fa-trash-alt pointer"
                                                style="color:red;cursor:pointer;text-align:right" aria-hidden="true"></i>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="row mt-3">
                                                <label class="form-label" for="inspection_title">Inspection</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter Inspection Title" value="{{ $content['title'] ?? '' }}"
                                                    name="inspection_title" id="inspectionTitle">
                                            </div>

                                            <hr class="mt-4">
                                            <div class="row mt-4">
                                                    <div class="form-group col-6">
                                                        @if (isset($imagesData) && !empty($imagesData))
                                                            @foreach ($imagesData as $image)
                                                                <div class="form-element">
                                                                    <div class="upload-img-wrap">
                                                                        <input id="uploadimage" type="file"
                                                                            name="inspection_image"
                                                                            accept="image/jpg, image/jpeg, image/png">
                                                                        <label for="uploadimage">
                                                                            @if (isset($image) && !empty($image))
                                                                                <img src="{{ asset($image) }}"
                                                                                    id="image-container" alt="Uploaded Image"
                                                                                    width="100" height="100">
                                                                            @else
                                                                                <div class="upload-img-icon">
                                                                                    <img src="{{ asset('frontend-assets/images/img-icon.svg') }}"
                                                                                        alt="img-icon" width="30"
                                                                                        height="30">
                                                                                </div>
                                                                                <div class="upload-img-text">Upload your picture</div>
                                                                                <div class="upload-img-formate">(PNG or JPEG file accepted)</div>
                                                                            @endif
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div class="form-element">
                                                                <div class="upload-img-wrap">
                                                                    <input id="uploadimage" type="file"
                                                                        name="inspection_image"
                                                                        accept="image/jpg, image/jpeg, image/png">
                                                                    <label for="uploadimage">
                                                                        @if (isset($content['image']) && !empty($content['image']))
                                                                            <img src="{{ asset($content['image']) }}"
                                                                                id="image-container" alt="Uploaded Image"
                                                                                width="100" height="100">
                                                                        @else
                                                                            <div class="upload-img-icon">
                                                                                <img src="{{ asset('frontend-assets/images/img-icon.svg') }}"
                                                                                    alt="img-icon" width="30" height="30">
                                                                            </div>
                                                                            <div class="upload-img-text">Upload your picture</div>
                                                                            <div class="upload-img-formate">(PNG or JPEG file
                                                                                accepted)</div>
                                                                        @endif
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        {{-- @foreach ($imagesData as $image) --}}

                                                        {{-- @if (isset($content['image']) && !empty($content['image'])) --}}
                                                        <div class="pl-3 mt-3">{{-- <i class="fas fa-edit"></i> --}}
                                                            <i class="fa-solid fa-trash pl-5" id="delete-image-btn"></i></button>
                                                        </div>
                                                        {{-- @endforeach --}}
                                                    </div>


                                                    @if (isset($contentData) && !empty($contentData))
                                                        @foreach ($contentData as $key => $content)
                                                            <div class="form-group col-5">
                                                                <div class="form-element">
                                                                    <textarea id="default" id="{{ $key }}">{!! $content ?? '' !!}</textarea>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        {{-- <textarea id="default"></textarea> --}}
                                                    @endif

                                                    <input type="button" id="callsaveData" name="callsaveData"
                                                        class="btn btn-primary" value="saveData" />
                                                <div class="form-group col-1">
                                                    <i class="far ml-2 fa-trash-alt pointer" value=""
                                                        style="color:red;cursor:pointer" aria-hidden="true"></i>
                                                </div>
                                            </div>


                            <div id="container"></div>

                            <div class="row col-md-3 mt-3 mb-3">
                                <input type="button" class="btn btn-primary btn-sm" id="addItemInspection"
                                    value="Add Item">
                            </div>
                            <hr>
                            {{-- <div class="row col-md-3 mt-3">
                                <input type="button" class="btn btn-primary btn-sm" id="addSection" value="Add Section">
                                </div> --}}
                            </div>
                                @elseif($section->name === 'TermsandConditions')
                                @if (isset($sectionContents[$section->id]))
                                @php
                                    $content = $sectionContents[$section->id];
                                @endphp
                                @endif
                                {{-- term and condition  --}}
                                <x-term-and-condition-section  :section="$section" :content="$sectionContents[$section->id] ?? []"/>
                                 {{-- End term and condition  --}}
                                @elseif($section->name == 'Warranty')
                                    @if (isset($sectionContents[$section->id]))
                                        @php
                                            $content = $sectionContents[$section->id];
                                            //  dd($content);
                                        @endphp
                                    @endif
                                        {{-- Warranty page  --}}
                                        <x-warranty-component :section="$section" :sectionContents="$sectionContents" :customerDetails="$getCustomerDetails" />
                                         {{-- End Warranty page  --}}
                                @elseif($section->name == 'ThankYouPage')
                                @php
                                // dd($section);
                                @endphp 
                                @if (isset($sectionContents[$section->id]))
                                    @php
                                        $content = $sectionContents[$section->id];
                                    @endphp
                                @endif
                                    <x-thank-you-component  :section="$section"/>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="toast-message" class="toast fade" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Success</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Success message here
                </div>
            </div>
        </div>


          <!-- START POPUP MODEL -->
       
          <div class="modal fade" id="PublicBookTourPopUp-report" tabindex="-1" aria-labelledby="BookTourPopUpLabel"
          aria-hidden="true">    
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content pdf-report-model">
                  <div class="modal-body">
                      <div class="d-flex justify-content-end">
                          <div class="flex-grow-1 d-flex align-items-center">

                            <span class="msg-success" id="senquoteBox"></span>
                            <button class="btn-sendmail" style="font-size:15px" id="sendReport">Send Quotation <i class="fa fa-envelope"></i></button>
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

        
<!-- Modal HTML for displaying PDF -->
{{-- <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">PDF Preview</h5>
                <!-- Ensure that the button has the right classes and attributes -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Updated iframe to have proper dimensions -->
                <iframe id="pdfFrame" src="" width="100%" height="600px" style="border:none;"></iframe>
            </div>
            <div class="modal-footer">
                <!-- Modal footer with a Close button -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> --}}

@endsection

@section('scripts')
<script type="text/javascript">
    
            // document.getElementById('generate-pdf').addEventListener('click', function () {
            //     var reportId = this.getAttribute('data-report-id');
            //     var pdfUrl = '/generate-pdf/' + reportId;

            //     // Set the iframe source to load the PDF
            //     document.getElementById('pdfFrame').src = pdfUrl;

            //     // Show the modal
            //     $('#pdfModal').modal('show');
            // });

          document.addEventListener('DOMContentLoaded', function() {
            let sectionId = null;

            document.querySelectorAll('#pills-tab .nav-link').forEach(function(navLink) {
                navLink.addEventListener('click', function(event) {
                    event.preventDefault();
                    const navItem = navLink.closest('.nav-item');
                    const sectionIdInput = navItem.querySelector('#sectionId');
                    if (sectionIdInput) {
                        sectionId = sectionIdInput.value;
                        // console.log('Section ID:', sectionId);
                    } else {
                        // console.log('Section ID not found');
                    }
                });
            });
            $(document).ready(function() {
                //active deactivate the switch
                $('.switch-tabs').on("change", function() {
                    // alert('The switch');
                    var status = $(this).prop('checked') ? 'active' : 'deactive';
                    // alert('Status: ' + status);
                    var reportId = $('#report_id').val();
                    // console.log('Report ID:', reportId);

                    var sectionId = $(this).data(
                    'section-id'); // Get section_id from data attribute

                    console.log('Section ID:', sectionId);
                    $.ajax({
                        url: '{{ route('change.page.status') }}',
                        type: 'POST',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'section_type_id': sectionId,
                            'reportId': reportId,
                            'status': status
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#toast-message .toast-body').text('Saved !');
                                var toast = new bootstrap.Toast(document.getElementById(
                                    'toast-message'), {
                                    autohide: true,
                                    delay: 3000
                                });
                                toast.show();
                            }
                        },
                        error: function(xhr) {
                            alert('An error occurred while saving data');
                        }
                    });
                });
                //endactive deactivate the switch
            });



            // $('#switch-{{ $section->name }}').change(function() {
            //     var status = $(this).prop('checked') ? 'active' : 'deactive';
            //     var sectionId = $('#sectionId').val();
            //     var reportId = $('#reportId').val();
            //     alert(sectionId);
            //     $.ajax({
            //         url: '{{-- route('change.page.status') --}}',
            //         type: 'POST',
            //         data: {
            //             '_token': '{{ csrf_token() }}',
            //             'section_type_id': sectionId,
            //             'report_id': reportId,
            //             'status': status
            //         },
            //         success: function(response) {
            //             if (response.message === 'Status changed successfully') {
            //                 $('#toast-message .toast-body').text('Saved!');
            //                 var toast = new bootstrap.Toast(document.getElementById(
            //                     'toast-message'), {
            //                     autohide: true,
            //                     delay: 3000
            //                 });
            //                 toast.show();
            //             }
            //         },
            //         error: function(xhr) {
            //             alert('An error occurred while saving data');
            //         }
            //     });
            // });

        });
    </script>


     <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('.booktourReport').on('click', function(e) {
                e.preventDefault();
                var reportId = this.getAttribute('data-report-id');
                // console.log(reportId);


                // var selected_style = jQuery(this).data('style');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),

                    }
                });
                // if(selected_style){
                if(reportId){
                    $.ajax({
                        url: '{{ route('report-pdf-view') }}',
                        type: 'POST',
                        data: {
                            reportId:reportId,
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


            $('#sendReport').on('click', function(event) {
                event.preventDefault();
                var user_id = $('#user_id').val();
                var report_id = $('#report_id').val();
                // alert(user_id);

                // Make sure to replace the URL with your correct route
                $.ajax({
                    url: '{{route('send.report')}}', // Adjust the URL according to your routing
                    type: 'POST',
                    data: {
                        user_id: user_id,
                        report_id: report_id,
                        _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
                    },
                    beforeSend: function() {
                            $('#senquoteBox').html('<div class="loader-box"><div class="spinner-border mx-2" role="status" style="width: 20px; height: 20px;"><span class="visually-hidden">Loading...</span></div></div>');
                    },
                    success: function(response) {
                        $('#senquoteBox').html('');
                        $('#senquoteBox').html(response.message);
                        $('#senquoteBox').addClass('text-success');
                        setTimeout(function() {
                            $('#senquoteBox').html('');
                        }, 5000);
                    },
                    error: function(xhr) {
                        alert('Error sending report: ' + xhr.responseText);
                    }
                });
            });

        });
    </script>

@endsection
