@extends('layouts.front.master')
@section('title', 'Design Studio')
@section('css')
{{-- for date range picker --}}
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{-- end range picker --}}  
<link rel="stylesheet" href="{{asset('frontend-assets/css/custom.css')}}" type="text/css">
<style>
	/*filter data   */
	.error-message {
    color: red;
    font-size: 12px;
    margin-top: 5px;
}
	/* .d-none {
    display: none !important;
} */
	/* Add red border for invalid fields */
.invalid {
    border: 1px solid red;
}

/* Optional: highlight field after validation */
input:focus.invalid, textarea:focus.invalid {
    border: 1px solid red;
}
button.btn.btn-primary#editinfo{
            cursor: pointer;
            font-size: 16px;
            font-weight: 800;
            line-height: 1;
            color: #fff;
            background-color: #53b746;
            display: inline-block;
            /* padding: 16px; */
            border: 1px solid #53b746;
            border-radius: 7px;
            text-align: center
        }

        button.btn.btn-primary#editinfo:focus,
        button.btn.btn-primary#editinfo:hover {
            background-color: #fff;
            border-color: #2c2c2e;
            color: #2c2c2e
        }

		
		button.btn.btn-primary.addprojectsavebtn{
            cursor: pointer;
            font-size: 16px;
            font-weight: 800;
            line-height: 1;
            color: #fff;
            background-color: #53b746;
            display: inline-block;
            padding: 16px;
            border: 1px solid #53b746;
            border-radius: 7px;
            text-align: center
        }

        button.btn.btn-primary.addprojectsavebtn:focus,
        button.btn.btn-primary.addprojectsavebtn:hover {
            background-color: #fff;
            border-color: #2c2c2e;
            color: #2c2c2e
        }

	
.btn-gallery-filter-wrap { display: flex;align-items: center;margin: 20px 0;}
.filter-label {margin-right: 10px;font-weight: bold;font-size: 16px;}
.gallery-filter {padding: 10px 15px;border: 1px solid #ccc;border-radius: 5px;font-size: 14px;background-color: #fff;cursor: pointer;transition: border-color 0.3s ease;}
.gallery-filter:hover {border-color: #007bff; }
.gallery-filter:focus {outline: none;border-color: #007bff; box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);}
/* filter data */
.documentation-download-item .download-item{margin-top:10px;display:flex;align-items:center;justify-content:space-between}
.documentation-download-item .download-item-img-title-wrap img{max-width:25px}
.documentation-download-item .download-item-img-title-wrap{display:flex;align-items:center}
.documentation-download-item .download-item-img-title-wrap .file-name{font-size:16px;font-weight:600;color:#0a84ff;white-space:nowrap;width:250px;overflow:hidden;text-overflow:ellipsis;text-align:left;text-decoration:underline}
p.p-not-found{margin:0;line-height:0}p.notes-pop{margin:0;font-size:14px;color:#fff}
#reportrange{background:#fff;border:1px solid #ddd;border-radius:5px;padding:10px;box-shadow:0 2px 5px rgba(0,0,0,.1);display:flex;align-items:center;justify-content:space-between}
#details_page_popup.gallerypopup .modal-body{padding:20px}
#media-description,#notes-container .form-label{font-size:14px;color:#2c2c2e}
#notes-container textarea.form-control{font-size:14px;color:#2c2c2e;height:90px; box-shadow: none}
#notes-container .btn-primary{font-size:14px;padding:10px}#notes-text{color:#2c2c2e;margin-bottom:16px}
#media-display{text-align:center}#media-display video{max-width:100%}#media-display img,#media-display video{max-height:400px}
.error{border:red}#reportrange i{color:#333}#reportrange span{font-size:14px}
.daterangepicker .ranges li.active{background-color:#53b746}
.is-invalid{border-color:red}@media (max-width:1199px){
.contractor-sec .project-detail-tabs .nav-tabs{justify-content:center}
.contractor-sec .project-detail-tabs .nav-tabs #nav-filters{margin-right:auto!important;width:100%}.contractor-sec .project-detail-tabs .nav-tabs #nav-filters #reportrange{margin-top:20px;max-width:320px;margin-left:auto;margin-right:auto}
}@media (max-width:767px){#reportrange{width:100%}#reportrange span{font-size:12px}}@media (min-width:768px){#reportrange{width:auto}#reportrange span{font-size:14px}}
.daterangepicker td.active,.daterangepicker td.active:hover{background-color:#53b746;border-color:transparent;color:#fff}
/*.clickable-image{cursor:pointer}.modal-lg{max-width:90%}
.text-truncate{overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
@media (max-width:768px){.modal-lg{max-width:100%;margin:0}#modal-image,
#modal-media{width:100%!important;height:auto!important}
#media-display img,#media-display video{max-width:100%;max-height:300px}
#media-description{font-size:14px}.modal-header h5{font-size:16px}
.text-truncate{text-overflow:ellipsis;white-space:normal}} */
</style>
<style>
.clickable-image{cursor:pointer}#media-display img,#media-display video { max-width: 100%;max-height: 400px;/* border-radius:8px !important; */}.btn-3{border-radius: 4px;}#details_page_popup.gallerypopup .modal-body {padding: 15px;}.modal-dialog {max-width:50%;}.modal-content {border-radius: 8px;}
.modal-body {padding: 20px;}.modal-title { font-size: 16px;}
#media-description,#notes-container .form-label {font-size: 14px;color: #2c2c2e;}
#notes-container textarea.form-control {font-size: 14px;color: #2c2c2e;height: 80px;border-radius: 10px;}
#notes-container .btn-primary {font-size: 14px;padding: 10px;}
#notes-text {color: #2c2c2e;margin-bottom: 16px;}
#media-display {text-align: center;}
#media-display img,#media-display video {max-width: 100%;height: auto;}
.error {border: 1px solid red;}
.clickable-image {cursor: pointer;}
.text-truncate {overflow: hidden;text-overflow: ellipsis;white-space: nowrap;}
@media (max-width: 768px) {.modal-dialog {max-width: 100%;}#media-display img,#media-display video {max-height: 300px;}#media-description {font-size: 14px;}.modal-header h5 {font-size: 14px;}.text-truncate {text-overflow: ellipsis;white-space: normal;}}
/* notes popup css  date 21*/
#details_page_popup .notes-text-wrp{border: 1px solid #ccc;border-radius: 10px;padding: 10px;background-color: #f5f5f5;margin-bottom: 5px;}
#details_page_popup .notes-text-wrp #username {font-size: 14px; font-weight: 700; color: #888888;}
#notes-container {text-align: left;}
.profile-img {width: 30px;height: 30px;margin-right: 10px;border-radius: 50px;overflow: hidden; min-width: 30px;}
.profile-img img {width: 100%; height: 100%; object-fit: cover; object-position: center center;}
.notes-details {width: 100%;}
#edit-notes {color: #A9A9A9;font-size: 14px;font-weight: 700;}
#edit-notes svg {margin-right: 5px;}
#reportrange i {color: #53b746;}
/* end note popup css */
</style>
{{-- /* end image details page  */ --}}
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend-assets/css/custom.css')}}">
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="breadcrumb-title-wrap pb-0">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<ol class="breadcrumb m-0">
					<li class="breadcrumb-item"><a href="{{route('contractor.dashboard')}}"><svg width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.13654 8L1.25522 5.11869C0.914945 4.77841 0.914945 4.22159 1.25522 3.88131L4.13654 1" stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg> Back</a></li>
				</ol>
			</div>
		</div>
		<div class="row breadcrumb-title">
			<div class="col-12 col-lg-7 pb-3">
				<div class="section-title">{{$projectinfo->title??Projects}}</div>
			</div>
		</div>
	</div>
</div>


<section class="contractor-sec">
	<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="contractor-list-tab-pane" role="tabpanel" aria-labelledby="contractor-list-tab" tabindex="0">
							<div class="row">
								<div class="col-12">
									<div class="project-detail-tabs">
									    <nav class="d-md-flex justify-content-between">
													<input type="hidden" name="project_id" id="project_id" value={{$projectinfo->id??''}}>
													<input type="hidden" name="user_id" id="user_id" value="{{$projectinfo->user_id??''}}"/>
													<input type="hidden" name="user_role" id="user_role" value="{{$projectinfo->role??''}}"/>
													<input type="hidden" name="loginuser_id" id="loginuser_id" value="{{auth()->guard('contractor')->user()->id??''}}"/>
													<input type="hidden" name="detailsproject_id" id="detailsproject_id" value={{$projectinfo->id??''}}>
													<input type="hidden" name="user_id" id="detailsuser_id" value="{{$projectinfo->user_id??''}}"/>
													@php
													$messageCount = \App\Models\Message::where('project_id',$projectinfo->id)->where('user_id',$projectinfo->user_id)->where('role','customer')->where('is_read',0)->get()->count();	 // ->where('contractor_id',Auth::user()->id)// ->where('project_id',$project->id)
													@endphp
												
												<div class="nav nav-tabs mb-0 justify-content-start" id="nav-tab" role="tablist">
													<button class="nav-link active" id="nav-design-studio-tab" data-bs-toggle="tab" data-bs-target="#nav-design-studio" type="button" role="tab" aria-controls="nav-design-studio" aria-selected="true"><img src="{{asset('frontend-assets/images/ProjectDetails/home_green.svg')}}">&nbsp;Design studio</button>
                                                    <button class="nav-link" id="nav-general-info-tab" data-bs-toggle="tab" data-bs-target="#nav-general-info" type="button" role="tab" aria-controls="nav-general-info" aria-selected="false"><img src="{{asset('frontend-assets/images/ProjectDetails/General Info.svg')}}">&nbsp;General Info</button>
													<button class="nav-link" id="nav-documentation-tab" data-bs-toggle="tab" data-bs-target="#nav-documentation" type="button" role="tab" aria-controls="nav-documentation" aria-selected="false"><img src="{{asset('frontend-assets/images/ProjectDetails/documentation.svg')}}">&nbsp;Documentation</button>
													<button class="nav-link @if($quotations->isEmpty()) {{'d-none'}} @endif" id="nav-quotation-tab" data-bs-toggle="tab" data-bs-target="#nav-quotation-info" type="button" role="tab" aria-controls="nav-quotation-info" aria-selected="false"><img src="{{asset('frontend-assets/images/ProjectDetails/qoutation_detail.svg')}}">&nbsp;Quotation Details</button>
													<a class="nav-link" href="{{URL('contractor/chat-customer-board/'.base64_encode($projectinfo->id).'/'.base64_encode($projectinfo->user_id))}}"><span class="position-relative" id="chatnowdetails-{{$projectinfo->id??''}}"><img class="chat-icon" src="{{asset('frontend-assets/images/ProjectDetails/chat.svg')}}">@if($messageCount > 0)<span class="chat-notification" d="chat-notification-contractorside-{{$projectinfo->id}}">{{ $messageCount }}</span>@endif</span>Chat now </a>
													<a class="nav-link d-none" href="#" data-bs-toggle="modal" data-bs-target="#designstudiopopup"><img class="btn-hover-icon-data" src="{{asset('frontend-assets/images/ProjectDetails/gallery-add.svg')}}" style="width:25px;">&nbsp;Add</a>
													<button class="nav-link d-none" id="nav-filters-tab"><img class="btn-hover-icon-data" src="{{asset('frontend-assets/images/ProjectDetails/Filter.svg')}}" style="">&nbsp;<span id="button-text">Filters</span></button><div class="ms-auto position-absolute end-0 mt-2" id="nav-filters"><div id="reportrange" class="text-nowrap" style="display: none;"><i class="fa fa-calendar" ></i>&nbsp;<span></span> <i class="fa fa-caret-down"></i>
												</div>
												{{-- </div></div> --}}
										 </nav>
											         

										<div class="tab-content" id="project-detail-nav">
											<div class="tab-pane fade show active" id="nav-design-studio" role="tabpanel" aria-labelledby="nav-design-studio-tab" tabindex="0">
													
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="contractor-list-item">
                                                    <div class="contractor-img-wrap">
                                                        @php $images =  json_decode($projectinfo->project_image, true);
                                                        @endphp
                                                        @if(isset($images) && is_array($images) && count($images) > 0)
                                                        <div class="contractor-img">
                                                            <img src="{{ asset('storage/project_images/'.$images[0]) }}" alt="contractor" width="370" height="200">
                                                        </div>
                                                        <div class="contractor-img-icon" data-bs-toggle="modal" data-bs-target="#gallerypopup">
                                                            <img src="{{asset('frontend-assets/images/img-icon.svg')}}" alt="img-icon" width="32" height="32">
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
											

                        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1">
                            <div id="toast-message" class="toast fade" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                    <strong class="me-auto">Success</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                                <div class="toast-body">
                                </div>
                            </div>
                        </div>
							    
					{{-- Design studio --}}

                                    <div class="row studio-stepform-wrap general-info-wrap" id="testData">
												<div class="d-md-flex justify-content-between">
													<div class="">
														<a class="nav-link d-inline-block ms-1" href="#" data-bs-toggle="modal" data-bs-target="#designstudiopopup"><img class="btn-hover-icon-data" src="{{asset('frontend-assets/images/ProjectDetails/gallery-add.svg')}}" style="width:25px;">&nbsp;Add</a>
														<button class="nav-link d-inline-block ms-1 nav-filters-tab-data" id="nav-filters-tab"><img class="btn-hover-icon-data" src="{{asset('frontend-assets/images/ProjectDetails/Filter.svg')}}" style="">&nbsp;<span id="button-text-data">Filters</span></button>
														<div class="ms-auto position-absolute end-0 mt-2" id="nav-filters">
															<div id="reportrange" class="text-nowrap" style="display: none;"><i class="fa fa-calendar" ></i>&nbsp;<span></span> <i class="fa fa-caret-down"></i></div>
														</div>
													</div>
												</div>
								
								            <!-- added -->
							                {{--No images or videos found--}}
											<?php
												$currentMonth = \Carbon\Carbon::now()->month;
												$currentYear = \Carbon\Carbon::now()->year;

												$projectImageData = \App\Models\ProjectImagesData::where('project_id',$projectinfo->id)
													->whereMonth('date', $currentMonth)
													->whereYear('date', $currentYear)
													->orderBy('date', 'desc')
													->get();

												$groupedData = $projectImageData->groupBy('date');
											?>
												
											@if($groupedData && $groupedData->isEmpty() != true)
											@foreach($groupedData as $date => $mediaItems)
												<h6>{{ \Carbon\Carbon::parse($date)->format('m-d-Y') }}
												</h6> 
												@foreach($mediaItems as $mediaItem)
													@if($mediaItem->media_type == 'image') 
													@php
														$authuser = auth()->guard('contractor')->user()->id??'';
														if($mediaItem->created_by == $authuser){
															$color = ""; 
														}else{
															$color = "design-studio-with-customer";
														}
														@endphp 
													
													   <div class="design-studio-img-items {{$color??''}} project-detail-photos-item-img gallery_container">
														

														@if($authuser == $mediaItem->created_by??'')
														<button type="button" class="remove-img" data-media-item-id="{{ $mediaItem->id }}">X</button>
														@endif	
														{{-- <a class="lightbox" href="{{ asset('storage/project_images/'.$mediaItem->project_image)  }}"> --}}
															<span class="lightbox"  class="detail_page_popup">
																<img src="{{ asset('storage/project_images/'.$mediaItem->project_image)  }}"  data-notes="{{$mediaItem->notes??''}}"  alt="Image" data-type="{{$mediaItem->media_type}}"  data-image-id="{{ $mediaItem->id }}"                
																class="clickable-image"  data-project-name="{{$mediaItem->project_image}}"  data-date="{{$mediaItem->date}}" data-time="{{$mediaItem->time}}">
															</span>
															<span class="image-upload-time">{{$mediaItem->time}}</span>
														</div>
														@elseif($mediaItem->media_type == 'video')
														@php
														$authuser = auth()->guard('contractor')->user()->id??'';
														if($mediaItem->created_by == $authuser){
															$color = ""; 
														}else{
															$color = "design-studio-with-customer";
														}
														// dd($color);
														@endphp 
														<div class="design-studio-img-items {{$color??''}} project-detail-photos-item-img">
														
														@php
														$authuser = auth()->guard('contractor')->user()->id??'';
														@endphp 
														@if($authuser == $mediaItem->created_by??'')
															<button type="button" class="remove-img" data-media-item-id="{{ $mediaItem->id }}">X</button>
														@endif  

														
														{{-- <a class="image-gallery-popup" href="{{ asset('storage/project_images/'.$mediaItem->project_image) }}"> --}}
																<video width="150" height="150" controls  data-project-name="{{$mediaItem->project_image}}"  data-type="{{$mediaItem->media_type}}" data-notes="{{$mediaItem->notes??''}}"  data-source="{{ asset('storage/project_images/'.$mediaItem->project_image) }}" data-image-id="{{ $mediaItem->id }}" class="clickable-image" data-date="{{$mediaItem->date}}" data-time="{{$mediaItem->time}}">
																	<source src="{{ asset('storage/project_images/'.$mediaItem->project_image) }}"  type="video/mp4">
																	Your browser does not support the video tag.
																</video>
															{{-- </a> --}}
															<span class="image-upload-time">{{$mediaItem->time}}</span>
														</div>
													@endif 
												@endforeach
											@endforeach
											@else
												<p class="p-not-found"><strong style="color:black">No Data Found</strong></p>
											@endif
								</div>
		             	   <!-- added -->

  												    
												@if($projectImageData->count() > 0)	
												<div class="row justify-content-center">
													<div class="col-12 col-md-6 col-lg-4">
														<a class="btn-primary d-block" id="designStudiotab" href="javascript:void(0)">Next</a>
													</div>
												</div>
												@endif
											</div>
										
											{{-- general information --}}
											
											<div class="tab-pane fade mt-5" id="nav-general-info" role="tabpanel" aria-labelledby="nav-general-info-tab" tabindex="0">
												{{-- @if(isset($projectinfo->added_by_contractor) == 1)
													<div class="row">
														<div class="col-12 col-md-2">
																<input type="button" class="btn btn-primary btn-sm" id="editgeneralinfo" value="EDIT">
														</div>
													</div> --}}
													
													{{-- general info form --}}

													{{-- <div class="container d-none"  id="generalinfo-form">
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
																							<input id="name" type="text" name="title" @if(isset($projectinfo))
																								value="{{$projectinfo->title ?? ''}}" @endif placeholder="John doe">
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
																						<div class="form-element"><textarea id="address" name="address" rows="4"
																								placeholder="Enter your address">@if(isset($projectinfo)){{$projectinfo->address ?? ''}}@endif</textarea>
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
																						@if($projectinfo->customer_name)
																							<div class="form-element">
																								<input id="customer_name" type="text" @if(isset($projectinfo))
																									value="{{$projectinfo->customer_name ?? ''}}" @endif name="customer_name"
																									placeholder="Enter Customer name">
																							</div>
																						@else 
																							<div class="form-element">
																								<input id="customer_name" type="text" @if(isset($projectinfo))
																									value="{{\Auth::user()->name ?? ''}}" @endif name="customer_name"
																									placeholder="Enter Customer name">
																							</div>
																						@endif
																					</div>
																				</div>
																				<div class="form-group col-12 col-md-6">
																					<div class="field-wrap">
																						<div class="form-label">
																							<label for="contact_number">Contact Number<span>*</span></label>
																						</div>
																						@if(isset($projectinfo->phone))
																							<div class="form-element">
																								<input id="contact_number" type="text" @if(isset($projectinfo))
																								value="{{$projectinfo->phone ?? ''}}" @endif
																									name="contact_number" placeholder="Enter Contact Number">
																							</div>
																						@else 
																							<div class="form-element">
																								<input id="contact_number" type="text" @if(isset($projectinfo))
																								value="{{\Auth::user()->contact_number ?? ''}}" @endif
																									name="contact_number" placeholder="Enter Contact Number">
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
																							<input id="insurancecompany" type="text" @if(isset($projectinfo))
																								value="{{$projectinfo->insurance_company ?? ''}}" @endif name="insurancecompany"
																								placeholder="Enter insurance company name">
																						</div>
																					</div>
																				</div>
																				<div class="form-group col-12 col-md-6">
																					<div class="field-wrap">
																						<div class="form-label">
																							<label for="insuranceagency">Insurance agency</label>
																						</div>
																						<div class="form-element">
																							<input id="insuranceagency" type="text" @if(isset($projectinfo))
																								value="{{$projectinfo->insurance_agency ?? ''}}" @endif name="insuranceagency"
																								placeholder="Enter insurance agency name">
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
																							<input id="billing" type="text" @if(isset($projectinfo))
																								value="{{$projectinfo->billing ?? ''}}" @endif name="billing"
																								placeholder="Enter billing info">
																						</div>
																					</div>
																				</div>
																				<div class="form-group col-12 col-md-6">
																					<div class="field-wrap">
																						<div class="form-label">
																							<label for="mortgagecompany">Mortgage company</label>
																						</div>
																						<div class="form-element">
																							<input id="mortgagecompany" type="text" @if(isset($projectinfo))
																								value="{{$projectinfo->mortgage_company ?? ''}}" @endif name="mortgagecompany"
																								placeholder="Enter mortgage company name">
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
																				
																		</div>
																	</form>
																</div>
															</div>
														</div>
													</div> --}}
													{{-- geral info form end --}}
												{{-- @endif --}}


												
												{{-- Display general info data --}}
												{{-- <div class="row" id="displayinfo">
													<div class="col-12">
														
														<div class="general-info-wrap">

															<div class="general-info-item">
																@if(isset($projectinfo->added_by_contractor) && $projectinfo->added_by_contractor == 1)
																<div class="col-sm-12 col-md-8 col-lg-8 mb-3 mb-md-0 pb-3 text-end" style="padding-left: 1280%">
																	<div class="position-relative">
																		<button type="button" class="btn btn-primary btn-sm" id="editinfo">
																			Edit
																		</button>
																	</div>
																</div>
															@endif
															
															</div>

															<div class="general-info-item">
																<div class="general-info-item-title">Name:</div>
																<div class="general-info-item-detail">{{$projectinfo->title??''}}</div>
															</div>

															<div class="general-info-item">
																<div class="general-info-item-title">phone:</div>
																<div class="general-info-item-detail">{{$projectinfo->user->contact_number??''}}</div>
															</div>
															<div class="general-info-item">
																<div class="general-info-item-title">Address:</div>
																<div class="general-info-item-detail">{{$projectinfo->address??''}}</div>
															</div>
															@if($projectinfo->insurance_company != '' && $projectinfo->insurance_company != NULL)
															<div class="general-info-item">
																<div class="general-info-item-title">Insurance company:</div>
																<div class="general-info-item-detail">{{$projectinfo->insurance_company??''}}</div>
															</div>
															@endif
															@if($projectinfo->insurance_agency != '' && $projectinfo->insurance_agency != NULL)
															<div class="general-info-item">
																<div class="general-info-item-title">Insurance agency:</div>
																<div class="general-info-item-detail">{{$projectinfo->insurance_agency??''}} </div>
															</div>
															@endif
															@if($projectinfo->billing != '' && $projectinfo->billing != NULL)
															<div class="general-info-item">
																<div class="general-info-item-title">Billing:</div>
																<div class="general-info-item-detail">{{$projectinfo->billing??''}}</div>
															</div>
															@endif
															@if($projectinfo->mortgage_company != '' && $projectinfo->mortgage_company != NULL)
															<div class="general-info-item">
																<div class="general-info-item-title">Mortgage company:</div>
																<div class="general-info-item-detail">{{$projectinfo->mortgage_company??''}}</div>
															</div>
															@endif
														</div>
													</div>
												</div>
												
												
											</div> --}}
											<div class="row" id="displayinfo">
												<div class="col-12">
													<div class="general-info-wrap" id="general-info-wrap">
														<div class="general-info-item">
															@if(isset($projectinfo->added_by_contractor) && $projectinfo->added_by_contractor == 1)
															<div class="col-sm-12 col-md-8 col-lg-8 mb-3 mb-md-0 pb-3 text-end" style="padding-left:600%">
																<div class="position-relative">
																	<button type="button" class="btn btn-primary btn-sm" id="editinfo">
																		Edit
																	</button>
																</div>
															</div>
															@endif
														</div>
											
														<div class="general-info-item">
															<div class="general-info-item-title">Project Name:</div>
															<div class="general-info-item-detail" id="name-detail">{{$projectinfo->title ?? ''}}</div>
														</div>
											
														<div class="general-info-item">
															<div class="general-info-item-title">Phone:</div>
															<div class="general-info-item-detail" id="phone-detail">{{$projectinfo->phone??''}}</div>
														</div>
														<div class="general-info-item">
															<div class="general-info-item-title">Customer Name:</div>
															<div class="general-info-item-detail" id="customer_name_details">{{$projectinfo->customer_name ?? ''}}</div>
														</div>
											
														<div class="general-info-item">
															<div class="general-info-item-title">Address:</div>
															@php
															
															@endphp
															<div class="general-info-item-detail" id="address-detail">{{$projectinfo->address ?? ''}}</div>
														</div>
											
														{{-- <div class="general-info-item insurance-company-detail">
															<div class="general-info-item-title">Insurance company:</div>
															<div class="general-info-item-detail" id="insurance-company-detail">@if($projectinfo->insurance_company)
																{{$projectinfo->insurance_company ?? ''}}														@endif
															</div>
														</div>
											
														<div class="general-info-item">
															<div class="general-info-item-title">Insurance agency:</div>
															<div class="general-info-item-detail" id="insurance-agency-detail">														@if($projectinfo->insurance_agency)
																{{$projectinfo->insurance_agency ?? ''}}														@endif
															</div>
														</div>
											
														<div class="general-info-item">
															<div class="general-info-item-title">Billing:</div>
															<div class="general-info-item-detail" id="billing-detail">														@if($projectinfo->billing)
																{{$projectinfo->billing ?? ''}}														@endif
															</div>
														</div>
											
														<div class="general-info-item">
															<div class="general-info-item-title">Mortgage company:</div>
															<div class="general-info-item-detail" id="mortgage-company-detail">														@if($projectinfo->mortgage_company)
																{{$projectinfo->mortgage_company ?? ''}}														@endif
															</div>
														</div> --}}
														<div class="general-info-item insurance-company-detail">
															<div class="general-info-item-title">Insurance company:</div>
															<div class="general-info-item-detail" id="insurance-company-detail"></div>
														</div>
														
														<div class="general-info-item">
															<div class="general-info-item-title">Insurance agency:</div>
															<div class="general-info-item-detail" id="insurance-agency-detail"></div>
														</div>
														
														<div class="general-info-item">
															<div class="general-info-item-title">Billing:</div>
															<div class="general-info-item-detail" id="billing-detail"></div>
														</div>
														
														<div class="general-info-item">
															<div class="general-info-item-title">Mortgage company:</div>
															<div class="general-info-item-detail" id="mortgage-company-detail"></div>
														</div>
														
													</div>
											
													<!-- Editable Form -->
													{{-- <div class="editable-form-wrap form-group col-12 col-md-12" id="editable-form-wrap" style="display:none;">
														<form id="edit-form">
															@csrf


															<div class="field-wrap">
																<div class="form-label">
																	<label for="name">Name<span>*</span></label>
																</div>
																<div class="form-element">
																	<input id="title" type="text" name="title" placeholder="John doe"  value="{{$projectinfo->title ?? ''}}">
																</div>
															</div>

										

															<div class="field-wrap">
																<div class="form-label">
																	<label for="contact_number">Phone<span>*</span></label>
																</div>
																<div class="form-element">
																	<input type="text" id="contact_number" name="contact_number" class="form-control" value="{{$projectinfo->phone??''}}">
																</div>
															</div>

															<div class="field-wrap">
																<div class="form-label">
																	<label for="address">Address<span>*</span></label>
																</div>
																<div class="form-element">
																	<input type="text" id="address" name="address" class="form-control" value="{{$projectinfo->address ?? ''}}">
																</div>
															</div>
											
															<div class="field-wrap">
																<div class="form-label">
																	<label for="insurance_company">Insurance company:<span>*</span></label>
																</div>
																<div class="form-element">
																	<input type="text" id="insurance_company" name="insurance_company" class="form-control" value="{{$projectinfo->insurance_company ?? ''}}">
																</div>
															</div>

															<div class="field-wrap">
																<div class="form-label">
																	<label for="insurance_agency">Insurance agency:<span>*</span></label>
																</div>
																<div class="form-element">
																	<input type="text" id="insurance_agency" name="insurance_agency" class="form-control" value="{{$projectinfo->insurance_agency ?? ''}}">
																</div>
															</div>

															<div class="field-wrap">
																<div class="form-label">
																	<label for="billing">Billing:<span>*</span></label>
																</div>
																<div class="form-element">
																	<input type="text" id="billing" name="billing" class="form-control" value="{{$projectinfo->billing ?? ''}}">
																</div>
															</div>

															<div class="field-wrap">
																<div class="form-label">
																	<label for="mortgage_company">Mortgage Company:<span>*</span></label>
																</div>
																<div class="form-element">
																	<input type="text" id="mortgage_company" name="mortgage_company" class="form-control" value="{{$projectinfo->mortgage_company ?? ''}}">
																</div>
															</div>
															
											
															<button type="submit" class="btn btn-success btn-sm mt-3">Save</button>
														</form>
													</div> --}}
													
															{{-- <div class="studio-stepform-wrap general-info-wrap editable-form-wrap" id="editable-form-wrap" style="display:none;">
																<form id="edit-form" method="post" enctype="multipart/form-data">
																	@csrf
																	<div class="row">
																			<div class="form-group col-12 col-md-12">
																				<div class="field-wrap">
																					<div class="form-label">
																						<label for="title">Name<span>*</span></label>
																					</div>
																					<div class="form-element">
																						<input id="title" type="text" name="title" value="The House Roofing" placeholder="John doe">
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
																					 
																						<div class="form-element">
																							<input id="customer_name" type="text" value="John" name="customer_name" placeholder="Enter Customer name">
																						</div>
																				</div>
																			</div>
																			<div class="form-group col-12 col-md-6">
																				<div class="field-wrap">
																					<div class="form-label">
																						<label for="contact_number">Contact Number<span>*</span></label>
																					</div>
																					 
																						<div class="form-element">
																							<input id="contact_number" type="text" value="{{$projectinfo->phone??''}}" name="contact_number" placeholder="Enter Contact Number">
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
																					<div class="form-element"><textarea id="address" name="address" rows="4" placeholder="Enter your address">{{$projectinfo->address ?? ''}}</textarea>
																					</div>
																				</div>
																			</div>
																		</div>
																	
																		<div class="row">
																			<div class="form-group col-12 col-md-6">
																				<div class="field-wrap">
																					<div class="form-label">
																						<label for="insurance_company">Insurance company</label>
																					</div>
																					<div class="form-element">
																						<input id="insurance_company" type="text" value="{{$projectinfo->insurance_company ?? ''}}" name="insurance_company" placeholder="Enter insurance company name">
																					</div>
																				</div>
																			</div>
																			<div class="form-group col-12 col-md-6">
																				<div class="field-wrap">
																					<div class="form-label">
																						<label for="insurance_agency">Insurance agency</label>
																					</div>
																					<div class="form-element">
																						<input id="insurance_agency" type="text" value="{{$projectinfo->insurance_agency??''}}" name="insurance_agency" placeholder="Enter insurance agency name">
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
																						<input id="billing" type="text" value="{{$projectinfo->billing??''}}" name="billing" placeholder="Enter billing info">
																					</div>
																				</div>
																			</div>
																			<div class="form-group col-12 col-md-6">
																				<div class="field-wrap">
																					<div class="form-label">
																						<label for="mortgage_company">Mortgage company</label>
																					</div>
																					<div class="form-element">
																						<input id="mortgage_company" type="text" value="{{$projectinfo->mortgage_company ?? ''}}" name="mortgage_company" placeholder="Enter mortgage company name">
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="form-group button-wrap col-md-12">
																				<div class="field-wrap text-center">
																					
																						<button type="submit" class="btn btn-success btn-sm mt-3">Save</button>
																				</div>
																			</div>
																			
																		</div>
																	</div>
																</form>
															</div> --}}


															<div class="studio-stepform-wrap general-info-wrap editable-form-wrap" id="editable-form-wrap" style="display:none;">
																<form id="edit-form" method="post" enctype="multipart/form-data">
																	@php
																	$country_code   = $projectinfo->country_code ? $projectinfo->country_code : 'us';
																	$phone_no       = $projectinfo->contact_number ? $projectinfo->contact_number : '';
																	@endphp
																	@csrf
																	<div class="row">
																		<div class="form-group col-12 col-md-12">
																			<div class="field-wrap">
																				<div class="form-label">
																					<label for="title">Name<span>*</span></label>
																				</div>
																				<div class="form-element">
																					<input id="title" type="text" name="title" value="The House Roofing" placeholder="John Doe">
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
																				<div class="form-element">
																					<input id="customer_name" type="text" value="John" name="customer_name" placeholder="Enter Customer name">
																					<div id="customer_name_error" class="error-message"></div> <!-- Error message for Customer Name -->

																				</div>
																			</div>
																		</div>
																		<div class="form-group col-12 col-md-6">
																			<div class="field-wrap">
																				<div class="form-label">
																					<label for="contact_number">Contact Number<span>*</span></label>
																				</div>
																				{{-- <div class="form-element">
																					<input id="contact_number" type="text" value="{{$projectinfo->phone??''}}" name="contact_number" placeholder="Enter Contact Number">
																					<div id="contact_number_error" class="error-message"></div> <!-- Error message for Contact Number -->
																				</div> --}}

																				<div class="form-element" style="display: grid;">
																					<input id="country_code" type="hidden" name="country_code"
																					value="{{ $country_code }}" />
																					<input type="text"
																						value="{{ old('contact_number', $contractor->contact_number ?? '') }}"
																						id="contact_number" name="contact_number"
																						placeholder="Enter your contact number">
																					@error('contact_number')
																					<div id="contact_number_error" class="error-message"></div> <!-- Error message for Contact Number -->
																					@enderror
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
																					<textarea id="address" name="address" rows="4" placeholder="Enter your address">{{$projectinfo->address ?? ''}}</textarea>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="form-group col-12 col-md-6">
																			<div class="field-wrap">
																				<div class="form-label">
																					<label for="insurance_company">Insurance company</label>
																				</div>
																				<div class="form-element">
																					<input id="insurance_company" type="text" value="{{$projectinfo->insurance_company ?? ''}}" name="insurance_company" placeholder="Enter insurance company name">
																				</div>
																			</div>
																		</div>
																		<div class="form-group col-12 col-md-6">
																			<div class="field-wrap">
																				<div class="form-label">
																					<label for="insurance_agency">Insurance agency</label>
																				</div>
																				<div class="form-element">
																					<input id="insurance_agency" type="text" value="{{$projectinfo->insurance_agency??''}}" name="insurance_agency" placeholder="Enter insurance agency name">
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
																					<input id="billing" type="text" value="{{$projectinfo->billing??''}}" name="billing" placeholder="Enter billing info">
																				</div>
																			</div>
																		</div>
																		<div class="form-group col-12 col-md-6">
																			<div class="field-wrap">
																				<div class="form-label">
																					<label for="mortgage_company">Mortgage company</label>
																				</div>
																				<div class="form-element">
																					<input id="mortgage_company" type="text" value="{{$projectinfo->mortgage_company ?? ''}}" name="mortgage_company" placeholder="Enter mortgage company name">
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="form-group button-wrap col-md-12">
																			<div class="field-wrap text-center">
																				<button type="submit" class="btn btn-success btn-primary addprojectsavebtn btn-sm mt-3">Save</button>
																			</div>
																		</div>
																	</div>
																</form>
															</div>
											            </div>
														</div>
														


												{{-- </div>
											</div> --}}
										</div>

											{{-- end general info form --}}
											{{-- general information --}}

											

											


											{{-- quotation  Start --}}
											<div class="tab-pane fade general-info-wrap mt-4"  id="nav-quotation-info" role="tabpanel" aria-labelledby="nav-quotation-tab" tabindex="0">
												{{-- <div class="row"> --}}
													@php
													$quotationStatus = \App\Models\Quotation::select('status')
														->where('contractor_id', auth()->guard('contractor')->user()->id)
														->where('project_id', $projectinfo->id)
														//->whereHas('quoteItems')
														->where('status','!=',NULL)
														->orderBy('id', 'DESC')
														->first();
													@endphp 
														<div class="row">
														
															<div class="col-12">
																<div class="btn-gallery-filter-wrap">
																	<select id="gallery-filter" class="gallery-filter" onchange="filterGallery(this.value)">
																		<option value="all" data-category="all" selected>All</option>
																		<option value="approved"  data-category="approved">Approved</option>
																		<option value="Requested"  data-category="Requested">Requested</option>
																		<option value="Responded"  data-category="Responded">Responded</option>
																		<option value="rejected"  data-category="rejected">Rejected</option>
																	</select>
																</div>
															</div>
														</div>
														<div class="row mt-1">

																@if(isset($quotations))
																@foreach($quotations as $quotation)
																<div class="col-12 col-md-6 col-lg-4 item" data-category="{{$quotation->status??''}}">
																	<div class="quotation-wrap">
																		<div class="quotes-detail-item-title">Quotation  No: {{$quotation->id??''}}</div>
																		<div class="quotes-detail-item-dates">
																			<svg class="me-2" width="16" height="19" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.77148 1.35645V3.75645" stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M11.1719 1.35645V3.75645" stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M1.17188 7.02832H14.7719" stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M15.1715 6.55664V13.3566C15.1715 15.7566 13.9715 17.3566 11.1715 17.3566H4.77148C1.97148 17.3566 0.771484 15.7566 0.771484 13.3566V6.55664C0.771484 4.15664 1.97148 2.55664 4.77148 2.55664H11.1715C13.9715 2.55664 15.1715 4.15664 15.1715 6.55664Z" stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M10.9278 10.7164H10.935" stroke="#0A84FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M10.9278 13.1163H10.935" stroke="#0A84FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M7.96787 10.7164H7.97506" stroke="#0A84FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M7.96787 13.1163H7.97506" stroke="#0A84FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M5.00693 10.7164H5.01412" stroke="#0A84FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M5.00693 13.1163H5.01412" stroke="#0A84FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
																			<strong>{{ \Carbon\Carbon::parse($quotation->created_at??'')->format('d M Y, D') }}</strong>
																		</div>
																		
																		<div class="quotation-info-item">
																			<div class="quotation-info-item-title">Quoted price: </div>
																			<div class="quotation-info-item-detail"><span class="price-tag">${{$quotation->final_price??''}}</span></div>
																		</div>
																		<div class="quotation-info-item">
																			<div class="quotation-info-item-title">Status: </div>
																			<div class="quotation-info-item-detail">
																									@if($quotation->status == 'Requested')
																									<div class="quotes-detail-item-content"><span class="requested-status-tag">Requested for quote</span></div>
																									@elseif($quotation->status == 'Responded')
																									<div class="quotes-detail-item-content"><span class="requested-status-tag">Responded</span></div>
																									
																									@elseif($quotation->status == 'approved')
																									<div class="quotes-detail-item-content"><span class="price-tag">Approved</span></div>
																									@elseif($quotation->status == 'rejected')

																									<div class="quotes-detail-item-content"><span class="rejected-status-tag">Rejected</span></div>
																									@endif
																			</div>
																		</div>
																		<div class="quotation-info-item">
															@php
															$projectData = \App\Models\Project::where('id',$quotation->project_id??'')->first();
															$userData = \App\Models\User::where('id',$projectData->user_id??'')->first();
															@endphp
															<input type="hidden" value="{{$userData->id??''}}" name="customerid" id="customerid">
																									<input type="hidden" value="{{auth()->guard('contractor')->user()->id??''}}" id="contractorid">
																								

																			<div class="quotation-info-item-title">Call: </div>
																			<div class="quotation-info-item-detail">{{$userData->contact_number??''}}</div>
																		</div>
																		<div class="quotation-info-item">
																			<div class="quotation-info-item-title">Email: </div>
																			<div class="quotation-info-item-detail">{{$userData->email??''}}</div>
																		</div>
																		@if(isset($quotation->rejection_reason))
																		<div class="quotation-info-item">
																			<div class="quotation-info-item-title">Description: </div>
																			<div class="quotation-info-item-detail">
																				{{--I can't afford this price. Please call us for further discussion--}}
																				{{$quotation->rejection_reason??''}}
																			</div>
																		</div>
																		@endif
																		<div class="quotation-btn-wrap">
																				@if($quotation->status == 'Requested')
																				<div class="quotes-request-btn-wrap">
																					<a class="btn-primary d-block btn-approved" href="{{route('send.quotation.view',base64_encode($quotation->id))}}">Send a quote</a>
																				</div>
																				@elseif($quotation->status == 'Responded')
																					<div class="quotes-request-btn-wrap">
																						<a class="btn-primary d-block btn-approved" href="{{route('preview.quotation',base64_encode($quotation->id))}}">View quotation</a>
																					</div>
																				@elseif($quotation->status == 'approved')
																				<div class="quotes-request-btn-wrap">
																						<a class="btn-primary d-block btn-approved" href="{{route('preview.quotation',base64_encode($quotation->id))}}">View quotation</a>
																					</div>
																					@elseif($quotation->status == 'rejected')
																					<div class="quotes-request-btn-wrap">
																						<a class="btn-primary d-block btn-approved" href="{{route('preview.quotation',base64_encode($quotation->id))}}">View quotation</a>
																					</div>
																				@endif
																		</div>
																	</div>
																</div>
																@endforeach
															@endif
														</div>


												{{-- </div> --}}
												@if(isset($quotationStatus))
												@if($quotationStatus->status == 'rejected')
												<div class="row justify-content-center mb-5">
													@if ($quotationStatus && $quotationStatus->status == 'rejected')
														<div class="quotes-request-btn-wrap col-md-6 col-lg-4">
															<a class="btn-primary d-block" id="sendnewQuote">Send a new quote</a>
														</div>
													@endif
												</div>
												@endif
												@endif 
											</div>
											{{-- Quotation End --}}


											{{-- Documentation section --}}

											@if($projectinfo->added_by_contractor == 1)
											{{-- doc update --}}
											{{-- <div class="row">
												<div class="col-12">
													<div class="studio-stepform-wrap"> --}}
														<div class="tab-pane fade mt-5" id="nav-documentation" role="tabpanel"
														aria-labelledby="nav-documentation-tab" tabindex="0">
														{{-- resources/views/example.blade.php --}}
														<x-contractor-documents-component 
                                                        :project-id="$projectinfo->id" 
                                                        :documents="$documentdata" 
                                                        :insurance-documents="$insurancedocuments" 
                                                        :mortgage-documents="$mortgagedocuments" 
                                                        :contractor-documents="$contractordocuments" 
                                                    />
													</div>
													{{-- </div>
												</div>
											</div> --}}
											{{-- doc update end  --}}
											@else 
											<div class="tab-pane fade mt-5" id="nav-documentation" role="tabpanel" aria-labelledby="nav-documentation-tab" tabindex="0">
												<div class="row">
													{{--<div class="col-12">
														<div class="section-subtitle mb-4">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</div>
													</div>--}}
												</div>
												<div class="row">

													<div class="col-12 col-lg-6">
														<div class="documentation-download-item">
															<div class="documentation-download-img">
																<img src="{{asset('frontend-assets/images/pdf.png')}}" alt="download icon" width="50" height="50">
															</div>
															<div class="documentation-download-detail-wrap">
																<div class="documentation-download-title">Third party agreement document</div>
																<div class="documentation-download-contant">(Third party agreement, signed contract and warranty from manufacturer)</div>
																<div class="documentation-download-btn-wrap text-end" style="">
    																@if(isset($documentdata))
																	
																	@foreach($documentdata as $document)
    																    <div class="download-item">
																			<a href="{{route('download.file', ['filename' => $document['filename']]) }}">
																				@if(isset($document) && $document !== NULL && $document !== '')
                    																<div class="download-item-img-title-wrap">
                        																@php
                            																$filename = explode("/", $document['filename']);
                            																$ext = pathinfo($document['filename'], PATHINFO_EXTENSION);
																						@endphp
                        																@if($ext == 'jpg' || $ext == 'jpeg')
                        																	<img src="{{asset('frontend-assets/images/image_icon.png')}}" style="width:30px;margin-right:10px;"/>
                        																	@elseif($ext == 'doc' || $ext == 'docx')
                        																	<img src="{{asset('frontend-assets/images/word-file.png')}}" style="width:30px;margin-right:10px;"/>
                        																	@else
                        																	<img src="{{asset('frontend-assets/images/file.png')}}" style="width:30px;margin-right:10px;"/>
                        																@endif
                        																<div class="file-name" > {{$filename[1]??''}}</div>
                        															</div>
                    															
																				<div class="file-date">{{$document['filedate']??''}}</div>
                                                                               <svg width="25" height="25" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.0631 11.6913C15.2753 11.5145 15.3039 11.1992 15.1271 10.9871C14.9504 10.7749 14.6351 10.7462 14.4229 10.923L15.0631 11.6913ZM10.5004 14.8427L10.1803 15.2268C10.3657 15.3813 10.635 15.3813 10.8205 15.2268L10.5004 14.8427ZM6.57778 10.923C6.36564 10.7462 6.05036 10.7749 5.87358 10.987C5.6968 11.1992 5.72546 11.5145 5.9376 11.6913L6.57778 10.923ZM11.0004 6.35736C11.0004 6.08122 10.7765 5.85736 10.5004 5.85736C10.2242 5.85736 10.0004 6.08122 10.0004 6.35736H11.0004ZM14.4229 10.923L10.1803 14.4586L10.8205 15.2268L15.0631 11.6913L14.4229 10.923ZM10.8205 14.4586L6.57778 10.923L5.9376 11.6913L10.1803 15.2268L10.8205 14.4586ZM11.0004 14.8427V6.35736H10.0004V14.8427H11.0004ZM16.9351 17.0347C13.3813 20.5884 7.61949 20.5884 4.06572 17.0347L3.35861 17.7418C7.30291 21.6861 13.6979 21.6861 17.6422 17.7418L16.9351 17.0347ZM4.06572 17.0347C0.511948 13.4809 0.511948 7.7191 4.06572 4.16533L3.35861 3.45822C-0.585683 7.40252 -0.585683 13.7975 3.35861 17.7418L4.06572 17.0347ZM4.06572 4.16533C7.61949 0.611557 13.3813 0.611557 16.9351 4.16533L17.6422 3.45822C13.6979 -0.486074 7.30291 -0.486074 3.35861 3.45822L4.06572 4.16533ZM16.9351 4.16533C20.4888 7.7191 20.4888 13.4809 16.9351 17.0347L17.6422 17.7418C21.5865 13.7975 21.5865 7.40252 17.6422 3.45822L16.9351 4.16533Z" fill="#53B746"/></svg>
            																@endif
																		</a>
        																</div>
    																@endforeach
																	@endif
                                                            </div>
														</div>
													</div>


													<!-- </div>
													<div class="col-12 col-lg-6"> -->
														<div class="documentation-download-item">
															<div class="documentation-download-img">
																<img src="{{asset('frontend-assets/images/word-file.png')}}" alt="download icon" width="50" height="50">
															</div>
															<div class="documentation-download-detail-wrap">
																<div class="documentation-download-title">Insurance documents</div>
																<div class="documentation-download-contant">(Insurance Scope, final invoice and completion doc)</div>
																<div class="documentation-download-btn-wrap text-end" style="">
																@foreach($contractordocuments as $contractordocuments)
    																<div class="download-item">
																		<a href="{{route('download.file', ['filename' => $contractordocuments['filename']]) }}">
        																@if(isset($contractordocuments) && $contractordocuments !== NULL && $contractordocuments !== '')
        																    <div class="download-item-img-title-wrap">
                																@php
                																    $filename = explode("/",$contractordocuments['filename']);
                																$ext = pathinfo($contractordocuments['filename'], PATHINFO_EXTENSION);

                																    
                																@endphp
                																@if($ext == 'jpg' || $ext == 'jpeg')
                																	<img src="{{asset('frontend-assets/images/image_icon.png')}}" style="width:30px;margin-right:10px;"/>
                																@elseif($ext == 'doc')
                																    <img src="{{asset('frontend-assets/images/doc_icon.png')}}" style="width:30px;margin-right:10px;"/>
                																@else
                															        <img src="{{asset('frontend-assets/images/doc_icon.jpg')}}" style="width:30px;margin-right:10px;"/>
                																@endif
                																<div class="file-name" > {{$filename[1]??''}}</div>
                															</div>
																			<div class="file-date">{{$contractordocuments['filedate']??''}}</div>
                															<svg width="25" height="25" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.0631 11.6913C15.2753 11.5145 15.3039 11.1992 15.1271 10.9871C14.9504 10.7749 14.6351 10.7462 14.4229 10.923L15.0631 11.6913ZM10.5004 14.8427L10.1803 15.2268C10.3657 15.3813 10.635 15.3813 10.8205 15.2268L10.5004 14.8427ZM6.57778 10.923C6.36564 10.7462 6.05036 10.7749 5.87358 10.987C5.6968 11.1992 5.72546 11.5145 5.9376 11.6913L6.57778 10.923ZM11.0004 6.35736C11.0004 6.08122 10.7765 5.85736 10.5004 5.85736C10.2242 5.85736 10.0004 6.08122 10.0004 6.35736H11.0004ZM14.4229 10.923L10.1803 14.4586L10.8205 15.2268L15.0631 11.6913L14.4229 10.923ZM10.8205 14.4586L6.57778 10.923L5.9376 11.6913L10.1803 15.2268L10.8205 14.4586ZM11.0004 14.8427V6.35736H10.0004V14.8427H11.0004ZM16.9351 17.0347C13.3813 20.5884 7.61949 20.5884 4.06572 17.0347L3.35861 17.7418C7.30291 21.6861 13.6979 21.6861 17.6422 17.7418L16.9351 17.0347ZM4.06572 17.0347C0.511948 13.4809 0.511948 7.7191 4.06572 4.16533L3.35861 3.45822C-0.585683 7.40252 -0.585683 13.7975 3.35861 17.7418L4.06572 17.0347ZM4.06572 4.16533C7.61949 0.611557 13.3813 0.611557 16.9351 4.16533L17.6422 3.45822C13.6979 -0.486074 7.30291 -0.486074 3.35861 3.45822L4.06572 4.16533ZM16.9351 4.16533C20.4888 7.7191 20.4888 13.4809 16.9351 17.0347L17.6422 17.7418C21.5865 13.7975 21.5865 7.40252 17.6422 3.45822L16.9351 4.16533Z" fill="#53B746"/></svg>
        																@endif 	
																	</a>
        															</div>
																@endforeach
															</div>
															</div>
														</div>
													</div>
													<div class="col-12 col-lg-6">
														<div class="documentation-download-item">
															<div class="documentation-download-img">
																<img src="{{asset('frontend-assets/images/file.png')}}" alt="download icon" width="50" height="50">
															</div>
															<div class="documentation-download-detail-wrap">
																<div class="documentation-download-title">Insurance documents</div>
																<div class="documentation-download-contant">(Insurance Scope, final invoice and completion doc)</div>
																<div class="documentation-download-btn-wrap text-end" style="">
    																@foreach($insurancedocuments as $insurancedocument)
    																    <div class="download-item">
																			<a href="{{route('download.file', ['filename' => $insurancedocument['filename']]) }}">
        																	@if(isset($insurancedocument) && $insurancedocument !== NULL  && $insurancedocument !== '')
            																	<div class="download-item-img-title-wrap">
                																	@php
                    																	$filename = explode("/", $insurancedocument['filename']);
                    																	$ext = pathinfo($insurancedocument['filename'], PATHINFO_EXTENSION);
                																	@endphp
                																	@if($ext == 'jpg' || $ext == 'jpeg')
                																	    <img src="{{asset('frontend-assets/images/image_icon.png')}}" style="width:30px;margin-right:10px;"/>
                																	@elseif($ext == 'doc')
                																	    <img src="{{asset('frontend-assets/images/doc_icon.png')}}" style="width:30px;margin-right:10px;"/>
                																	@else
                																	    <img src="{{asset('frontend-assets/images/doc_icon.jpg')}}" style="width:30px;margin-right:10px;"/>
                																	@endif
                																	<div class="file-name" > {{$filename[1]??''}}</div>
                																</div>
																				<div class="file-date">{{$insurancedocument['filedate']??''}}</div>
                																<svg width="25" height="25" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.0631 11.6913C15.2753 11.5145 15.3039 11.1992 15.1271 10.9871C14.9504 10.7749 14.6351 10.7462 14.4229 10.923L15.0631 11.6913ZM10.5004 14.8427L10.1803 15.2268C10.3657 15.3813 10.635 15.3813 10.8205 15.2268L10.5004 14.8427ZM6.57778 10.923C6.36564 10.7462 6.05036 10.7749 5.87358 10.987C5.6968 11.1992 5.72546 11.5145 5.9376 11.6913L6.57778 10.923ZM11.0004 6.35736C11.0004 6.08122 10.7765 5.85736 10.5004 5.85736C10.2242 5.85736 10.0004 6.08122 10.0004 6.35736H11.0004ZM14.4229 10.923L10.1803 14.4586L10.8205 15.2268L15.0631 11.6913L14.4229 10.923ZM10.8205 14.4586L6.57778 10.923L5.9376 11.6913L10.1803 15.2268L10.8205 14.4586ZM11.0004 14.8427V6.35736H10.0004V14.8427H11.0004ZM16.9351 17.0347C13.3813 20.5884 7.61949 20.5884 4.06572 17.0347L3.35861 17.7418C7.30291 21.6861 13.6979 21.6861 17.6422 17.7418L16.9351 17.0347ZM4.06572 17.0347C0.511948 13.4809 0.511948 7.7191 4.06572 4.16533L3.35861 3.45822C-0.585683 7.40252 -0.585683 13.7975 3.35861 17.7418L4.06572 17.0347ZM4.06572 4.16533C7.61949 0.611557 13.3813 0.611557 16.9351 4.16533L17.6422 3.45822C13.6979 -0.486074 7.30291 -0.486074 3.35861 3.45822L4.06572 4.16533ZM16.9351 4.16533C20.4888 7.7191 20.4888 13.4809 16.9351 17.0347L17.6422 17.7418C21.5865 13.7975 21.5865 7.40252 17.6422 3.45822L16.9351 4.16533Z" fill="#53B746"/></svg>
        																	@endif
																		</a>
        																</div>
    																@endforeach
																</div>
															</div>
														</div>
													<!-- </div>
													<div class="col-12 col-lg-6"> -->
														<div class="documentation-download-item">
															<div class="documentation-download-img">
																<img src="{{asset('frontend-assets/images/file.png')}}" alt="download icon" width="50" height="50">
															</div>
															<div class="documentation-download-detail-wrap">
																<div class="documentation-download-title">Insurance documents</div>
																<div class="documentation-download-contant">(Insurance Scope, final invoice and completion doc)</div>
																<div class="documentation-download-btn-wrap text-end" style="">
																@foreach($mortgagedocuments as $mortgagedocument)
																	<div class="download-item">
																		<a href="{{route('download.file', ['filename' => $mortgagedocument['filename']]) }}">
																		@if(isset($mortgagedocument) && $mortgagedocument !== NULL && $mortgagedocument !== '')
																			<div class="download-item-img-title-wrap">
																				@php
																					$filename = explode("/",$mortgagedocument['filename']);
																					$ext = pathinfo($mortgagedocument['filename'], PATHINFO_EXTENSION);
																				@endphp
			
																				@if($ext == 'jpg' || $ext == 'jpeg')
																					<img src="{{asset('frontend-assets/images/image_icon.png')}}" style="width:30px;margin-right:10px;"/>
																					@elseif($ext == 'doc')
																					<img src="{{asset('frontend-assets/images/doc_icon.png')}}" style="width:30px;margin-right:10px;"/>
																				@else
																					<img src="{{asset('frontend-assets/images/doc_icon.jpg')}}" style="width:30px;margin-right:10px;"/>
																				@endif
																				<div class="file-name">{{$filename[1]}}</div>
																			</div>
																			<div class="file-date">{{$mortgagedocument['filedate']}}</div>
																			<svg width="25" height="25" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.0631 11.6913C15.2753 11.5145 15.3039 11.1992 15.1271 10.9871C14.9504 10.7749 14.6351 10.7462 14.4229 10.923L15.0631 11.6913ZM10.5004 14.8427L10.1803 15.2268C10.3657 15.3813 10.635 15.3813 10.8205 15.2268L10.5004 14.8427ZM6.57778 10.923C6.36564 10.7462 6.05036 10.7749 5.87358 10.987C5.6968 11.1992 5.72546 11.5145 5.9376 11.6913L6.57778 10.923ZM11.0004 6.35736C11.0004 6.08122 10.7765 5.85736 10.5004 5.85736C10.2242 5.85736 10.0004 6.08122 10.0004 6.35736H11.0004ZM14.4229 10.923L10.1803 14.4586L10.8205 15.2268L15.0631 11.6913L14.4229 10.923ZM10.8205 14.4586L6.57778 10.923L5.9376 11.6913L10.1803 15.2268L10.8205 14.4586ZM11.0004 14.8427V6.35736H10.0004V14.8427H11.0004ZM16.9351 17.0347C13.3813 20.5884 7.61949 20.5884 4.06572 17.0347L3.35861 17.7418C7.30291 21.6861 13.6979 21.6861 17.6422 17.7418L16.9351 17.0347ZM4.06572 17.0347C0.511948 13.4809 0.511948 7.7191 4.06572 4.16533L3.35861 3.45822C-0.585683 7.40252 -0.585683 13.7975 3.35861 17.7418L4.06572 17.0347ZM4.06572 4.16533C7.61949 0.611557 13.3813 0.611557 16.9351 4.16533L17.6422 3.45822C13.6979 -0.486074 7.30291 -0.486074 3.35861 3.45822L4.06572 4.16533ZM16.9351 4.16533C20.4888 7.7191 20.4888 13.4809 16.9351 17.0347L17.6422 17.7418C21.5865 13.7975 21.5865 7.40252 17.6422 3.45822L16.9351 4.16533Z" fill="#53B746"/></svg>
																		@endif
																		</a>
																	</div>
																@endforeach
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											@endif
											{{-- end Documentation section --}}

										</div>
									</div>
								</div>
							</div>
						</div>
					{{-- End Design studio  --}}


                        {{-- quotation code --}}
						<!-- new aded -->
						@php
						$quotationStatus = \App\Models\Quotation::select('status')
							->where('contractor_id', auth()->guard('contractor')->user()->id)
							->where('project_id', $projectinfo->id)
							//->whereHas('quoteItems')
							->where('status','!=',NULL)
							->orderBy('id', 'DESC')
							->first();
						@endphp
						
						<div class="tab-pane fade" id="view-quotes-tab-pane" role="tabpanel" aria-labelledby="view-quotes-tab" tabindex="0">
						    @if(isset($quotationStatus))
							@if($quotationStatus->status == 'rejected')
							<div class="row justify-content-center mb-5">
								@if ($quotationStatus && $quotationStatus->status == 'rejected')
									<div class="quotes-request-btn-wrap col-md-6 col-lg-4">
										<a class="btn-primary d-block" id="sendnewQuote">Send a new quote</a>
									</div>
								@endif
							</div>
							@endif
							@endif 
							<div class="container">
								<div class="row">
									<div class="col-12">
										<div class="btn-gallery-filter-wrap text-center">
											<button class="btn btn-outline-primary btn-gallery-filter active" data-category="all">All</button>
											<button class="btn btn-outline-primary btn-gallery-filter" data-category="approved">Approved</button>
											<button class="btn btn-outline-primary btn-gallery-filter" data-category="requested">Requested</button>
											<button class="btn btn-outline-primary btn-gallery-filter" data-category="responded">Responded</button>
											<button class="btn btn-outline-primary btn-gallery-filter" data-category="rejected">Rejected</button>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
							@if(isset($quotations))
								@foreach($quotations as $quotation)
								<div class="col-12 col-md-6 col-lg-4 item" data-category="{{$quotation->status??''}}">
									<div class="quotation-wrap">
										<div class="quotes-detail-item-title">Quotation  No: {{$quotation->id??''}}</div>
										<div class="quotes-detail-item-dates">
											<svg class="me-2" width="16" height="19" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.77148 1.35645V3.75645" stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M11.1719 1.35645V3.75645" stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M1.17188 7.02832H14.7719" stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M15.1715 6.55664V13.3566C15.1715 15.7566 13.9715 17.3566 11.1715 17.3566H4.77148C1.97148 17.3566 0.771484 15.7566 0.771484 13.3566V6.55664C0.771484 4.15664 1.97148 2.55664 4.77148 2.55664H11.1715C13.9715 2.55664 15.1715 4.15664 15.1715 6.55664Z" stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M10.9278 10.7164H10.935" stroke="#0A84FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M10.9278 13.1163H10.935" stroke="#0A84FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M7.96787 10.7164H7.97506" stroke="#0A84FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M7.96787 13.1163H7.97506" stroke="#0A84FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M5.00693 10.7164H5.01412" stroke="#0A84FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M5.00693 13.1163H5.01412" stroke="#0A84FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
											<strong>{{ \Carbon\Carbon::parse($quotation->created_at??'')->format('d M Y, D') }}</strong>
										</div>
										
										<div class="quotation-info-item">
											<div class="quotation-info-item-title">Quoted price: </div>
											<div class="quotation-info-item-detail"><span class="price-tag">${{$quotation->final_price??''}}</span></div>
										</div>
										<div class="quotation-info-item">
											<div class="quotation-info-item-title">Status: </div>
											<div class="quotation-info-item-detail">
																	@if($quotation->status == 'Requested')
																	<div class="quotes-detail-item-content"><span class="requested-status-tag">Requested for quote</span></div>
																	@elseif($quotation->status == 'Responded')
																	<div class="quotes-detail-item-content"><span class="requested-status-tag">Responded</span></div>
																	
																	@elseif($quotation->status == 'approved')
																	<div class="quotes-detail-item-content"><span class="price-tag">Approved</span></div>
																	@elseif($quotation->status == 'rejected')

																	<div class="quotes-detail-item-content"><span class="rejected-status-tag">Rejected</span></div>
																	@endif
											</div>
										</div>
										<div class="quotation-info-item">
							@php
							$projectData = \App\Models\Project::where('id',$quotation->project_id??'')->first();
							$userData = \App\Models\User::where('id',$projectData->user_id??'')->first();
							@endphp
							<input type="hidden" value="{{$userData->id??''}}" name="customerid" id="customerid">
																	<input type="hidden" value="{{auth()->guard('contractor')->user()->id??''}}" id="contractorid">
																

											<div class="quotation-info-item-title">Call: </div>
											<div class="quotation-info-item-detail">{{$userData->contact_number??''}}</div>
										</div>
										<div class="quotation-info-item">
											<div class="quotation-info-item-title">Email: </div>
											<div class="quotation-info-item-detail">{{$userData->email??''}}</div>
										</div>
										@if(isset($quotation->rejection_reason))
										<div class="quotation-info-item">
											<div class="quotation-info-item-title">Description: </div>
											<div class="quotation-info-item-detail">
												{{--I can't afford this price. Please call us for further discussion--}}
												{{$quotation->rejection_reason??''}}
											</div>
										</div>
										@endif
										<div class="quotation-btn-wrap">
												@if($quotation->status == 'Requested')
												<div class="quotes-request-btn-wrap">
													<a class="btn-primary d-block btn-approved" href="{{route('send.quotation.view',base64_encode($quotation->id))}}">Send a quote</a>
												</div>
												@elseif($quotation->status == 'Responded')
													<div class="quotes-request-btn-wrap">
														<a class="btn-primary d-block btn-approved" href="{{route('preview.quotation',base64_encode($quotation->id))}}">View quotation</a>
													</div>
												@elseif($quotation->status == 'approved')
												<div class="quotes-request-btn-wrap">
														<a class="btn-primary d-block btn-approved" href="{{route('preview.quotation',base64_encode($quotation->id))}}">View quotation</a>
													</div>
													@elseif($quotation->status == 'rejected')
													<div class="quotes-request-btn-wrap">
														<a class="btn-primary d-block btn-approved" href="{{route('preview.quotation',base64_encode($quotation->id))}}">View quotation</a>
													</div>
												@endif
										</div>
									</div>
								</div>
								@endforeach
							@endif

							</div>
						</div>
						<!-- end added new old code  -->

					</div>
				</div>
			</div>
		</div>
	</section>

	{{-- Modal --}}

	
{{-- notes popup --}}
<div class="modal fade sendquotepopup" id="details_page_popup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    <div class="d-flex">
                        <div style="font-size:17px;">
                            <span id="date_added"></span> 
                            &nbsp;,&nbsp;
                            <span id="time_added"></span>
                            &nbsp;&nbsp;<span> By</span>&nbsp;
                            <span id="added_by_name"></span>
                        </div>
                    </div>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <div id="media-display">
                            <!-- Media content goes here -->
                        </div>
                    </div>
					<div class="col-md-4 mt-3 mt-md-0">
						<div id="media-description">
							 <div id="notes-container">
								 <!-- Notes content goes here -->
							 </div>
						 </div>
					 </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- end details page popup --}}

<!-- design studio popup start  -->
<div class="modal fade sendquotepopup designstudiopopup" id="designstudiopopup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabeltitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title" id="staticBackdropLabeltitle">Design Studio
					<p class="notes-pop">(You can upload up to 15 files at a time)</p>
					{{-- <p class="notes-pop"></p> --}}
				</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
				<form method="post" enctype="multipart/form-data" id="image-upload" class="dropzone">
					<!-- Other form fields... -->
					<div class="row">
						<div class="form-group col-12 col-md-12">
							@php
							$data = base64_encode($projectinfo->id);
							@endphp
							<input type="hidden" name="project_id" value="{{$data}}" id="project_id">
							@csrf
						</div>
					</div>
				</form>
				<span id="error-message" style="color: red;"></span>

				<div id="uploaded-images">
					<?php
					$projectData = \App\Models\Project::findOrFail($projectinfo->id);
					$imageArray = json_decode($projectData->project_image, true);
					?>
				</div>

				<!-- Other form fields... -->
				<div class="row justify-content-center mt-4">
					<div class="form-group button-wrap col-md-5 mb-0">
						<div class="field-wrap text-center">
							<button type="submit" align="center" id="submit-all" class="btn btn-primary btn-studio-step-1">Submit and continue</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- design studio popup end  -->
@endsection

@section('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

{{-- date range picker --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

{{--end  date range picker --}}




<script type="text/javascript">
 // general info update 
    $(document).ready(function(e){
//   $('#editinfo').on('click', function() {
//         $('#general-info-wrap').hide();  
//         $('#editable-form-wrap').show();  
//     });

//     $('#edit-form').on('submit', function(e) {
//         e.preventDefault(); 

//         let isValid = true;
        
//         $('input, textarea').removeClass('invalid');
        
//         $('#customer_name, #address, #contact_number, #title, #edit-form textarea').each(function() {
// 			if ($(this).val().trim() === '') {
// 				$(this).addClass('invalid');
// 				isValid = false;
// 			}
// 		});

//         if (!isValid) {
//             return;
//         }
//         let formData = $(this).serialize(); 
//         let url = '{{-- route("update.projectinfo", $projectinfo->id) --}}'; 

//         $.ajax({
//             url: url,
//             type: 'POST',
//             data: formData,
//             success: function(response) {
//                 if (response.success) {
//                     $('#name-detail').text(response.projectinfo.title);
//                     $('#phone-detail').text(response.projectinfo.phone);
//                     $('#address-detail').text(response.projectinfo.address);
//                     $('#customer_name_details').text(response.projectinfo.customer_name);
//                     if (response.projectinfo.insurance_company !== null) {

//                         $('#insurance-company-detail').text(response.projectinfo.insurance_company);
//                     }else{
// 						$('.insurance-company-detail').addClass('d-none');

// 					}
//                     if (response.projectinfo.insurance_agency !== null) {
//                         $('#insurance-agency-detail').text(response.projectinfo.insurance_agency);
//                     }else{
// 						$('#insurance-agency-detail').text('');

// 					}
//                     if (response.projectinfo.billing !== null) {
//                         $('#billing-detail').text(response.projectinfo.billing);
//                     }else{
// 						$('#billing-detail').text('');
// 					}
//                     if (response.projectinfo.mortgage_company !== null) {
//                         $('#mortgage-company-detail').text(response.projectinfo.mortgage_company);
//                     }else{
// 						$('#mortgage-company-detail').text('');

// 					}

//                     $('#editable-form-wrap').hide();
//                     $('#general-info-wrap').show();
//                 } else {
//                     alert('Error updating project details');
//                 }
//             },
//             error: function(xhr, status, error) {
//                 alert('An error occurred: ' + error);
//             }
//         });
//     });

//     // Remove red border when user key pressed
//     $('#edit-form input, #edit-form textarea').on('input', function() {
//         if ($(this).val().trim() !== '') {
//             $(this).removeClass('invalid'); 
//         }
//     });


 // Toggle edit form visibility
//  $('#editinfo').on('click', function() {
//             $('#general-info-wrap').hide();  
//             $('#editable-form-wrap').show();  
//         });

//         // Form submit handler for updating project info
//         $('#edit-form').on('submit', function(e) {
//             e.preventDefault(); 

//             let isValid = true;
//             $('input, textarea').removeClass('invalid');

//             $('#customer_name, #address, #contact_number, #title, #edit-form textarea').each(function() {
//                 if ($(this).val().trim() === '') {
//                     $(this).addClass('invalid');
//                     isValid = false;
//                 }
//             });

// 			 // Additional Customer Name validation: No digits allowed
// 			 const customerName = $('#customer_name').val().trim();
//         if (customerName && /\d/.test(customerName)) {
//             $('#customer_name').addClass('invalid');
//             isValid = false;
//             // alert('Customer Name cannot contain digits');
//         }

//         // Additional Contact Number validation: Only numbers allowed
//         const contactNumber = $('#contact_number').val().trim();
//         if (contactNumber && !/^\d+$/.test(contactNumber)) {
//             $('#contact_number').addClass('invalid');
//             isValid = false;
//             // alert('Contact Number must be a valid number');
//         }


//             if (!isValid) {
//                 return;
//             }

//             let formData = $(this).serialize(); 
//             let url = '{{-- route("update.projectinfo", $projectinfo->id) --}}'; 

//             $.ajax({
//                 url: url,
//                 type: 'POST',
//                 data: formData,
//                 success: function(response) {
//                     if (response.success) {
//                         // Update details after form submission
//                         $('#name-detail').text(response.projectinfo.title);
//                         $('#phone-detail').text(response.projectinfo.phone);
//                         $('#address-detail').text(response.projectinfo.address);
//                         $('#customer_name_details').text(response.projectinfo.customer_name);

//                         // Conditionally show/hide details based on response
//                         toggleDetailField('#insurance-company-detail', response.projectinfo.insurance_company);
//                         toggleDetailField('#insurance-agency-detail', response.projectinfo.insurance_agency);
//                         toggleDetailField('#billing-detail', response.projectinfo.billing);
//                         toggleDetailField('#mortgage-company-detail', response.projectinfo.mortgage_company);

//                         // Hide the editable form and show the general info
//                         $('#editable-form-wrap').hide();
//                         $('#general-info-wrap').show();
//                     } else {
//                         alert('Error updating project details');
//                     }
//                 },
//                 error: function(xhr, status, error) {
//                     alert('An error occurred: ' + error);
//                 }
//             });
//         });

//         // Function to show/hide fields if data is missing
//         function toggleDetailField(selector, value) {
//             if (!value) {
//                 $(selector).parent().addClass('d-none');
//             } else {
//                 $(selector).parent().removeClass('d-none');
//                 $(selector).text(value);
//             }
//         }

//         // Remove red border when user keys pressed
//         $('#edit-form input, #edit-form textarea').on('input', function() {
//             if ($(this).val().trim() !== '') {
//                 $(this).removeClass('invalid'); 
//             }
//         });

//         // Initial check to hide empty fields on page load
//         checkEmptyFields();

//         function checkEmptyFields() {
//             // Check if initial data is missing and hide elements
//             toggleDetailField('#insurance-company-detail', '{{$projectinfo->insurance_company}}');
//             toggleDetailField('#insurance-agency-detail', '{{$projectinfo->insurance_agency}}');
//             toggleDetailField('#billing-detail', '{{$projectinfo->billing}}');
//             toggleDetailField('#mortgage-company-detail', '{{$projectinfo->mortgage_company}}');
//         }
//     // });
// });


  $('#editinfo').on('click', function() {
        $('#general-info-wrap').hide();  
        $('#editable-form-wrap').show();  
    });

    $('#edit-form').on('submit', function(e) {
        e.preventDefault(); 

        let isValid = true;
        $('input, textarea').removeClass('invalid');
        $('.error-message').text(''); 

        $('#customer_name, #address, #contact_number, #title, #edit-form textarea').each(function() {
            if ($(this).val().trim() === '') {
                $(this).addClass('invalid');
                isValid = false;
            }
        });

        const customerName = $('#customer_name').val().trim();
		// alert(customerName);
        if (customerName && /\d/.test(customerName)) {
            $('#customer_name').addClass('invalid');
            $('#customer_name_error').text('Customer Name cannot contain digits');
            isValid = false;
        }

		
        // const contactNumber = $('#contact_number').val().trim();
        // if (contactNumber && !/^\d+$/.test(contactNumber)) {
        //     $('#contact_number').addClass('invalid');
        //     $('#contact_number_error').text('Contact Number must be a valid number');
        //     isValid = false;
        // }



        if (!isValid) {
            return;
        }

        let formData = $(this).serialize(); 
        let url = '{{ route("update.projectinfo", $projectinfo->id) }}'; 

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#name-detail').text(response.projectinfo.title);
                    $('#phone-detail').text(response.projectinfo.phone);
                    $('#address-detail').text(response.projectinfo.address);
                    $('#customer_name_details').text(response.projectinfo.customer_name);

                    toggleDetailField('#insurance-company-detail', response.projectinfo.insurance_company);
                    toggleDetailField('#insurance-agency-detail', response.projectinfo.insurance_agency);
                    toggleDetailField('#billing-detail', response.projectinfo.billing);
                    toggleDetailField('#mortgage-company-detail', response.projectinfo.mortgage_company);

                    $('#editable-form-wrap').hide();
                    $('#general-info-wrap').show();
                } else {
                    alert('Error updating project details');
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred: ' + error);
            }
        });
    });

    function toggleDetailField(selector, value) {
        if (!value) {
            $(selector).parent().addClass('d-none');
        } else {
            $(selector).parent().removeClass('d-none');
            $(selector).text(value);
        }
    }

    $('#edit-form input, #edit-form textarea').on('input', function() {
        if ($(this).val().trim() !== '') {
            $(this).removeClass('invalid'); 
            $(this).next('.error-message').text(''); 
        }
    });

    checkEmptyFields();

    function checkEmptyFields() {
        toggleDetailField('#insurance-company-detail', '{{$projectinfo->insurance_company}}');
        toggleDetailField('#insurance-agency-detail', '{{$projectinfo->insurance_agency}}');
        toggleDetailField('#billing-detail', '{{$projectinfo->billing}}');
        toggleDetailField('#mortgage-company-detail', '{{$projectinfo->mortgage_company}}');
    }
});
    // $('#editinfo').on('click', function() {
    //     $('#general-info-wrap').hide();  
    //     $('#editable-form-wrap').show();  
    // });

    // $('#edit-form').on('submit', function(e) {
    //     e.preventDefault();

    //     let formData = $(this).serialize(); 
    //     let url = '{{-- route("update.projectinfo", $projectinfo->id) --}}'; 

    //     $.ajax({
    //         url: url,
    //         type: 'POST',
    //         data: formData,
    //         success: function(response) {
    //             if(response.success) {
    //                 $('#name-detail').text(response.projectinfo.title);
    //                 $('#phone-detail').text(response.projectinfo.phone);
    //                 $('#address-detail').text(response.projectinfo.address);
	// 				$('#customer_name').text(response.projectinfo.customer_name);
	// 			   if(response.projectinfo.insurance_company) {
    //                     $('#insurance-company-detail').text(response.projectinfo.insurance_company);
    //                 }
    //                 if(response.projectinfo.insurance_agency) {
    //                     $('#insurance-agency-detail').text(response.projectinfo.insurance_agency);
    //                 }
    //                 if(response.projectinfo.billing) {
    //                     $('#billing-detail').text(response.projectinfo.billing);
    //                 }
    //                 if(response.projectinfo.mortgage_company) {
    //                     $('#mortgage-company-detail').text(response.projectinfo.mortgage_company);
    //                 }

    //                 $('#editable-form-wrap').hide();
    //                 $('#general-info-wrap').show();
    //             } else {
    //                 alert('Error updating project details');
    //             }
    //         },
    //         error: function(xhr, status, error) {
    //             alert('An error occurred: ' + error);
    //         }
    //     });
    // });
// });

    // document.addEventListener('DOMContentLoaded', function () {
    //         const editButton = document.getElementById('editgeneralinfo'); // Assuming there's only one edit button
    //         const formSection = document.getElementById('generalinfo-form');
    //         const displayInfoSection = document.getElementById('displayinfo');
            
    //         // editButton.addEventListener('click', function () {
    //         //     formSection.style.display = 'block'; // Show the form
    //         //     displayInfoSection.style.display = 'none'; // Hide the display info
    //         // });
    
    
    //         $('#editgeneralinfo').on('click', function () {
    //             $('#displayinfo').addClass('d-none');
    //             $('#generalinfo-form').removeClass('d-none');
    //             $('#generalinfo-form').addClass('d-block');
    //             $('#editgeneralinfo').addClass('d-none');
    //             // alert(':in');
    //         })
    //         const form = document.getElementById('addproject');
    //         form.addEventListener('submit', function (event) {
    //             event.preventDefault(); 
    
    //             const formData = new FormData(form);
    //             fetch(form.action, {
    //                 method: 'POST',
    //                 body: formData,
    //                 headers: {
    //                     'X-CSRF-TOKEN': '{{ csrf_token() }}' 
    //                 }
    //             })
    //             .then(response => response.json())
    //             .then(data => {
    //                 if (data.success) {
    //                     document.querySelector('.general-info-item-detail').innerText = data.projectinfo.title;
                        
    //                     formSection.style.display = 'none';
    //                     displayInfoSection.style.display = 'block';
    //                 } else {
    //                 }
    //             })
    //             .catch(error => console.error('Error:', error));
    //         });
    
    //     });
    // // end general info update
    
    
    
    // $('#nav-quotation-tab').on('click', function(e){
    
    // });
    // function filterGallery(category) {
    
    // 	var category = $(this).attr('data-category');
    // 	alert(category)
    // 		$('.btn-gallery-filter').removeClass('active');
    // 		$(this).addClass('active');
    // 		if (category == 'all') {
    // 			$('.item').removeClass('hide');
    // 		} else {
    // 			$('.item').removeClass('hide').filter(':not([data-category*="' + category + '"])').addClass('hide');
    // 		}
    //     // console.log('Selected category:', category);
    // }
    function filterGallery(selectedValue) {
        var category = selectedValue; 
    
    if (category == 'all') {
            $('.item').removeClass('hide');
        } else {
            $('.item').removeClass('hide').filter(':not([data-category*="' + category + '"])').addClass('hide');
        }
    
    }
    
        // when design studio tab is active at that time display a filter and add button 
        document.addEventListener('DOMContentLoaded', function() {
        const addButton = document.querySelector('a[data-bs-target="#designstudiopopup"]');
        const filterButton = document.querySelector('button#nav-filters-tab');
        const tabs = document.querySelectorAll('#nav-tab button.nav-link');
    
        function updateButtonVisibility() {
            const activeTab = document.querySelector('#nav-tab .nav-link.active');
            if (activeTab && activeTab.getAttribute('data-bs-target') === '#nav-design-studio') {
                addButton.style.display = 'inline-block';
                filterButton.style.display = 'inline-block';
            } else {
                addButton.style.display = 'none';
                filterButton.style.display = 'none';
            }
        }
        // Initial check
        updateButtonVisibility();
    
        // Update visibility on tab change
        tabs.forEach(tab => {
            tab.addEventListener('shown.bs.tab', updateButtonVisibility);
        });
    });
            
    // dropzone initialization
    
    Dropzone.autoDiscover = false;
    
    $(document).ready(function () {
        var getname =	sessionStorage.getItem("lastname");
        if(getname){
            if(getname !== null && getname !== ''){
                $('#nav-design-studio-tab').removeClass('active');
            
                $('#nav-quotation-tab').addClass('active');
    
                $('#nav-design-studio').removeClass('active show');
    
              $('#nav-quotation-info').addClass('active show');
            }
            // $('#view-quotes-tab').trigger('click');
                 
                sessionStorage.removeItem("lastname");
        }
        var project_id = $('#project_id').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
     
        // Initialize Dropzone
            var dropzone = new Dropzone('#image-upload', {
                thumbnailWidth: 200,
                url: "{{ route('test') }}",
                maxFilesize: 200,
                // createImageThumbnails:true,
                addRemoveLinks: true, 
                // acceptedFiles: ".jpeg,.jpg,.png,.gif,.mp4",
                acceptedFiles: ".jpeg,.jpg,.png,.gif,.mp4,.heic,.heif",
                dictRemoveFile: "Remove file",
                parallelUploads:5,
                uploadMultiple: true,
                headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
    
                init: function () {
                    loadExistingImages(this);
    
                    this.on("removedfile", function (file) {
                        //if (confirm("Are you sure you want to delete this image?")) {
                            var fileName = file.name;
                            console.log(fileName);
                            removeImageFromServer(fileName);
                        //}
                    });
                }
                
            });
            
            // $('#designstudiopopup').on('click', function(){
            //         $('#designstudiopopup').modal("show");
            //         dropzone.removeAllFiles();
            //         $('#error-message').text("");
            // });
    
    
            $('#submit-all').click(function () {
                var files = dropzone.getAcceptedFiles();
                console.log(files);
    
    
                // Check if no files are selected
                //   if (files.length === 0 || existingImages.length === 0) {
                //     alert("Please select at least one image before submitting.");
                //     return;
                // }
    
                var formData = new FormData();
    
    
                for (var i = 0; i < files.length; i++) {
                    formData.append('file[]', files[i]);
                }
    
    
            if (files.length === 0) {
                displayErrorMessage("Please select at least one image before submitting.");
                return;
            }
            if (files.length > 15) {
                displayErrorMessage("You can upload a maximum of 15 images.");
                return;
            }
            showLoader();
    
                var existingImages = <?php echo json_encode($imageArray); ?> || [];
                for (var i = 0; i < existingImages.length; i++) {
                    formData.append('existing_images[]', existingImages[i]);
                }
    
    
                if (files.length === 0 && existingImages.length === 0) {
                displayErrorMessage("Please select at least one image before submitting.");
                return;
                 }
                formData.append('_token', '{{ csrf_token() }}');
    
                $.ajax({
                    type: 'POST',
                    url: "{{ route('design.studio.post.contractor', ['project_id' => '__project_id__']) }}".replace('__project_id__',btoa(project_id)),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        var project_id = response.project_id;
                        $('#error-message').text("");
    
                        $('#submit-all').text('Save and Continue');
                        // console.log(response.designstudio);
                        $('#designstudiopopup').modal('hide');
                        $('#testData').html(response.designstudio);
                        $('#designStudiotab').removeClass('d-none');
                        $('#designStudiotab').addClass('d-block');
                        //$('#designstudiopopup .dz-preview.dz-image-preview').html('');
                        // window.location.href = "{{ route('documentation', ['project_id' => '__project_id__']) }}".replace('__project_id__', project_id);
                        //dropzone.on("complete", function(file) {
                            // console.log(file);
                            //dropzone.removeFile(file);
                            
                        //});
                        // displaySuccessMessage("You are safe to leave the page. Your images are uploading in the background.");
                        displaySuccessMessage("All files uploaded successfully");
                        dropzone.removeAllFiles();
    
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
                });
    
    
    
    // function displaySuccessMessage(message) {
    //     // alert(message); 
    // 	// $('.notes-pop').text(message);
    // }
    
    function displaySuccessMessage(message) {
            $('#toast-message .toast-body').text(message);
            var toast = new bootstrap.Toast(document.getElementById('toast-message'), {
                autohide: true,
                delay: 3000
            });
            toast.show();
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
                        dropzoneInstance.emit('thumbnail', file, "{{ asset('storage/project_images/') }}" + '/' + existingImages[i]);
                    }
                }
            }
    
    
    
    
            function removeImageFromServer(fileName) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('remove.image.contractor') }}",
                    data: { file_name: fileName, project_id: project_id, _token: '{{ csrf_token() }}' },
                    success: function (response) {
                    },
                    error: function (error) {
                    }
                });
            }
    
    
            $('.remove-img').on('click', function (e) {
                e.preventDefault();
            var project_id = $('#project_id').val();
            var file = $(this).data('media-item-id'); 
            console.log(file);
            currentButton = $(this);
            // var isConfirmed = confirm('Are you sure you want to remove this file?');
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
                // if (isConfirmed) {
                    currentButton = $(this);
    
                $.ajax({
               url: "{{ route('delete.image.designstudio.contractor', ['project_id' => ':project_id', 'file' => ':file']) }}"
                    .replace(':project_id', project_id)
                    .replace(':file', file),
    
                type: 'post',
                data:{_token:'{{ csrf_token() }}'},
                success: function (response) {
                    // console.log(response);
    
                    if(response.count === 0 || response.customer_count === 0) {
                        $('#dsresetFilterButton').trigger('click');
                        $('#nav-filters-tab').trigger('click');
                    }
                    if(response.count === 0 && response.customer_count === 0){
                        $('#designStudiotab').removeClass('d-block');
                        $('#designStudiotab').addClass('d-none');
                        $('#nav-filters-tab').trigger('click');
    
                    }
                    var file = $(this).closest('media-item-id'); 
                    currentButton.closest('.design-studio-img-items').remove();
    
    
                    // $.ajax({
                    //     url: "{{route('design.studio.filter.contractor', ['project_id' => ':project_id']) }}",
                    //     type: 'POST',
                    //     data:{
                    //             _token:'{{ csrf_token() }}' ,
                    //             project_id: '{{ base64_encode($projectinfo->id) }}'
            
                    //     },
                    //     success: function(response) {
                    //         $('#testData').html(response.filterdata); 
                    //     },
                    //     error: function(xhr) {
                    //         console.error('An error occurred while fetching data.');
                    //     }
                    // });
    
                },
                error: function (error) {
                    console.error('Error deleting file:', error);
                }
            });
               }else{
                }
            });
            });
    
    
    
        });
    
    /* Video Popup */
    // jQuery(document).ready(function ($) {
    //   var popup = {
    //     // Initializer
    //     init: function() {
    //       popup.popupVideo();
    //     },
    //     popupVideo : function() {
    
    //     $('.video_model').magnificPopup({
    //     type: 'iframe',
    //     mainClass: 'mfp-fade',
    //     removalDelay: 160,
    //     preloader: false,
    //     fixedContentPos: false,
    //     gallery: {
    //           enabled:true
    //         }
    //   });
    
    // /* Image Popup*/ 
    //  $('.gallery_container').magnificPopup({
    //       delegate: 'a',
    //     type: 'image',
    //     mainClass: 'mfp-fade',
    //     removalDelay: 160,
    //     preloader: false,
    //     fixedContentPos: false,
    //     gallery: {
    //           enabled:true
    //         }
    //   });
    
    //     }
    //   };
    // });
    
    
    
       // start details page 
    let mediaImageId = null; // Variable to store the image ID
    let profileImageUrl = ''; // Variable to store the profile image URL
    
    $(document).on('click', '.clickable-image', function(e) {
        e.preventDefault();
        mediaImageId = $(this).data('image-id'); // Fixed variable scoping
        $('#details_page_popup').modal('show');
    
        $.ajax({
            url: "{{ route('design.studio.detailspage') }}",
            method: 'GET',
            data: { id: mediaImageId },
            success: function(response) {
                if (response.error) {
                    alert('Error: ' + response.error);
                    return;
                }
    
                let mediaContent;
                if (response.media_type === 'video') {
                    mediaContent = `<video id="modal-media" controls>
                                        <source src="${response.media_url}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>`;
                } else {
                    mediaContent = `<img src="${response.media_url}" id="modal-media" alt="Image" class="img-fluid">`;
                }
    
                $('#media-display').html(mediaContent);
                $('#date_added').text(response.date);
                $('#time_added').text(response.time);
                $('#imagename').text(response.project_name);
                $('#added_by_name').text(response.user_name);
    
                // Store profile image URL
                profileImageUrl = response.profile_image;
    
                if (response.notes) {
                    $('#notes-container').html(`
                        <div class="notes-wrap d-flex">
                            <div class="profile-img">
                                <img src="${profileImageUrl}" alt="Profile Image"/>
                            </div>
                            <div class="notes-details">
                                <div class="notes-text-wrp">
                                    <p id="notes-text">${response.notes}</p>
                                </div>
                                <a href="#" class="" id="edit-notes">
                                    <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.68668 2.38407L1.75165 8.66609C1.52755 8.90465 1.31068 9.37454 1.2673 9.69984L0.999827 12.042C0.90585 12.8878 1.51309 13.4662 2.35165 13.3216L4.6794 12.924C5.00471 12.8662 5.46014 12.6276 5.68424 12.3818L11.6193 6.09979C12.6458 5.01543 13.1084 3.77927 11.5108 2.2684C9.92045 0.771995 8.7132 1.29971 7.68668 2.38407Z" stroke="#A9A9A9" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M6.69482 3.43164C7.00567 5.42685 8.62497 6.95218 10.6346 7.15459" stroke="#A9A9A9" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg> Edit	
                                </a>
                            </div>
                        </div>
                    `);
                } else {
                    $('#notes-container').html(`
                      <div class="notes-wrap d-flex">
                        <div class="profile-img">
                            <img src="${profileImageUrl}" alt="Profile Image"/>
                        </div>
                        <form id="notes-form">
                            <div class="mb-3">
                                <textarea class="form-control" id="notes" rows="3" placeholder="Update your notes here"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Notes</button>
                        </form>
                    </div>
                    `);
                }
            },
            error: function(xhr) {
                alert('An error occurred while fetching media details.');
            }
        });
    });
    
    $(document).on('submit', '#notes-form', function(e) {
        e.preventDefault();
    
        let notes = $('#notes').val();
        let $notesField = $('#notes');
    
        if (notes === '') {
            $notesField.addClass('is-invalid'); // Add red border
            return;
        } else {
            $notesField.removeClass('is-invalid'); // Remove red border
        }
    
        if (!mediaImageId) {
            alert('No media item selected.');
            return;
        }
    
        $.ajax({
            url: "{{ route('save.notes') }}",
            method: 'POST',
            data: {
                notes: notes,
                _token: $('meta[name="csrf-token"]').attr('content'),
                mediaImageId: mediaImageId
            },
            success: function(response) {
                $('#notes-container').html(`
                    <div class="notes-wrap d-flex">
                            <div class="profile-img">
                                <img src="${profileImageUrl}" alt="Profile Image"/>
                            </div>
                            <div class="notes-details">
                                <div class="notes-text-wrp">
                                    <p id="notes-text">${notes}</p>
                                </div>
                                <a href="#" class="" id="edit-notes">
                                    <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.68668 2.38407L1.75165 8.66609C1.52755 8.90465 1.31068 9.37454 1.2673 9.69984L0.999827 12.042C0.90585 12.8878 1.51309 13.4662 2.35165 13.3216L4.6794 12.924C5.00471 12.8662 5.46014 12.6276 5.68424 12.3818L11.6193 6.09979C12.6458 5.01543 13.1084 3.77927 11.5108 2.2684C9.92045 0.771995 8.7132 1.29971 7.68668 2.38407Z" stroke="#A9A9A9" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M6.69482 3.43164C7.00567 5.42685 8.62497 6.95218 10.6346 7.15459" stroke="#A9A9A9" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg> Edit	
                                </a>
                            </div>
                        </div>
                    
                `);
            },
            error: function(xhr) {
                alert('An error occurred while saving notes.');
            }
        });
    });
    
    $(document).on('click', '#edit-notes', function() {
        let currentNotes = $('#notes-text').text();
        $('#notes-container').html(`
        <div class="notes-wrap d-flex">
            <div class="profile-img">
                <img src="${profileImageUrl}" alt="Profile Image"/>
            </div>
            <form id="notes-form">
                <div class="mb-3">
                    <textarea class="form-control" id="notes" rows="3" placeholder="Update your notes here">${currentNotes}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save Notes</button>
            </form>
        </div>
        `);
    });
    
    // end details page 
    
    
    $('#generalinfotab').on("click",function(){
        $('#nav-general-info').removeClass('show active');
        $('#nav-design-studio').addClass('show active');
    
        $('#nav-general-info-tab').removeClass('active');
        $('#nav-design-studio-tab').addClass('active');
    
    })
    
    $('#designStudiotab').on("click",function(){
        $('#nav-design-studio').removeClass('show active');
        $('#nav-documentation').addClass('show active');
    
    
        $('#nav-design-studio-tab').removeClass('active');
        $('#nav-documentation-tab').addClass('active');
    });
    
        function showLoader() {
            $('#submit-all').text('Uploading...');
        }
    
    
        function displayErrorMessage(message) {
            $('#error-message').text(message);
        }
    
    
    
    
        $('#sendnewQuote').on("click",function(e){
            var projectid = $('#project_id').val();
            var contractorid = $('#contractorid').val();
            var customerid = $('#customerid').val();
            e.preventDefault();
            // console.log(customerid)
    
            $.ajax({
            url: "{{ route('send.new.quote') }}",
            type: 'post',
            data: {
                _token: '{{ csrf_token() }}',
                projectid: projectid,
                customerid:customerid,
                contractorid:contractorid
            },
    
            success: function(response) {
                console.log(response)
                if(response.success == true) {
                    window.location.href = "{{ route('send.quotation.view', ['quote_id' => ':quote_id']) }}".replace(':quote_id', response.quoteid);
    
                }
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    
            
        });
    
    
        // Check the stored tab state on page load
    $(document).ready(function() {
        var activeTab = localStorage.getItem('activeTab');
        
        if (activeTab === 'design-studio') {
            // Activate the design studio tab and deactivate the general info tab
            $('#nav-general-info-tab').removeClass('active');
            $('#nav-design-studio-tab').addClass('active');
            $('#nav-general-info').removeClass('active show');
            $('#nav-design-studio').addClass('active show');
            // Clear the stored tab state
            localStorage.removeItem('activeTab');
    
        }
    });
    
    //new 
    // console.log(projectId);
    $(document).ready(function() {
    
            const detailsproject_id = $('#detailsproject_id').val();
            let userId = $('#detailsuser_id').val();;
                let role = 'customer';
    
    
                function debounce(func, wait) {
                let timeout;
                return function(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }
    
    
            function getMessageCount(userId, detailsproject_id, role) {
                axios.post('/get-message-count', {
                    userId: userId,
                    projectId: detailsproject_id,
                    role: role
                }).then(response => {
                    let messageCount = response.data.messageCount;
                    updateMessageCount(messageCount, detailsproject_id);
                }).catch(error => {
                    console.error('Error fetching message count:', error.response ? error.response.data : error);
                });
            }
    
    
            function updateMessageCount(count, detailsproject_id) {
                // console.log('Updating message count for project'+ projectId +'to'+ count);
                let messageCountElement = $('#chat-notification-contractorside-' + detailsproject_id);
                messageCountElement.text(count);
    
                if (count === 1) {
                    $('#chatnowdetails-' + detailsproject_id).load(location.href + ' #chatnowdetails-' + detailsproject_id);
                    messageCountElement.text(count);
    
                }
    
                if(count === 0){
                    $('#chatnowdetails-' + detailsproject_id).load(location.href + ' #chatnowdetails-' + detailsproject_id);
                }    
            }
    
    
    
                const debouncedGetMessageCount = debounce(() => {
                    getMessageCount(userId, detailsproject_id, role);
                }, 1000);
    
                getMessageCount(userId, detailsproject_id, role);
    
                window.Echo.channel(`update-real-time-count-contractor-side.${detailsproject_id}`)
                    .listen('UnreadMessageCountUpdated', (e) => {
                        console.log('UnreadMessageCountUpdated event received:', e);
                        updateMessageCount(e.messageCount, detailsproject_id);
                    });
    
                setInterval(() => {
                    debouncedGetMessageCount();
                }, 5000);
                
    
            });
    
    
    $(document).ready(function () {
        var start = moment().subtract(29, 'days');
        var end = moment();
        var project_id = $('#project_id').val();
    
    
        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    
            $.ajax({
             url:"{{route('design.studio.filter.contractor', ['project_id' => ':project_id']) }}",
                type: 'POST',
                data: {
                    designfilter_fromdate: start.format('MM-DD-YYYY'),
                    designfilter_todate: end.format('MM-DD-YYYY'),
                    project_id: '{{ base64_encode($projectinfo->id) }}',
                    _token:'{{ csrf_token() }}'  
                },
                success: function(response) {
                        $('#testData').html(response.filterdata);
    
                }
            });
        }
    
        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);
    
        cb(start, end);
    
        $('#nav-filters-tab').on('click', function() {
        var buttonText = $('#button-text');
        
        if (buttonText.text() === 'Filters') {
            buttonText.text('Reset');
            $('#reportrange').css('display', 'block');
        } else {
            buttonText.text('Filters');
            $('#reportrange').css('display', 'none');
            
            $.ajax({
                url: "{{route('design.studio.filter.contractor', ['project_id' => ':project_id']) }}",
                type: 'POST',
                data:{
                        _token:'{{ csrf_token() }}' ,
                        project_id: '{{ base64_encode($projectinfo->id) }}'
     
                },
                success: function(response) {
                    $('#testData').html(response.filterdata); 
                },
                error: function(xhr) {
                    console.error('An error occurred while fetching data.');
                }
            });
        }
    });
    
    



	
    
    });

	// country code script 

	
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.0/css/intlTelInput.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.0/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.8/jquery.inputmask.bundle.min.js"></script>
    

    
@endsection