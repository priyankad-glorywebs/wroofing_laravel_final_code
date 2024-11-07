@extends('layouts.front.master')
@section('title', 'Documentation')
@section('css')
<link rel="stylesheet" href="{{asset('frontend-assets/css/custom.css')}}" type="text/css">
@endsection
@section('content')
<div class="breadcrumb-title-wrap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ol class="breadcrumb m-0">
                    @php
                        $projectId = base64_encode($project_id);


                        if (isset($project_id)) {
                            $projectName = \App\Models\Project::where('id', $project_id)->select('title', 'credit')->first();

                        }
                    @endphp
                    <li class="breadcrumb-item"><a
                            href="{{ route('design.studio', ['project_id' => base64_encode($project_id)])}}"><svg
                                width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4.13654 8L1.25522 5.11869C0.914945 4.77841 0.914945 4.22159 1.25522 3.88131L4.13654 1"
                                    stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg> Back</a></li>
                </ol>
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
                            <a class="btn-gallery-filter project-list-item-link"
                                href="{{route('general.info', ['project_id' => base64_encode($project_id)])}}">General
                                Info</a>
                            <a class="btn-gallery-filter project-list-item-link"
                                href="{{ route('design.studio', ['project_id' => base64_encode($project_id)]) }}">Design
                                studio</a>
                            <a class="btn-gallery-filter project-list-item-link active"
                                href="{{route('documentation', ['project_id' => base64_encode($project_id)])}}">Documents</a>
                            <a class="btn-gallery-filter project-list-item-link"
                                href="{{route('contractor.list', ['project_id' => base64_encode($project_id)])}}">Contractor
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
                            <div class="step-count-title">Step 3 out of 3</div>
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
                                    style="width: {{$progress_bar_score}}%;background-color: {{$progress_bar_color}}"
                                    aria-valuenow="{{$progress_bar_score}}" aria-valuemin="0" aria-valuemax="100">
                                    {{$progress_bar_score}}%</div>
                            </div>
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
    </div>
</div>

<section class="studio-stepform-sec">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="studio-stepform-wrap">
                    <form id="documentform_step3" name="documentform_step3" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="project_id" id="project_id" value="{{$project_id}}" />
                        <div class="studio-step-3">
                            <div class="row">
                                <div class="form-group col-12 col-md-6 documents">
                                    <div class="field-wrap">
                                        <div class="form-element">
                                            <div class="upload-img-wrap">
                                                <input id="documents" type="file" name="documents[]"
                                                    accept="image/jpg, image/jpeg, image/png, image/heic, image/heif, application/pdf, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                                    multiple>
                                                <label for="documents">
                                                    <div class="inner-wrap">
                                                        @if(isset($documents) && $documents > 0)
                                                            <div class="uploaded-files">
                                                                @foreach($documents as $document)
                                                                                @if(isset($document['basename']))
                                                                                @php
                                                                                $document_basename = preg_replace('/^[^_]*_[^_]*_/', '', $document['basename']);
                                                                                @endphp
                                                                                    <div class="uploaded-file"
                                                                                        data-url="{{asset('project_documents_laststage/' . $document['basename'])}}">
                                                                                        <a href="#" class="remove-document">x</a>
                                                                                        <span class="name" data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="{{ $document_basename }}">
                                                                                            <img src="{{asset('frontend-assets/images/document.svg')}}"
                                                                                                alt="img-icon" width="30" height="30">
                                                                                        </span>
                                                                                    </div>
                                                                                    <input type="hidden" name="documents_hidden[]"
                                                                                        value="{{ $document['basename'] }}">
                                                                                @endif

                                                                @endforeach
                                                                    </div>
                                                        @else

                                                            <img class="mb-2"
                                                                src="{{ asset('frontend-assets/images/receive-square.svg') }}"
                                                                alt="img-icon" width="30" height="30">
                                                            <p class="m-0" style="color:black" class="doc">Your Documents
                                                            </p>
                                                        @endif

                                                    </div>
                                                    <div class="upload-img-formate">(Third party agreement, signed
                                                        contract, and warranty from manufacturer)</div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-12 col-md-6 insurancedocuments">
                                    <div class="field-wrap">
                                        <div class="form-element">

                                            <div class="upload-img-wrap">
                                                <input id="insurancedocuments" type="file" name="insurancedocuments[]"
                                                    accept="image/jpg, image/jpeg, image/png,image/heic, image/heif , application/pdf, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                                    multiple>
                                                <label for="insurancedocuments">
                                                    <div class="inner-wrap">
                                                        @if(isset($insurancedocuments))
                                                            <div class="uploaded-files">
                                                                @foreach($insurancedocuments as $insurancedocument)
                                                                                @if(isset($insurancedocument['basename']))
                                                                                @php
                                                                                    $insurance_document_basename = preg_replace('/^[^_]*_[^_]*_/', '', $insurancedocument['basename']);
                                                                                @endphp
                                                                                    <div class="uploaded-file"
                                                                                        data-url="{{asset('project_documents_laststage/' . $insurancedocument['basename'])}}">
                                                                                        <a href="#" class="remove-document">x</a>
                                                                                        <span class="name" data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="{{ $insurance_document_basename }}">
                                                                                            <img src="{{asset('frontend-assets/images/document.svg')}}"
                                                                                                alt="img-icon" width="30" height="30">
                                                                                        </span>
                                                                                    </div>
                                                                                    <input type="hidden" name="insurance_hidden[]"
                                                                                        value="{{ $insurancedocument['basename'] }}">
                                                                                @endif

                                                                @endforeach
                                                                    </div>
                                                        @else

                                                            <img class="mb-2"
                                                                src="{{ asset('frontend-assets/images/receive-square.svg') }}"
                                                                alt="img-icon" width="30" height="30">
                                                            <p class="m-0" style="color:black"> Insurance Documents </p>
                                                        @endif

                                                    </div>
                                                    <div class="upload-img-formate">(Insurance Scope, final invoice and
                                                        <br> completion doc)</div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-md-6 mortgagedocuments">
                                    <div class="field-wrap">
                                        <div class="form-element">
                                            <div class="upload-img-wrap">
                                                <input id="mortgagedocuments" type="file" name="mortgagedocuments[]"
                                                    accept="image/jpg, image/jpeg, image/png , image/heic, image/heif, application/pdf, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                                    multiple>
                                                <label for="mortgagedocuments">
                                                    <div class="inner-wrap">
                                                        @if(isset($mortgagedocuments))
                                                            <div class="uploaded-files">
                                                                @foreach($mortgagedocuments as $mortgagedocument)
                                                                                @if(isset($mortgagedocument['basename']))
                                                                                @php
                                                                                    $mortgage_document_basename = preg_replace('/^[^_]*_[^_]*_/', '', $mortgagedocument['basename']);
                                                                                @endphp
                                                                                    <div class="uploaded-file"
                                                                                        data-url="{{asset('project_documents_laststage/' . $mortgagedocument['basename'])}}">
                                                                                        <a href="#" class="remove-document">x</a>
                                                                                        <span class="name" data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="{{ $mortgage_document_basename }}">
                                                                                            <img src="{{asset('frontend-assets/images/document.svg')}}"
                                                                                                alt="img-icon" width="30" height="30">
                                                                                        </span>
                                                                                    </div>
                                                                                    <input type="hidden" name="mortgage_hidden[]"
                                                                                        value="{{ $mortgagedocument['basename'] }}">
                                                                                @endif

                                                                @endforeach
                                                                    </div>
                                                        @else

                                                            <img class="mb-2"
                                                                src="{{ asset('frontend-assets/images/receive-square.svg') }}"
                                                                alt="img-icon" width="30" height="30">
                                                            <p class="m-0" style="color:black"> Mortgage Documents </p>
                                                        @endif

                                                    </div>
                                                    <div class="upload-img-formate">(Loss Draft Package ready for HO to
                                                        sign)</div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12 col-md-6 contractordocuments">
                                    <div class="field-wrap">
                                        <div class="form-element">
                                            <div class="upload-img-wrap">
                                                <input id="contractordocuments" type="file" name="contractordocuments[]"
                                                    accept="image/jpg, image/jpeg, image/png , image/heic, image/heif, application/pdf, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                                    multiple>
                                                <label for="contractordocuments">
                                                    <div class="inner-wrap">
                                                        @if(isset($contractordocuments))
                                                            <div class="uploaded-files">
                                                                @foreach($contractordocuments as $contractordocument)
                                                                                @if(isset($contractordocument['basename']))
                                                                                @php
                                                                                    $contractor_document_basename = preg_replace('/^[^_]*_[^_]*_/', '', $contractordocument['basename']);
                                                                                @endphp
                                                                                    <div class="uploaded-file"
                                                                                        data-url="{{asset('project_documents_laststage/' . $contractordocument['basename'])}}">
                                                                                        <a href="#" class="remove-document">x</a>
                                                                                        <span class="name" data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="{{ $contractor_document_basename }}">
                                                                                            <img src="{{asset('frontend-assets/images/document.svg')}}"
                                                                                                alt="img-icon" width="30" height="30">
                                                                                        </span>
                                                                                    </div>
                                                                                    <input type="hidden" name="contractor_hidden[]"
                                                                                        value="{{ $contractordocument['basename'] }}">
                                                                                @endif

                                                                @endforeach
                                                                    </div>
                                                        @else

                                                            <img class="mb-2"
                                                                src="{{ asset('frontend-assets/images/receive-square.svg') }}"
                                                                alt="img-icon" width="30" height="30">
                                                            <p class="m-0" style="color:black"> Contractor Documents</p>
                                                        @endif

                                                    </div>
                                                    <div class="upload-img-formate">(Estimate and final invoice and
                                                        warranty)</div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group button-wrap col-md-12 mt-3">
                                    <div class="field-wrap text-center add-to-basket--button-wrap"
                                        data-js="add-to-basket--wrapper" data-state="ready">
                                        <button type="submit" class="btn btn-primary" data-add-to-basket="ready"
                                            name="button" data-js="add-to-basket">
                                            <span data-js="add-to-basket--inner-text">Get started now</span>
                                            <span class="add-to-basket--tick-animation">
                                                <svg width="24" height="24" class="add-to-basket--tick-icon"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 37 37">
                                                    <path class="circ path"
                                                        style="fill:none;stroke:#00ab49;stroke-width:3;stroke-linejoin:round;stroke-miterlimit:10;"
                                                        d="M30.5,6.5L30.5,6.5c6.6,6.6,6.6,17.4,0,24l0,0c-6.6,6.6-17.4,6.6-24,0l0,0c-6.6-6.6-6.6-17.4,0-24l0,0C13.1-0.2,23.9-0.2,30.5,6.5z">
                                                    </path>
                                                    <polyline class="tick path"
                                                        style="fill:none;stroke:#00ab49;stroke-width:3;stroke-linejoin:round;stroke-miterlimit:10;"
                                                        points="11.6,20 15.9,24.2 26.4,13.8 "></polyline>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <div class="backto-login text-center"><a
                                        href="{{ route('design.studio', ['project_id' => base64_encode($project_id)])}}"><svg
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
    </div>
</section>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @php $pid = base64_decode($projectId); @endphp
    <script>
    /* start jquery */
    $(document).ready(function () {
        // START FIRST BOX
        // document form documentform
        let selectedDocuments = [];
        let updatedDocuments = [];
        $('#documents').change(function (e) {
            /*remove error*/
            jQuery(document).find('.documents .upload-img-wrap').removeClass('field-error');
            const files = e.target.files;
            const maxSize = 51 * 1024 * 1024; // 50MB in bytes
            
            // Check file size for each selected file
            for (let i = 0; i < files.length; i++) {
                if (files[i].size > maxSize) {
                    alert("File " + files[i].name + " is too large! The maximum allowed size is 50MB.");
                    return; // Stop further execution if file exceeds size limit
                }
            }

            // Add selected files to the array
            for (let i = 0; i < files.length; i++) {
                selectedDocuments.push(files[i]);
            }
            const test = $(this).closest(".upload-img-wrap");
            // Remove any existing uploaded files display
            test.find(".uploaded-files").remove();
            // Display existing documents
            const existingDocuments = {!! json_encode($documents ?? '') !!}; // Get existing documents from Blade

            if (existingDocuments && existingDocuments.length > 0) {
                const $uploadedFilesDiv = $('<div class="uploaded-files"></div>');
                existingDocuments.forEach(function (document) {
                    if (document.basename) {
                        var doc_path = "{{asset('project_documents_laststage/')}}";
                        const $uploadedFile = $('<div class="uploaded-file" data-url="' + doc_path + '/' + document.basename + '"><a href="#" class="remove-document">X</a><span class="name" data-toggle="tooltip" data-placement="top" title="' + document.basename + '"><img src="{{asset('frontend-assets/images/document.svg')}}" alt="img-icon" width="30" height="30"></span></div>');
                        $uploadedFilesDiv.append($uploadedFile);
                        const $hiddenInput = $('<input type="hidden" name="documents_hidden[]" value="' + document.basename + '">');
                        $uploadedFilesDiv.append($hiddenInput);
                    }
                });
                test.find('.inner-wrap').append($uploadedFilesDiv);
            }
            // Remove any placeholder icons if files are uploaded
            if (files.length > 0) {
                test.find('.inner-wrap').find('img[src*="receive-square.svg"]').remove();
                test.find('.inner-wrap').find('br').remove(); // remove the line break
                test.find('.inner-wrap').find('p').remove();
            }
            // Display newly uploaded files
            for (let i = 0; i < files.length; i++) {
                const filename = files[i].name;
                const $iconDiv = $('<span class="uploaded-file"><a href="#" data-fileIndex="' + i + '" class="remove-document-newly">X</a><span class="name" data-bs-toggle="tooltip" data-bs-placement="top" data-type="' + files[i].type + '" title="' + filename + '"><img src="{{asset('frontend-assets/images/document.svg')}}" alt="img-icon" width="30" height="30"></span></span>');
                test.find(".inner-wrap").append($iconDiv);
            }
        });


        // Click event listener for removing a document
        $(document).find('#documentform_step3').on("click", ".documents .remove-document-newly", function (e) {
            const isConfirmednewlydoc = confirm('Are you sure you want to remove this document?');

            if (isConfirmednewlydoc) {

                e.preventDefault();
                const $uploadedFile = $(this).closest('.uploaded-file');
                const filename = $uploadedFile.find('.name').attr('title');
                const fileIndex = parseInt($(this).attr('data-fileindex'));
                updatedDocuments = removeSelectedDocuments(filename);
                $uploadedFile.remove();
                $(this).closest('.upload-img-wrap').find('input[type="hidden"][value="' + filename + '"]').remove();
            }
        });

        function removeSelectedDocuments(fileName) {
            selectedDocuments = selectedDocuments.filter(file => file.name !== fileName);
            return selectedDocuments;
        }
        // END FIRST BOX


        // START SECOND BOX
        let selectedInsurances = [];
        let updatedInsurances = [];
        $('#insurancedocuments').change(function (e) {
            /*remove error*/
            jQuery(document).find('.insurancedocuments .upload-img-wrap').removeClass('field-error');
            const files = e.target.files;
            const maxSize = 51 * 1024 * 1024; // 50MB in bytes
            
            // Check file size for each selected file
            for (let i = 0; i < files.length; i++) {
                if (files[i].size > maxSize) {
                    alert("File " + files[i].name + " is too large! The maximum allowed size is 50MB.");
                    return; // Stop further execution if file exceeds size limit
                }
            }

            // Add selected files to the array
            for (let i = 0; i < files.length; i++) {
                selectedInsurances.push(files[i]);
            }

            const test = $(this).closest(".upload-img-wrap");
            // Remove any existing uploaded files display
            test.find(".uploaded-files").remove();
            // Display existing documents
            const existingDocuments = {!! json_encode($insurancedocuments ?? '') !!}; // Get existing documents from Blade
            // console.log(existingDocuments);
            if (existingDocuments && existingDocuments.length > 0) {
                const $uploadedFilesDiv = $('<div class="uploaded-files"></div>');
                existingDocuments.forEach(function (document) {
                    if (document.basename) {
                        var doc_path = "{{asset('project_documents_laststage/')}}";
                        const $uploadedFile = $('<div class="uploaded-file" data-url="' + doc_path + '/' + document.basename + '"><a href="#" class="remove-document">X</a><span class="name" data-toggle="tooltip" data-placement="top" title="' + document.basename + '"><img src="{{asset('frontend-assets/images/document.svg')}}" alt="img-icon" width="30" height="30"></span></div>');
                        $uploadedFilesDiv.append($uploadedFile);
                        const $hiddenInput = $('<input type="hidden" name="insurance_hidden[]" value="' + document.basename + '">');
                        $uploadedFilesDiv.append($hiddenInput);
                    }
                });
                test.find('.inner-wrap').append($uploadedFilesDiv);
            }
            // Remove any placeholder icons if files are uploaded
            if (files.length > 0) {
                test.find('.inner-wrap').find('img[src*="receive-square.svg"]').remove();
                test.find('.inner-wrap').find('br').remove(); // remove the line break
                test.find('.inner-wrap').find('p').remove();
            }
            // Display newly uploaded files
            for (let i = 0; i < files.length; i++) {
                const filename = files[i].name;
                const $iconDiv = $('<span class="uploaded-file"><a href="#" data-fileIndex="' + i + '" class="remove-document-newly">X</a><span class="name" data-bs-toggle="tooltip" data-bs-placement="top" data-type="' + files[i].type + '" title="' + filename + '"><img src="{{asset('frontend-assets/images/document.svg')}}" alt="img-icon" width="30" height="30"></span></span>');
                test.find(".inner-wrap").append($iconDiv);
            }
        });

        // Click event listener for removing a document
        $(document).find('#documentform_step3').on("click", ".insurancedocuments .remove-document-newly", function (e) {
            e.preventDefault();
            const isConfirmednewlyinsurancedocuments = confirm('Are you sure you want to remove this document?');
            if (isConfirmednewlyinsurancedocuments) {
                const $uploadedFile = $(this).closest('.uploaded-file');
                const filename = $uploadedFile.find('.name').attr('title');
                const fileIndex = parseInt($(this).attr('data-fileindex'));
                updatedInsurances = removeSelectedInsurances(filename);
                $uploadedFile.remove();
                $(this).closest('.upload-img-wrap').find('input[type="hidden"][value="' + filename + '"]').remove();
            }
        });

        function removeSelectedInsurances(fileName) {
            selectedInsurances = selectedInsurances.filter(file => file.name !== fileName);
            return selectedInsurances;
        }
        // END SECOND BOX

        // START THIRD BOX
        let selectedMortgage = [];
        let updatedMortgage = [];
        $('#mortgagedocuments').change(function (e) {
            /*remove error*/
            jQuery(document).find('.mortgagedocuments .upload-img-wrap').removeClass('field-error');
            const files = e.target.files;
            const maxSize = 51 * 1024 * 1024; // 50MB in bytes
            
            // Check file size for each selected file
            for (let i = 0; i < files.length; i++) {
                if (files[i].size > maxSize) {
                    alert("File " + files[i].name + " is too large! The maximum allowed size is 50MB.");
                    return; // Stop further execution if file exceeds size limit
                }
            }
            // Add selected files to the array
            for (let i = 0; i < files.length; i++) {
                selectedMortgage.push(files[i]);
            }

            const test = $(this).closest(".upload-img-wrap");
            // Remove any existing uploaded files display
            test.find(".uploaded-files").remove();
            // Display existing documents
            const existingDocuments = {!! json_encode($mortgagedocuments ?? '') !!}; // Get existing documents from Blade
            // console.log(existingDocuments);
            if (existingDocuments && existingDocuments.length > 0) {
                const $uploadedFilesDiv = $('<div class="uploaded-files"></div>');
                existingDocuments.forEach(function (document) {
                    if (document.basename) {
                        var doc_path = "{{asset('project_documents_laststage/')}}";
                        const $uploadedFile = $('<div class="uploaded-file" data-url="' + doc_path + '/' + document.basename + '"><a href="#" class="remove-document">X</a><span class="name" data-toggle="tooltip" data-placement="top" title="' + document.basename + '"><img src="{{asset('frontend-assets/images/document.svg')}}" alt="img-icon" width="30" height="30"></span></div>');
                        $uploadedFilesDiv.append($uploadedFile);
                        const $hiddenInput = $('<input type="hidden" name="mortgage_hidden[]" value="' + document.basename + '">');
                        $uploadedFilesDiv.append($hiddenInput);
                    }
                });
                test.find('.inner-wrap').append($uploadedFilesDiv);
            }
            // Remove any placeholder icons if files are uploaded
            if (files.length > 0) {
                test.find('.inner-wrap').find('img[src*="receive-square.svg"]').remove();
                test.find('.inner-wrap').find('br').remove(); // remove the line break
                test.find('.inner-wrap').find('p').remove();
            }
            // Display newly uploaded files
            for (let i = 0; i < files.length; i++) {
                const filename = files[i].name;
                const $iconDiv = $('<span class="uploaded-file"><a href="#" data-fileIndex="' + i + '" class="remove-document-newly">X</a><span class="name" data-bs-toggle="tooltip" data-bs-placement="top" data-type="' + files[i].type + '" title="' + filename + '"><img src="{{asset('frontend-assets/images/document.svg')}}" alt="img-icon" width="30" height="30"></span></span>');
                test.find(".inner-wrap").append($iconDiv);
            }
        });

        // Click event listener for removing a document
        $(document).find('#documentform_step3').on("click", ".mortgagedocuments .remove-document-newly", function (e) {
            e.preventDefault();
            const isConfirmednewlymortgage = confirm('Are you sure you want to remove this document?');
            if (isConfirmednewlymortgage) {

                const $uploadedFile = $(this).closest('.uploaded-file');
                const filename = $uploadedFile.find('.name').attr('title');
                const fileIndex = parseInt($(this).attr('data-fileindex'));
                updatedMortgage = removeSelectedMortgage(filename);
                $uploadedFile.remove();
                $(this).closest('.upload-img-wrap').find('input[type="hidden"][value="' + filename + '"]').remove();
            }
        });

        function removeSelectedMortgage(fileName) {
            selectedMortgage = selectedMortgage.filter(file => file.name !== fileName);
            return selectedMortgage;
        }
        // END THIRD BOX

        // START FOURTH BOX
        let selectedContractor = [];
        let updatedContractor = [];
        $('#contractordocuments').change(function (e) {
            /*remove error*/
            jQuery(document).find('.contractordocuments .upload-img-wrap').removeClass('field-error');
            const files = e.target.files;
            const maxSize = 51 * 1024 * 1024; // 50MB in bytes
            
            // Check file size for each selected file
            for (let i = 0; i < files.length; i++) {
                if (files[i].size > maxSize) {
                    alert("File " + files[i].name + " is too large! The maximum allowed size is 50MB.");
                    return; // Stop further execution if file exceeds size limit
                }
            }
            
            // Add selected files to the array
            for (let i = 0; i < files.length; i++) {
                selectedContractor.push(files[i]);
            }

            const test = $(this).closest(".upload-img-wrap");
            // Remove any existing uploaded files display
            test.find(".uploaded-files").remove();
            // Display existing documents
            const existingDocuments = {!! json_encode($contractordocuments ?? '') !!}; // Get existing documents from Blade
            // console.log(existingDocuments);
            if (existingDocuments && existingDocuments.length > 0) {
                const $uploadedFilesDiv = $('<div class="uploaded-files"></div>');
                existingDocuments.forEach(function (document) {
                    if (document.basename) {
                        var doc_path = "{{asset('project_documents_laststage/')}}";
                        const $uploadedFile = $('<div class="uploaded-file" data-url="' + doc_path + '/' + document.basename + '"><a href="#" class="remove-document">X</a><span class="name" data-toggle="tooltip" data-placement="top" title="' + document.basename + '"><img src="{{asset('frontend-assets/images/document.svg')}}" alt="img-icon" width="30" height="30"></span></div>');
                        $uploadedFilesDiv.append($uploadedFile);
                        const $hiddenInput = $('<input type="hidden" name="contractor_hidden[]" value="' + document.basename + '">');
                        $uploadedFilesDiv.append($hiddenInput);
                    }
                });
                test.find('.inner-wrap').append($uploadedFilesDiv);
            }
            // Remove any placeholder icons if files are uploaded
            if (files.length > 0) {
                test.find('.inner-wrap').find('img[src*="receive-square.svg"]').remove();
                test.find('.inner-wrap').find('br').remove(); // remove the line break
                test.find('.inner-wrap').find('p').remove();
            }
            // Display newly uploaded files
            for (let i = 0; i < files.length; i++) {
                const filename = files[i].name;
                const $iconDiv = $('<span class="uploaded-file"><a href="#" data-fileIndex="' + i + '" class="remove-document-newly">X</a><span class="name" data-bs-toggle="tooltip" data-bs-placement="top" data-type="' + files[i].type + '" title="' + filename + '"><img src="{{asset('frontend-assets/images/document.svg')}}" alt="img-icon" width="30" height="30"></span></span>');
                test.find(".inner-wrap").append($iconDiv);
            }
        });

        // Click event listener for removing a document
        $(document).find('#documentform_step3').on("click", ".contractordocuments .remove-document-newly", function (e) {
            e.preventDefault();
            const isConfirmednewlycontractor = confirm('Are you sure you want to remove this document?');
            if (isConfirmednewlycontractor) {

                const $uploadedFile = $(this).closest('.uploaded-file');
                const filename = $uploadedFile.find('.name').attr('title');
                const fileIndex = parseInt($(this).attr('data-fileindex'));
                updatedContractor = removeSelectedContractor(filename);
                $uploadedFile.remove();
                $(this).closest('.upload-img-wrap').find('input[type="hidden"][value="' + filename + '"]').remove();
            }
        });

        function removeSelectedContractor(fileName) {
            selectedContractor = selectedContractor.filter(file => file.name !== fileName);
            return selectedContractor;
        }
        // END FOURTH BOX

        /* START FINAL SUBMIT BUTTON */
        $("#documentform_step3 button").click(function (e) {
            /* click after button disable */

            /* check alreay file selected */
            var form = $("#documentform_step3");
            form.validate({
                errorElement: 'span',
                errorClass: 'help-block',
                highlight: function (element) {
                    $(element).addClass("help-block");
                    $(element).parent().addClass("field-error");
                },
                unhighlight: function (element) {
                    $(element).removeClass("help-block");
                    $(element).parent().removeClass("field-error");
                },
                rules: {
                },
                submitHandler: function (form) {
                    var formData = new FormData(form);
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    /* documents file */
                    formData.delete('documents[]');
                    if (updatedDocuments.length != 0) {
                        updatedDocuments.forEach(file => {
                            formData.append('documents[]', file);
                        });
                    } else {
                        selectedDocuments.forEach(file => {
                            formData.append('documents[]', file);
                        });
                    }
                    /* insurance file */
                    formData.delete('insurancedocuments[]');
                    if (updatedInsurances.length != 0) {
                        updatedInsurances.forEach(file => {
                            formData.append('insurancedocuments[]', file);
                        });
                    } else {
                        selectedInsurances.forEach(file => {
                            formData.append('insurancedocuments[]', file);
                        });
                    }
                    /* mortgage documents file */
                    formData.delete('mortgagedocuments[]');
                    if (updatedMortgage.length != 0) {
                        updatedMortgage.forEach(file => {
                            formData.append('mortgagedocuments[]', file);
                        });
                    } else {
                        selectedMortgage.forEach(file => {
                            formData.append('mortgagedocuments[]', file);
                        });
                    }
                    /* contractor documents file */
                    formData.delete('contractordocuments[]');
                    if (updatedContractor.length != 0) {
                        updatedContractor.forEach(file => {
                            formData.append('contractordocuments[]', file);
                        });
                    } else {
                        selectedContractor.forEach(file => {
                            formData.append('contractordocuments[]', file);
                        });
                    }
                    /* START JQUERY VALIDATION */
                    let valid_status = true;
                    // if ($(document).find('.documents .inner-wrap .uploaded-files').find('.uploaded-file').length == 0) {
                    //     if ($(document).find('.documents .inner-wrap .uploaded-file').find('span').length < 1) {
                    //         jQuery(document).find('.documents .upload-img-wrap').addClass('field-error');
                    //         valid_status = false;
                    //     }
                    // }else{
                    //     jQuery(document).find('.documents .upload-img-wrap').removeClass('field-error');
                    // }

                    // if ($(document).find('.insurancedocuments .inner-wrap .uploaded-files').find('.uploaded-file').length == 0) {
                    //     if ($(document).find('.insurancedocuments .inner-wrap .uploaded-file').find('span').length < 1) {
                    //         jQuery(document).find('.insurancedocuments .upload-img-wrap').addClass('field-error');
                    //         valid_status = false;
                    //     }
                    // }else{
                    //     jQuery(document).find('.insurancedocuments .upload-img-wrap').removeClass('field-error');
                    // }

                    // if ($(document).find('.mortgagedocuments .inner-wrap .uploaded-files').find('.uploaded-file').length == 0) {
                    //     if ($(document).find('.mortgagedocuments .inner-wrap .uploaded-file').find('span').length < 1) {
                    //         jQuery(document).find('.mortgagedocuments .upload-img-wrap').addClass('field-error');
                    //         valid_status = false;
                    //     }
                    // }else{
                    //     jQuery(document).find('.mortgagedocuments .upload-img-wrap').removeClass('field-error');
                    // }

                    // if ($(document).find('.contractordocuments .inner-wrap .uploaded-files').find('.uploaded-file').length == 0) {
                    //     if ($(document).find('.contractordocuments .inner-wrap .uploaded-file').find('span').length < 1) {
                    //         jQuery(document).find('.contractordocuments .upload-img-wrap').addClass('field-error');
                    //         valid_status = false;
                    //     }
                    // }else{
                    //     jQuery(document).find('.contractordocuments .upload-img-wrap').removeClass('field-error');
                    // }
                    /* END JQUERY VALIDATION */
                    if (valid_status == true) {
                        $.ajax({
                            url: "{{ route('documentation.store', ['project_id' => $pid]) }}", // Replace $project_id with the actual project ID
                            type: "POST",
                            Accept: "application/json",
                            data: formData,
                            processData: false,
                            dataType: 'json',
                            contentType: false,
                            headers: {
                                'X-CSRF-Token': csrfToken // Include the CSRF token in the headers
                            },
                            beforeSend: function () {
                                jQuery(document).find('.add-to-basket--button-wrap').attr("data-state", "loading");
                                jQuery(document).find('.add-to-basket--button-wrap button').attr("data-add-to-basket", "loading");
                            },
                            success: function (response) {
                                jQuery(document).find('.add-to-basket--button-wrap').attr("data-state", "added");
                                jQuery(document).find('.add-to-basket--button-wrap button').attr("data-add-to-basket", "added");
                                if (response.status === true) {
                                    // Handle success, for example, show a message
                                    setTimeout(function () {
                                        // location.reload();
                                        // window.location.href = "{{ route('project.list') }}";
                                        window.location.href = "{{route('contractor.list', ['project_id' => $projectId])}}";
                                    }, 500); // 3000 milliseconds = 3 seconds
                                }
                            },
                            error: function (xhr, status, error) {
                                // Handle error
                                console.log(error);
                                alert('something is wrong');
                                //console.error(xhr.responseText);
                            }
                        });
                    }
                }
            });
        });
        /* END FINAL SUBMIT BUTTON */

        /* START DELETE FILE AJAX */
        jQuery(document).on('click', 'form .upload-img-wrap .remove-document', function (e) {
            e.stopPropagation(); // Prevent the event from bubbling up to the parent
            e.preventDefault();
            var link = $(this);
            var fileInput = link.closest('.upload-img-wrap').find('input[type="file"]');
            var hiddenInput = link.closest('.upload-img-wrap').find('input[type="hidden"]');
            var project_id = $('#project_id').val();
            // var isConfirmed = confirm('Are you sure you want to remove this document?');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this document!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {


            // if (isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: '{{route("remove.document")}}',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        file: hiddenInput.val(),
                        project_id: project_id,
                    },
                    success: function (response) {
                        fileInput.val('');
                        hiddenInput.val('');
                        location.reload();
                    },
                    error: function (error) {
                        console.error('Error removing document:', error);
                    }
                });
            }
        });
        });
        /* END DELETE FILE AJAX */
        /* end jquery */
        /* OPEN DOCUMENT NEW TAB */
        jQuery(document).on('click', '#documentform_step3 .inner-wrap .uploaded-files .uploaded-file', function (e) {
            e.preventDefault();
            var show_doc_url = jQuery(this).data('url');
            if (show_doc_url.length != 0) {
                window.open(show_doc_url, '_blank');
            } else {
                alert('something is wrong');
            }
        });
    });
</script>
@endsection