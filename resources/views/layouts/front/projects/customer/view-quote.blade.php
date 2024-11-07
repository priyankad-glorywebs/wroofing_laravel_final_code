							{{--<div class="row">
								<div class="col-12">
									<div class="btn-gallery-filter-wrap">
										<button class="btn-gallery-filter active" data-category="all">All</button>
										<button class="btn-gallery-filter" data-category="approved">Approved</button>
										<button class="btn-gallery-filter" data-category="requested">Requested</button>
										<button class="btn-gallery-filter" data-category="rejected">Rejected</button>
									</div>
								</div>
							</div>--}}
							<div class="row">
								
							@if(isset($quotations))
								@foreach($quotations as $quotation)
								@php
								$contractor = \App\Models\Contractor::where('id',$quotation->contractor_id)->first();
								@endphp
								<div class="col-12 col-md-6 col-lg-4 item" data-category="{{$quotation->status??''}}">
									<div class="contractor-list-item">
										<div class="contractor-detail-wrap">
											<div class="accordion" id="accordionExample">
												<div class="accordion-item">
													<div class="accordion-header" id="headingOne">
														<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
															<div class="contractor-detail-title-wrap d-flex">
																<div class="contractor-title-img">
																	{{--<img src="{{asset('frontend-assets/images/Ellipse 15.svg'
                                                                        )}}" alt="contractor-img" width="55" height="">--}}
																		@if(isset($contractor->profile_image))
                                                        <img src="{{asset($contractor->profile_image)}}" onerror="this.onerror=null;callfundata(this);" alt="contractor-img" width="55" height="">
                                                    @else
                                                        <img src="{{asset('frontend-assets/images/Ellipse 15.svg')}}" alt="contractor-img" width="55" height="">
                                                    @endif
																</div>
																<div class="contractor-title-main">
																	<div class="contractor-title">{{$contractor->name??''}}’s Roofing</div>
																	{{--<div class="contractor-location d-flex align-items-center">
																		<div class="contractor-location-icon"><img src="images/location-icon.svg"></div>
																		<div class="contractor-location-text">Rockwall (3.5 miles away)</div>
																	</div>--}}
																</div>																
															</div>
														</button>
													</div>
													<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
														<div class="accordion-body">
															<div class="quotes-detail">
																
																{{--<div class="quotes-detail-item d-flex align-items-center justify-content-between">
																	<div class="quotes-detail-item-title">Time:</div>
																	<div class="quotes-detail-item-content">9:00am to 5:00pm</div>
																</div>--}}
																<div class="quotes-detail-item d-flex align-items-center justify-content-between">
																	<div class="quotes-detail-item-title">Call:</div>
																	<div class="quotes-detail-item-content">{{$contractor['contact_number']??''}}</div>

																</div>
																<div class="quotes-detail-item d-flex align-items-center justify-content-between">
																	<div class="quotes-detail-item-title">Email:</div>
																	<div class="quotes-detail-item-content"><a href="mailto:jon.doe4@gmail.com">{{$contractor['email']??''}}</a></div>
																</div>
																<div class="quotes-detail-item d-flex align-items-center justify-content-between">
																	<div class="quotes-detail-item-title">Date:</div>
																	<div class="quotes-detail-item-content">{{--$quotation->created_at--}}
																	{{ \Carbon\Carbon::parse($quotation->created_at??'')->format('d M Y, D') }}
																	</div>
																</div>


																<div class="quotes-detail-item d-flex align-items-center justify-content-between">
																	<div class="quotes-detail-item-title">Status:</div>
																	@if($quotation->status == 'Requested')
																	<div class="quotes-detail-item-content">{{$quotation->status??''}}</div>
																	@elseif($quotation->status == 'approved')
																	<div><span class="approved-status">{{$quotation->status??''}}</span></div>
																	@elseif($quotation->status == 'Responded')
																	<div><span class="approved-status">{{$quotation->status??''}}</span></div>
																	@elseif($quotation->status == 'rejected')
																	<div><span class="rejected-status">{{$quotation->status??''}}</span></div>
																	@endif		
																</div>


																<div class="quotes-request-btn-wrap">
																@if($quotation->status == 'Requested')
																<a class="btn-primary d-block btn-requested" disabled >Requested for quote</a>
																@elseif($quotation->status == 'Responded')
																<a class="btn-primary d-block btn-approved" href="{{route('view.quote',['quote_id'=>base64_encode($quotation->id)])}}" >View quote</a>
																@elseif($quotation->status == 'approved')
																<a class="btn-primary d-block btn-approved" href="{{route('view.quote',['quote_id'=>base64_encode($quotation->id)])}}" >View quote</a>
																{{--@elseif($quotation->status == 'rejected')
																<a class="btn-primary d-block btn-rejected" disbaled >Rejected quote</a>--}}
																@endif
																</div>
																{{--<div class="quotes-request-btn-wrap">
																	@if(isset($quoteData))  
																	@if(in_array($contractorList->id, $quoteData))
																	
																	@if($quotation->status == 'Requested')
																	<a class="btn-primary d-block btn-requested" disabled >Requested for quote</a>
																	@elseif($quotation->status == 'Responded')
																	<a class="btn-primary d-block btn-approved" href="{{route('view.quote',['quote_id'=>base64_encode($quotation->id)])}}" >View quote</a>
																	@elseif($quotation->status == 'approved')
																	

																	<div class="quotes-detail-item d-flex align-items-center justify-content-between">
																	<div class="quotes-detail-item-title">Status</div>
																	<div class="quotes-detail-item-content approved-status">Approved</div>


																</div>
																	@elseif($quotation->status == 'rejected')
																	 
																	<div class="quotes-detail-item d-flex align-items-center justify-content-between">
																	<div class="quotes-detail-item-title">Status</div>
																	<div class="quotes-detail-item-content rejected-status">Rejected</div>

																</div>
															
																	@endif
																	@endif
																	@endif
																</div>--}}
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
								{{--<div class="col-12 col-md-6 col-lg-4 item" data-category="approved">
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
																	<div class="contractor-title">Bob’s Roofing</div>
																	<div class="contractor-location d-flex align-items-center">
																		<div class="contractor-location-icon"><img src="{{asset('frontend-assets/images/location-icon.svg')}}"></div>
																		<div class="contractor-location-text">Rockwall (3.5 miles away)</div>
																	</div>
																</div>																
															</div>
														</button>
													</div>
													<div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample2">
														<div class="accordion-body">
															<div class="quotes-detail">
																<div class="quotes-detail-item d-flex align-items-center justify-content-between">
																	<div class="quotes-detail-item-title">Date:</div>
																	<div class="quotes-detail-item-content">Monday to Friday</div>
																</div>
																<div class="quotes-detail-item d-flex align-items-center justify-content-between">
																	<div class="quotes-detail-item-title">Time:</div>
																	<div class="quotes-detail-item-content">9:00am to 5:00pm</div>
																</div>
																<div class="quotes-detail-item d-flex align-items-center justify-content-between">
																	<div class="quotes-detail-item-title">Call:</div>
																	<div class="quotes-detail-item-content"><a href="tel:8525625112">852 - 562 - 5112</a></div>
																</div>
																<div class="quotes-detail-item d-flex align-items-center justify-content-between">
																	<div class="quotes-detail-item-title">Email:</div>
																	<div class="quotes-detail-item-content"><a href="mailto:jon.doe4@gmail.com">jon.doe4@gmail.com</a></div>
																</div>
																<div class="quotes-request-btn-wrap">
																	<a class="btn-primary d-block btn-approved" href="#" data-bs-toggle="modal" data-bs-target="#quotepopup">Request a quote</a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>--}}

								{{--<div class="col-12 col-md-6 col-lg-4 item" data-category="rejected">
									<div class="contractor-list-item">
										<div class="contractor-detail-wrap">
											<div class="accordion" id="accordionExample3">
												<div class="accordion-item">
													<div class="accordion-header" id="headingThree">
														<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
															<div class="contractor-detail-title-wrap d-flex">
																<div class="contractor-title-img">
																	<img src="{{asset('frontend-assets/images/Ellipse 15.svg')}}" alt="contractor-img" width="55" height="">
																</div>
																<div class="contractor-title-main">
																	<div class="contractor-title">Bob’s Roofing</div>
																	<div class="contractor-location d-flex align-items-center">
																		<div class="contractor-location-icon"><img src="{{asset('frontend-assets/images/location-icon.svg')}}"></div>
																		<div class="contractor-location-text">Rockwall (3.5 miles away)</div>
																	</div>
																</div>																
															</div>
														</button>
													</div>
													<div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample3">
														<div class="accordion-body">
															<div class="quotes-detail">
																<div class="quotes-detail-item d-flex align-items-center justify-content-between">
																	<div class="quotes-detail-item-title">Date:</div>
																	<div class="quotes-detail-item-content">Monday to Friday</div>
																</div>
																<div class="quotes-detail-item d-flex align-items-center justify-content-between">
																	<div class="quotes-detail-item-title">Time:</div>
																	<div class="quotes-detail-item-content">9:00am to 5:00pm</div>
																</div>
																<div class="quotes-detail-item d-flex align-items-center justify-content-between">
																	<div class="quotes-detail-item-title">Call:</div>
																	<div class="quotes-detail-item-content"><a href="tel:8525625112">852 - 562 - 5112</a></div>
																</div>
																<div class="quotes-detail-item d-flex align-items-center justify-content-between">
																	<div class="quotes-detail-item-title">Email:</div>
																	<div class="quotes-detail-item-content"><a href="mailto:jon.doe4@gmail.com">jon.doe4@gmail.com</a></div>
																</div>
																<div class="quotes-request-btn-wrap">
																	<a class="btn-primary d-block btn-rejected" href="#" data-bs-toggle="modal" data-bs-target="#quotepopup">Request a quote</a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>--}}
							</div>
						