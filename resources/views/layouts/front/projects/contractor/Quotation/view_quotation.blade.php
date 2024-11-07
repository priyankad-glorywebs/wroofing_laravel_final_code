@extends('layouts.front.master')
@section('title', 'View Quotation')
@section('css')
<style>
	a[disabled] {
		pointer-events: none;
		cursor: not-allowed;
		opacity: 0.5; /* Optional: makes the link look disabled */
	}
</style>

@endsection

@section('content')
 <script>
	function callfundata(obj)
{
        var noimg = '{{ asset("frontend-assets/images/logo.png") }}';
        obj.src=noimg;

	}
	 </script>
<div class="breadcrumb-title-wrap">
	@if(isset($quoteData->project_id))
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{URL('/contractor/list/'.base64_encode($quoteData->project_id))}}"><svg width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.13654 8L1.25522 5.11869C0.914945 4.77841 0.914945 4.22159 1.25522 3.88131L4.13654 1" stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path></svg> Back</a></li>
                </ol>
            </div>
        </div>

		@if($quoteData->status === 'approved' && !empty($quoteData->id) && !isset($transaction)) 
			@php  $quoteID = base64_encode($quoteData->id); @endphp
			<div class="row breadcrumb-title d-lg-flex">
				<div class="col-12 text-end">
					<div class="section-title text-end">
						<a class="btn-primary" id="paynow" href="{{route('customer.quotation.paynow', ['quote_id' => $quoteID])}}">Pay now</a>
					</div>
				</div>
			</div>
		@elseif( isset($transaction) && $transaction['payment_status'] == 'Completed')	
			<div class="row breadcrumb-title d-lg-flex">
				<div class="col-12 text-end">
					<div class="section-title text-end">
						<div class="row justify-content-center">
							<div class="payment-success">
								<h2 class="text-success font-weight-bold">Payment Successful!</h2>

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
	@endif
</div>

	<section class="quotation-aboveprint-btn-sec">
		<div class="container">
			{{--<div class="row btn-action-wrap">
				<div class="col-12 d-flex justify-content-end">
					<a class="btn-outline-secondary me-3" href="#"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_551_1386)"><path d="M4.5 6.75V1.5H13.5V6.75" stroke="#2C2C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M4.5 13.5H3C2.60218 13.5 2.22064 13.342 1.93934 13.0607C1.65804 12.7794 1.5 12.3978 1.5 12V8.25C1.5 7.85218 1.65804 7.47064 1.93934 7.18934C2.22064 6.90804 2.60218 6.75 3 6.75H15C15.3978 6.75 15.7794 6.90804 16.0607 7.18934C16.342 7.47064 16.5 7.85218 16.5 8.25V12C16.5 12.3978 16.342 12.7794 16.0607 13.0607C15.7794 13.342 15.3978 13.5 15 13.5H13.5" stroke="#2C2C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M13.5 10.5H4.5V16.5H13.5V10.5Z" stroke="#2C2C2E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></g><defs><clipPath id="clip0_551_1386"><rect width="18" height="18" fill="white"/></clipPath></defs></svg> Print</a>
					<a class="btn btn-primary" href="#">Send</a>
				</div>
			</div>--}}
			<div class="row quotation-send-success-wrap d-none mt-2">
				<div class="col-12">
					<div class="quotation-send-success-msg">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="12" fill="#53B746"/><path d="M17.6476 8.4707L9.88293 16.2354L6.35352 12.706" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
						Your Quotation has been Approved
					</div>
				</div>
			</div>

        </div>
	</section>

	<section class="quotation-sec">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="quotation-form-wrap">
						<div class="row">
							<div class="col-12">
								{{--<img src="{{asset('frontend-assets/images/forward-logo.png')}}" alt="forward-logo" width="230" height="57">--}}
								@if (file_exists (public_path ($quoteData->contractor->company_logo)) )
                              <img  src="{{asset($quoteData->contractor->company_logo)}}"  style="max-width:230px;max-height:57px;" onerror="this.onerror=null;callfundata(this);" >
                              {{-- onerror="this.onerror=null;callfundata(this);" --}}
                              @else
                              <img  src="{{asset('frontend-assets/images/logo.png')}}"  width="220">
                              
                              @endif
							</div>
						</div>
						<form id="quotation-form">
							<div class="row">
								<input type="hidden" id="project_id" value="{{$quoteData->project->id??''}}">
								<div class="col-12 col-md-6">
									<div class="field-wrap mb-1">
										<div class="form-element">
											<!-- <span>Forward Financial Company</span> -->
											<span>{{$quoteData->contractor->company_name??""}}</span>
										</div>
									</div>
									<div class="field-wrap mb-1">
										<div class="form-element">
											<!-- <span>John doe (your name here)</span> -->
											<span>{{$quoteData->contractor->name??""}}</span>
										</div>
									</div>
									<div class="field-wrap mb-1">
										<div class="form-element">
											<!-- <span>infoemail@gmail.com</span> -->
											<span>{{$quoteData->contractor->email??""}}</span>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="field-wrap mb-1">
										<div class="form-element duedate-inputs d-flex align-items-center">
											<label for="quotationno" class="form-label">Quotation No:</label> {{$quoteData->id??''}}
										</div>
									</div>
									<div class="field-wrap mb-1">
										<div class="form-element duedate-inputs d-flex align-items-center">
											<label for="duedate" class="form-label">Due date:</label>
											{{ \Carbon\Carbon::parse($quoteData->due_date??'')->format('m /d /Y') }}

										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-md-12"><hr></div>
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
											{{$userDetails->name??''}}
										</div>
									</div>
									<div class="field-wrap mb-1">
										<div class="form-element d-flex align-items-center justify-content-between">
											<!-- 1553 Woodhill Avenue Baltimore, MD 21202 -->
											{{$userDetails->address??''}}
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
												<td>{{$item->description??''}}</td>
													<td class="qtywrap">{{$item->quantity}}</td>
													<td class="unitprice">${{$item->unit_price}}</td>
													@php
													$unittotal = $item->quantity * $item->unit_price;
													@endphp

													<td class="unittotal">${{ number_format($unittotal, 2) }}	
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
											{{$quoteData->message??''}}
											<!-- High Profile Ridge Cap Add a beautiful aesthetic to your Home by accepting the ridge line -->
										</div>
										@endif
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="subtotal-title-wrap d-flex align-items-center justify-content-end">
										<div class="subtotal-title">Quote Subtotal:</div>
										<!-- <div class="subtotal-detail">$13,671.15</div> -->
										<div class="subtotal-detail">${{$quoteData->final_price??''}}</div>
									</div>
									<div class="total-title-wrap d-flex align-items-center justify-content-end">
										<div class="subtotal-title">Total:</div>
										<!-- <div class="subtotal-detail">$13,671.15</div> -->
										<div class="subtotal-detail">${{$quoteData->final_price??''}}</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	{{-- @if($quoteData->project->project_status !== "approved")--}}
	@if($quoteData->status !== 'approved' && $quoteData->status !== 'rejected' && !isset($transaction)) 
    <section class="quotation-aboveprint-btn-sec">
		<div class="container">
			<div class="row">
				<div class="col-12 d-flex justify-content-center mb-5">
					<a class="btn-outline-secondary me-3" id="rejected_message" href="javascript:void(0);">Reject</a>
					<a class="btn-primary"  id="approve_message" href="javascript:void(0);">Approve</a>
					<input type="hidden" id="quotation_id" value="{{$quoteData->id??''}}">
				</div>
			</div>
		</div>
	</section>
	 @endif
    {{--@endif --}}

	<!-- start reject quotation popup -->
	<div class="modal fade rejectpopup quotepopup" id="rejectpopup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<div class="modal-title" id="staticBackdropLabel">Reject Quotation</div>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
				</div>
				<form name="addProjectform" method="post">
					<div class="modal-body">
						<div class="quotepopup-wrap">
							<div class="form-label">
								<label for="uname">Reason for Rejection<span>*</span></label>
							</div>
							<div class="form-element">
								<textarea class="form-control" id="reason" name="reason" rows="5" required></textarea>
							</div>
							<span style="color:red" class="error-message d-none"></span>
							<br/>
							<div class="quotepopup-button-wrap d-flex">
								<a class="btn-primary d-block" id="reject_btn"  href="javascript:void(0);">Reject</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade approvedpopup quotepopup" id="approvedpopup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<div class="modal-title" id="staticBackdropLabel">Approved Quotation</div>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
				</div>
				<form name="addProjectform" method="post">
					<div class="modal-body">
						<div class="quotepopup-wrap">
							<div class="form-label">
								<label for="uname">Remarks :<span>*</span></label>
							</div>
							<div class="form-element">
								<textarea class="form-control" id="approved_reason" name="approved_reason" rows="5" required></textarea>
							</div>
							<span style="color:red" class="error-message d-none"></span>
							<br/>
							<div class="quotepopup-button-wrap d-flex">
								<a class="btn-primary d-block" id="approved_btn"  href="javascript:void(0);">Approved</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- end reject quotation popup -->

    @endsection

	@section('scripts')
     <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
	 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	 
	
	<script>
	$(document).ready(function () {
	/* start reject quotation model */
	$('#rejected_message').on("click", function () {
		$('.error-message').val('');
		$('#rejectpopup').modal('show');
	});
	$('#approve_message').on("click", function () {
		$('.error-message').val('');
		$('#approvedpopup').modal('show');
	});
	var quote_id = $('#quotation_id').val();
	$('#reject_btn').on("click", function (e) {
		e.preventDefault();
		var reasonRejection = $('#reason').val();
		var project_id = $('#project_id').val();
		if (reasonRejection == "") {
			$('#reason').css("border", "1px solid red"); 
		}else{
			$('#reason').css("border", "");
			$('#reject_btn').attr('disabled', true);
			$.ajax({
				type: "POST",
				url: "{{route('customer.quotation.status')}}",
				data: {
					reasonRejection:reasonRejection,
					quote_id: quote_id,
					status: 'rejected',
					_token: '{{ csrf_token() }}',
				},
				success: function (response) {
					if(response.success == true){
						if(response.success){
							var projectId = response.data;
							Swal.fire({
							title: "Rejected",
							text: response.message,
							icon: "success",
							}).then((result) => {
						if (result.isConfirmed) {
							$('#addproject').modal('hide');
								location.reload();
							}
						});

						}
					}else{
						$('.error-message').html(response.errors.reasonRejection[0]).removeClass('d-none');
					}
				},
				error: function (xhr, status, error) {
					var responseObject = JSON.parse(xhr.responseText);
					if(responseObject.message != null){
						$('.error-message').html(responseObject.message).removeClass('d-none');
					}
					console.error(xhr.responseText);
				}
			});
		}
	});
	
	$('#approved_btn').on("click", function (e) {
		e.preventDefault();
		var project_id = $('#project_id').val();
		console.log('in');
		var reasonRejection = jQuery(document).find('#approvedpopup #approved_reason').val();
		
		if (reasonRejection == "") {
			$('#approved_reason').css("border", "1px solid red"); 
		}else{
			$('#approved_reason').css("border", "");
			$('#approved_btn').attr('disabled', true);
			$.ajax({
				type: "POST",
				url: "{{route('customer.quotation.status')}}",
				data: {
					reasonRejection:reasonRejection,
					quote_id: quote_id,
					status: 'approved',
					_token: '{{ csrf_token() }}',
					project_id:project_id,

				},
				success: function (response) {
					if(response.success == true){
						// $('#addproject').modal('hide');
						// if(response.success){
						// 	var projectId = response.data;
						// 	location.reload();
						// }
						if(response.success){
							var projectId = response.data;
							Swal.fire({
							title: "Approved",
							text: response.message,
							icon: "success",
							}).then((result) => {
						if (result.isConfirmed) {
							$('#addproject').modal('hide');
								location.reload();
							}
						});

						}

					}else{
						$('#approvedpopup .error-message').html(response.errors.reasonRejection[0]).removeClass('d-none');
					}
				},
				error: function (xhr, status, error) {
					var responseObject = JSON.parse(xhr.responseText);
					if(responseObject.message != null){
						$('#approvedpopup .error-message').html(responseObject.message).removeClass('d-none');
					}
					console.error(xhr.responseText);
				}
			});
		}
	});
	/* end reject quotation model */
});

 

	</script>
	@endsection
