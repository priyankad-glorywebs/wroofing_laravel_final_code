@extends('layouts.front.master')
@section('css')
<style type="text/css">
    .rejected-status{
        background: #FFF9F2; font-size: 13px;
        font-weight: 700;
        color: #F14336;
        padding: 3px 6px;
        border-radius: 5px;
        display: inline-block;
    }
    .approved-status{
        background: #D9F1D6;
        font-size: 13px;
        font-weight: 700;
        color: #53B746;
        padding: 3px 6px;
        border-radius: 5px;
        display: inline-block;
    }
</style>
@endsection
@section('title', 'Project Details')
    <script>
    function callfundata(obj){
        var noimg = '{{ asset("frontend-assets/images/defaultimage.jpg") }}';
        obj.src=noimg;
    }
    function callfun(obj){
        var noimg = '{{ asset("frontend-assets/images/contractor-1.png") }}';
        obj.src=noimg;
    }
    </script>
@section('content')
    <div class="breadcrumb-title-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('project.list')}}"><svg width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.13654 8L1.25522 5.11869C0.914945 4.77841 0.914945 4.22159 1.25522 3.88131L4.13654 1" stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg> Back</a></li>
                    </ol>
                </div>
            </div>
            <div class="row breadcrumb-title d-none d-lg-flex align-items-center">

                <div class="col-12 col-lg-6">
                    @php
                        if(isset($project_id)){
                            $projectId = base64_decode($project_id);
                            $data = \App\Models\Project::where('id',$projectId)->first();
                        }                    
                    @endphp
                    <input type="hidden" name="project_details_id" id="project_details_id" value="{{$project_id??''}}">
                    <div class="section-title">
                        @if(isset($data))
                        {{$data->title}}
                        @else
                        Roof project 1
                        @endif
                    </div>
                    </div>
                    @if(isset($data->credit))
                        @if($data->credit >  0)
                        <div class="col-12 col-lg-6 text-end">
                            <span class="total-credit">  Total Credit : {{$data->credit??''}}</span>
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="project-list-sec">
        <div class="container">
            <div class="row d-lg-none">
                <div class="col-12">
                    <div class="section-title text-center mb-2">{{$data->title}} </div>
                    @if(isset($data->credit))
                    @if($data->credit >  0)
                    <div class="text-center mb-4">
                    <span class="total-credit">  Total Credit : {{$data->credit??''}}</span>
                    </div>
                    @endif
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="project-list-item">
                        <div class="project-item-img">
                            <img src="{{asset('frontend-assets/images/project-detail-2.png')}}" alt="project img" width="270" height="230">
                        </div>
                        <div class="project-item-title-wrap d-flex align-items-center justify-content-between">
                            <div class="project-item-title">General Info</div>
                            <div class="project-item-icon"><svg width="9" height="17" viewBox="0 0 9 17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 16L7.43043 9.82576C8.18986 9.09659 8.18986 7.90341 7.43043 7.17424L1 1" stroke="#0A84FF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
                        </div>
                        <a class="project-list-item-link" href="{{route('general.info', ['project_id' => $project_id])}}"></a>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="project-list-item">
                        <div class="project-item-img">
                            <img src="{{asset('frontend-assets/images/project-detail-1.png') }}" alt="project img" width="270" height="230">
                        </div>
                        <div class="project-item-title-wrap d-flex align-items-center justify-content-between">
                            <div class="project-item-title">Design Studio</div>
                            <div class="project-item-icon"><svg width="9" height="17" viewBox="0 0 9 17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 16L7.43043 9.82576C8.18986 9.09659 8.18986 7.90341 7.43043 7.17424L1 1" stroke="#0A84FF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
                        </div>
                        <a class="project-list-item-link" href="{{ route('design.studio', ['project_id' => $project_id]) }}"></a>
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-3">                      
                    <div class="project-list-item">
                        <div class="project-item-img">
                            <img src="{{asset('frontend-assets/images/project-detail-3.png')}}" alt="project img" width="270" height="230">
                        </div>
                        <div class="project-item-title-wrap d-flex align-items-center justify-content-between">
                            <div class="project-item-title">Documents</div>
                            <div class="project-item-icon"><svg width="9" height="17" viewBox="0 0 9 17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 16L7.43043 9.82576C8.18986 9.09659 8.18986 7.90341 7.43043 7.17424L1 1" stroke="#0A84FF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
                        </div>
                        <a class="project-list-item-link" href="{{route('documentation', ['project_id' => $project_id])}}"></a>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="project-list-item">
                        <div class="project-item-img">
                            <img src="{{asset('frontend-assets/images/project-detail-4.png')}}" alt="project img" width="270" height="230">
                        </div>
                        <div class="project-item-title-wrap d-flex align-items-center justify-content-between">
                            <div class="project-item-title">Contractor Portal</div>
                            <div class="project-item-icon"><svg width="9" height="17" viewBox="0 0 9 17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 16L7.43043 9.82576C8.18986 9.09659 8.18986 7.90341 7.43043 7.17424L1 1" stroke="#0A84FF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
                        </div>
                        <a class="project-list-item-link" href="{{route('contractor.list',['project_id' => $project_id])}}"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
                <!-- view quote data start -->
    <section class="contractor-sec pt-0">
        <div class="container">
            <div class="row viewquotation">
                @if(isset($quotations))
                    @foreach($quotations as $quotation)
                    @php
                    $contractor = \App\Models\Contractor::where('id',$quotation->contractor_id)->first();
                    // dd($data->user_id);
                $messageCount = App\Models\Message::
                                where('project_id', $projectId)
                                ->where('contractor_id', $contractor->id)
                                ->where('is_read',0)
                                ->where('role', 'contractor')
                                ->get()
                                ->count();
                // dd($messageCount);
                    
                    @endphp
                    <input type="hidden" name="contractor_id" value="{{$contractor->id??''}}" id="project_details_user_id" >
                    
                    <div class="col-12 col-md-6 col-lg-4 item" data-category="{{$quotation->status??''}}">
                        <div class="contractor-list-item">
                            <div class="contractor-detail-wrap">
                                <div class="accordion" id="accordionExample{{$quotation->id??''}}">
                                    <div class="accordion-item">
                                        <div class="accordion-header" id="heading{{$quotation->id??''}}">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$quotation->id??''}}" aria-expanded="true" aria-controls="collapse{{$quotation->id??''}}">
                                                <div class="contractor-detail-title-wrap d-flex align-items-center">
                                                    <div class="contractor-title-img mt-0">
                                                        @if(isset($contractor->profile_image))
                                                            <img src="{{asset($contractor->profile_image)}}" onerror="this.onerror=null;callfundata(this);" alt="contractor-img">
                                                        @else
                                                            <img src="{{asset('frontend-assets/images/Ellipse 15.svg')}}" alt="contractor-img" width="55" height="">
                                                        @endif
                                                    </div>
                                                    <div class="contractor-title-main">
                                                        <div class="contractor-title">{{$contractor->name??''}}’s Roofing</div>
                                                    </div>																
                                                </div>
                                            </button>
                                        </div>
                                        <div id="collapse{{$quotation->id??''}}" class="accordion-collapse collapse show" aria-labelledby="headingOne-{{$quotation->id??''}}" data-bs-parent="#accordionExample{{$quotation->id??''}}">
                                            <div class="accordion-body">
                                                <div class="quotes-detail">
                                                    @if(isset($contractor['contact_number']))
                                                    <div class="quotes-detail-item d-flex align-items-center justify-content-between">
                                                        <div class="quotes-detail-item-title">Call:</div>
                                                        <div class="quotes-detail-item-content">
                                                            {{$contractor['contact_number']??''}}
                                                        </div>
                                                    </div>
                                                    @endif

                                                    @if(isset($contractor['email']))
                                                    <div class="quotes-detail-item d-flex align-items-center justify-content-between">
                                                        <div class="quotes-detail-item-title">Email:</div>
                                                        <div class="quotes-detail-item-content">{{$contractor['email']??''}}</div>
                                                    </div>
                                                    @endif

                                                    @if(isset($quotation['created_at']))
                                                    <div class="quotes-detail-item d-flex align-items-center justify-content-between">
                                                        <div class="quotes-detail-item-title">Date:</div>
                                                        <div class="quotes-detail-item-content">{{--$quotation->created_at--}}
                                                            {{ \Carbon\Carbon::parse($quotation->created_at??'')->format('d M Y, D') }}
                                                        </div>
                                                    </div>
                                                    @endif

                                                    <div class="chatbox quotes-detail-item d-flex align-items-center justify-content-between">
                                                        <div class="quotes-detail-item-title"></div>
                                                        <div class="quotes-detail-item-content">
                                                            <span class="position-relative" id="chat-now-{{$contractor['id']??''}}">
                                                                <a href="{{URL('contractor/chat-board/'.$project_id.'/'.base64_encode($contractor->id))}}">
                                                                    <span class="position-relative">
                                                                        <img class="chat-icon" src="{{asset('frontend-assets/images/chat_icon.svg')}}">
                                                                    @if($messageCount > 0)
                                                                        <span class="chat-notification" id="chat-notification-customerside-projectdetails-{{$contractor->id??''}}">{{ $messageCount }}</span>
                                                                    @endif
                                                                    </span>
                                                                    Chat now  
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    @if(isset($quotation->status))
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
                                                    @endif
                                                    
                                                    <div class="quotes-request-btn-wrap">
                                                        @if($quotation->status == 'Requested')
                                                        <a class="btn-primary d-block btn-requested" disabled >Requested for quote</a>
                                                        @elseif($quotation->status == 'Responded')
                                                        <a class="btn-primary d-block btn-approved" href="{{route('view.quote',['quote_id'=>base64_encode($quotation->id)])}}" >View quote</a>
                                                        @elseif($quotation->status == 'approved')
                                                        <a class="btn-primary d-block btn-approved" href="{{route('view.quote',['quote_id'=>base64_encode($quotation->id)])}}" >View quote</a>
                                                        @elseif($quotation->status == 'rejected')
                                                        <a class="btn-primary d-block btn-rejected" disbaled >Rejected quote</a>
                                                        @endif
                                                    </div>
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
            </div>
        </div>
    </section>
    <!--end view quote data start -->
@endsection


@section('scripts')
<script type="text/javascript">
    // count real time message at customer side 

$(document).ready(function() {
    const project_details_id = atob($('#project_details_id').val());
    const project_details_user_id = $('#project_details_user_id').val();
    let role ="contractor";
   

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


    function updateMessageCount(count,project_details_id, project_details_user_id) {
        let messageCountElement = $('#chat-notification-customerside-projectdetails-' + project_details_user_id);
        console.log("test  " +count);
        messageCountElement.text(count);
         if (count === 1) {
            console.log("one  "+ project_details_user_id);
            if(project_details_user_id !== 'undefined'){

            $('#chat-now-' + project_details_user_id).load(location.href + ' #chat-now-' + project_details_user_id);
             messageCountElement.text(count);
            }


        }

        if(count === 0){
            if(project_details_user_id !== 'undefined'){
                $('#chat-now-' + project_details_user_id).load(location.href + ' #chat-now-' + project_details_user_id);
            }
         }    
    }
  
 const debouncedGetMessageCount = debounce(() => {
            getMessageCountData(project_details_user_id, project_details_id, role);
        }, 1000);

        getMessageCountData(project_details_user_id, project_details_id, role);
            window.Echo.channel(`update-real-time-count-customer-side.${project_details_user_id}`)
            .listen('UnreadMessageCountCustomer', (e) => {
                if (e.project_details_user_id == project_details_user_id) {

                    updateMessageCount(e.messageCount,project_details_id, project_details_user_id);
                }
            });

        setInterval(() => {
            debouncedGetMessageCount();
        }, 5000);
    


function getMessageCountData(project_details_user_id, project_details_id, role) {
    // axios.post('/get-message-count-customer', {
    //     contractor_uid: project_details_user_id,
    //         contractor_pid: project_details_id,
    //         role: role
    //     }).then(response => {
    //         let messageCount = response.data.messageCount;
    //         updateMessageCount(messageCount, project_details_id,project_details_user_id);
    //     }).catch(error => {
    //         console.error('Error fetching message count:', error.response ? error.response.data : error);
    //     });
    // }

});
</script>
@endsection