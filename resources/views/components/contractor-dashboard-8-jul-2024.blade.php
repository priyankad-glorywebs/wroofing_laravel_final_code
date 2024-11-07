
<style> .contractor-detail-title-wrap {
    display: flex;
    align-items: flex-start;
    margin-bottom: 10px; /* Adjust spacing between items */
   /*  border: 1px solid #ddd; Optional: Add a border for separation */
    padding: 5px;
   /*  background-color: #f9f9f9; Optional: Background color for the container */
}

.contractor-title-img {
    flex: 0 0 auto;
    margin-right: 20px;
    width: 120px; /* Fixed width for the image column */
}

.contractor-title-img img {
    width: 100%;
    height: auto;
    display: block;
}

.contractor-title-main {
    flex: 1;
}

.project-title {
    margin-bottom: 10px;
}

.project-title h4 {
    margin-bottom: 5px;
}

.project-detail-item {
    margin-bottom: 10px;
}

.project-detail-item ul {
    padding-left: 0;
    list-style: none;
}

.project-detail-item li {
    margin-bottom: 5px;
}

/* .project-chat-wrap .btn-primary {
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    padding: 8px 16px;
    border-radius: 4px;
} */
.project-chat-wrap .btn-primary {
    height: 42px;
    padding: 10px 20px;
    text-align: center;
    line-height: 20px;
    vertical-align: middle;
}
.project-chat-wrap .btn-primary:first-child {
margin-left: auto;
margin-right: 10px;
}

.detail-project-link {
    display: block;
    text-align: center; 
    margin-top: 10px; 
}


/* .project-chat-wrap .btn-primary,
.detail-project-link {
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    padding: 8px 16px;
    border-radius: 4px;
    margin-bottom: 10px; 
     width: calc(100% - 20px); 
    max-width: 200px;
    box-sizing: border-box; 
} */


.detail-project-link {
    background-color: #28a745; /* Example background color */
    color: #fff; /* Example text color */
    border: 1px solid #28a745; /* Example border color */
}
.contractor-sec .list-view .contractor-list-item {
    border-left:5px solid #53B746;
}
.contractor-sec .list-view {}
.contractor-sec .list-view .list-view-detial-item {
    padding: 10px;
}
.contractor-sec .list-view .list-view-detial-item .contractor-title-img {
    width: 100px;
    height: 100px;
}
.contractor-sec .list-view .contractor-detail-title-wrap {
    margin-bottom: 0;
    padding: 0
}
.contractor-sec .list-view .project-detail-item {margin-bottom: 0;}
.contractor-sec .list-view .project-chat-wrap {display: flex;}
    </style>
<div class="col-12 col-md-6 col-lg-4 item {{ $project->project_status??'' }}" data-cate="{{ $project->project_status??'' }}">
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
    {{-- resources/views/components/project-item.blade.php --}}

<div>
    <div class="contractor-list-item">
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
            
            {{--@if($project->project_status??'' != "Request" && $project->project_status??'' != null)
                <div class="contractor-review approved-txt d-flex align-items-center 123">
                    <div class="contractor-review-text project-status-link">
                        <a href="{{ URL::to('contractor/project/details/' . base64_encode($project->id)) }}">{{ $project->project_status??'' }}</a>
                    </div>
                </div>
            @endif--}}
        </div>
       
        <div class="contractor-detail-wrap">
            <div class="accordion" id="accordionExample-{{ $project->id }}">
                <div class="accordion-item">
                    <div class="accordion-header" id="headingOne-{{ $project->id }}">
                        <div class="accordion-button collapsed list-view-detial-item">
                           <div class="contractor-detail-title-wrap">
                                <div class="contractor-title-img">
                                    @if (isset($projectImage) && isImage($projectImage->project_image))
                                        <img src="{{ asset('storage/project_images/' . $projectImage->project_image) }}" alt="Project Image" class="project-image">
                                    @else
                                        <img src="{{ asset('frontend-assets/images/project-1.png') }}" alt="Default Project Image" class="project-image">
                                    @endif
                                </div>
                                <div class="contractor-title-main">
                                    <div class="project-detail-item project-title">
                                        <h4>{{ $project->title }}</h4>
                                        @if ($project->id)
                                            <span class="text-muted"># <strong>{{ '['. $project->id .']' }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="project-detail-item">
                                        <ul class="list-unstyled">
                                            <li>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-user mr-2" style="color: #040404;"></i>
                                                    <span class="project-name" style="color: #040404;">{{ $userinfo->name }}</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-phone mr-2" style="color: #040404;"></i>
                                                    <span class="project-content-number" style="color: #040404;">{{ $userinfo->contact_number }}</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-envelope mr-2" style="color: #040404;"></i>
                                                    <span class="project-content-email" style="color: #040404;">{{ $userinfo->email }}</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="project-detail-item project-chat-wrap d-flex align-items-center justify-content-between">
                                        <a class="btn-primary mr-2" href="{{ URL('contractor/chat-customer-board/' . base64_encode($project->id) . '/' . base64_encode($project->user_id)) }}">
                                            <span class="position-relative" id="chatnowgrid-{{ $project->id }}">
                                                @if ($messageCount > 0)
                                                    <span class="chat-notification" id="chat-notification-contractorsidegrid-{{ $project->id }}">{{ $messageCount }}</span>
                                                @endif
                                                <img class="chat-icon" src="{{ asset('frontend-assets/images/chat_icon.svg') }}" style="max-width: 22px; margin-right: 4px;">
                                            </span>
                                        </a>
                                        <a class="btn-primary mb-0" href="{{ URL::to('contractor/project/details/' . base64_encode($project->id)) }}">View More</a>
                                    </div>
                                </div>
                            </div> 

                            {{-- <div class="contractor-detail-title-wrap">
                                <div class="contractor-title-img">
                                    @if (isset($projectImage) && isImage($projectImage->project_image))
                                        <img src="{{ asset('storage/project_images/' . $projectImage->project_image) }}" alt="Project Image" class="project-image">
                                    @else
                                        <img src="{{ asset('frontend-assets/images/project-1.png') }}" alt="Default Project Image" class="project-image">
                                    @endif
                                </div>
                                <div class="contractor-title-main">
                                    <div class="project-detail-item project-title">
                                        <h4>{{ $project->title }}</h4>
                                        @if ($project->id)
                                            <span class="text-muted"># <strong>{{ '['. $project->id .']' }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="project-detail-item">
                                        <ul class="list-unstyled">
                                            <li>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-user mr-2" style="color: #040404;"></i>
                                                    <span class="project-name" style="color: #040404;">{{ $userinfo->name }}</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-phone mr-2" style="color: #040404;"></i>
                                                    <span class="project-content-number" style="color: #040404;">{{ $userinfo->contact_number }}</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-envelope mr-2" style="color: #040404;"></i>
                                                    <span class="project-content-email" style="color: #040404;">{{ $userinfo->email }}</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="project-detail-item project-chat-wrap">
                                        <a class="btn-primary btn-sm w-100 mb-2" href="{{ URL('contractor/chat-customer-board/' . base64_encode($project->id) . '/' . base64_encode($project->user_id)) }}">
                                            <span class="position-relative" id="chatnowgrid-{{ $project->id }}">
                                                @if ($messageCount > 0)
                                                    <span class="chat-notification" id="chat-notification-contractorsidegrid-{{ $project->id }}">{{ $messageCount }}</span>
                                                @endif
                                                <img class="chat-icon" src="{{ asset('frontend-assets/images/chat_icon.svg') }}" style="max-width: 22px; margin-right: 4px;">
                                            </span> Chat now
                                        </a>
                                        <a class="btn-primary btn-sm detail-project-link" href="{{ URL::to('contractor/project/details/' . base64_encode($project->id)) }}">View More</a>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="contractor-detail-title-wrap">
                                <div class="contractor-title-img">
                                    @if (isset($projectImage) && isImage($projectImage->project_image))
                                        <img src="{{ asset('storage/project_images/' . $projectImage->project_image) }}" alt="Project Image" class="project-image">
                                    @else
                                        <img src="{{ asset('frontend-assets/images/project-1.png') }}" alt="Default Project Image" class="project-image">
                                    @endif
                                </div>
                                <div class="contractor-title-main">
                                    <div class="project-detail-item project-title">
                                        <div class="mb-3">
                                            <h4 class="mb-3">{{ $project->title }}</h4>
                                            @if ($project->id)
                                                <span class="text-muted"># <strong>{{ '['. $project->id .']' }}</strong></span>
                                            @endif
                                        </div>
                                        <ul class="list-unstyled">
                                            <li class="mb-2">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-user mr-2" style="color: #040404;"></i>
                                                    <span class="project-name" style="color: #040404;">{{ $userinfo->name }}</span>
                                                </div>
                                            </li>
                                            <li class="mb-2">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-phone mr-2" style="color: #040404;"></i>
                                                    <span class="project-content-number" style="color: #040404;">{{ $userinfo->contact_number }}</span>
                                                </div>
                                            </li>
                                            <li class="mb-2">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-envelope mr-2" style="color: #040404;"></i>
                                                    <span class="project-content-email" style="color: #040404;">{{ $userinfo->email }}</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <div class="project-detail-item project-chat-wrap">
                                        <a class="btn-primary btn-sm w-100 mb-2" href="{{ URL('contractor/chat-customer-board/' . base64_encode($project->id) . '/' . base64_encode($project->user_id)) }}">
                                            <span class="position-relative" id="chatnowgrid-{{ $project->id }}">
                                                @if ($messageCount > 0)
                                                    <span class="chat-notification" id="chat-notification-contractorsidegrid-{{ $project->id }}">{{ $messageCount }}</span>
                                                @endif
                                                <img class="chat-icon" src="{{ asset('frontend-assets/images/chat_icon.svg') }}" style="max-width: 22px; margin-right: 4px;">
                                            </span> Chat now
                                        </a>
                                        <a class="btn-primary btn-sm detail-project-link w-100" href="{{ URL::to('contractor/project/details/' . base64_encode($project->id)) }}">View More</a>
                                    </div>
                                </div>
                            </div> --}}
                            
                            {{-- <div class="contractor-detail-title-wrap d-flex">
                                <div class="contractor-title-img">
                                    @if (isset($projectImage) && isImage($projectImage->project_image))
                                        <img src="{{ asset('storage/project_images/' . $projectImage->project_image) }}" alt="Project Image"   style="width=82% !important;height:70% !important" >
                                    @else
                                        <img src="{{ asset('frontend-assets/images/project-1.png') }}" alt="Default Project Image"     style="width=82% !important;height:70% !important" >
                                    @endif
                                </div>
                                <div class="contractor-title-main">
                                    
                                     <div class="project-detail-item project-title">
                                        <div class="mb-3">
                                            <h4 class="mb-3">{{ $project->title }}</h4>
                                            @if ($project->id)
                                                <span class="text-muted"># <strong>{{ '['. $project->id .']' }}</strong></span>
                                            @endif
                                        </div>
                                        <ul class="list-unstyled">
                                            <li class="mb-2">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-user mr-2" style="color: #040404;"></i>
                                                    <span class="project-name" style="color: #040404;">{{ $userinfo->name }}</span>
                                                </div>
                                            </li>
                                            <li class="mb-2">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-phone mr-2" style="color: #040404;"></i>
                                                    <span class="project-content-number" style="color: #040404;">{{ $userinfo->contact_number }}</span>
                                                </div>
                                            </li>
                                            <li class="mb-2">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-envelope mr-2" style="color: #040404;"></i>
                                                    <span class="project-content-email" style="color: #040404;">{{ $userinfo->email }}</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    
                            
                                    <div class="project-detail-item project-chat-wrap">
                                        <a class="btn-primary btn-sm w-100 mb-2" href="{{ URL('contractor/chat-customer-board/' . base64_encode($project->id) . '/' . base64_encode($project->user_id)) }}">
                                            <span class="position-relative" id="chatnowgrid-{{ $project->id }}">
                                                @if ($messageCount > 0)
                                                    <span class="chat-notification" id="chat-notification-contractorsidegrid-{{ $project->id }}">{{ $messageCount }}</span>
                                                @endif
                                                <img class="chat-icon" src="{{ asset('frontend-assets/images/chat_icon.svg') }}" style="max-width: 22px; margin-right: 4px;">
                                            </span> Chat now
                                        </a>
                                        <a class="btn-primary btn-sm detail-project-link w-100" href="{{ URL::to('contractor/project/details/' . base64_encode($project->id)) }}">View More</a>
                                    </div>
                                </div>
                            </div> --}}
                            
                            {{-- <div class="contractor-detail-title-wrap d-flex">
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
                                        <div class="project-id mb-2">{{ $project->title }} @if($project->id) # <strong>{{ '['. $project->id .']' }}</strong> @endif</div>
                                        <div class="project-name mb-2" style="color: #0A84FF">{{ $userinfo->name }}</div>
                                        <div class="project-content-number mb-2" style="color: #0A84FF">{{ $userinfo->contact_number }}</div>  
                                        <div class="project-content-email mb-2" style="color: #0A84FF">{{ $userinfo->email }}</div>
                                        
                                    </div>

                                    <div class="project-detail-item project-chat-wrap">
                                        <a class="btn-primary btn-sm w-100 mb-2" href="{{ URL('contractor/chat-customer-board/' . base64_encode($project->id) . '/' . base64_encode($project->user_id)) }}">
                                            <span class="position-relative" id="chatnowgrid-{{ $project->id }}">
                                                @if($messageCount > 0)
                                                    <span class="chat-notification" id="chat-notification-contractorsidegrid-{{ $project->id }}">{{ $messageCount }}</span>
                                                @endif
                                                <img class="chat-icon" src="{{ asset('frontend-assets/images/chat_icon.svg') }}" style="max-width: 22px;margin-right:4px;">
                                            </span> Chat now
                                        </a>
                                        <a class="btn-primary btn-sm detail-project-link w-100" href="{{ URL::to('contractor/project/details/' . base64_encode($project->id)) }}">View More</a>
                                    </div>
                                </div>
                            </div> --}}
                            
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
                                            <div class="contractor-location-text">#{{ $project->id }}</div>
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
                                    <div class="quotes-detail-item-title">Customer:</div>
                                    <div class="quotes-detail-item-content">{{ $userinfo->name }}</div>
                                </div>
                                <div class="quotes-detail-item d-flex align-items-center justify-content-between">
                                    <div class="quotes-detail-item-title">Phone:</div>
                                    <div class="quotes-detail-item-content"><a>{{ $userinfo->contact_number }}</a>
                                    </div>
                                </div>
                                <div class="quotes-detail-item d-flex align-items-center justify-content-between">
                                    <div class="quotes-detail-item-title">Email:</div>
                                    <div class="quotes-detail-item-content"><a>{{ $userinfo->email }}</a>
                                    </div>
                                </div>
                                <div class="chatbox quotes-detail-item d-flex align-items-center justify-content-between">
                                    <div class="quotes-detail-item-title"></div>
                                    <div class="quotes-detail-item-content">
                                        <a href="{{ URL('contractor/chat-customer-board/' . base64_encode($project->id) . '/' . base64_encode($project->user_id)) }}">
                                            <span class="position-relative" id="chatnow-{{ $project->id }}">
                                                @if($messageCount > 0)
                                                    <span class="chat-notification" id="chat-notification-contractorside-{{ $project->id }}">{{ $messageCount }}</span>
                                                @endif
                                                <img class="chat-icon" src="{{ asset('frontend-assets/images/chat_icon.svg') }}" style="max-width: 22px;margin-right:4px;">
                                            </span> Chat now
                                        </a>
                                    </div>
                                </div>
                                <div class="quotes-request-btn-wrap">
                                    <a class="btn-primary d-block" href="{{ URL::to('contractor/project/details/' . base64_encode($project->id)) }}">View More</a>
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




 