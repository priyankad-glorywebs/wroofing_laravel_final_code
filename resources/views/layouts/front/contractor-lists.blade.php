@if (isset($contractorList) && $contractorList->count() > 0)
    @foreach ($contractorList as $contractor)
    <input type="hidden" value="{{ base64_decode($project_id) }}" id="contractor_p_id">

        <input type="hidden" value="{{ base64_decode($project_id) }}" id="project_id">

        <div class="col-12 col-md-6 col-lg-4">
            <div class="contractor-list-item">
                <div class="contractor-img-wrap">
                    <div class="contractor-img">
                        @if (isset($contractor->banner_image) && imageExists($contractor->banner_image))
                            <img src="{{ asset($contractor->banner_image) }}"
                                onerror="this.onerror=null;this.src='{{ asset('frontend-assets/images/contractor-1.png') }}';"
                                alt="contractor" width="370" height="200">
                        @else
                            <img src="{{ asset('frontend-assets/images/contractor-1.png') }}" alt="contractor" width="370"
                                height="200">
                        @endif
                    </div>
                    @php
                        $c_portfolio = App\Models\ContractorPortfolio::where('contractor_id', $contractor->id)->count();
                    @endphp
                    @if ($c_portfolio > 0)
                        <div class="contractor-img-icon" data-id="{{ $contractor->id }}">
                            <img src="{{ asset('frontend-assets/images/img-icon.svg') }}" alt="img-icon" width="32" height="32">
                        </div>
                    @endif
                </div>
                <div class="contractor-detail-wrap">
                    <div class="accordion" id="accordionExample{{ $contractor->id }}">
                        <div class="accordion-item">
                            <div class="accordion-header" id="heading{{ $contractor->id }}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $contractor->id }}" aria-expanded="true"
                                    aria-controls="collapse{{ $contractor->id }}">
                                    <div class="contractor-detail-title-wrap d-flex">
                                        <div class="contractor-title-img">
                                            @if (isset($contractor->profile_image) && imageExists($contractor->profile_image))
                                                <img src="{{ asset($contractor->profile_image) }}"
                                                    onerror="this.onerror=null;this.src='{{ asset('frontend-assets/images/Ellipse 15.svg') }}';"
                                                    alt="contractor-img" width="55">
                                            @else
                                                <img src="{{ asset('frontend-assets/images/Ellipse 15.svg') }}" alt="contractor-img"
                                                    width="55">
                                            @endif
                                        </div>
                                        <div class="contractor-title-main">
                                            @php
                                                $messageCount = \App\Models\Message::where(
                                                    'project_id',
                                                    base64_decode($project_id),
                                                )
                                                    ->where('contractor_id', $contractor->id)
                                                    ->where('is_read', 0)
                                                    ->where('role', 'contractor')
                                                    ->get()
                                                    ->count();
                                            @endphp

                                            <div class="contractor-title">{{ $contractor->name }}’s Roofing
                                                {{-- $messageCount --}}</div>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <div id="collapse{{ $contractor->id }}" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne{{ $contractor->id }}"
                                data-bs-parent="#accordionExample{{ $contractor->id }}">
                                <div class="accordion-body">
                                    <div class="quotes-detail">
                                        @if(isset($contractor->contact_number))
                                        <div class="quotes-detail-item d-flex align-items-center justify-content-between">
                                            <div class="quotes-detail-item-title">Call:</div>
                                            <div class="quotes-detail-item-content">{{ $contractor->contact_number??'' }}
                                            </div>
                                        </div>
                                        @endif
                                        @if(isset($contractor->email))
                                        <div class="quotes-detail-item d-flex align-items-center justify-content-between">
                                            <div class="quotes-detail-item-title">Email:</div>
                                            <div class="quotes-detail-item-content">{{ $contractor->email??'' }}
                                            </div>
                                        </div>
                                        @endif


                                        <div
                                            class="chatbox quotes-detail-item d-flex align-items-center justify-content-between">
                                            <div class="quotes-detail-item-title"></div>
                                            <div class="quotes-detail-item-content">

                                                <span class="position-relative" id="chat-now-{{ $contractor->id ?? ''}}">

                                                    <a
                                                        href="{{ URL('contractor/chat-board/' . $project_id . '/' . base64_encode($contractor->id)) }}">
                                                        <span class="position-relative">
                                                            <img class="chat-icon"
                                                                src="{{ asset('frontend-assets/images/chat_icon.svg') }}">
                                                            @if ($messageCount > 0)
                                                                <span class="chat-notification"
                                                                    id="chat-notification-customerside-{{ $contractor->id ?? '' }}">{{ $messageCount }}</span>
                                                            @endif
                                                        </span>
                                                        Chat now
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                        @php
                                            $contra_quotes_id = null;
                                            $contra_quotes_status = null;
                                            $contra_quotes_custoid = null;
                                        @endphp
                                        @if (isset($quotations))
                                                        @foreach ($quotations as $quotation)
                                                                        @if ($quotation->contractor_id === $contractor->id)
                                                                                        @php
                                                                                            $contra_quotes_id = $quotation->id;
                                                                                            $contra_quotes_status = $quotation->status;
                                                                                            $contra_quotes_custoid = $quotation->contractor_id;
                                                                                        @endphp
                                                                        @endif
                                                        @endforeach
                                        @endif
                                        <div class="quotes-detail-item d-flex align-items-center justify-content-between quote_status"
                                            id="quote_status">
                                            @if (isset($contra_quotes_status))
                                                <div class="quotes-detail-item-title">Status: </div>
                                                @if ($contra_quotes_status == 'Requested')
                                                    <div class="quotes-detail-item-content">{{ $contra_quotes_status }}
                                                    </div>
                                                @elseif($contra_quotes_status == 'approved')
                                                    <div><span class="approved-status">{{ $contra_quotes_status }}</span>
                                                    </div>
                                                @elseif($contra_quotes_status == 'Responded')
                                                    <div><span class="approved-status">{{ $contra_quotes_status }}</span>
                                                    </div>
                                                @elseif($contra_quotes_status == 'rejected')
                                                    <div><span class="rejected-status">{{ $contra_quotes_status }}</span>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="quotes-request-btn-wrap">
                                            @if (isset($quoteData) && $contra_quotes_status != 'approved' && $contra_quotes_status != 'Responded')
                                                @if (in_array($contractor->id, $quoteData))
                                                    <a class="btn-primary d-block btn-requested" id="request-quote" disabled>Requested
                                                        for quote</a>
                                                @else
                                                    <a class="btn-primary d-block request-quote-btn" id="request-quote"
                                                        data-id="{{ $contractor->id }}">Request a quote</a>
                                                @endif
                                            @elseif(
                                                    $contra_quotes_custoid === $contractor->id &&
                                                    ($contra_quotes_status === 'approved' || $contra_quotes_status === 'Responded')
                                                )
                                                                            <a class="btn-primary d-block btn-approved"
                                                                                href="{{ route('view.quote', ['quote_id' => base64_encode($contra_quotes_id)]) }}">View
                                                                                quote</a>
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
    @if ($contractorList !== null && $contractorList->count() > 0)
    <div class="col-12">
        <div class="pagination all-pagination">
            {!! $contractorList->appends(Request::except('page'))->render() !!}
        </div>
    </div>
    @endif
@else
    <p>No contractors found.</p>
@endif

@php

    $contractorList = \App\Models\Contractor::all();

@endphp

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  
    <script>

   $(document).ready(function() {


    $('#contractorfilterButton').click(function() {
                var search = $('#contractor_search').val();
                var project_id = $('#project_id').val();

                $.ajax({
                    url: "{{ route('contractor.list', ['project_id' => $project_id]) }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        contractor_search: search
                    },
                    success: function(response) {
                        // $('#contractorList-container').val("");
                        $('#contractorList-container').html(response.html);

                        $(document).on('click', '.pagination a', function(event) {
                            event.preventDefault();
                            var url = $(this).attr('href');
                            $.get(url, function(response) {
                                // $('#contractorList-container').html("");

                                $('#contractorList-container').html(response
                                    .html);
                                $('html, body').animate({
                                    scrollTop: $(
                                            '#contractorList-container')
                                        .offset().top
                                }, 'slow');
                            });
                        });
                    }
                });
            });

            $('#contractorresetFilterButton').click(function() {
                $('#contractor_search').val('');
                var project_id = $('#project_id').val();

                $.ajax({
                    url: "{{ route('contractor.list', ['project_id' => $project_id]) }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        // console.log("dbvhbhmdbjdbd  "+response.html);
                        $('#contractorList-container').html(response.html);
                    }
                });
            });


            $(document).on('click','.contractor-img-icon' ,function() {
                var contractor_id = $(this).attr('data-id');
                $('#gallerypopup').modal('show');

                $('#gallerypopup').find('#c_id').val(contractor_id);

                $.ajax({
                    url: '{{ route('contractor.list', ['project_id' => $project_id]) }}',
                    method: 'GET',
                    data: {
                        c_id: contractor_id
                    },
                    success: function(response) {
                        $('.display-gallery-portfolio').html(response);
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr);
                    }
                });
            });
        });

        jQuery(document).ready(function() {
            jQuery('#view-quotes-tab-pane').find('.btn-gallery-filter').on('click', function() {
                jQuery('#contractor_portal_tab').addClass('active');
            });
        });

        function callfuncontractor(obj) {
            var noimg = '{{ asset('frontend-assets/images/contractor-1.png') }}';
            obj.src = noimg;
        }
    //     $(document).on("click",".request-quote-btn",function() {
    //     alert("sdfsfs");
    // });

    $(document).one("click",".request-quote-btn",function(e) {
            // alert("in");
            var upadtestatus = $(this);
            e.preventDefault();
            var project_id = $('#project_id').val();
            var contractor_id = $(this).attr("data-id");
            var clickedButton = $(this);

            var checkquotes = $('#checkquotes').hasClass('d-none');
            if (checkquotes == true) {
                $('#checkquotes').removeClass('d-none');
            }


            $.ajax({
                url: "{{ route('send.quote.contractor') }}",
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    project_id: project_id,
                    contractor_id: contractor_id
                },
                success: function(response) {
                    if (response.success) {
                        $(upadtestatus).closest(".quotes-detail").find('#quote_status').html("");
                        $(upadtestatus).closest(".quotes-detail").find('#quote_status').append(response
                            .status);

                        $('.viewquotation').html("");
                        $('.viewquotation').html(response.html);
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    }
                    clickedButton.addClass('disabled').css({
                        color: '#ED8105',
                        backgroundColor: '#FFF9F2',
                        border: '1px solid #FFF9F2'
                    });
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });

             $('#contractorresetFilterButton').click(function() {
                 $('#contractor_search').val('');
                 var project_id = $('#project_id').val();
                 $.ajax({
                     url: "{{ route('contractor.list', ['project_id' => $project_id]) }}",
                     method: 'POST',
                     data: {
                        _token: "{{ csrf_token() }}"
                   },
                    success: function(response) {
                        $('#contractorList-container').html(response.html);
                     }
                });
             });



        });


        // count real time message at customer side 

        $(document).ready(function() {
            const contractorList = @json($contractorList);
            // let contractorpid = $('#contractor_p_id').val();
            let contractor_pid = $('#contractor_p_id').val();

            // alert(contractorpid)
            // let contractor_pid = atob(contractorpid);
            // alert("bfjks "+ contractor_pid  )
            // alert("gjkv " +contractorpid)
            //     // console.log(contractor_pid);
            const contractor_uid = '';

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


            function updateMessageCount(count, contractor_pid, contractor_uid) {
                const messageCountElement = $('#chat-notification-customerside-' + contractor_uid);
                messageCountElement.text(count);
                if (count === 1) {
                  messageCountElement.text(count);
                }

                if (count === 0) {
                    // $('#chat-now-' + contractor_uid).load(location.href + ' #chat-now-' + contractor_uid);

                    console.log("zero  " + contractor_uid);
                }
            }

            contractorList.forEach(contractor => {
                let contractor_uid = contractor.id;
                let role = 'contractor';
                // let c_pid = $('#contractor_pid').val();
                     let contractor_pid = $('#contractor_p_id').val();

                // let contractor_pid = atob(c_pid);
                // alert(contractor_pid)
                const debouncedGetMessageCount = debounce(() => {
                    getMessageCountData(contractor_uid, contractor_pid, role);
                }, 1000);

                getMessageCountData(contractor_uid, contractor_pid, role);
                window.Echo.channel(`update-real-time-count-customer-side.${contractor_uid}`)
                    .listen('UnreadMessageCountCustomer', (e) => {
                        if (e.contractor_uid == contractor_uid) {

                            updateMessageCount(e.messageCount, contractor_pid, contractor_uid);
                        }
                    });

                setInterval(() => {
                    debouncedGetMessageCount();
                }, 5000);
            });


            function getMessageCountData(contractor_uid, contractor_pid, role) {
                // axios.post('/get-message-count-customer', {
                //     contractor_uid: contractor_uid,
                //     contractor_pid: contractor_pid,
                //     role: role
                // }).then(response => {
                //     let messageCount = response.data.messageCount;
                //     updateMessageCount(messageCount, contractor_pid, contractor_uid);
                // }).catch(error => {
                //     console.error('Error fetching message count:', error.response ? error.response.data :
                //         error);
                // });
            }




        });
</script>
@endsection