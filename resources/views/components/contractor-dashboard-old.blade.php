			{{-- <input type="text" name="project_id" id="project_id" value={{$project->id??''}}> --}}

            
					<div class="col-12 col-md-6 col-lg-4 item {{$project->project_status}}">
						<div class="contractor-list-item">
							<div class="contractor-img-wrap">
								<div class="contractor-img">
									{{--@if (isset($projectImge))
										<img src="{{ asset('storage/project_images/' . $projectImge->project_image) }}" alt="ProjectImage"
											width="370" height="200">
									@else
										<img src="{{ asset('frontend-assets/images/project-1.png') }}" alt="projectimage"
											width="370" height="200">
									@endif--}}
									@if (isset($projectImge) && isImage($projectImge->project_image))
									<img src="{{ asset('storage/project_images/' . $projectImge->project_image) }}" alt="ProjectImage"
										width="370" height="200">
									@else
									<img src="{{ asset('frontend-assets/images/project-1.png') }}" alt="projectimage"
										width="370" height="200">
									@endif
								</div>
								{{-- @if($project->project_status != "Request" && $project->project_status != null)
									<div class="contractor-review approved-txt d-flex align-items-center 123">
										<div class="contractor-review-text project-status-link">
											<a href="{{ URL::to('contractor/project/details/' . base64_encode($project->id)) }}">{{ $project->project_status ?? '' }}</a>
										</div>
									</div>
								@endif --}}
							</div>
							<div class="contractor-detail-wrap">
								<div class="accordion" id="accordionExample-{{ $project->id }}">
									<div class="accordion-item">
										<div class="accordion-header" id="headingOne-{{ $project->id }}">
											<div class="accordion-button collapsed list-view-detial-item">
												<div class="contractor-detail-title-wrap d-flex">
													<div class="contractor-title-img">
														{{-- <img class="project-img-list-view"
															src="{{ asset('frontend-assets/images/project-1.png') }}"
															alt="contractor" width="370" height="200"> --}}
															{{-- @if (isset($projectImge))
																<img src="{{ asset('storage/project_images/' . $projectImge->project_image) }}" alt="ProjectImage"
																	width="370" height="200">
															@else
																<img src="{{ asset('frontend-assets/images/project-1.png') }}" alt="projectimage"
																	width="370" height="200">
															@endif --}}

													@if (isset($projectImge) && isImage($projectImge->project_image))
													<img src="{{ asset('storage/project_images/' . $projectImge->project_image) }}" alt="ProjectImage"
														width="370" height="200">
													@else
													<img src="{{ asset('frontend-assets/images/project-1.png') }}" alt="projectimage"
														width="370" height="200">
													@endif
													</div>
													<div class="contractor-title-main">
														<div class="project-detail-item project-title">
															{{ $project->title ?? '' }}
															@if ($project->id)
																<div class="contractor-location-text">
																	#{{ $project->id ?? '' }}</div>
															@endif
														</div>

														<div class="project-detail-item d-flex">
															<div class="project-detail-item-detail">{{ $userinfo->name ?? '' }}</div>
														</div>

														<div class="project-detail-item d-flex">
															<div class="project-detail-item-detail ">{{ $userinfo->contact_number ?? '' }}
															</div>
														</div>
														<div class="project-detail-item d-flex">
															<div class="project-detail-item-detail">{{ $userinfo->email ?? '' }}
															</div>
														</div>
														{{-- <div class="project-detail-item">
															@if($project->prroject_status != 'Request')
															<div class="project-detail-item-detail project-status-link"
															><a href="{{ URL::to('contractor/project/details/' . base64_encode($project->id)) }}">{{ $project->project_status ?? '' }}</a>
															</div>
															@endif 
														</div> --}}
														<div class="project-detail-item  d-flex justify-content-end">
															
															<a href="{{ URL('contractor/chat-customer-board/' . base64_encode($project->id) . '/' . base64_encode($project->user_id)) }}">
																<span class="position-relative" id="chatnow-{{$project->id}}">
																	{{-- <x-message-count :project-id="$project->id" :user-id="$project->user_id" role="customer"/> --}}

																	@if($messageCount > 0)<span class="chat-notification" id="chat-notification-contractorside-{{$project->id}}">{{$messageCount}}</span>@endif
																	<img  class="chat-icon" src="{{asset('frontend-assets/images/chat_icon.svg')}}" style="max-width: 22px;margin-right:4px;">
																</span> Chat now</a>
														</div>
														<div class="project-detail-item  d-flex justify-content-end">
															<a class="detail-project-link"
																href="{{ URL::to('contractor/project/details/' . base64_encode($project->id)) }}">View
																More</a>
														</div>
													</div>
												</div>
											</div>
											<button class="accordion-button" type="button" data-bs-toggle="collapse"
												data-bs-target="#collapseOne-{{ $project->id }}" aria-expanded="true"
												aria-controls="collapseOne-{{ $project->id }}">
												<div class="contractor-detail-title-wrap d-flex">
													<div class="contractor-title-img">
														<img class="project-img-list-view"
															src="{{ asset('frontend-assets/images/project-.png') }}"
															alt="contractor" width="370" height="200"
															style="display: none;">

															<img class="profile-image-grid-view"
															src="{{ asset($userinfo->profile_image) }}"
															onerror="this.onerror=null;this.src='{{ asset('frontend-assets/images/Ellipse 15.svg') }}';" alt="contractor-img" width="55" height="55">
													{{--@if(isset($usrinfo->profile_image) && imageExists($usrinfo->profile_image))
														<img src="{{ asset($usrinfo->profile_image) }}" onerror="this.onerror=null;this.src='{{ asset('frontend-assets/images/Ellipse 15.svg') }}';" alt="contractor-img" width="55" height="">
													@elseif(isset($usrinfo->profile_image) && imageExists($usrinfo->profile_image))
														<img src="{{ asset($usrinfo->profile_image) }}" onerror="this.onerror=null;this.src='{{ asset('frontend-assets/images/Ellipse 15.svg') }}';" alt="contractor-img" width="55" height="">
													@else
														<img src="{{ asset('frontend-assets/images/Ellipse 15.svg') }}" alt="customer profile " width="55" height="">
													@endif--}}

														</div>
													<div class="contractor-title-main">
														<div class="contractor-title">{{ $project->title ?? '' }}</div>
														@if ($project->id != null)
															<div class="contractor-location d-flex align-items-center">
																<!-- <div class="contractor-location-icon"><img src="{{-- asset('frontend-assets/images/location-icon.svg') --}}"></div> -->
																<div class="contractor-location-text">
																	#{{ $project->id ?? '' }}</div>
															</div>
														@endif
													</div>
												</div>
											</button>
										</div>
										<div id="collapseOne-{{ $project->id }}"
											class="accordion-collapse collapse show"
											aria-labelledby="headingOne-{{ $project->id }}"
											data-bs-parent="#accordionExample-{{ $project->id }}" style="">
											<div class="accordion-body">
												<div class="quotes-detail">
													{{-- <div class="quotes-detail-item d-flex align-items-center justify-content-between">
												<div class="quotes-detail-item-title">Date:</div>
												<div class="quotes-detail-item-content">Monday to Friday</div>
											</div> --}}
													<div
														class="quotes-detail-item d-flex align-items-center justify-content-between">
														<div class="quotes-detail-item-title">Customer:</div>
														<div class="quotes-detail-item-content">{{ $userinfo->name ?? '' }}
														</div>
													</div>
                                                    {{-- @if(isset($userinfo->contact_number)) --}}
													<div
														class="quotes-detail-item d-flex align-items-center justify-content-between">
														@if(isset($userinfo->contact_number))<div class="quotes-detail-item-title">Phone:</div>@endif
														<div class="quotes-detail-item-content">{{ $userinfo->contact_number ?? '' }}
														</div>
													</div>
                                                    {{-- @endif --}}
													<div
														class="quotes-detail-item d-flex align-items-center justify-content-between">
														<div class="quotes-detail-item-title">Email:</div>
														<div class="quotes-detail-item-content">{{ $userinfo->email ?? '' }}
														</div>
													</div>
													<div
														class="chatbox quotes-detail-item d-flex align-items-center justify-content-between">
														<div class="quotes-detail-item-title">
															<span class="position-relative" id="chatnow-{{$project->id}}">
																{{-- <x-message-count :project-id="$project->id" :user-id="$project->user_id" role="customer"/> --}}
															@if($messageCount > 0)<span id="chat-notification-contractorside-{{$project->id}}">{{$messageCount}}</span>@endif
														
														</div>
														<div class="quotes-detail-item-content"><a
																href="{{ URL('contractor/chat-customer-board/' . base64_encode($project->id) . '/' . base64_encode($project->user_id)) }}"><img class="chat-icon"  src="{{asset('frontend-assets/images/chat_icon.svg')}}"> Chat now</a></div>
													</div>
													<div class="quotes-request-btn-wrap">
														<a class="btn-primary d-block"
															href="{{ URL::to('contractor/project/details/' . base64_encode($project->id)) }}">View
															More</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				