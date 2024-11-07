@extends('layouts.front.master')
@section('title', 'Design Studio')
@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
	.profileimg{
		height:55px;
		
	}
</style>
@endsection

@section('content')
<div class="breadcrumb-title-wrap pb-0">
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
					{{-- <strong><h2>Project list</h2></strong> --}}
				</div>
			</div>
		</div>
	</div>



	<section class="contractor-sec">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<form id="filterForm" action="{{ route('contractor.dashboard') }}" method="get">
							@csrf
							<div class="row">
							<div class="col-sm-12 col-md-6 col-lg-3 mb-3 mb-md-0">
								<label for="from_date">Search:</label>
								<input type="text" id="title" name="fromtitledate" value="{{old('fromtitledate')}}"  required>
							</div>
							<div class="col-sm-6 col-md-3 col-lg-2 mb-3 mb-sm-0">
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
							</div>
							   <div class="col-sm-12 col-md-2 col-sm-2 col-lg-1 text-end">
								<br/>
							{{--<button type="button" class="btn-primary btn-change-view"><svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.5 3.75H3.75V12.5H12.5V3.75Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M26.25 3.75H17.5V12.5H26.25V3.75Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M26.25 17.5H17.5V26.25H26.25V17.5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12.5 17.5H3.75V26.25H12.5V17.5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg></button>--}}
							<button type="button" class="btn-primary btn-change-view">
								<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M12.5 3.75H3.75V12.5H12.5V3.75Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
									<path d="M26.25 3.75H17.5V12.5H26.25V3.75Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
									<path d="M26.25 17.5H17.5V26.25H26.25V17.5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
									<path d="M12.5 17.5H3.75V26.25H12.5V17.5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
							</svg>
							</button>
								
							</div>
						</div>
						<br/>
					</form>
				<div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="tab-content list-view" id="myTabContent">
						<div class="tab-pane fade show active" id="contractor-list-tab-pane" role="tabpanel" aria-labelledby="contractor-list-tab" tabindex="0">
							
						</div>
						<div class="col-12">
							<div class="btn-gallery-filter-wrap" id="ajax_filter_dash">
								<button class="btn-gallery-filter-dash active" data-category_status="all">All</button>
								<button class="btn-gallery-filter-dash ajax_filter" data-category_status="Approved">Approved</button>
								<button class="btn-gallery-filter-dash ajax_filter" data-category_status="Requested">Requested</button>
								<button class="btn-gallery-filter-dash  ajax_filter" data-category_status="Responded">Responded</button>
								<button class="btn-gallery-filter-dash ajax_filter" data-category_status="Rejected">Rejected</button>
							</div>
						</div>
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

	{{-- @section('scripts') --}}

	{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}


	<script>
        // document.addEventListener('DOMContentLoaded', function() {
		// 	$('.btn-change-view').on('click', function(){
		// 		const filterButton = document.getElementById('filterButton');
		// 		if (filterButton) {
		// 			filterButton.click();
		// 		}
		// 		});
		// 	});
   	 </script>
<script>
// $('#title').on('keypress',function(e) {
// 	if(e.which == 13) {
// 		$('#filterButton').click();
// 	}
// });



// $(document).ready(function () {
// 	$('.project-status-link').on("click",function(e){
// 		sessionStorage.setItem("lastname", "smith");
// 	});

// var initialfromDate = "";
// var initialtoDate = "";


// var currentDate = new Date();

// var fromDefaultDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);

// var year = fromDefaultDate.getFullYear();
// var month = ('0' + (fromDefaultDate.getMonth() + 1)).slice(-2);
// var day = ('0' + fromDefaultDate.getDate()).slice(-2);

// var formattedfromDate = month + '-' + day + '-' + year;
// $('#from_date').val(formattedfromDate);

// var toDefaultDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);

// var year = toDefaultDate.getFullYear();
// var month = ('0' + (toDefaultDate.getMonth() + 1)).slice(-2);
// var day = ('0' + toDefaultDate.getDate()).slice(-2);

// var formattedtoDate = month + '-' + day + '-' + year;
// $('#to_date').val(formattedtoDate);

// var dateFormat = "mm-dd-yy";

// var dates = $("#from_date, #to_date").datepicker({
// 	dateFormat: dateFormat, 
// 	onSelect: function(selectedDate) {
// 		var option = this.id == "from_date" ? "minDate" : "maxDate",
// 			instance = $(this).data("datepicker"),
// 			date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);

// 		if (this.id === "from_date") {
// 			option = "minDate";
// 		}
// 		else {
// 			option = null;
// 		}

// 		dates.not(this).datepicker("option", option, date);
// 	},
// 	onChangeMonthYear: function(year, month, instance) {
// 		var currentMonthStart = new Date(year, month - 1, 1);
// 		var currentMonthEnd = new Date(year, month, 0);
// 		var formattedCurrentMonthStart = year + '-' + ('0' + month).slice(-2) + '-' + ('0' + currentMonthStart.getDate()).slice(-2);
// 		var formattedCurrentMonthEnd = year + '-' + ('0' + (month + 1)).slice(-2) + '-' + ('0' + currentMonthEnd.getDate()).slice(-2);
// 		// $('#from_date').val(formattedCurrentMonthStart);
// 		//$('#to_date').val(formattedCurrentMonthEnd);
// 	}
// });

	// $('#filterButton').on('click', function () {
	// 	// alert("dnjkn");
	// 	var categoryName = jQuery('#ajax_filter_dash').find('.btn-gallery-filter-dash.active').data('cate');
	// 	var fromDate = $('#from_date').val();
	// 	var toDate = $('#to_date').val();
	// 	var title = $('#title').val();

	// 	$.ajax({
	// 		url: '{{ route("contractor.dashboard")}}',
	// 		type: 'GET',
	// 		data: { 
	// 			from_date: fromDate,
	// 			to_date: toDate,
	// 			title:title,
	// 			project_status: categoryName,
	// 		},
	// 		success: function (data) {
	// 			$('#test').html(data.html);
	// 		},
	// 		error: function (xhr, status, error) {
	// 			console.error(error);
	// 		}
	// 	});
	// 	$(document).on('click', '.pagination a', function (event) {
	// 		event.preventDefault();
	// 		var url = $(this).attr('href');
	// 		$.get(url, function (data) {
	// 			$('#test').html(data.html);
	// 			$('html, body').animate({ scrollTop: $('#test').offset().top }, 'slow');
	// 		});
	// 	});
	// });

	// var contractorDashboardUrl = "{{ route('contractor.dashboard') }}";
	// $('#resetFilterButton').on('click', function () {
	// 	$('#filterForm #title').val('');
	// 	// Remove 'active' class from all buttons
	// 	$('.btn-gallery-filter-dash').removeClass('active');
    //     // Add 'active' class to the first button
    //     $('.btn-gallery-filter-dash').first().addClass('active');
	// 	$('#from_date').datepicker('setDate', formattedfromDate);
	// 	$('#to_date').datepicker('setDate', formattedtoDate);
	// 	filterButton.click();
	// });



	/* 22-05-2024 */
	// jQuery('#ajax_filter_dash .btn-gallery-filter-dash').click(function(e){
	// 	e.preventDefault();
	// 	$('.btn-gallery-filter-dash').removeClass('active');
	// 	$(this).addClass('active');
	// 	var categoryName = jQuery(this).data('cate');
	// 	var fromDate = $('#from_date').val();
	// 	var toDate = $('#to_date').val();
	// 	var title = $('#title').val();
	// 	$.ajax({
	// 		url: '{{ route("contractor.dashboard")}}',
	// 		type: 'GET',
	// 		data: { 
	// 			from_date	: fromDate, 
	// 			to_date		: toDate,
	// 			title		: title,
	// 			title		: title,
	// 			project_status		: categoryName,
	// 		},
	// 		success: function (data) {
	// 			$('#test').html(data.html);
	// 		},
	// 		error: function (xhr, status, error) {
	// 			console.error(error);
	// 		}
	// 	});

	// 	$(document).on('click', '.pagination a', function (event) {
	// 		event.preventDefault();
	// 		var url = $(this).attr('href');
	// 		$.get(url, function (data) {
	// 			$('#test').html(data.html);
	// 			$('html, body').animate({ scrollTop: $('#test').offset().top }, 'slow');
	// 		});
	// 	});
	// });


// });

// $(document).ready(function() {
//     $('.btn-gallery-filter-dash').click(function(e) {
//         e.preventDefault();

//         var category = $(this).attr('data-category');
// 		alert("category: " + category)
//         $('.btn-gallery-filter-dash').removeClass('active');
// 		$(this).addClass('active');

//         if (category == 'all') {
//             $('.item').removeClass('hide');
//         } else {
//             $('.item').each(function() {
//                 var itemCategory = $(this).attr('data-cate');
//                 if (itemCategory && itemCategory.includes(category)) {
// 					$(this).removeClass('hide');


//                 } else {
// 					$(this).addClass('hide');

					
//                 }
//             });
//         }
//     });
// });
// $(document).ready(function() {
//     $('.btn-gallery-filter-dash').click(function(e) {
//         e.preventDefault();

//         var category = $(this).attr('data-category_status');
// 		// alert(category + ' selected');
//         $('.btn-gallery-filter-dash').removeClass('active');
//         $(this).addClass('active');

//         if (category == 'all') {
//             $('.item').removeClass('hide');
//         } else {
//             $('.item').each(function() {
//                 var itemCategory = $(this).attr('data-cate');
//                 if (itemCategory && itemCategory.includes(category)) {
//                   $(this).removeClass("hide");

//                 } else {
//                    $(this).addClass('hide');


//                 }
//             });
//         }
//     });
// });



</script>
{{-- @endsection --}}