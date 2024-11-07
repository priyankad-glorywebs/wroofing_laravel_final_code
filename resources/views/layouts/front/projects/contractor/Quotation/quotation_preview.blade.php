@extends('layouts.front.master')
@section('title', 'send Qutation')
<script>
	function callfundata(obj) {
		var noimg = '{{ asset("frontend-assets/images/logo.png") }}';
		obj.src = noimg;
	}
</script>
@section('css')
<style>
	@media print {
		.btn-print {
			display: none;
		}
		.btn-send {
			display: none;
		}
	}
	@media print {
		.navbar {
			display: none;
		}
	}
	@media print {
		.breadcrumb-title-wrap {
			display: none;
		}
	}
	@media print {
		.quotation-aboveprint-btn-sec {
			display: none;
		}
	}
</style>
@endsection
@section('content')
<div class="breadcrumb-title-wrap">
	<div class="container">
		<div class="row">
			<div class="col-12" id="previous-link"> 
				@if(!in_array($quoteData->status ?? '', ['approved', 'rejected', 'Responded']))
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a
								href="{{ route('send.quotation.view', ['quote_id' => base64_encode($quoteData->id)]) }}"><svg
									width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path
										d="M4.13654 8L1.25522 5.11869C0.914945 4.77841 0.914945 4.22159 1.25522 3.88131L4.13654 1"
										stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
										stroke-linejoin="round" />
								</svg> Preview Quotation {{$quoteData->id ?? ''}}</a></li>
					</ol>
				@else
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a
								href="{{URL('contractor/project/details/' . base64_encode($quoteData->project_id))}}"><svg
									width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path
										d="M4.13654 8L1.25522 5.11869C0.914945 4.77841 0.914945 4.22159 1.25522 3.88131L4.13654 1"
										stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
										stroke-linejoin="round" />
								</svg> Back </a></li>
					</ol>
				@endif
			</div>
		</div>
		@if(isset($transaction) && $transaction['payment_status'] == 'Completed')
		<div class="row breadcrumb-title d-lg-flex">
			<div class="col-12 text-end">
				<div class="section-title text-end">
					<div class="row justify-content-center">
						<div class="payment-success">
							<h2 class="text-success font-weight-bold">Paid</h2>
							@php
								$dateString = $transaction['created_at'];
								$created_at = \Carbon\Carbon::parse($dateString)->format('F j, Y');
							@endphp
							<div class="mt-4">
								<h5 class="mb-2">Transaction ID: <span id="transaction-id">[#{{$transaction['id']}}]</span></h5>
								<h5> Date: <span id="transaction-date">[#{{$created_at}}]</span> </h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>
<section class="quotation-aboveprint-btn-sec">
	<div class="container">
		<input type="hidden" value="{{$quoteData->project_id ?? ''}}" id="project_id">
		@if(!in_array($quoteData->status ?? '', ['approved', 'rejected', 'Responded']))
			<div class="row btn-action-wrap">
				<div class="col-12 d-flex justify-content-end">
					<a class="btn-outline-secondary me-3" href="javascript:void(0);" onclick="window.print();"><svg
							width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<g clip-path="url(#clip0_551_1386)">
								<path d="M4.5 6.75V1.5H13.5V6.75" stroke="#2C2C2E" stroke-width="1.5" stroke-linecap="round"
									stroke-linejoin="round" />
								<path
									d="M4.5 13.5H3C2.60218 13.5 2.22064 13.342 1.93934 13.0607C1.65804 12.7794 1.5 12.3978 1.5 12V8.25C1.5 7.85218 1.65804 7.47064 1.93934 7.18934C2.22064 6.90804 2.60218 6.75 3 6.75H15C15.3978 6.75 15.7794 6.90804 16.0607 7.18934C16.342 7.47064 16.5 7.85218 16.5 8.25V12C16.5 12.3978 16.342 12.7794 16.0607 13.0607C15.7794 13.342 15.3978 13.5 15 13.5H13.5"
									stroke="#2C2C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
								<path d="M13.5 10.5H4.5V16.5H13.5V10.5Z" stroke="#2C2C2E" stroke-width="1.5"
									stroke-linecap="round" stroke-linejoin="round" />
							</g>
							<defs>
								<clipPath id="clip0_551_1386">
									<rect width="18" height="18" fill="white" />
								</clipPath>
							</defs>
						</svg> Print</a>
					<a class="btn btn-primary send_quotation" href="javascript:void(0);" id="send">Send</a>
				</div>
			</div>
		@endif
		<div class="row quotation-send-success-wrap d-none mt-2">
			<div class="col-12">
				<div class="quotation-send-success-msg">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<circle cx="12" cy="12" r="12" fill="#53B746" />
						<path d="M17.6476 8.4707L9.88293 16.2354L6.35352 12.706" stroke="white" stroke-width="2.5"
							stroke-linecap="round" stroke-linejoin="round" />
					</svg>
					Your Quotation has been sent
				</div>
			</div>
		</div>
	</div>
</section>
<section class="quotation-sec">
	<div class="loader-container">
		<div id="sendloader" style="display: none;"></div>
	</div>
	<style>
		#sendloader {
			position: fixed;
			top: 0;
			left: 0;
			width: 100vw;
			height: 100vh;
			background-color: #0000001f;
			background-repeat: no-repeat;
			background-size: 6%;
			background-position: 50% 50%;
			background-image: url("{{asset('send-quatation.gif')}}");
			/* background-image: url("https://smartpay.pl/Content/loading2.gif"); */
		}
	</style>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="quotation-form-wrap">
					<div class="row">
						<div class="col-12">
							@if (file_exists(public_path($quoteData->contractor->company_logo)))
								<img src="{{asset($quoteData->contractor->company_logo)}}" style="width:230px;height:57px;"
									onerror="this.onerror=null;callfundata(this);">
							@else
								<img src="{{asset('frontend-assets/images/logo.png')}}" style="width:230px;height:57px;">
							@endif
						</div>
					</div>
					<form id="quotation-form">
						<div class="row">
							<div class="col-12 col-md-6">
								<div class="field-wrap mb-1">
									<div class="form-element">
										<!-- <span>Forward Financial Company</span> -->
										<span>{{$quoteData->contractor->company_name ?? ""}}</span>
									</div>
								</div>
								<div class="field-wrap mb-1">
									<div class="form-element">
										<!-- <span>John doe (your name here)</span> -->
										<span>{{$quoteData->contractor->name ?? ""}}</span>
									</div>
								</div>
								<div class="field-wrap mb-1">
									<div class="form-element">
										<!-- <span>infoemail@gmail.com</span> -->
										<span>{{$quoteData->contractor->email ?? ""}}</span>
									</div>
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="field-wrap mb-1">
									<div class="form-element duedate-inputs d-flex align-items-center">
										<label for="quotationno" class="form-label">Quotation No:</label>
										{{$quoteData->id ?? ''}}
									</div>
								</div>
								<div class="field-wrap mb-1">
									<div class="form-element duedate-inputs d-flex align-items-center">
										<label for="duedate" class="form-label">Due date:</label>
										{{ \Carbon\Carbon::parse($quoteData->due_date ?? '')->format('m /d /Y') }}
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-md-12">
								<hr>
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-md-12">
								<div class="billto-title">Bill To:</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-md-6">
								<div class="field-wrap mb-1">
									<div class="form-element d-flex align-items-center">
										<!-- Richard M.Rollins -->
										{{$userDetails->name ?? ''}}
									</div>
								</div>
								<div class="field-wrap mb-1">
									<div class="form-element d-flex align-items-center justify-content-between">
										<!-- 1553 Woodhill Avenue Baltimore, MD 21202 -->
										{{$userDetails->address ?? ''}}
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="table-responsive">
									<table class="table">
										<thead class="table-light">
											<tr>
												<th width="40%">Description</th>
												<th width="15%">Qty</th>
												<th width="15%">Unit Price</th>
												<th width="15%">Total</th>
											</tr>
										</thead>
										<tbody>
											@foreach($quotationitem as $item)	
												<tr>
													<td>{{$item->description ?? ''}}</td>
													<td class="qtywrap">{{$item->quantity}}</td>
													<td class="unitprice">${{$item->unit_price}}</td>
													@php
														$unittotal = $item->quantity * $item->unit_price;
													@endphp
													<td class="unittotal">
														${{ number_format($unittotal, 2) }}
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-md-6">
								<div class="field-wrap mb-3">
									@if(isset($quoteData->message) && $quoteData->message !== null && $quoteData->message !== '')

									<div class="form-label">
										<label for="address">Message to customer</label>
									</div>
									<div class="form-element">
										{{$quoteData->message ?? ''}}
										<!-- High Profile Ridge Cap Add a beautiful aesthetic to your Home by accepting the ridge line -->
									</div>
									@endif
								</div>
							</div>
							
							<div class="col-12 col-md-6">
								<div class="subtotal-title-wrap d-flex align-items-center justify-content-end">
									<div class="subtotal-title">Quote Subtotal:</div>
									<!-- <div class="subtotal-detail">$13,671.15</div> -->
									<div class="subtotal-detail">${{$quoteData->final_price ?? ''}}</div>
								</div>
								<div class="total-title-wrap d-flex align-items-center justify-content-end">
									<div class="subtotal-title">Total:</div>
									<!-- <div class="subtotal-detail">$13,671.15</div> -->
									<div class="subtotal-detail">${{$quoteData->final_price ?? ''}}</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@if(!in_array($quoteData->status ?? '', ['approved', 'rejected', 'Responded']))
	<section class="quotation-aboveprint-btn-sec">
		<div class="container">
			<div class="row">
				<div class="col-12 d-flex justify-content-center mb-5">
					<a class="btn-outline-secondary me-3" href="javascript:void(0);" onclick="window.print();"><svg
							width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<g clip-path="url(#clip0_551_1386)">
								<path d="M4.5 6.75V1.5H13.5V6.75" stroke="#2C2C2E" stroke-width="1.5" stroke-linecap="round"
									stroke-linejoin="round"></path>
								<path
									d="M4.5 13.5H3C2.60218 13.5 2.22064 13.342 1.93934 13.0607C1.65804 12.7794 1.5 12.3978 1.5 12V8.25C1.5 7.85218 1.65804 7.47064 1.93934 7.18934C2.22064 6.90804 2.60218 6.75 3 6.75H15C15.3978 6.75 15.7794 6.90804 16.0607 7.18934C16.342 7.47064 16.5 7.85218 16.5 8.25V12C16.5 12.3978 16.342 12.7794 16.0607 13.0607C15.7794 13.342 15.3978 13.5 15 13.5H13.5"
									stroke="#2C2C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
								</path>
								<path d="M13.5 10.5H4.5V16.5H13.5V10.5Z" stroke="#2C2C2E" stroke-width="1.5"
									stroke-linecap="round" stroke-linejoin="round"></path>
							</g>
							<defs>
								<clipPath id="clip0_551_1386">
									<rect width="18" height="18" fill="white"></rect>
								</clipPath>
							</defs>
						</svg> Print</a>
					<a class="btn-primary send_quotation" href="javascript:void(0);" id="send">Send</a>
					<input type="hidden" id="quotation_id" value="{{$quoteData->id ?? ''}}">
				</div>
			</div>
		</div>
	</section>
@endif
@endsection
@section('scripts')
<script>
	$(document).ready(function () {
		quote_id = $('#quotation_id').val();
		// var projectId = $('#project_id').val();
		// var projectId = btoa($('#project_id').val());
		// alert(quote_id);
		jQuery(document).find('.send_quotation').on("click", function (event) {
			event.preventDefault()
			// Display confirmation alert
			sweetAlert({
				title: 'Are you sure?',
				text: "You want to send a quotation to the customer!",
				type: 'info',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, proceed!'
			}, function (isConfirmed) {
				if (isConfirmed) {
					jQuery('#sendloader').show();
					$.ajax({
						url: "{{route('send.quote')}}",
						type: 'POST',
						data: {
							quote_id: quote_id,
							_token: '{{ csrf_token() }}',
						},
						success: function (response) {
							if (response.success == true) {
								//console.log(response.pdf);
								$('.quotation-send-success-wrap').removeClass('d-none').addClass('d-block');
								setTimeout(function () {
									$('.quotation-send-success-wrap').addClass('d-none').removeClass('d-block');
									$('.quotation-aboveprint-btn-sec').addClass('d-none');

									$('#previous-link').load(location.href + ' #previous-link');
										// window.location.href = "{{route('contractor.dashboard')}}";
									$('#sendloader').hide();
								}, 5000);
							}
						},
						error: function (xhr, status, error) {
						}
					});
				}
			});
		});
	});

history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
</script>
@endsection
