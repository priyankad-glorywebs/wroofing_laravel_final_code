@extends('layouts.front.master')
@section('title', 'Design Studio')
@section('css')
{{-- for date range picker --}}
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{-- end range picker --}}  
<style>
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
	.is-invalid{border-color:red
	}@media (max-width:1199px){
	.contractor-sec .project-detail-tabs .nav-tabs{justify-content:center}
	.contractor-sec .project-detail-tabs .nav-tabs #nav-filters{margin-right:auto!important;width:100%}
	.contractor-sec .project-detail-tabs .nav-tabs #nav-filters #reportrange{margin-top:20px;max-width:320px;margin-left:auto;margin-right:auto
	}
	}@media (max-width:767px){
	#reportrange{width:100%}
	#reportrange span{font-size:12px}}
	@media (min-width:768px){#reportrange{width:auto}
	#reportrange span{font-size:14px}}
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
.clickable-image{cursor:pointer}
#media-display img,
#media-display video {
    max-width: 100%;
    max-height: 400px;
	/* border-radius:8px !important; */
}
 .btn-3{
	border-radius: 4px;
 }
 #details_page_popup.gallerypopup .modal-body {
    padding: 15px;
}

.modal-dialog {
            max-width:50%;
        }

        .modal-content {
            border-radius: 8px;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-title {
            font-size: 16px;
        }

        #media-description,
        #notes-container .form-label {
            font-size: 14px;
            color: #2c2c2e;
        }

        #notes-container textarea.form-control {
            font-size: 14px;
            color: #2c2c2e;
            height: 80px;
			border-radius: 10px;

        }

        #notes-container .btn-primary {
            font-size: 14px;
            padding: 10px;
        }

        #notes-text {
            color: #2c2c2e;
            margin-bottom: 16px;
        }

        #media-display {
            text-align: center;
        }

        #media-display img,
        #media-display video {
            max-width: 100%;
            height: auto;
        }

        .error {
            border: 1px solid red;
        }

        .clickable-image {
            cursor: pointer;
        }

        .text-truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        @media (max-width: 768px) {
            .modal-dialog {
                max-width: 100%;
            }

            #media-display img,
            #media-display video {
                max-height: 300px;
            }

            #media-description {
                font-size: 14px;
            }

            .modal-header h5 {
                font-size: 14px;
            }

            .text-truncate {
                text-overflow: ellipsis;
                white-space: normal;
            }
        }

		/* notes popup css  date 21*/
#details_page_popup #notes-text{
	border: 1px solid #ccc;
    border-radius: 10px;
    padding: 10px;
    background-color: #f5f5f5;
	margin-bottom: 5px;
}

#notes-container {
	text-align: left;
}

.profile-img {
	width: 30px;
	height: 30px;
	margin-right: 10px;
	border-radius: 50px;
}
.notes-details {
	width: 100%;
}
#edit-notes {
	color: #A9A9A9;
    font-size: 14px;
    font-weight: 700;
}
#edit-notes svg {
	margin-right: 5px;
}
#reportrange i {
	color: #53b746;
}
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
		{{--<div class="row d-lg-none mt-4">
			<div class="col-12">
				<!-- <div class="signin-notes">Request a quote</div> -->
			</div>
		</div>--}}
		<div class="row breadcrumb-title">
			<div class="col-12 col-lg-7 pb-3">
				<div class="section-title">{{$projectinfo->title??Projects}}</div>
			</div>
			{{--<div class="col-12 col-lg-5 text-end">
			</div>--}}
		</div>

		<div class="row">
			<div class="col-12">
				{{-- <ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="contractor-list-tab" data-bs-toggle="tab" data-bs-target="#contractor-list-tab-pane" type="button" role="tab" aria-controls="contractor-list-tab-pane" aria-selected="true">Project Details</button>
					</li>
					<li class="nav-item @if($quotations->isEmpty()) {{'d-none'}} @endif" role="presentation">
						<button class="nav-link" id="view-quotes-tab" data-bs-toggle="tab" data-bs-target="#view-quotes-tab-pane" type="button" role="tab" aria-controls="view-quotes-tab-pane" aria-selected="false">Quote Details</button>
					</li>
				</ul> --}}
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
                                                    $messageCount = \App\Models\Message::where('project_id',$projectinfo->id)
                                                    ->where('user_id',$projectinfo->user_id)
                                                    ->where('role','customer')
                                                    // ->where('contractor_id',Auth::user()->id)
                                                    ->where('is_read',0)
                                                    // ->where('project_id',$project->id)
                                                    ->get()
                                                    ->count();	
                                                    @endphp
												
												<div class="nav nav-tabs mb-0 justify-content-start" id="nav-tab" role="tablist">
													<button class="nav-link active" id="nav-design-studio-tab" data-bs-toggle="tab" data-bs-target="#nav-design-studio" type="button" role="tab" aria-controls="nav-design-studio" aria-selected="true"><img src="{{asset('frontend-assets/images/ProjectDetails/home_green.svg')}}">
														&nbsp;Design studio</button>
                                                    <button class="nav-link" id="nav-general-info-tab" data-bs-toggle="tab" data-bs-target="#nav-general-info" type="button" role="tab" aria-controls="nav-general-info" aria-selected="false"><img src="{{asset('frontend-assets/images/ProjectDetails/General Info.svg')}}">
														&nbsp;General Info</button>
													<button class="nav-link" id="nav-documentation-tab" data-bs-toggle="tab" data-bs-target="#nav-documentation" type="button" role="tab" aria-controls="nav-documentation" aria-selected="false"><img src="{{asset('frontend-assets/images/ProjectDetails/documentation.svg')}}">
														&nbsp;Documentation</button>
													{{-- <button class="nav-link" id="view-quotes-tab" data-bs-toggle="tab" data-bs-target="#view-quotes-tab-pane" type="button" role="tab" aria-controls="view-quotes-tab-pane" aria-selected="false">Quote Details</button> --}}
													{{-- <a class="nav-link" href="{{URL('contractor/chat-customer-board/'.base64_encode($projectinfo->id).'/'.base64_encode($projectinfo->user_id))}}">
														<span class="position-relative" id="chatnowdetails-{{$projectinfo->id??''}}">
															@if($messageCount > 0)<span  id="chat-notification-contractorside-{{$projectinfo->id}}"></span>@endif

														<img class="chat-icon" src="{{asset('frontend-assets/images/chat_icon.svg')}}"></span> Chat now
													</a> --}}

													<a class="nav-link" href="{{URL('contractor/chat-customer-board/'.base64_encode($projectinfo->id).'/'.base64_encode($projectinfo->user_id))}}">
														<span class="position-relative" id="chatnowdetails-{{$projectinfo->id??''}}">
															{{-- <img class="chat-icon" src="{{asset('frontend-assets/images/chat_icon.svg')}}"> --}}
														<img class="chat-icon" src="{{asset('frontend-assets/images/ProjectDetails/chat.svg')}}">
														@if($messageCount > 0)
															<span class="chat-notification" d="chat-notification-contractorside-{{$projectinfo->id}}">{{ $messageCount }}</span>
														@endif
														</span>
														Chat now  
													</a>

													{{-- <li class="nav-item @if($quotations->isEmpty()) {{'d-none'}} @endif" role="presentation"> --}}
														<a class="@if($quotations->isEmpty()) {{'d-none'}} @endif" role="presentation">
														<button class="nav-link" id="view-quotes-tab" data-bs-toggle="tab" data-bs-target="#view-quotes-tab-pane" type="button" role="tab" aria-controls="view-quotes-tab-pane" aria-selected="false">
															<img class="btn-hover-icon-data" src="{{asset('frontend-assets/images/ProjectDetails/General Info.svg')}}" style="width:25px;">&nbsp;
															&nbsp; Quote Details</button>
													{{-- </li> --}}</a>

                                                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#designstudiopopup">
														{{-- <img class="btn-normal-icon" src="{{asset('frontend-assets/images/upload_photos.webp')}}" style="width:30px;"/>  upload_photos-ezgif.gif--}}
														<img class="btn-hover-icon-data" src="{{asset('frontend-assets/images/ProjectDetails/gallery-add.svg')}}" style="width:25px;">&nbsp;
													Add</a>
									
													<button class="nav-link" id="nav-filters-tab" >
													{{-- <img class="btn-hover-icon-data" src="{{asset('frontend-assets/images/filter_design_studio.gif')}}" style="">&nbsp; --}}
												<img class="btn-hover-icon-data" src="{{asset('frontend-assets/images/ProjectDetails/Filter.svg')}}" style="">&nbsp;
													<span id="button-text">Filters</span></button>

													<div class="ms-auto position-absolute end-0 mt-2" id="nav-filters">
														<div id="reportrange" class="text-nowrap" style="display: none;">
															<i class="fa fa-calendar" ></i>&nbsp;
															<span></span> <i class="fa fa-caret-down"></i>
														</div>
													</div>


													
												
												</div>

												

										</nav>

										<div class="tab-content" id="project-detail-nav">
											<div class="tab-pane fade show active" id="nav-design-studio" role="tabpanel" aria-labelledby="nav-design-studio-tab" tabindex="0">
													{{--<div class="row">
														<div class="col-12">
															<div class="section-subtitle mb-4">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</div>
														</div>
													</div>--}}
												<div class="row">

                                                    {{-- <div class="tab-pane fade col-12 col-md-6 col-lg-4" id="nav-filters" role="tabpanel" aria-labelledby="nav-filters-tab">
                                                        <div id="reportrange" class="col-3">
                                                            <i class="fa fa-calendar" ></i>&nbsp;
                                                            <span></span> <i class="fa fa-caret-down"></i>
                                                        </div>
                                                    </div> --}}

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
												{{-- old code <div class="row">
															@if(isset($images) && is_array($images) && count($images) > 0)
															@foreach($images as $img)
															<div class="col-6 col-md-4 col-lg-3">
														     <div class="project-detail-photos-item">
																@if(is_video_file($img))
																<a class="image-gallery-popup" href="{{ $img }}">
																	<video width="170" height="150" controls>
																		<source src="{{ asset('storage/project_images/'.$img) }}" type="video/mp4">
																		Your browser does not support the video tag.
																	</video>
																</a>
																
																@else
																<div class="project-detail-photos-item-img">
																	<img src="{{ asset('storage/project_images/'.$img) }}" alt="project-photos" width="270" height="230">
																</div>
															@endif
															</div>
													        </div>
															@endforeach
															@endif
												</div>--}}

									
										
					{{-- <form id="filterForm"  method="post">
						@csrf
						<div class="row">
							<div class="col-md-3">
								<label for="design-filter">From Date:</label>
								<input type="text" id="design-filter_todate" name="design-filter" placeholder="Select Date" required>
							</div>
							<div class="col-md-3">
								<label for="design-filter">To Date:</label>
								<input type="text" id="design-filter_fromdate" name="design-filter" placeholder="Select Date" required>
							</div>
							<div class="col-md-2">
								<br/>
								<input type="button" class="btn-primary" value="Filter" id="dsfilterButton">
							</div>
							<div class="col-md-2">
								<br/>
								<input type="button" class="btn-primary" value="Reset Filter" id="dsresetFilterButton">
							</div>
							<div class="col-md-2">
									<a class="btn-primary mt-3" href="#" data-bs-toggle="modal" data-bs-target="#designstudiopopup">
									<img class="btn-normal-icon" src="{{asset('frontend-assets/images/upload_photos.webp')}}" style="width:30px;"/> 
									<img class="btn-hover-icon" src="{{asset('frontend-assets/images/upload_photos-ezgif.gif')}}" style="width:30px;">
								Add</a>
								<br/>
							</div>
						</div>
						<br/> --}}
					{{-- </form> --}}
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
							    	
                                <div class="row studio-stepform-wrap general-info-wrap" id="testData" >
								
						
							         <!-- added -->
							        {{--No images or videos found--}}
											<?php
												// $projectImageData = \App\Models\ProjectImagesData::where('project_id',$projectinfo->id)
												// ->orderBy('date', 'desc')
												// ->get();
												// $groupedData = $projectImageData->groupBy('date');
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
												<h6>{{ \Carbon\Carbon::parse($date)->format('m-d-Y') }}</h6>
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
																class="clickable-image"  data-project-name="{{$mediaItem->project_image}}"  data-date="{{$mediaItem->date}}" data-time="{{$mediaItem->time}}"
												 >
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

  												       {{-- old code @if(isset($images) && is_array($images) && count($images) > 0)
        												@foreach($images as $img)
        												<div class="col-6 col-md-4 col-lg-3">
        													<div class="project-detail-photos-item">
        														@if(is_video_file($img))
        															<div class="video_container">
        															<a class="image-gallery-popup video_model" href="{{ asset('storage/project_images/'.$img) }}">
        																<video width="170" height="150" controls>
        																	<source src="{{ asset('storage/project_images/'.$img) }}" type="video/mp4">
        																		Your browser does not support the video tag.
        																</video>
        															</a>
        															</div>
        														@else
        														<div class="gallery_container">
        													    <div class="project-detail-photos-item-img ">
        													        <a class="lightbox" href="{{ asset('storage/project_images/'.$img) }}">
        														        <img src="{{ asset('storage/project_images/'.$img) }}" alt="project-photos" width="270" height="230">
        														    </a>
        														</div>
        														</div>
        														@endif
        													</div>
        												</div>
        												@endforeach
        												@endif --}}
												

											
												
												{{--<div class="row">
													<div class="col-6 col-md-4 col-lg-3">
														<div class="project-detail-photos-item">
															<div class="project-detail-photos-item-img">
																<img src="{{asset('frontend-assets/images/project-photos-1.png')}}" alt="project-photos" width="270" height="230">
															</div>
															<div class="project-detail-photos-item-title">Roof and gutter designer</div>
														</div>
													</div>
													<div class="col-6 col-md-4 col-lg-3">
														<div class="project-detail-photos-item">
															<div class="project-detail-photos-item-img">
																<img src="{{asset('frontend-assets/images/project-photos-2.png')}}" alt="project-photos" width="270" height="230">
															</div>
															<div class="project-detail-photos-item-title">Roof types and ratings</div>
														</div>
													</div>
													<div class="col-6 col-md-4 col-lg-3">
														<div class="project-detail-photos-item">
															<div class="project-detail-photos-item-img">
																<img src="{{asset('frontend-assets/images/project-photos-3.png')}}" alt="project-photos" width="270" height="230">
															</div>
															<div class="project-detail-photos-item-title">Gutter types and accessories</div>
														</div>
													</div>
													<div class="col-6 col-md-4 col-lg-3">
														<div class="project-detail-photos-item">
															<div class="project-detail-photos-item-img">
																<img src="{{asset('frontend-assets/images/project-photos-4.png')}}" alt="project-photos" width="270" height="230">
															</div>
															<div class="project-detail-photos-item-title">Gutter types and accessories</div>
														</div>
													</div>
												</div>--}}
												@if($projectImageData->count() > 0)	
												<div class="row justify-content-center">
													<div class="col-12 col-md-6 col-lg-4">
														<a class="btn-primary d-block" id="designStudiotab" href="javascript:void(0)">Next</a>
													</div>
												</div>
												@endif
											</div>
											<div class="tab-pane fade" id="nav-general-info" role="tabpanel" aria-labelledby="nav-general-info-tab" tabindex="0">
												<div class="row">
													<div class="col-12">
														<div class="general-info-wrap">
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
												<div class="row justify-content-center">
													<div class="col-12 col-md-6 col-lg-4">
														<a class="btn-primary d-block" id="generalinfotab" href="javascript:void(0)">Next</a>
													</div>
												</div>
												
											</div>

											{{--<div class="tab-pane fade" id="nav-documentation" role="tabpanel" aria-labelledby="nav-documentation-tab" tabindex="0">
												<div class="row">
													
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
																@foreach($documentdata as $document)
																@if(isset($document) && $document !== NULL && $document !== '')
																@php
																$filename = explode("/",$document);
																$ext = pathinfo($document, PATHINFO_EXTENSION);
																@endphp
																@if($ext == 'jpg' || $ext == 'jpeg')
																	<img src="{{asset('frontend-assets/images/image_icon.png')}}" style="height:50px;width:50px;"/>
																	@elseif($ext == 'doc')
																	<img src="{{asset('frontend-assets/images/doc_icon.png')}}" style="height:50px;width:50px;"/>
																	@else
																	<img src="{{asset('frontend-assets/images/doc_icon.jpg')}}" style="height:50px;width:50px;"/>
																@endif
																<div class="file-name" > {{$filename[1]}}</div>
                                                                <a class="btn-outline-secondary" href="{{route('download.file', ['filename' => $document]) }}"> Download <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.0631 11.6913C15.2753 11.5145 15.3039 11.1992 15.1271 10.9871C14.9504 10.7749 14.6351 10.7462 14.4229 10.923L15.0631 11.6913ZM10.5004 14.8427L10.1803 15.2268C10.3657 15.3813 10.635 15.3813 10.8205 15.2268L10.5004 14.8427ZM6.57778 10.923C6.36564 10.7462 6.05036 10.7749 5.87358 10.987C5.6968 11.1992 5.72546 11.5145 5.9376 11.6913L6.57778 10.923ZM11.0004 6.35736C11.0004 6.08122 10.7765 5.85736 10.5004 5.85736C10.2242 5.85736 10.0004 6.08122 10.0004 6.35736H11.0004ZM14.4229 10.923L10.1803 14.4586L10.8205 15.2268L15.0631 11.6913L14.4229 10.923ZM10.8205 14.4586L6.57778 10.923L5.9376 11.6913L10.1803 15.2268L10.8205 14.4586ZM11.0004 14.8427V6.35736H10.0004V14.8427H11.0004ZM16.9351 17.0347C13.3813 20.5884 7.61949 20.5884 4.06572 17.0347L3.35861 17.7418C7.30291 21.6861 13.6979 21.6861 17.6422 17.7418L16.9351 17.0347ZM4.06572 17.0347C0.511948 13.4809 0.511948 7.7191 4.06572 4.16533L3.35861 3.45822C-0.585683 7.40252 -0.585683 13.7975 3.35861 17.7418L4.06572 17.0347ZM4.06572 4.16533C7.61949 0.611557 13.3813 0.611557 16.9351 4.16533L17.6422 3.45822C13.6979 -0.486074 7.30291 -0.486074 3.35861 3.45822L4.06572 4.16533ZM16.9351 4.16533C20.4888 7.7191 20.4888 13.4809 16.9351 17.0347L17.6422 17.7418C21.5865 13.7975 21.5865 7.40252 17.6422 3.45822L16.9351 4.16533Z" fill="#53B746"/></svg></a>
																@endif
																@endforeach
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
																@if(isset($contractordocuments) && $contractordocuments !== NULL && $contractordocuments !== '')
																@php
																$filename = explode("/",$contractordocuments);
																@endphp
																@if($ext == 'jpg' || $ext == 'jpeg')
																	<img src="{{asset('frontend-assets/images/image_icon.png')}}" style="height:50px;width:50px;"/>
																	@elseif($ext == 'doc')
																	<img src="{{asset('frontend-assets/images/doc_icon.png')}}" style="height:50px;width:50px;"/>
																	@else
																    <img src="{{asset('frontend-assets/images/doc_icon.jpg')}}" style="height:50px;width:50px;"/>
																	@endif
																<div class="file-name" > {{$filename[1]}}</div>
																<a class="btn-outline-secondary" href="{{route('download.file', ['filename' => $contractordocuments]) }}">Download <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.0631 11.6913C15.2753 11.5145 15.3039 11.1992 15.1271 10.9871C14.9504 10.7749 14.6351 10.7462 14.4229 10.923L15.0631 11.6913ZM10.5004 14.8427L10.1803 15.2268C10.3657 15.3813 10.635 15.3813 10.8205 15.2268L10.5004 14.8427ZM6.57778 10.923C6.36564 10.7462 6.05036 10.7749 5.87358 10.987C5.6968 11.1992 5.72546 11.5145 5.9376 11.6913L6.57778 10.923ZM11.0004 6.35736C11.0004 6.08122 10.7765 5.85736 10.5004 5.85736C10.2242 5.85736 10.0004 6.08122 10.0004 6.35736H11.0004ZM14.4229 10.923L10.1803 14.4586L10.8205 15.2268L15.0631 11.6913L14.4229 10.923ZM10.8205 14.4586L6.57778 10.923L5.9376 11.6913L10.1803 15.2268L10.8205 14.4586ZM11.0004 14.8427V6.35736H10.0004V14.8427H11.0004ZM16.9351 17.0347C13.3813 20.5884 7.61949 20.5884 4.06572 17.0347L3.35861 17.7418C7.30291 21.6861 13.6979 21.6861 17.6422 17.7418L16.9351 17.0347ZM4.06572 17.0347C0.511948 13.4809 0.511948 7.7191 4.06572 4.16533L3.35861 3.45822C-0.585683 7.40252 -0.585683 13.7975 3.35861 17.7418L4.06572 17.0347ZM4.06572 4.16533C7.61949 0.611557 13.3813 0.611557 16.9351 4.16533L17.6422 3.45822C13.6979 -0.486074 7.30291 -0.486074 3.35861 3.45822L4.06572 4.16533ZM16.9351 4.16533C20.4888 7.7191 20.4888 13.4809 16.9351 17.0347L17.6422 17.7418C21.5865 13.7975 21.5865 7.40252 17.6422 3.45822L16.9351 4.16533Z" fill="#53B746"/></svg></a>
																@endif 	
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
																	@if(isset($insurancedocument) && $insurancedocument !== NULL  && $insurancedocument !== '')
																	@php
																	$filename = explode("/",$insurancedocument);
																	$ext = pathinfo($insurancedocument, PATHINFO_EXTENSION);

																	@endphp
																	@if($ext == 'jpg' || $ext == 'jpeg')
																	<img src="{{asset('frontend-assets/images/image_icon.png')}}" style="height:50px;width:50px;"/>
																	@elseif($ext == 'doc')
																	<img src="{{asset('frontend-assets/images/doc_icon.png')}}" style="height:50px;width:50px;"/>
																	@else
																	<img src="{{asset('frontend-assets/images/doc_icon.jpg')}}" style="height:50px;width:50px;"/>
																	@endif
																	<div class="file-name" > {{$filename[1]}}</div>
																	<a class="btn-outline-secondary" href="{{route('download.file', ['filename' => $insurancedocument]) }}">Download <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.0631 11.6913C15.2753 11.5145 15.3039 11.1992 15.1271 10.9871C14.9504 10.7749 14.6351 10.7462 14.4229 10.923L15.0631 11.6913ZM10.5004 14.8427L10.1803 15.2268C10.3657 15.3813 10.635 15.3813 10.8205 15.2268L10.5004 14.8427ZM6.57778 10.923C6.36564 10.7462 6.05036 10.7749 5.87358 10.987C5.6968 11.1992 5.72546 11.5145 5.9376 11.6913L6.57778 10.923ZM11.0004 6.35736C11.0004 6.08122 10.7765 5.85736 10.5004 5.85736C10.2242 5.85736 10.0004 6.08122 10.0004 6.35736H11.0004ZM14.4229 10.923L10.1803 14.4586L10.8205 15.2268L15.0631 11.6913L14.4229 10.923ZM10.8205 14.4586L6.57778 10.923L5.9376 11.6913L10.1803 15.2268L10.8205 14.4586ZM11.0004 14.8427V6.35736H10.0004V14.8427H11.0004ZM16.9351 17.0347C13.3813 20.5884 7.61949 20.5884 4.06572 17.0347L3.35861 17.7418C7.30291 21.6861 13.6979 21.6861 17.6422 17.7418L16.9351 17.0347ZM4.06572 17.0347C0.511948 13.4809 0.511948 7.7191 4.06572 4.16533L3.35861 3.45822C-0.585683 7.40252 -0.585683 13.7975 3.35861 17.7418L4.06572 17.0347ZM4.06572 4.16533C7.61949 0.611557 13.3813 0.611557 16.9351 4.16533L17.6422 3.45822C13.6979 -0.486074 7.30291 -0.486074 3.35861 3.45822L4.06572 4.16533ZM16.9351 4.16533C20.4888 7.7191 20.4888 13.4809 16.9351 17.0347L17.6422 17.7418C21.5865 13.7975 21.5865 7.40252 17.6422 3.45822L16.9351 4.16533Z" fill="#53B746"/></svg></a>
																	@endif
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
																@if(isset($mortgagedocument) && $mortgagedocument !== NULL && $mortgagedocument !== '')
																@php
																$filename = explode("/",$mortgagedocument);
																$ext = pathinfo($mortgagedocument, PATHINFO_EXTENSION);

																@endphp

																@if($ext == 'jpg' || $ext == 'jpeg')
																	<img src="{{asset('frontend-assets/images/image_icon.png')}}" style="height:50px;width:50px;"/>
																	@elseif($ext == 'doc')
																	<img src="{{asset('frontend-assets/images/doc_icon.png')}}" style="height:50px;width:50px;"/>
																@else
																    <img src="{{asset('frontend-assets/images/doc_icon.jpg')}}" style="height:50px;width:50px;"/>
																@endif
																<div class="file-name">{{$filename[1]??''}}</div>
																<a class="btn-outline-secondary" href="{{route('download.file', ['filename' => $mortgagedocument]) }}">Download <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.0631 11.6913C15.2753 11.5145 15.3039 11.1992 15.1271 10.9871C14.9504 10.7749 14.6351 10.7462 14.4229 10.923L15.0631 11.6913ZM10.5004 14.8427L10.1803 15.2268C10.3657 15.3813 10.635 15.3813 10.8205 15.2268L10.5004 14.8427ZM6.57778 10.923C6.36564 10.7462 6.05036 10.7749 5.87358 10.987C5.6968 11.1992 5.72546 11.5145 5.9376 11.6913L6.57778 10.923ZM11.0004 6.35736C11.0004 6.08122 10.7765 5.85736 10.5004 5.85736C10.2242 5.85736 10.0004 6.08122 10.0004 6.35736H11.0004ZM14.4229 10.923L10.1803 14.4586L10.8205 15.2268L15.0631 11.6913L14.4229 10.923ZM10.8205 14.4586L6.57778 10.923L5.9376 11.6913L10.1803 15.2268L10.8205 14.4586ZM11.0004 14.8427V6.35736H10.0004V14.8427H11.0004ZM16.9351 17.0347C13.3813 20.5884 7.61949 20.5884 4.06572 17.0347L3.35861 17.7418C7.30291 21.6861 13.6979 21.6861 17.6422 17.7418L16.9351 17.0347ZM4.06572 17.0347C0.511948 13.4809 0.511948 7.7191 4.06572 4.16533L3.35861 3.45822C-0.585683 7.40252 -0.585683 13.7975 3.35861 17.7418L4.06572 17.0347ZM4.06572 4.16533C7.61949 0.611557 13.3813 0.611557 16.9351 4.16533L17.6422 3.45822C13.6979 -0.486074 7.30291 -0.486074 3.35861 3.45822L4.06572 4.16533ZM16.9351 4.16533C20.4888 7.7191 20.4888 13.4809 16.9351 17.0347L17.6422 17.7418C21.5865 13.7975 21.5865 7.40252 17.6422 3.45822L16.9351 4.16533Z" fill="#53B746"/></svg></a>
																@endif
																@endforeach
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>--}}


											<div class="tab-pane fade" id="nav-documentation" role="tabpanel" aria-labelledby="nav-documentation-tab" tabindex="0">
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
                        																<div class="file-name" > {{$filename[1]}}</div>
                        															</div>
                    															
																				<div class="file-date">{{$document['filedate']}}</div>
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
                																<div class="file-name" > {{$filename[1]}}</div>
                															</div>
																			<div class="file-date">{{$contractordocuments['filedate']}}</div>
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
                																	<div class="file-name" > {{$filename[1]}}</div>
                																</div>
																				<div class="file-date">{{$insurancedocument['filedate']}}</div>
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
										</div>
									</div>
								</div>
							</div>
						</div>


						 <!-- quotation details -->
						{{--<div class="tab-pane fade" id="view-quotes-tab-pane" role="tabpanel" aria-labelledby="view-quotes-tab" tabindex="0">
							<div class="row">
								<div class="col-12">
									<div class="btn-gallery-filter-wrap">
										<button class="btn-gallery-filter active" data-category="all">All</button>
										<button class="btn-gallery-filter" data-category="approved">Approved</button>
										<button class="btn-gallery-filter" data-category="requested">Requested</button>
										<button class="btn-gallery-filter" data-category="rejected">Rejected</button>
									</div>
								</div>
							</div>
							<div class="row">

						       @php 
								$quotationStatus =	\App\Models\Quotation::select('status')->where('project_id',$projectinfo->id)->first();
								
								@endphp
								@if(isset($quotationStatus->status))
								@if($quotationStatus->status == 'rejected')
								<div class="quotes-request-btn-wrap col-md-6 col-lg-4">
									<a class="btn-primary d-block" id="sendnewQuote">Send a new quote</a>
								</div>
								@endif
								@endif
								@if(isset($quotations))
								
								@foreach($quotations as $quotation)
								

								<div class="col-12 col-md-6 col-lg-4 item" data-category="{{$quotation->status??''}}">
									<div class="contractor-list-item">
										<div class="contractor-detail-wrap">


												<div class="accordion" id="accordionExample2">
												<div class="accordion-item">
													<div class="accordion-header" id="headingTwo">
														<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
															<div class="contractor-detail-title-wrap d-flex">
																<div class="contractor-title-img">
																	<img src="{{asset('frontend-assets/images/Ellipse 15.svg')}}" alt="contractor-img" width="55" height="">
																</div>
																<div class="contractor-title-main">
																	@php
																	$projectData = \App\Models\Project::where('id',$quotation->project_id??'')->first();
																	$userData = \App\Models\User::where('id',$projectData->user_id??'')->first();
																	@endphp
																
																	<div class="contractor-title">{{$userData->name??''}}'s Roofing</div>
																	<input type="hidden" value="{{$userData->id??''}}" name="customerid" id="customerid">
																	<input type="hidden" value="{{auth()->guard('contractor')->user()->id??''}}" id="contractorid">
																


																</div>																
															</div>
														</button>
													</div>
													<div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample2">
														<div class="accordion-body">
															<div class="quotes-detail">

																		

																<div class="quotes-detail-item d-flex align-items-center justify-content-between">

																<div class="quotes-detail-item-title">
																		<svg class="me-2" width="16" height="19" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.77148 1.35645V3.75645" stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.1719 1.35645V3.75645" stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M1.17188 7.02832H14.7719" stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.1715 6.55664V13.3566C15.1715 15.7566 13.9715 17.3566 11.1715 17.3566H4.77148C1.97148 17.3566 0.771484 15.7566 0.771484 13.3566V6.55664C0.771484 4.15664 1.97148 2.55664 4.77148 2.55664H11.1715C13.9715 2.55664 15.1715 4.15664 15.1715 6.55664Z" stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M10.9278 10.7164H10.935" stroke="#0A84FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M10.9278 13.1163H10.935" stroke="#0A84FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M7.96787 10.7164H7.97506" stroke="#0A84FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M7.96787 13.1163H7.97506" stroke="#0A84FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M5.00693 10.7164H5.01412" stroke="#0A84FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M5.00693 13.1163H5.01412" stroke="#0A84FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
																		<strong>

																		{{ \Carbon\Carbon::parse($quotation->created_at??'')->format('d M Y, D') }}

																		</strong>
																	</div>
																</div>

																<div class="quotes-detail-item d-flex align-items-center justify-content-between">
																	<div class="quotes-detail-item-title">Quotation No: </div>
																	<div class="quotes-detail-item-content quotes-detail-item-title"><strong>{{$quotation->id??''}}</strong></div>
																</div>	

																<div class="quotes-detail-item d-flex align-items-center justify-content-between">
																	<div class="quotes-detail-item-title">Quoted price: </div>
																	<div class="quotes-detail-item-content"><span class="price-tag">${{$quotation->final_price??''}}</span></div>
																</div>	


																<div class="quotes-detail-item d-flex align-items-center justify-content-between">
																	
																	<div class="quotes-detail-item-title">Status: </div>
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
																@endif

																@if(isset($quotation->rejection_reason))
																<div class="quotes-detail-item d-flex align-items-center justify-content-between">
																	<div class="quotes-detail-item-title">Description: </div>
																	<div class="quotes-detail-item-content"><span>{{$quotation->rejection_reason??''}}</span></div>
																</div>	
																@endif 
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
						</div>--}}
						<!-- quotation details  -->

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
												{{--<span class="rejected-status-tag">Rejected</span>--}}
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
											{{--<a class="btn-outline-secondary d-block" href="#">View Quotation</a>--}}
											{{-- <a class="btn-primary d-block btn-approved" target="_blanck" href="route('preview.quotation',base64_encode($quotation->id))">View quotation</a> --}}
											
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
						<!-- end added new -->

					</div>
				</div>
			</div>
		</div>
	</section>

	



	<!-- Modal -->
	{{-- <div class="modal fade gallerypopup" id="gallerypopup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<div class="modal-title" id="staticBackdropLabel">Work gallery</div>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
				</div>
				<div class="modal-body">
					<div class="contractor-title-detail d-sm-flex">
						<div class="contractor-popuptitle">Bob’s Roofing</div>
						<div class="contractor-review d-flex align-items-center">
							<div class="contractor-review-text">4.5</div>
							<div class="contractor-review-icons">
								<img src="{{asset('frontend-assets/images/star.svg')}}" alt="star" width="12" height="12">
								<img src="{{asset('frontend-assets/images/star.svg')}}" alt="star" width="12" height="12">
								<img src="{{asset('frontend-assets/images/star.svg')}}" alt="star" width="12" height="12">
								<img src="{{asset('frontend-assets/images/star.svg')}}" alt="star" width="12" height="12">
								<img src="{{asset('frontend-assets/images/remaing-star.svg')}}" alt="star" width="12" height="12">
							</div>
						</div>
					</div>
					<div class="gallery-wrap">
						<div class="btn-gallery-filter-wrap">
							<button class="btn-gallery-filter active" data-category="all">All</button>
							<button class="btn-gallery-filter" data-category="images">Images</button>
							<button class="btn-gallery-filter" data-category="video">Video</button>
							<button class="btn-gallery-filter" data-category="recentwork">Recent work</button>
						</div>
						<div class="items">
								
					@if(isset($images) && is_array($images) && count($images) > 0)
						@foreach($images as $img)
								@if(is_video_file($img))
								<div class="item" data-category="{{ is_video_file($img) ? 'video' : 'images' }}">
								<a class="image-gallery-popup" href="{{ $img }}">
										<video width="170" height="150" controls>
											<source src="{{ asset('storage/project_images/'.$img) }}" type="video/mp4">
											Your browser does not support the video tag.
										</video>
									</a>
								</div>
								@else
								<div class="item">
									<a class="image-gallery-popup" href="{{ asset('storage/project_images/'.$img) }}">
										<img src="{{ asset('storage/project_images/'.$img) }}" alt="gallery-img" width="170" height="150">
									</a>
								</div>
								@endif
						@endforeach
					@endif


							<div class="item" data-category="images recentwork">
								<a class="image-gallery-popup" href="images/gallery-img-6.png">
									<img src="{{asset('frontend-assets/images/gallery-img-6.png')}}" alt="gallery-img" width="170" height="150">
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> --}}

	<!-- Quote Modal -->
	<div class="modal fade sendquotepopup" id="sendquotepopup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabeltitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<div class="modal-title" id="staticBackdropLabeltitle">Send a new quote</div>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
				</div>
				<div class="modal-body">
					<form id="addproject" action="thankyou.html" novalidate="novalidate">
						<div class="row">
							<div class="form-group col-12 col-md-6">
								<div class="field-wrap">
									<div class="form-label">
										<label for="name">Scheduled date<span>*</span></label>
									</div>
									<div class="form-element">
										<input id="name" type="date" name="date" placeholder="21  Nov  2023 , Tue">
										<!-- <span class="input-icon">
											<svg width="20" height="23" viewBox="0 0 20 23" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.96509 1.44556V4.44556" stroke="#2C2C2E" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M13.9651 1.44556V4.44556" stroke="#2C2C2E" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M1.46509 8.53555H18.4651" stroke="#2C2C2E" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M18.9651 7.94556V16.4456C18.9651 19.4456 17.4651 21.4456 13.9651 21.4456H5.96509C2.46509 21.4456 0.965088 19.4456 0.965088 16.4456V7.94556C0.965088 4.94556 2.46509 2.94556 5.96509 2.94556H13.9651C17.4651 2.94556 18.9651 4.94556 18.9651 7.94556Z" stroke="#2C2C2E" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M13.6598 13.1456H13.6688" stroke="#2C2C2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M13.6598 16.1456H13.6688" stroke="#2C2C2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M9.96057 13.1456H9.96955" stroke="#2C2C2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M9.96057 16.1456H9.96955" stroke="#2C2C2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M6.2594 13.1456H6.26838" stroke="#2C2C2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M6.2594 16.1456H6.26838" stroke="#2C2C2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
										</span> -->
									</div>
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="field-wrap">
									<div class="form-label">
										<label for="name">Scheduled time<span>*</span></label>
									</div>
									<div class="row">
										<div class="form-group col-12 col-md-6">
											<div class="form-element">
												<div class="input-group">
													<input type="text" name="from" placeholder="9:00am">
													<span class="input-group-text" id="inputGroup-sizing-default">From</span>
												</div>
											</div>
										</div>
										<div class="form-group col-12 col-md-6">
											<div class="form-element">
												<div class="input-group">
													<input type="text" name="to" placeholder="5:00am">
													<span class="input-group-text" id="inputGroup-sizing-default">to</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-12 col-md-6">
								<div class="field-wrap">
									<div class="form-label">
										<label for="name">Quote price*<span>*</span></label>
									</div>
									<div class="form-element">
										<input id="name" type="text" name="price" placeholder="$2,000">
										<span class="input-icon">
											<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.67212 13.3298C7.67212 14.6198 8.66212 15.6598 9.89212 15.6598H12.4021C13.4721 15.6598 14.3421 14.7498 14.3421 13.6298C14.3421 12.4098 13.8121 11.9798 13.0221 11.6998L8.99212 10.2998C8.20212 10.0198 7.67212 9.58984 7.67212 8.36984C7.67212 7.24984 8.54212 6.33984 9.61212 6.33984H12.1221C13.3521 6.33984 14.3421 7.37984 14.3421 8.66984" stroke="#53B746" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.0002 5V17" stroke="#53B746" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.0002 21C16.5231 21 21.0002 16.5228 21.0002 11C21.0002 5.47715 16.5231 1 11.0002 1C5.4774 1 1.00024 5.47715 1.00024 11C1.00024 16.5228 5.4774 21 11.0002 21Z" stroke="#53B746" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group col-12 col-md-6">
								<div class="field-wrap">
									<div class="form-label">
										<label for="name">Description<span>*</span></label>
									</div>
									<div class="form-element">
										<input id="name" type="text" name="description" placeholder="Please call us for further discussion">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-12 col-md-6">
								<div class="field-wrap">
									<div class="form-label">
										<label for="callphone">Call<span>*</span></label>
									</div>
									<div class="form-element">
										<input id="callphone" type="text" name="callphone" placeholder="852 - 562 - 5112">
									</div>
								</div>
							</div>
							<div class="form-group col-12 col-md-6">
								<div class="field-wrap">
									<div class="form-label">
										<label for="email">Email<span>*</span></label>
									</div>
									<div class="form-element">
										<input id="email" type="text" name="email" placeholder="Johndoe4@gmail.com">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-12 col-md-6">
								<div class="field-wrap">
									<div class="form-label">
										<label for="billing">Billing<span>*</span></label>
									</div>
									<div class="form-element">
										<input id="billing" type="text" name="billing" placeholder="Enter billing info">
									</div>
								</div>
							</div>
							<div class="form-group col-12 col-md-6">
								<div class="field-wrap">
									<div class="form-label">
										<label for="mortgagecompany">Mortgage company<span>*</span></label>
									</div>
									<div class="form-element">
										<input id="mortgagecompany" type="text" name="mortgagecompany" placeholder="Enter mortgage company name">
									</div>
								</div>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="form-group button-wrap col-md-5">
								<div class="field-wrap text-center">
									<button type="submit" class="btn btn-primary d-block w-100">Send quotation</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	

	<!-- Quote Modal -->
	{{-- <div class="modal fade quotepopup" id="editquotepopup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
				<div class="modal-title" id="staticBackdropLabel">Quote details</div>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
				</div>
				<div class="modal-body">
					<div class="contractor-title-detail d-sm-flex">
						<div class="contractor-popuptitle">Bob’s Roofing Quote</div>
						<div class="contractor-review d-flex align-items-center">
							<div class="contractor-review-text">4.5</div>
							<div class="contractor-review-icons">
								<img src="{{asset('frontend-assets/images/star.svg')}}" alt="star" width="12" height="12">
								<img src="{{asset('frontend-assets/images/star.svg')}}" alt="star" width="12" height="12">
								<img src="{{asset('frontend-assets/images/star.svg')}}" alt="star" width="12" height="12">
								<img src="{{asset('frontend-assets/images/star.svg')}}" alt="star" width="12" height="12">
								<img src="{{asset('frontend-assets/images/remaing-star.svg')}}" alt="star" width="12" height="12">
							</div>
						</div>
					</div>
					<div class="quotepopup-wrap">
						<div class="quotepopup-item">
							<div class="quotepopup-item-title">Scheduled date:</div>
							<div class="quotepopup-item-content">21  Nov  2023 , Tue</div>
						</div>
						<div class="quotepopup-item">
							<div class="quotepopup-item-title">Scheduled time:</div>
							<div class="quotepopup-item-content">9:00am to 5:00pm</div>
						</div>
						<div class="quotepopup-item">
							<div class="quotepopup-item-title">Quote price:</div>
							<div class="quotepopup-item-content"><span class="quotepopup-price-tag">$2,000</span></div>
						</div>
						<div class="quotepopup-item">
							<div class="quotepopup-item-title">Description:</div>
							<div class="quotepopup-item-content">Please call us for further discussion </div>
						</div>
						<div class="quotepopup-item">
							<div class="quotepopup-item-title">Call:</div>
							<div class="quotepopup-item-content">852 - 562 - 5112</div>
						</div>
						<div class="quotepopup-item">
							<div class="quotepopup-item-title">Email:</div>
							<div class="quotepopup-item-content">johndoe4@gmail.com</div>
						</div>
						<div class="quotepopup-button-wrap d-flex justify-content-center">
							<a class="btn-primary d-block" href="javascript:void(0)">Edit quote details</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> --}}


	{{-- Detail page popup --}}
{{-- <div class="modal fade" id="details_page_popup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"> <div class="d-flex mb-3">
					<div><span id="date_added"></span> 
						&nbsp;,&nbsp;
					<span id="time_added"></span>&nbsp;&nbsp;<span> By</span>&nbsp;&nbsp;      
					 <span id="added_by_name"></span></div>
				</div></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-7  order-md-1">
                        <div id="media-display">
                        </div>
                    </div>
                    <div class="col-12 col-md-5  order-md-2">
                        <div id="media-description" class="mb-4 mt-2 pt-4">
                            <div id="notes-container" class="mt-3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

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
                    <div class="col-8">
                        <div id="media-display">
                            <!-- Media content goes here -->
                        </div>
                    </div>
					<div class="col-4">
						<div id="media-description">
							 <div id="notes-container">
								 <!-- Notes content goes here -->
							 </div>
						 </div>
					 </div>
                </div>
                {{-- <div class="row mt-3">
					<div class="col-12">
                       <center> <div id="media-description">
                            <div id="notes-container">
                                <!-- Notes content goes here -->
                            </div></center>
                        </div>
                    </div>
                </div> --}}
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
{{-- <script src="{{asset('frontend-assets/js/message-count.js?time='.time())}}"></script> --}}

{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

{{-- date range picker --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

{{--end  date range picker --}}


{{-- detect a date and time of the picture taken  --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/exif-js/2.3.0/exif.js"></script> --}}


<script>
    // swal();

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
		$('#view-quotes-tab').trigger('click');
	sessionStorage.removeItem("lastname");
	}
    var project_id = $('#project_id').val();
	var csrfToken = $('meta[name="csrf-token"]').attr('content');
 
	// Initialize Dropzone
		var dropzone = new Dropzone('#image-upload', {
			thumbnailWidth: 200,
			url: "{{ route('test') }}",
			maxFilesize: 50,
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
				this.on('error', function(file, message) {
                    if (file.size > (50 * 1024 * 1024)) { // 50MB in bytes
                        alert("File is too large! The maximum allowed size is 50MB.");
                        this.removeFile(file); // Optionally remove the file from Dropzone
                    }
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
$(document).on('click', '.clickable-image', function(e) {
    e.preventDefault();
    let mediaImageId = $(this).data('image-id');
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
			
            // alert("username: " +  response.user_name );
            $('#added_by_name').text(response.user_name);

			// <div class="profile-img">
			// 				<img src="{{asset('frontend-assets/images/profile-image.png')}}" alt="Profile Image"/>
			// 				</div>
            if (response.notes) {
                $('#notes-container').html(`
                    <div>
						<div class="notes-wrap d-flex">
							<div class="notes-details">
								<p id="notes-text">${response.notes}</p>
								<a href="#" class="" id="edit-notes">
									<svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.68668 2.38407L1.75165 8.66609C1.52755 8.90465 1.31068 9.37454 1.2673 9.69984L0.999827 12.042C0.90585 12.8878 1.51309 13.4662 2.35165 13.3216L4.6794 12.924C5.00471 12.8662 5.46014 12.6276 5.68424 12.3818L11.6193 6.09979C12.6458 5.01543 13.1084 3.77927 11.5108 2.2684C9.92045 0.771995 8.7132 1.29971 7.68668 2.38407Z" stroke="#A9A9A9" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M6.69482 3.43164C7.00567 5.42685 8.62497 6.95218 10.6346 7.15459" stroke="#A9A9A9" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg> Edit	
								</a>
							</div>
						</div>
                    </div>
                `);
            } else {

				$('#notes-container').html('<a href="#" class="btn btn-primary btn-3"  id="show-form-link">Add Notes</a>');

                // $('#notes-container').html(`
                //     <form id="notes-form">
                //         <div class="mb-3">
                //             <textarea class="form-control" id="notes" rows="3" placeholder="Add your notes here"></textarea>
                //         </div>
                //         <button type="submit" class="btn btn-primary">Save Notes</button>
                //     </form>
                // `);

				$('#show-form-link').on('click', function(e) {
                        e.preventDefault();
                        $('#notes-container').html(`
                            <form id="notes-form">
                                <div class="mb-3">
                                    <textarea class="form-control" id="notes" rows="3" placeholder="Add your notes here"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Notes</button>
                            </form>
                        `);
                    });
            }
        },
        error: function(xhr) {
            alert('An error occurred while fetching media details.');
        }
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
            // $('#notes-container').html(`
            //     <div>
            //         <p id="notes-text">${notes}</p>
			// 		<a href="#"  class="btn btn-primary" id="edit-notes">Edit</a>

            //     </div>
            // `);
			// <div class="profile-img">
			// 				<img src="{{asset('frontend-assets/images/profile-image.png')}}" alt="Profile Image"/>
			// 				</div> 

			$('#notes-container').html(`

			 <div>
						<div class="notes-wrap d-flex">
							<div class="notes-details">
								<p id="notes-text">${notes}</p>
								<a href="#" class="" id="edit-notes">
									<svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.68668 2.38407L1.75165 8.66609C1.52755 8.90465 1.31068 9.37454 1.2673 9.69984L0.999827 12.042C0.90585 12.8878 1.51309 13.4662 2.35165 13.3216L4.6794 12.924C5.00471 12.8662 5.46014 12.6276 5.68424 12.3818L11.6193 6.09979C12.6458 5.01543 13.1084 3.77927 11.5108 2.2684C9.92045 0.771995 8.7132 1.29971 7.68668 2.38407Z" stroke="#A9A9A9" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M6.69482 3.43164C7.00567 5.42685 8.62497 6.95218 10.6346 7.15459" stroke="#A9A9A9" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg> Edit	
								</a>
							</div>
						</div>
                    </div>
			`);
        },
        error: function(xhr) {
            // alert('An error occurred while saving notes.');
        }
    });
});
});

$(document).on('click', '#edit-notes', function() {
    let currentNotes = $('#notes-text').text();
    // alert(currentNotes);


    $('#notes-container').html(`



        <form id="notes-form">
            <div class="mb-3">
                <textarea class="form-control" id="notes" rows="3" placeholder="Update your notes here">${currentNotes}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Notes</button>
        </form>
    `);
});


// end detsils page 

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
			// axios.post('/get-message-count', {
			// 	userId: userId,
			// 	projectId: detailsproject_id,
			// 	role: role
			// }).then(response => {
			// 	let messageCount = response.data.messageCount;
			// 	updateMessageCount(messageCount, detailsproject_id);
			// }).catch(error => {
			// 	console.error('Error fetching message count:', error.response ? error.response.data : error);
			// });
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


</script>


<script>
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


</script>


@endsection