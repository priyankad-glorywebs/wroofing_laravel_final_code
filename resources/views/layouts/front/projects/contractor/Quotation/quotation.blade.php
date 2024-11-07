@extends('layouts.front.master')
@section('title', 'Send Qutation')
<script>
	function callfundata(obj) {
		var noimg = '{{ asset("frontend-assets/images/logo.png") }}';
		obj.src = noimg;
	}
</script>
@section('css')
<style>
	.invalid {
		border: 1px solid red !important;
	}

	.error {
		border: 1px solid red !important;
	}

	a#addItemBtn {
		cursor: pointer;
	}
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
@section('content')
@if($quoteData->project_id)
	<div class="breadcrumb-title-wrap">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a
								href="{{URL('contractor/project/details/' . base64_encode($quoteData->project_id))}}"><svg
									width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path
										d="M4.13654 8L1.25522 5.11869C0.914945 4.77841 0.914945 4.22159 1.25522 3.88131L4.13654 1"
										stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
										stroke-linejoin="round"></path>
								</svg> Back </a></li>
					</ol>
				</div>
			</div>
		</div>
	</div>
@endif
<section class="quotation-sec">
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
					<form id="quotation-form" method="POST">
						<input type="hidden" id="quote_id" value="{{base64_encode($quoteData->id)}}" />
						@csrf
						<div class="row">
							<div class="col-12 col-md-6">
								<div class="field-wrap mb-1">
									<div class="form-element">
										<span class="large" id="yourcompanyname"
											name="yourcompanyname">{{$quoteData->contractor->company_name ?? ''}}</span>
									</div>
								</div>
								<div class="field-wrap mb-1">
									<div class="form-element">
										<span id="yourname" name="yourname">{{$quoteData->contractor->name ?? ''}}</span>
									</div>
								</div>
								<div class="field-wrap mb-1">
									<div class="form-element">
										<span id="emailaddress">{{$quoteData->contractor->email ?? ''}}</span>
									</div>
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="field-wrap mb-1">
									<div class="form-element duedate-inputs d-flex align-items-center ">
										<label for="quotationno" class="form-label">Quotation No:</label>
										<span id="quotationno" name="quotationno">{{$quoteData->id ?? ''}}</span>
									</div>
								</div>
								<div class="field-wrap mb-1">
									<div
										class="form-element duedate-inputs d-flex align-items-center justify-content-between">
										<label for="duedate" class="form-label">Due date:</label>
										<input id="duedate" type="text" name="duedate"
											value="{{$quoteData->due_date ?? ''}}" placeholder="01 / 12 / 2024"
											autocomplete="off">
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
										<label for="customername" class="form-label">Name:</label>
										<span id="customername" class="qty"
											name="customername">{{$userDetails->name ?? ''}}</span>
									</div>
								</div>
								<div class="field-wrap mb-1">
									<div class="form-element d-flex align-items-center">
										<label for="address" class="form-label">Address:</label>
										<span id="address" class="qty"
											name="customername">{{$userDetails->address ?? ''}}</span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="table-responsive">
									<table id="itemTable" class="table">
										<thead class="table-light">
											<tr>
												<th width="40%">Description</th>
												<th width="12%">Qty</th>
												<th width="12%">Unit Price</th>
												<th width="12%">Total</th>
												{{--<th width="12%">Est.Payment</th>--}}
												<th width="12%"></th>
											</tr>
										</thead>
										<tbody>
											@if(isset($quotationItems) && count($quotationItems) > 0)
																					@foreach($quotationItems as $item)	
																															<tr>
																																<td><textarea class="itemdescription" name="itemdescription"
																																		placeholder="Item Details">{{$item->description ?? ''}}</textarea>
																																</td>
																																<td><input type="text" class="itemqty"
																																		oninput="this.value = this.value.replace(/[^0-9]/g, '')"
																																		value="{{$item->quantity ?? ''}}"></td>
																																<td><input type="text" class="itemprice"
																																		oninput="this.value = this.value.replace(/[^0-9]/g, '')"
																																		value="{{$item->unit_price ?? ''}}"></td>
																																@php
																																	$unittotal = $item->quantity * $item->unit_price;
																																@endphp

																																<td><input type="text" class="itemtotal"
																																		value="${{ number_format($unittotal, 2) }}" readonly></td>
																																<td align="center"><span class="removeBtn"><svg width="20" height="20"
																																			viewBox="0 0 20 20" fill="none"
																																			xmlns="http://www.w3.org/2000/svg">
																																			<path d="M2.5 5H4.16667H17.5" stroke="#0A84FF"
																																				stroke-width="1.5" stroke-linecap="round"
																																				stroke-linejoin="round" />
																																			<path
																																				d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984"
																																				stroke="#0A84FF" stroke-width="1.5"
																																				stroke-linecap="round" stroke-linejoin="round" />
																																			<path d="M8.33301 9.1665V14.1665" stroke="#0A84FF"
																																				stroke-width="1.5" stroke-linecap="round"
																																				stroke-linejoin="round" />
																																			<path d="M11.667 9.1665V14.1665" stroke="#0A84FF"
																																				stroke-width="1.5" stroke-linecap="round"
																																				stroke-linejoin="round" />
																																		</svg></span></td>
																															</tr>
																					@endforeach
											@else
												<tr>
													<td><textarea class="itemdescription" name="itemdescription"
															placeholder="Item Details"></textarea></td>
													<td>
														<input class="itemqty" type="text" name="itemqty"
															oninput="this.value = this.value.replace(/[^0-9]/g, '')">
													</td>
													<td>
														<input class="itemprice" type="text" name="itemprice"
															oninput="this.value = this.value.replace(/[^0-9]/g, '')">
													</td>
													<td>
														<input class="itemtotal" type="text" name="itemtotal">
													</td>
													{{--<td class="estpayment"><input class="estpayment" type="text"
															name="estpayment"></td>--}}
													<!-- <td><button class="removeBtn">Remove</button> -->
													<td align="center"><span class="removeBtn"><svg width="20" height="20"
																viewBox="0 0 20 20" fill="none"
																xmlns="http://www.w3.org/2000/svg">
																<path d="M2.5 5H4.16667H17.5" stroke="#0A84FF"
																	stroke-width="1.5" stroke-linecap="round"
																	stroke-linejoin="round" />
																<path
																	d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984"
																	stroke="#0A84FF" stroke-width="1.5"
																	stroke-linecap="round" stroke-linejoin="round" />
																<path d="M8.33301 9.1665V14.1665" stroke="#0A84FF"
																	stroke-width="1.5" stroke-linecap="round"
																	stroke-linejoin="round" />
																<path d="M11.667 9.1665V14.1665" stroke="#0A84FF"
																	stroke-width="1.5" stroke-linecap="round"
																	stroke-linejoin="round" />
															</svg></span></td>

													</td>
												</tr>
											@endif
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-md-6">
								<div class="additem-btn-wrap">
									<div id="error-message" class="error-message" style="display: none;color:red"></div>
									<a id="addItemBtn" class="additem-btn btn-outline-secondary">+ Add item</a>
								</div>
								<div class="field-wrap">
									<div class="form-label">
										<label for="address">Message to customer{{--<span>*</span>--}}</label>
									</div>
									<div class="form-element">
										<textarea id="message" type="text" name="message"
											placeholder="Note to customer">{{$quoteData->message ?? ''}}</textarea>
									</div>
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="subtotal-title-wrap d-flex align-items-center justify-content-end">
									<div class="subtotal-title">Quote Subtotal:</div>
									<div readonly class="quote-subtotal-detail">${{$quoteData->final_price}} </div>
								</div>
								<div class="subtotal-title-wrap d-flex align-items-center justify-content-end">
									<div class="subtotal-title">Total:</div>
									<div readonlys class="subtotal-detail">${{$quoteData->final_price}}</div>
								</div>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col-12 col-md-5">
								<button type="button" class="btn btn-primary d-block w-100" id="submitBtn">Preview &
									Send</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	@endsection
	@section('scripts')
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
		$(document).ready(function () {
			$('.itemqty', '.itemprice', '.itemtotal', '.itemdescription').on('change', function () {
				validateInputs($(this));
			});
			function validateInputs(inputField) {
				var value = inputField.val().trim();
				if (value === '') {
					inputField.addClass('invalid');
				} else {
					inputField.removeClass('invalid');
				}
			}

			var currentDate = new Date();
			var today, datepicker;
			today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
			datepicker = $('#duedate').datepicker({
				minDate: today,
				format: 'mm/dd/yyyy',
			});
			datepicker.datepicker("setDate", currentDate);

			$("#submitBtn").click(function (event) {
				var itemCount = $("#itemTable tbody tr").length;
				if (itemCount === 0) {
					$("#error-message").text("Please add at least one item.").show();
					return;
				}
				event.preventDefault();
				var isEmpty = false;
				var isEmpty = false;
				$("#itemTable tbody").find('input[type="text"], textarea').each(function () {
					if ($(this).val().trim() === '') {
						$(this).addClass("invalid");
						isEmpty = true;
					}
				});
				var requiredFields = ['#duedate'];
				requiredFields.forEach(function (field) {
					var $field = $(field);
					if ($field.val().trim() === '') {
						$field.addClass("invalid");
						isEmpty = true;
					} else {
						$field.removeClass("invalid");
					}
				});
				if (isEmpty) {
					$("#error-message").text("").show();
				} else {
					$("#error-message").hide();
					var items = [];
					$('tbody tr').each(function () {
						var item = {
							description: $(this).find('.itemdescription').val(),
							qty: $(this).find('.itemqty').val(),
							price: $(this).find('.itemprice').val(),
							total: $(this).find('.itemtotal').val()
						};
						items.push(item);
					});
					var quote_id = $('#quote_id').val();
					var message = $('#message').val();
					var due_date = $('#duedate').val();
					var subtotal = $(".quote-subtotal-detail").text();

					$.ajax({
						url: "{{route('quotation.store', ['quote_id' => 'quote_id'])}}".replace('quote_id', quote_id),
						type: 'POST',
						data: {
							items: items,
							_token: '{{ csrf_token() }}',
							message: message,
							due_date: due_date,
							subtotal: subtotal,

						},
						success: function (response) {
							var previewUrl = '{{ route("preview.quotation", ":quote_id") }}';
							previewUrl = previewUrl.replace(':quote_id', quote_id);
							window.location.href = previewUrl;
						},
						error: function (xhr, status, error) {

						}
					});
				}
			});
			$("#itemTable").on('input', '.itemqty, .itemprice', function () {
				updateTotal();
				saveItems();
			});
			$("#itemTable").on('click', '.removeBtn', function () {
				$(this).closest('tr').remove();
				updateTotal();
				saveItems();
			});
			function updateTotal() {
				var subtotal = 0;
				$("#itemTable tbody tr").each(function () {
					var qty = parseFloat($(this).find(".itemqty").val()) || 0;
					var price = parseFloat($(this).find(".itemprice").val()) || 0;
					var total = qty * price;
					subtotal += total;
					$(this).find(".itemtotal").val(total.toFixed(2));
				});
				$(".subtotal-detail").text("$" + subtotal.toFixed(2));
				$(".quote-subtotal-detail").text("$" + subtotal.toFixed(2));

			}
			function saveItems() {
				var items = [];
				$("#itemTable tbody tr").each(function () {
					var qty = $(this).find(".itemqty").val();
					var price = $(this).find(".itemprice").val();
					var description = $(this).find(".itemdescription").val();
					items.push({ qty: qty, price: price, description: description });
				});
				localStorage.setItem('items', JSON.stringify(items));
			}
			$("#addItemBtn").click(function () {
				var isEmpty = false;
				$("#itemTable tbody").find('input[type="text"], textarea').each(function () {
					if ($(this).val().trim() === '') {
						$(this).addClass("invalid");
						isEmpty = true;
					}
				});
				if (isEmpty) {
					return "";
				}
				var newRow = '<tr>' +
					'<td><textarea class="itemdescription" name="itemdescription" placeholder="Item Details"></textarea></td>' +
					'<td><input type="text" class="itemqty" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"  value=""></td>' +
					'<td><input type="text" class="itemprice" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')" value=""></td>' +
					'<td><input type="text" class="itemtotal" readonly></td>' +
					'	<td align="center"><span class="removeBtn"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></td>' +
					'</tr>';
				$("#itemTable tbody").append(newRow);
				saveItems();
				const inputs = document.querySelectorAll("input, textarea");
				inputs.forEach(input => {
					input.addEventListener("blur", function () {
						if (this.value.trim() === "") {
						} else {
							this.classList.remove("invalid");
						}
					});
				});
			});
			function loadItems() {
				var items = JSON.parse(localStorage.getItem('items')) || [];
				$("#itemTable tbody").empty();
				items.forEach(function (item) {
					var newRow = '<tr>' +
						'<td><textarea class="itemdescription" name="itemdescription" placeholder="Item Details">' + item.description + '</textarea></td>' +
						'<td><input type="text" class="itemqty" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')" value="' + item.qty + '"></td>' +
						'<td><input type="text" class="itemprice" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')" value="' + item.price + '"></td>' +
						'<td><input type="text" class="itemtotal" readonly></td>' +
						'<td align="center"><span class="removeBtn"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></td>' +
						'</tr>';
					$("#itemTable tbody").append(newRow);
				});
				updateTotal();

			}

			// Remove 'invalid' class when tabbing from textarea to input
			jQuery(document).find('#itemTable .itemdescription').on('keydown', function (event) {
				$(this).removeClass('invalid');
				if (event.keyCode === 9) { // Tab key
					$(this).removeClass('invalid');
				}
			});
			// Remove 'invalid' class when tabbing from textarea to input
			jQuery(document).find('#itemTable .itemqty, #itemTable .itemprice').on('keydown', function (event) {
				if (!((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode === 9 || event.keyCode === 8)) {
					event.preventDefault();
				} else {
					$(this).removeClass('invalid');
				}
			});
		});
	</script>
	@endsection