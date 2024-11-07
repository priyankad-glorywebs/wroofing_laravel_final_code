<div class="col-12">
 <div class="row" id="test">
        <div class="col-12 col-md-6 col-lg-4 item list-view-main-title"  style="">
            <div class="contractor-list-item">
                <div class="contractor-img-wrap">
                    <div class="contractor-img"></div>
                    <div class="contractor-review approved-txt d-flex align-items-center">
                        <div class="contractor-review-text">Request</div>
                    </div>

                </div>
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
            </div>
        </div>


        @if (isset($projects) && count($projects) > 0)
            @foreach ($projects as $project)
                @php
                    $userinfo = \App\Models\User::where('id', $project->user_id)->first();
                    $projectImge = App\Models\ProjectImagesData::select('project_image')->where('project_id', $project->id)->first();
                    
                    $messageCount = \App\Models\Message::where('project_id',$project->id)
                    ->where('user_id',$userinfo->id)
                    ->where('role','customer')
                    ->where('is_read',0)
                    ->orderBy('id','DESC')
                    ->get()
                    ->count();
                @endphp
                @php
                $getStatus = \App\Models\Quotation::where('project_id', $project->id)
                ->where('contractor_id',Auth::user()->id)
                ->orderBy('id', 'DESC')
                ->first();
                if(isset($getStatus)){
                $get_status = \Str::ucfirst($getStatus->status);
                }else{
                    $get_status = "";
                }

                @endphp
            {{-- <input type="text" name="project_id" id="project_id" value={{$project->id??''}}> --}}
                {{-- <div class="col-12 col-md-6 col-lg-4 item {{$$get_status??''}}" data-cate="{{$get_status??''}}"> --}}
                    <div class="col-12 col-md-6 col-lg-4 item {{$get_status??''}}"  data-cate="{{$get_status??''}}">
                    <div class="contractor-list-item">
                        <div class="contractor-img-wrap">
                            <div class="contractor-img">
                                @if (isset($projectImge) && isImage($projectImge->project_image))
                                <img src="{{ asset('storage/project_images/' . $projectImge->project_image) }}" alt="ProjectImage"
                                    width="370" height="200">
                                @else
                                <img src="{{ asset('frontend-assets/images/project-1.png') }}" alt="projectimage"
                                    width="370" height="200">
                                @endif
                            </div>
            
                            @if($get_status??'' != "Request" && $get_status??'' != null)
                                <div class="contractor-review approved-txt d-flex align-items-center 123">
                                    <div class="contractor-review-text project-status-link">
                                        <a href="{{ URL::to('contractor/project/details/' . base64_encode($project->id)) }}">{{$get_status??''}}</a>
                                    </div>
                                </div>
                            @endif
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
                                                        <div class="project-detail-item-detail"><a
                                                                style="color: #0A84FF">{{ $userinfo->name ?? '' }}</a></div>
                                                    </div>

                                                    <div class="project-detail-item d-flex">
                                                        <div class="project-detail-item-detail "><a
                                                                style="color: #0A84FF">{{ $userinfo->contact_number ?? '' }}</a>
                                                        </div>
                                                    </div>
                                                    <div class="project-detail-item d-flex">
                                                        <div class="project-detail-item-detail"><a
                                                                style="color: #0A84FF">{{ $userinfo->email ?? '' }}</a>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                
                                                    <div class="project-detail-item">
                                                        @if(isset($get_status))
                                                        <div class="project-detail-item-detail project-status-link"
                                                        ><a href="{{ URL::to('contractor/project/details/' . base64_encode($project->id)) }}">{{ $get_status?? '' }}</a>
                                                        </div>
                                                        @endif 
                                                    </div>
                                                    <div class="project-detail-item  d-flex justify-content-end">
                                                        
                                                        <a href="{{ URL('contractor/chat-customer-board/' . base64_encode($project->id) . '/' . base64_encode($project->user_id)) }}">
                                                            <span class="position-relative" id="chatnowgrid-{{$project->id}}">

                                                             @if($messageCount > 0)<span class="chat-notification" id="chat-notification-contractorsidegrid-{{$project->id}}">{{$messageCount??''}}</span>@endif
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
                                                <div
                                                    class="quotes-detail-item d-flex align-items-center justify-content-between">
                                                    <div class="quotes-detail-item-title">Phone:</div>
                                                    <div class="quotes-detail-item-content"><a
                                                            style="color: #0A84FF ">{{ $userinfo->contact_number ?? '' }}</a>
                                                    </div>
                                                </div>
                                                <div
                                                    class="quotes-detail-item d-flex align-items-center justify-content-between">
                                                    <div class="quotes-detail-item-title">Email:</div>
                                                    <div class="quotes-detail-item-content"><a
                                                            style="color: #0A84FF ">{{ $userinfo->email ?? '' }}</a>
                                                    </div>
                                                </div>
                                                <div
                                                    class="chatbox quotes-detail-item d-flex align-items-center justify-content-between">
                                                    <div class="quotes-detail-item-title">
                                                        
                                                    </div>
                                                    <div class="quotes-detail-item-content">
                                                        <a href="{{ URL('contractor/chat-customer-board/' . base64_encode($project->id) . '/' . base64_encode($project->user_id)) }}">
                                                            <span class="position-relative" id="chatnow-{{$project->id}}">
                                                                @if($messageCount > 0)<span class="chat-notification" id="chat-notification-contractorside-{{$project->id}}">{{$messageCount??''}}</span>@endif
                                                                <img  class="chat-icon" src="{{asset('frontend-assets/images/chat_icon.svg')}}" style="max-width: 22px;margin-right:4px;">

                                                            </span> Chat now
                                                        </a>
                                                    </div>
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
                        <!-- <a class="contractor-link" href="{{ URL::to('contractor/project/details/' . base64_encode($project->id)) }}" style=""></a> -->
                    </div>
                </div>
            @endforeach
            @if($projects !== NULL && $projects->count() > 0)
                <div class="pagination all-pagination">
                    {{ $projects->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            @endif
            @else
                <div class=" item">
                    <div class="contractor-list-item">    
                        <div class="contractor-detail-wrap contractor-detail-notfound-wrap all-not-found">
                            <strong>No Projects Found</strong>
                        </div>
                    </div>
                </div>
            @endif
    </div>
</div>
</div>

@php
$projectData = [];
$projectData = App\Models\Project::all();
@endphp




<script>
$(document).ready(function() {
    $('.project-status-link').on("click", function(e) {
        sessionStorage.setItem("lastname", "smith");
    });
});
$(document).ready(function() {
const projects = @json($projectData);

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

function getMessageCount(userId, projectId, role) {
    // axios.post('/get-message-count', {
    //     userId: userId,
    //     projectId: projectId,
    //     role: role
    // }).then(response => {
    //     let messageCount = response.data.messageCount;
    //     updateMessageCount(messageCount, projectId);
    // }).catch(error => {
    //     console.error('Error fetching message count:', error.response ? error.response.data : error);
    // });
}

function updateMessageCount(count, projectId) {
    let messageCountElement = $('#chat-notification-contractorside-' + projectId);
    let messageCountgrid = $('#chat-notification-contractorsidegrid-'+projectId);
    messageCountElement.text(count);
    messageCountgrid.text(count);


    if (count === 1) {
        $('#chatnow-' + projectId).load(location.href + ' #chatnow-' + projectId);
        $('#chatnowgrid-' + projectId).load(location.href + ' #chatnowgrid-' + projectId);
    }

    if(count === 0){
        $('#chatnow-' + projectId).load(location.href + ' #chatnow-' + projectId);
        $('#chatnowgrid-' + projectId).load(location.href + ' #chatnowgrid-' + projectId);

    }    
}

projects.forEach(project => {
    let projectId = project.id;
    let userId = project.user_id;
    let role = 'customer';

    const debouncedGetMessageCount = debounce(() => {
        getMessageCount(userId, projectId, role);
    }, 1000);

    getMessageCount(userId, projectId, role);

    window.Echo.channel(`update-real-time-count-contractor-side.${projectId}`)
        .listen('UnreadMessageCountUpdated', (e) => {
            console.log('UnreadMessageCountUpdated event received:', e);
            updateMessageCount(e.messageCount, projectId);
        });

    setInterval(() => {
        debouncedGetMessageCount();
    }, 5000);
});
});

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
//                     $(this).removeClass("hide");


//                 } else {
//                    $(this).removeClass('hide');


//                 }
//             });
//         }
//     });
// });



</script>
