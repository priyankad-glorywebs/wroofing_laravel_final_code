<div class="col-12 col-md-6 col-lg-4 item {{ $project->project_status??'' }}" data-cate="{{ $project->project_status??'' }}">
    <style>
        .chat-btn .chat-icon {filter: brightness(0) invert(1);}
        .chat-btn:hover .chat-icon, .chat-btn:focus .chat-icon {filter: unset;}
        .quotes-detail-item-content img {max-width: 20px;}
        .contractor-sec .quotes-detail-item .btn-primary {font-size: 15px; padding: 10px;}

        .contractor-image {
    width: 20px; /* Set the size of the image */
    height: 20px;
    border-radius: 50%;
 /* Round the image if necessary */
}

.contractor-review-text {
    font-size: 12px; /* Adjust text size if needed */
    font-weight: normal; /* Optional: make the text lighter */
}

    </style>
    
    <div>
        <div class="contractor-list-item">
            <a class="contractor-item-link" href="{{ URL::to('contractor/project/details/' . base64_encode($project->id)) }}"></a>
            <div class="contractor-img-wrap">
    
                <div class="contractor-img">
                    @if (isset($projectImage) && isImage($projectImage->project_image))
                        <img src="{{ asset('storage/project_images/' . $projectImage->project_image) }}" alt="ProjectImage"
                            width="370" height="200">
                    @else
                        <img src="{{ asset('frontend-assets/images/project-1.png') }}" alt="projectimage"
                            width="370" height="200">
                    @endif
                </div>
                
                {{-- @if($project->project_status??'' != "Request" && $project->project_status??'' != null) --}}
               
                 @if(isset($status))   
                <div class="contractor-review approved-txt d-flex align-items-center 123">
                        <div class="contractor-review-text project-status-link detail-project-link">
                            <a href="{{ URL::to('contractor/project/details/' . base64_encode($project->id)) }}">View Quote</a>
                        </div>
                </div>
                @endif 
            </div>
           
            <div class="contractor-detail-wrap">
                <div class="accordion" id="accordionExample-{{ $project->id }}">
                    <div class="accordion-item">
                        <a class="overlay-link" href="{{ URL::to('contractor/project/details/' . base64_encode($project->id)) }}"></a>
                        <div class="accordion-header" id="headingOne-{{ $project->id }}">
                            <div class="accordion-button collapsed list-view-detial-item">
                                <div class="contractor-detail-title-wrap d-flex">
                                    <div class="contractor-title-img">
                                        @if (isset($projectImage) && isImage($projectImage->project_image))
                                            <img src="{{ asset('storage/project_images/' . $projectImage->project_image) }}" alt="ProjectImage"
                                                width="370" height="200">
                                        @else
                                            <img src="{{ asset('frontend-assets/images/project-1.png') }}" alt="projectimage"
                                                width="370" height="200">
                                        @endif
                                    </div>
                                    <div class="contractor-title-main">
                                        <div class="project-detail-item project-title">
                                            {{-- <div class="project-id mb-2">{{ $project->title }} @if($project->id) <strong style="color:#0A84FF"> # {{ '['. $project->id .']' }}</strong>  @endif  &nbsp;&nbsp;&nbsp;
                                                @if($project->added_by_contractor == '1') 
                                                <span class="contractor-review-text">
                                                    <img src="{{ asset('frontend-assets/images/Group.svg')}}" style="font-size:10px;border-radious:10%"/> &nbsp;By Contractor 
                                                </span>
                                              @endif
                                            </div> --}}
                                            <div class="project-id mb-2 d-flex align-items-center">
                                                <span class="project-title">
                                                    {{ $project->title }}
                                                    @if($project->id)
                                                        <strong style="color:#0A84FF"> # {{ '[' . $project->id . ']' }}</strong>
                                                    @endif
                                                </span>
                                              
                                                @if($project->added_by_contractor == '1') 
                                                    <span class="contractor-info d-flex align-items-center ms-3">
                                                        <img src="{{ asset('frontend-assets/images/Group.svg')}}" class="contractor-image" alt="Contractor" />
                                                        <span class="contractor-review-text ms-2">By Contractor</span>
                                                    </span>
                                                @endif
                                              </div>

                                              {{-- <div class="contractor-review-text project-status-link detail-project-link">
                                                <a href="http://13.56.14.87/contractor/project/details/Njc=">View Quote</a>
                         
                                                <a class="report-button" data-project-id="67" data-title="The House Roofing">Report</a>
                                            </div> --}}

                                            <div class="project-name mb-1" ><img src="{{asset('frontend-assets/images/contractorDashborad/Test-customer.svg')}}"></img> &nbsp;{{ $userinfo->name }}</div>
                                            @if(isset($userinfo->contact_number))
                                            <div class="project-content-number mb-1" ><img src="{{asset('frontend-assets/images/contractorDashborad/Phone.svg')}}"></img> &nbsp;{{ $userinfo->contact_number }}</div>  
                                            @endif
                                            <div class="project-content-email" ><img src="{{asset('frontend-assets/images/contractorDashborad/email.svg')}}"></img> &nbsp;{{ $userinfo->email }}</div>
                                            {{-- @if ($project->id)
                                                <div class="contractor-location-text">
                                                     @if($project->project_id)
                                                     ${{$project->project_id }}
    
                                                        @else
                                                        #{{$project->id}}
    
                                                    @endif
                                                </div>
                                            @endif --}}
                                        </div>
    
                                     
                                        <div class="project-detail-item project-chat-wrap">
                                            <a class="btn-primary btn-sm w-100 mb-2 chat-btn" href="{{ URL('contractor/chat-customer-board/' . base64_encode($project->id) . '/' . base64_encode($project->user_id)) }}">
                                                {{-- <span class="position-relative" id="chatnowgrid-{{ $project->id }}">
                                                    @if($messageCount > 0)
                                                        <span class="chat-notification" style="color:black;background-color:aliceblue;" id="chat-notification-contractorsidegrid-{{ $project->id }}">{{ $messageCount }}</span>
                                                    @endif
                                                    <img class="chat-icon" src="{{ asset('frontend-assets/images/chat_icon.svg') }}" style="max-width: 22px;margin-right:4px;">
                                                </span> --}}
                                                Chat now
                                                <span class="position-relative" id="chatnowgrid-{{ $project->id }}">
                                                    @if($messageCount > 0)
                                                        <span class="chat-notification" style="color:black;background-color:aliceblue;" id="chat-notification-contractorsidegrid-{{ $project->id }}">{{ $messageCount }}</span>
                                                    @endif
                                                    &nbsp;&nbsp;&nbsp;<img class="chat-icon" src="{{ asset('frontend-assets/images/contractorDashborad/chat.svg') }}" style="max-width: 22px;margin-right:4px;">
                                                </span>
                                            </a>
                                        
                                            {{-- <a class="btn-primary btn-sm detail-project-link w-100" href="{{ URL::to('contractor/project/details/' . base64_encode($project->id)) }}">View More
                                           &nbsp;&nbsp;&nbsp; <img class="chat-icon" src="{{ asset('frontend-assets/images/contractorDashborad/arrow.svg') }}" style="max-width: 22px;margin-right:4px;"></a> --}}
    
                                            @if(isset($status))
                                                  <a class="btn-primary btn-sm project-status-link detail-project-link w-100" href="{{ URL::to('contractor/project/details/' . base64_encode($project->id)) }}">View Quote</a>
                                            @endif
    
                                                @php
                                                $report = \App\Models\Report::where('project_id',$project->id)
                                                ->select('id')
                                                ->where('contractor_id',auth()->guard('contractor')->user()->id)
                                                ->first();
                                                @endphp
    
                                                @if(isset($report))
                                                <a class="btn btn-primary btn-sm mt-2 w-100" href="{{route('report-view',$report->id)}}">Report</a>
                                                @else
                                                <a class="btn btn-primary btn-sm mt-2 w-100 report-button" data-project-id="{{ $project->id }}" data-title="{{ $project->name }}">Report</a>
                                                @endif

    
    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne-{{ $project->id }}" aria-expanded="true"
                                aria-controls="collapseOne-{{ $project->id }}">
                                <div class="contractor-detail-title-wrap d-flex">
                                    <div class="contractor-title-img">
                                        <img class="project-img-list-view" src="{{ asset('frontend-assets/images/project-.png') }}"
                                            alt="contractor" width="370" height="200" style="display: none;">
                                        <img class="profile-image-grid-view" src="{{ asset($userinfo->profile_image) }}"
                                            onerror="this.onerror=null;this.src='{{ asset('frontend-assets/images/Ellipse 15.svg') }}';" alt="contractor-img" width="55" height="55">
                                    </div>
                                    <div class="contractor-title-main">
                                        <div class="contractor-title">{{ $project->title }}</div>
                                        @if ($project->id != null)
                                            <div class="contractor-location d-flex align-items-center">
                                                <div class="contractor-location-text" style="color:#0A84FF !important">#{{ $project->id }}</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </button>
                        </div>
                        <div id="collapseOne-{{ $project->id }}" class="accordion-collapse collapse show"
                            aria-labelledby="headingOne-{{ $project->id }}" data-bs-parent="#accordionExample-{{ $project->id }}" style="">
                            <div class="accordion-body">
                                <div class="quotes-detail">
                                    <div class="quotes-detail-item d-flex align-items-center justify-content-between">
                                        {{-- <div class="quotes-detail-item-title">Customer:</div> --}}
                                        <div class="quotes-detail-item-content d-flex align-items-center">
                                            <img class="me-2" src="{{asset('frontend-assets/images/contractorDashborad/Test-customer.svg')}}"></img> &nbsp;
                                                {{ $userinfo->name }}</div>
                                    </div>
                                    <div class="quotes-detail-item d-flex align-items-center justify-content-between">
                                        {{-- <div class="quotes-detail-item-title">Phone:</div> --}}
                                        @if(isset($userinfo->contact_number))
                                        <div class="quotes-detail-item-content d-flex align-items-center">
                                            <img class="me-2" src="{{asset('frontend-assets/images/contractorDashborad/Phone.svg')}}"></img> &nbsp;
                                             {{ $userinfo->contact_number }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="quotes-detail-item d-flex align-items-center justify-content-between">
                                        {{-- <div class="quotes-detail-item-title">Email:</div> --}}
                                        <div class="quotes-detail-item-content d-flex align-items-center">
                                        <img class="me-2" src="{{asset('frontend-assets/images/contractorDashborad/email.svg')}}"></img> &nbsp;
                                            {{ $userinfo->email }}
                                        </div>
                                    </div>
                                    {{-- <div class="chatbox quotes-detail-item d-flex align-items-center justify-content-between">
                                        <div class="quotes-detail-item-title"></div>
                                        <div class="quotes-detail-item-content">
                                            <a class="chat-btn" href="{{ URL('contractor/chat-customer-board/' . base64_encode($project->id) . '/' . base64_encode($project->user_id)) }}">
                                                <span class="position-relative" id="chatnow-{{ $project->id }}">
                                                    @if($messageCount > 0)
                                                        <span class="chat-notification" id="chat-notification-contractorside-{{ $project->id }}">{{ $messageCount }}</span>
                                                    @endif
                                                    <img class="chat-icon" src="{{ asset('frontend-assets/images/chat_icon.svg') }}" style="max-width: 22px;margin-right:4px;">
                                                </span> Chat now
                                            </a>
                                        </div>
                                    </div> --}}
    
    
    
                                    <div class="quotes-detail-item">
                                        <div class="quotes-detail-item-title">
                                            <div class="chatbox quotes-detail-item d-flex align-items-center justify-content-between">
                                                <div class="quotes-detail-item-content w-100 mt-2">
                                                    <a class="chat-btn btn-primary w-100" href="{{ URL('contractor/chat-customer-board/' . base64_encode($project->id) . '/' . base64_encode($project->user_id)) }}">
                                                        <span class="position-relative" id="chatnow-{{ $project->id }}">
                                                            @if($messageCount > 0)
                                                                <span class="chat-notification" id="chat-notification-contractorside-{{ $project->id }}">{{ $messageCount }}</span>
                                                            @endif
                                                            <img class="chat-icon " src="{{ asset('frontend-assets/images/contractorDashborad/chat.svg') }}" >
                                                        </span> Chat now
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="quotes-request-btn-wrap mt-0">
                                            <a class="btn-primary d-block" href="{{ URL::to('contractor/project/details/' . base64_encode($project->id)) }}">View More
                                            &nbsp;&nbsp;&nbsp;<img class="chat-icon" src="{{ asset('frontend-assets/images/contractorDashborad/arrow.svg') }}" ></a>
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
    
    <script type="text/javascript">
        $('.project-status-link').on("click",function(e){
        sessionStorage.setItem("lastname", "smith");
    });
    
    
    $(document).ready(function() {
     $('.report-button').on('click', function(e) {
            e.preventDefault();
    
            let projectId = $(this).data('project-id');
            let title = $(this).data('title');
            $.ajax({
                url: '{{ route('create-report') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    project_id: projectId,
                    title: title
                },
                success: function(response) {
                    if (response.success) {
                        window.location.href = response.redirect_url;
                    }
                },
                error: function(xhr) {
                    // Handle error
                    console.log(xhr.responseText);
                }
            });
        });
    });
        </script>
    
    
    
     