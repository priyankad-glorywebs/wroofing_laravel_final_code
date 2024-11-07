<div>
    <!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
    @extends('layouts.front.master')
@section('title', 'Project Dashboard')
@section('css')
{{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/daterangepicker/3.1/daterangepicker.min.css" rel="stylesheet"> --}}

{{-- for date range picker --}}
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{-- end range picker --}}
<style>

.error-message {
    color: red;
    font-size: 12px;
    margin-top: 5px;
}
	.profileimg{
		height:55px;
		
	}

	/* close button  */
	.position-relative {
    position: relative;
}

#title {
    padding-right: 30px; /* Adjust as needed */
}

.clear-button {
    position: absolute;
    top: 50%;
    right: 10px; /* Adjust as needed */
    transform: translateY(-50%);
    background: transparent;
    border: none;
    font-size: 16px;
    cursor: pointer;
    color: #e4200e; /* Adjust color as needed */
    display: none; /* Initially hidden */
}

.clear-button:focus {
    outline: none;
}



.btn-hover-icon-data {
            width: 24px;
            height: 24px;
            vertical-align: middle;
        } 
        .btn-primary-custom {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            border-radius: 0.375rem;
        }
        .btn-primary-custom img {
            margin-right: 0.5rem;
        }



		#reportrange-dashboard {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    justify-content: space-between;
	margin-bottom: 0 !important;
	width: 100% !important;
	max-width: calc(100% - 190px)!important;
	
}

#reportrange-dashboard i {
    /* color: #333; */
	color:#53B746;
}

#reportrange-dashboard span {
    font-size: 14px;
}
.daterangepicker .ranges li.active{
	background-color: #53B746 !important;
}
.daterangepicker .ranges li.active{
	background-color: #53B746 !important;
	color: #fff;
}

.daterangepicker td.active, .daterangepicker td.active:hover {
    background-color: #53B746 !important;
    border-color: transparent !important;
    color: #fff !important;
}



.input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

input {
    width: 100%;
    padding: 10px 40px 10px 10px; /* Adjust padding to make room for the icon */
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.search-icon {
    position: absolute;
    right: 10px; /* Adjust position of the icon */
    font-size: 16px;
    color: #888;
	line-height:3 !important;
	padding-right: 10px !important;
	padding-top:7px !important;

}
.daterangepicker td.active, .daterangepicker td.active:hover{
		background-color: #53B746;
		border-color:transparent;
		color: #fff;
	}

	.input-wrapper .search-wrap #title {padding-right: 40px;}
	.input-wrapper .search-wrap {
	max-width: 450px !important;
	width: 100%;
}

@media (max-width: 768px) {
    .input-wrapper {
        flex-direction: column;
    }

    input {
        padding-right: 30px; 
    }

    .search-icon {
        right: 15px;
        font-size: 14px;
    }
}
@media (max-width: 767px) {
    #reportrange-dashboard {
        width: 100%;
        margin-bottom: 10px;
    }

    #reportrange-dashboard span {
        font-size: 12px;
    }
	#reportrange-dashboard {margin-left: auto !important; margin-right: auto !important; margin-bottom: 20px !important; max-width: 350px !important;}
}

@media (min-width: 768px) {
    #reportrange-dashboard {
        width: auto;
        margin-bottom: 20px;
    }

    #reportrange-dashboard span {
        font-size: 14px;
    }
}
input#testDatainfo {
    width: 100%;
    box-sizing: border-box;
    border: 1px solid #ccc;
    margin: 10px;
    padding: 14px 14px 14px 14px;
}
	/* end close button  */
</style>
@endsection

@section('content')
    {{-- <div class="breadcrumb-title-wrap pb-0">
		<div class="container">
			
			<div class="row d-lg-none mt-4">
				<div class="col-12">
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="contractor-list-tab" data-bs-toggle="tab" data-bs-target="#contractor-list-tab-pane" type="button" role="tab" aria-controls="contractor-list-tab-pane" aria-selected="true" >Projects list</button>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div> --}}

	

	<section class="contractor-sec">
		<div class="container">
			<div class="row">
				<div class="col-12">
					{{-- <form id="filterForm" action="route('contractor.dashboard')" method="post">  --}}
							@csrf
							
							<div class="row mb-4">
							{{-- <div class="col-sm-12 col-md-8 col-lg-8 mb-3 mb-md-0 position-relative">
								<label for="title">Project Search:</label>
								<input type="text" id="title" placeholder="Project #, Customer Name, Email, Phone number" name="fromtitledate" value="{{ old('fromtitledate') }}" required>
							</div> --}}

							<div class="input-wrapper col-sm-12 col-md-6 col-lg-6 mb-3 mb-md-0 pb-3" style="padding-left:85% ">
								<div class="position-relative">
									<input type="button" id="testDatainfo" class="btn btn-sm btn-primary" value="Add New Project">
			
								</div>
							</div>
						

							<div class="input-wrapper col-sm-12 col-md-9 col-lg-9 mb-3 mb-md-0">
								<div class="position-relative search-wrap">
									<input type="text" id="title" placeholder="Project #, Customer Name, Email, Phone number" name="fromtitledate" value="{{ old('fromtitledate') }}" required>
									{{-- <i class="fas fa-search search-icon"></i> --}}
									<img class="search-icon" src="{{ asset('frontend-assets/images/contractorDashborad/search.svg')}}"/> 
								</div>
								{{-- <div class="add-con-project">
									<input type="button" id="testDatainfo" class="btn btn-sm btn-primary" value="Add">
								</div> --}}
							</div>


							<div class="col-sm-12 col-md-3 col-lg-3 d-md-flex align-items-center justify-content-end" >
								<div id="reportrange-dashboard" class="me-md-3" style="display: none">
									<i class="fa fa-calendar" ></i>&nbsp;
									<span></span> <i class="fa fa-caret-down"></i>
								</div>
								<div class="d-flex align-items-center justify-content-center">
									<button id="filter-button" class="btn btn-primary-custom me-3">
										<img class="btn-hover-icon-data" src="{{asset('frontend-assets/images/contractorDashborad/Filter.svg')}}" alt="Filter Icon">
										<span id="button-text">Filters</span>
									</button>

									<button type="button" class="btn-primary btn-change-view">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M19.9 13.5H4.1C2.6 13.5 2 14.14 2 15.73V19.77C2 21.36 2.6 22 4.1 22H19.9C21.4 22 22 21.36 22 19.77V15.73C22 14.14 21.4 13.5 19.9 13.5Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M19.9 2H4.1C2.6 2 2 2.64 2 4.23V8.27C2 9.86 2.6 10.5 4.1 10.5H19.9C21.4 10.5 22 9.86 22 8.27V4.23C22 2.64 21.4 2 19.9 2Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											</svg>
											
										{{-- <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.5 3.75H3.75V12.5H12.5V3.75Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M26.25 3.75H17.5V12.5H26.25V3.75Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M26.25 17.5H17.5V26.25H26.25V17.5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12.5 17.5H3.75V26.25H12.5V17.5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg> --}}
									</button>
								</div>
								{{-- <br/>
								<img class="btn-hover-icon-data" src="{{asset('frontend-assets/images/filter-1.gif')}}" style="">&nbsp;
													<span id="button-text" class="btn-primary">Filters</span></button> --}}
							</div>


							
							

							{{-- <div class="col-sm-6 col-md-3 col-lg-2 mb-3 mb-sm-0">
								<label for="from_date">From Date:</label>
								<input type="text" id="from_date" name="from_date"  value="{{ old('from_date', date('m-d-Y')) }}" placeholder="From Date" required>
							</div>
							<div class="col-sm-6 col-md-3 col-lg-2">
								<label for="to_date">To Date:</label>
								<input type="text" id="to_date" name="to_date" value="{{ old('to_date', date('m-d-Y')) }}" placeholder="To Date" required>
							</div>
							<div class="col-sm-6 col-md-5 col-lg-2">
								<br/>
								<input type="button" class="btn-primary" value="Filter" id="filterButton">
							</div>
							<div class="col-sm-6 col-md-5 col-lg-2">
								<br/>
								<input type="button" class="btn-primary" value="Reset Filter" id="resetFilterButton">
							</div> --}}
							  

{{-- Display range picker --}}
<div class="col-12 text-right" >
	
</div>
{{-- end display a range picker --}}
							
						</div>
							
						
					{{-- </form> --}}


					

				<div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="tab-content list-view" id="myTabContent">
						<div class="tab-pane fade show active" id="contractor-list-tab-pane" role="tabpanel" aria-labelledby="contractor-list-tab" tabindex="0">
						</div>
						{{--<div class="col-12">
							<div class="btn-gallery-filter-wrap" id="ajax_filter_dash">
								<button class="btn-gallery-filter-dash active" data-cate="all">All</button>
								<button class="btn-gallery-filter-dash ajax_filter" data-cate="approved">Approved</button>
								<button class="btn-gallery-filter-dash ajax_filter" data-cate="Requested">Requested</button>
								<button class="btn-gallery-filter-dash  ajax_filter" data-cate="Responded">Responded</button>
								<button class="btn-gallery-filter-dash ajax_filter" data-cate="rejected">Rejected</button>
							</div>
						</div>--}}
						{{-- <div class="col-12 col-md-6 col-lg-4 item list-view-main-title" data-category="requested1" style=""> --}}
							{{-- <div class="contractor-list-item">
								
								<div class="contractor-detail-wrap">
									<div class="accordion" id="accordionExample">
										<div class="accordion-item">
											<div class="accordion-header" id="headingOne">
												<div class="accordion-button collapsed list-view-detial-item">
													<div class="contractor-detail-title-wrap d-flex">
														<div class="contractor-title-img">
														</div>
														<div class="contractor-title-main">
															<div class="project-detail-item project-title">Project Title</div>
			
															<div class="project-detail-item d-flex">
																<div class="project-detail-item-detail project-title">Customer</div>
															</div>
			
															<div class="project-detail-item d-flex">
																<div class="project-detail-item-detail project-title">Phone </div>
															</div>
															<div class="project-detail-item d-flex">
																<div class="project-detail-item-detail project-title">Email</div>
															</div>
															<div class="project-detail-item">
																<div class="project-detail-item-detail project-title">Status</div>
															</div>
															<div class="project-detail-item">
																<div class="project-detail-item-detail project-title"></div>
															</div>
															<div class="project-detail-item  d-flex justify-content-end"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> --}}
						@include('layouts.front.projects.contractor.contractordashboard')
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Modal -->
	<div class="modal fade gallerypopup" id="gallerypopup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
							<div class="item" data-category="images">
								<a class="image-gallery-popup" href="images/gallery-img-1.png">
									<img src="{{asset('frontend-assets/images/gallery-img-1.png')}}" alt="gallery-img" width="170" height="150">
								</a>
							</div>

							<div class="item" data-category="video">
								<a class="image-gallery-popup video" href="https://www.youtube.com/watch?v=LXb3EKWsInQ">
									<img src="{{asset('frontend-assets/images/gallery-img-2.png')}}" alt="gallery-img" width="170" height="150">
								</a>
							</div>

							<div class="item" data-category="video recentwork">
								<a class="image-gallery-popup video" href="https://www.youtube.com/watch?v=LXb3EKWsInQ">
									<img src="{{asset('frontend-assets/images/gallery-img-3.png')}}" alt="gallery-img" width="170" height="150">
								</a>
							</div>

							<div class="item" data-category="images recentwork">
								<a class="image-gallery-popup" href="images/gallery-img-4.png">
									<img src="{{asset('frontend-assets/images/gallery-img-4.png')}}" alt="gallery-img" width="170" height="150">
								</a>
							</div>

							<div class="item" data-category="images">
								<a class="image-gallery-popup" href="images/gallery-img-5.png">
									<img src="{{asset('frontend-assets/images/gallery-img-5.png')}}" alt="gallery-img" width="170" height="150">
								</a>
							</div>

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
	</div>

	<!-- Add Project Modal -->
	<div class="modal fade addprojectpopup quotepopup" id="addprojectpopup" data-bs-backdrop="static"
	data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title" id="staticBackdropLabel">Add Project</div>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
			</div>
			<form name="addProjectform" method="post">
				<div class="modal-body">
					<div class="quotepopup-wrap">
						<div class="form-label">
							<label for="uname">Project Name<span>*</span></label>
						</div>

						<div class="form-element">
							<input type="text" name="projectname" id="projectname"
								placeholder="Enter your Project Name">
								<div id="projectname-error" class="error-message d-none" style="color: red;"></div>

						</div>

						<div class="form-label">
							<label for="email">Email<span>*</span></label>
						</div>

						<div class="form-element">
							<input type="email" name="email" id="email"
								placeholder="Enter your Email">
								<div id="email-error" class="error-message d-none" style="color: red;"></div>

						</div>


						@php
							$country_code   = 'us';
							// $phone_no       = $projectinfo->contact_number ? $projectinfo->contact_number : '';
						@endphp

							<div class="field-wrap">
								<div class="form-label">
									<label for="contact_number">Contact Number<span>*</span></label>
								</div>
								
								<div class="form-element" style="display: grid;">
									<input id="country_code" type="hidden" name="country_code"
									value="{{ $country_code }}" />
									<input type="text"
										id="contact_number" name="contact_number"
										placeholder="Enter your contact number">
									{{-- @error('contact_number') --}}
									<div id="contact_number_error" class="error-message d-none"></div> 
									{{-- @enderror --}}
								</div>
							</div>







						<div class="form-label">
							<label for="name">Name<span>*</span></label>
						</div>

						<div class="form-element">
							<input type="text" name="name" id="name"
								placeholder="Enter your Name">
								<div id="name-error" class="error-message d-none" style="color: red;"></div>

						</div>
						<span style="color:red" class="error-message d-none"></span>
						<br />
						<div class="quotepopup-button-wrap d-flex">
							<a class="btn-primary d-block" id="approvebtn" href="javascript:void(0);">Add</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

	<!-- Quote Modal -->
	<div class="modal fade quotepopup" id="quotepopup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
						<div class="quotepopup-button-wrap d-flex">
							<a class="btn-outline-secondary me-3 d-block" href="#">Reject</a>
							<a class="btn-primary d-block" href="#">Approve</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    @endsection
</div>