
@extends('layouts.front.master')
@section('title', 'Contractor Chat Board')
@section('css')
<!-- Custom Chat CSS -->
<link rel="stylesheet" type="text/css" href="{{asset('frontend-assets/css/chat-style.css')}}">
@php
// $pid
// $message_data
// $contractor_data
$contractor_id = $contractor_data->id;
$profile_image = 'frontend-assets/images/defaultimage.jpg';
if(isset($contractor_data->profile_image)){
	$profile_image = $contractor_data->profile_image;
}
$user = Auth::user();
$userName 	 = NUll;
$userprofile = 'frontend-assets/images/defaultimage.jpg';
if(isset($user->profile_image)){
	$userprofile = $user->profile_image;
}
if(isset($user->name)){
	$userName = $user->name;
}

$project_title = null;
if(isset($projectInfo->title)){
	$project_title = $projectInfo->title;
}
@endphp


<div class="header-space"></div>
<div class="breadcrumb-title-wrap chatboat">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<ol class="breadcrumb m-0">
					<li class="breadcrumb-item">
						<a href="{{route('contractor.list',['project_id' => base64_encode($pid)])}}">
							<svg width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M4.13654 8L1.25522 5.11869C0.914945 4.77841 0.914945 4.22159 1.25522 3.88131L4.13654 1" stroke="#0A84FF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
							</svg> Back</a>
					</li>
				</ol>
			</div>
		</div>
		<div class="row d-lg-none mt-4">
			<div class="col-12">
				{{-- <div class="signin-notes">Request a quote</div> --}}
			</div>
		</div>
		<div class="row breadcrumb-title">
			<div class="col-12 col-lg-12">
				<div class="section-title">Contractor Chat Board </div>
				@if(isset($project_title))
				<div class="info-box mt-2">
					{{-- <div class="label">projects info:</div> --}}
					<ul class="meta">
						<li class="meta-item"><span class="icon icon-bed"></span> Project Id: #{{$pid}}</li>
						<li class="meta-item"><span class="icon icon-bed"></span> Project Name: {{$project_title}}</li>
						<li class="meta-item"><sapn class="icon icon-bed">
							<input type="hidden" id="project_id" name="project_id" value="{{$pid??''}}"/></sapn>
							<input type="hidden" id="login_id" name="login_id" value="{{AUTH::user()->id}}"/>	
							<input type="hidden" id="customerId" value="{{$contractor_id}}">
							<input type="hidden" id="projectstatus" value="offsite">
						</li>
					</ul>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>	

<!-- START CHAT BOARD HTML -->
<section class="container" id="chatboatmain">
    <div id="wrapper" class="wrapper">
        <!-- end back-to-top -->
        <!-- Start main_content -->
        <div id="main-content">
            <main>
                <section class="msger">
                    <header class="msger-header">
                        <div class="msger-header-title">
                            <div class="author-img">
								@if(!empty($profile_image))
                                	<img src="{{asset($profile_image)}}" alt="Admin Image" />
								@else
									<img src="{{asset('frontend-assets/images/defaultimage.jpg')}}" alt="Admin Image" />
								@endif
                            </div>
							@if(isset($contractor_data->name))
                            <div class="author-info">
                                <div class="author-title-wrap">
                                    <h3 class="author-name"><input type="hidden" id="contractorId" value="{{$contractor_data->id}}">{{$contractor_data->name}}</h3>
                                </div>
								<div class="d-flex mt-1" id="online-offline-status">
									<div class="offline-indicator">
										<span class="do_not_blink"></span>
									  </div>
									<div class="author-description offline-class" id="{{$contractor_id}}-status">Offline</div>
								</div>
                            </div>
                            <a href="#"></a>
							@endif
                        </div>
                        
                    </header>
                    <main id="messages-{{$contractor_id}}" class="msger-chat">
                        @php
							$today = now()->setTimezone('Asia/Kolkata')->format('Y-m-d');
							$yesterday = now()->subDay()->setTimezone('Asia/Kolkata')->format('Y-m-d');
							$current_date = null;
						@endphp
						@if(!$message_data->isEmpty())
							@foreach(array_reverse($message_data->toArray()) as $Message_val)
								@if($Message_val->contractor_id == $contractor_id)
									@php
										$date = Carbon\Carbon::parse($Message_val->created_at)->setTimezone('Asia/Kolkata');
										$msg_date = $date->format('g:ia');
							
										// Check if the current message's date is today, yesterday, or other
										if($date->format('Y-m-d') == $today) {
											$date_label = 'Today';
										} elseif($date->format('Y-m-d') == $yesterday) {
											$date_label = 'Yesterday';
										} else {
											$date_label = $date->format('F j, Y'); // Any other date format you desire
										}
							
										// Display the date divider only if it's a new date
										if($date_label != $current_date) {
											echo '<div class="message-divider sticky-top pb-2" data-label="' . $date_label . '">&nbsp;</div>';
											$current_date = $date_label;
										}
									@endphp
									@if($Message_val->role == 'customer')
										<div class="msg right-msg">
											<div class="msg-item">
												<span class="msg-time">{{$Message_val->name}}, {{$msg_date}}</span>
												<div class="msg-bubble">
													<div class="msg-text">
														<p>{{$Message_val->text}}</p>
													</div>
													@if($Message_val->is_read == 1)
														<div class="msg-status seen"><span aria-label=" Read " data-icon="msg-dblcheck" class="x1q15gih"><svg viewBox="0 0 16 11" height="11" width="16" preserveAspectRatio="xMidYMid meet" class="" fill="none"><title>msg-dblcheck</title><path d="M11.0714 0.652832C10.991 0.585124 10.8894 0.55127 10.7667 0.55127C10.6186 0.55127 10.4916 0.610514 10.3858 0.729004L4.19688 8.36523L1.79112 6.09277C1.7488 6.04622 1.69802 6.01025 1.63877 5.98486C1.57953 5.95947 1.51817 5.94678 1.45469 5.94678C1.32351 5.94678 1.20925 5.99544 1.11192 6.09277L0.800883 6.40381C0.707784 6.49268 0.661235 6.60482 0.661235 6.74023C0.661235 6.87565 0.707784 6.98991 0.800883 7.08301L3.79698 10.0791C3.94509 10.2145 4.11224 10.2822 4.29844 10.2822C4.40424 10.2822 4.5058 10.259 4.60313 10.2124C4.70046 10.1659 4.78086 10.1003 4.84434 10.0156L11.4903 1.59863C11.5623 1.5013 11.5982 1.40186 11.5982 1.30029C11.5982 1.14372 11.5348 1.01888 11.4078 0.925781L11.0714 0.652832ZM8.6212 8.32715C8.43077 8.20866 8.2488 8.09017 8.0753 7.97168C7.99489 7.89128 7.8891 7.85107 7.75791 7.85107C7.6098 7.85107 7.4892 7.90397 7.3961 8.00977L7.10411 8.33984C7.01947 8.43717 6.97715 8.54508 6.97715 8.66357C6.97715 8.79476 7.0237 8.90902 7.1168 9.00635L8.1959 10.0791C8.33132 10.2145 8.49636 10.2822 8.69102 10.2822C8.79681 10.2822 8.89838 10.259 8.99571 10.2124C9.09304 10.1659 9.17556 10.1003 9.24327 10.0156L15.8639 1.62402C15.9358 1.53939 15.9718 1.43994 15.9718 1.32568C15.9718 1.1818 15.9125 1.05697 15.794 0.951172L15.4386 0.678223C15.3582 0.610514 15.2587 0.57666 15.1402 0.57666C14.9964 0.57666 14.8715 0.635905 14.7657 0.754395L8.6212 8.32715Z" fill="currentColor"></path></svg></span></div>
													@else
														<div class="msg-status unseen">
															<span aria-label=" Un Read " data-icon="msg-dblcheck" class="x1q15gih unseen">
																<svg viewBox="0 0 16 11" height="11" width="16" preserveAspectRatio="xMidYMid meet" fill="none">
																	<title>msg-check</title>
																	<path d="M11.0714 0.652832C10.991 0.585124 10.8894 0.55127 10.7667 0.55127C10.6186 0.55127 10.4916 0.610514 10.3858 0.729004L4.19688 8.36523L1.79112 6.09277C1.7488 6.04622 1.69802 6.01025 1.63877 5.98486C1.57953 5.95947 1.51817 5.94678 1.45469 5.94678C1.32351 5.94678 1.20925 5.99544 1.11192 6.09277L0.800883 6.40381C0.707784 6.49268 0.661235 6.60482 0.661235 6.74023C0.661235 6.87565 0.707784 6.98991 0.800883 7.08301L3.79698 10.0791C3.94509 10.2145 4.11224 10.2822 4.29844 10.2822C4.40424 10.2822 4.5058 10.259 4.60313 10.2124C4.70046 10.1659 4.78086 10.1003 4.84434 10.0156L11.4903 1.59863C11.5623 1.5013 11.5982 1.40186 11.5982 1.30029C11.5982 1.14372 11.5348 1.01888 11.4078 0.925781L11.0714 0.652832Z" fill="currentColor"></path>
																</svg>
															</span>
														</div>
												    @endif		
												</div>
											</div>
										</div>
									@else
										<div class="msg left-msg">
											<div class="msg-img">
												@if(isset($Message_val->c_profile_image))
												<img src="{{asset($Message_val->c_profile_image)}}" alt="Admin Image" />
												@else
												<img src="{{asset('frontend-assets/images/defaultimage.jpg')}}" alt="Admin Image" />
												@endif
											</div>
											<div class="msg-item">
												<span class="msg-time">{{$Message_val->contractor_name}}, {{$msg_date}}</span>
												<div class="msg-bubble">
													<div class="msg-text">
														<p>{{$Message_val->text}}</p>
													</div>
														
												</div>
											</div>
										</div>
									@endif
								@endif
							@endforeach
						@else
							<!-- START NOT MESSAGE FOUNDS -->	
							<div id="if_no_msg" class="d-flex flex-column justify-content-center text-center h-100 w-100">
								<div class="container">
									<div class="avatar avatar-lg mb-2">
										<img class="avatar-img" src="{{ asset($userprofile) }}" alt="">
									</div>
									<h5>Welcome, {{ucwords($userName)}}!</h5>
									<p class="text-muted">Please Start messaging.</p>
								</div>
							</div>
							<!-- END NOT MESSAGE FOUNDS -->					
						@endif
                    </main>
                    <div class="input-form">
                        <div class="input-form-wrap">
							<div class="input-button-wrap">
                            </div>
                            <form id="msgForm-{{$contractor_id}}" class="msger-inputarea">
                                <input id="msgText-{{$contractor_id}}" type="text" class="msger-input" placeholder="Type a message" />
                                <button type="submit" class="msger-attachment-btn right-btn">
                                    <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#2B2C33" gradientcolor1="#2B2C33" gradientcolor2="#2B2C33">
                                        <path
                                            d="M20.063 8.445a3.218 3.218 0 0 1-.002 4.551l-7.123 7.112a2.25 2.25 0 0 1-.943.562L7.702 21.96a1 1 0 0 1-1.24-1.264l1.362-4.228c.11-.34.299-.65.552-.903l7.133-7.121a3.22 3.22 0 0 1 4.553.002Zm-3.494 1.06-7.133 7.12a.75.75 0 0 0-.184.301l-1.07 3.323 3.382-1.015a.75.75 0 0 0 .314-.188L19 11.936a1.718 1.718 0 1 0-2.431-2.432ZM8.15 2.37l.05.105 3.253 8.249-1.157 1.155L9.556 10H5.443l-.995 2.52a.75.75 0 0 1-.877.454l-.097-.031a.75.75 0 0 1-.453-.876l.032-.098 3.753-9.495c.236-.595 1.043-.63 1.345-.104Zm-.648 2.422L6.036 8.5h2.928L7.503 4.792Z"
                                        ></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <button class="back-to-top">
                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#2B2C33" gradientcolor1="#2B2C33" gradientcolor2="#2B2C33">
                            <path d="M4.22 8.47a.75.75 0 0 1 1.06 0L12 15.19l6.72-6.72a.75.75 0 1 1 1.06 1.06l-7.25 7.25a.75.75 0 0 1-1.06 0L4.22 9.53a.75.75 0 0 1 0-1.06Z"></path>
                        </svg>
                    </button>
                </section>
            </main>
            <!-- End Main -->
        </div>
        <!-- End main_content -->
    </div>
</section>
<!-- END CHAT BOARD HTML -->




<script>
	$(document).ready(function () {
		/* start check online user status */
			var projectId 		= $('#project_id').val();
			var sender_id 		= $('#login_id').val();
			var contractorId 	= $('#login_id').val();
			var role			= 'contractor';

			updateUserStatus(true);
			$('.msg-status.unseen').removeClass('unseen').addClass('seen');

			window.Echo.join(`status-update-project.${projectId}`)
			.here((users) => {
				users.forEach(user => {
					if (sender_id !== user['id'] && user['role'] === "contractor") {
						updateStatusProject(user['id'], projectId, true);
						$(document).find('.msg-status.unseen').each(function() {
							// Remove the 'unseen' class
							$(this).removeClass('unseen');
							// Add the 'seen' class
							$(this).addClass('seen');
							// Update the text to the check mark symbol (✓✓)
							$(this).html('<span aria-label=" Read " data-icon="msg-dblcheck" class="x1q15gih"><svg viewBox="0 0 16 11" height="11" width="16" preserveAspectRatio="xMidYMid meet" class="" fill="none"><title>msg-dblcheck</title><path d="M11.0714 0.652832C10.991 0.585124 10.8894 0.55127 10.7667 0.55127C10.6186 0.55127 10.4916 0.610514 10.3858 0.729004L4.19688 8.36523L1.79112 6.09277C1.7488 6.04622 1.69802 6.01025 1.63877 5.98486C1.57953 5.95947 1.51817 5.94678 1.45469 5.94678C1.32351 5.94678 1.20925 5.99544 1.11192 6.09277L0.800883 6.40381C0.707784 6.49268 0.661235 6.60482 0.661235 6.74023C0.661235 6.87565 0.707784 6.98991 0.800883 7.08301L3.79698 10.0791C3.94509 10.2145 4.11224 10.2822 4.29844 10.2822C4.40424 10.2822 4.5058 10.259 4.60313 10.2124C4.70046 10.1659 4.78086 10.1003 4.84434 10.0156L11.4903 1.59863C11.5623 1.5013 11.5982 1.40186 11.5982 1.30029C11.5982 1.14372 11.5348 1.01888 11.4078 0.925781L11.0714 0.652832ZM8.6212 8.32715C8.43077 8.20866 8.2488 8.09017 8.0753 7.97168C7.99489 7.89128 7.8891 7.85107 7.75791 7.85107C7.6098 7.85107 7.4892 7.90397 7.3961 8.00977L7.10411 8.33984C7.01947 8.43717 6.97715 8.54508 6.97715 8.66357C6.97715 8.79476 7.0237 8.90902 7.1168 9.00635L8.1959 10.0791C8.33132 10.2145 8.49636 10.2822 8.69102 10.2822C8.79681 10.2822 8.89838 10.259 8.99571 10.2124C9.09304 10.1659 9.17556 10.1003 9.24327 10.0156L15.8639 1.62402C15.9358 1.53939 15.9718 1.43994 15.9718 1.32568C15.9718 1.1818 15.9125 1.05697 15.794 0.951172L15.4386 0.678223C15.3582 0.610514 15.2587 0.57666 15.1402 0.57666C14.9964 0.57666 14.8715 0.635905 14.7657 0.754395L8.6212 8.32715Z" fill="currentColor"></path></svg></span>');
						});
					}
				});
			})
			.joining((user) => {
				if (sender_id !== user['id'] && user['role'] === "contractor") {
					updateStatusProject(user['id'], projectId, true);
					$(document).find('.msg-status.unseen').each(function() {
						// Remove the 'unseen' class
						$(this).removeClass('unseen');
						// Add the 'seen' class
						$(this).addClass('seen');
						// Update the text to the check mark symbol (✓✓)
						$(this).html('<span aria-label=" Read " data-icon="msg-dblcheck" class="x1q15gih"><svg viewBox="0 0 16 11" height="11" width="16" preserveAspectRatio="xMidYMid meet" class="" fill="none"><title>msg-dblcheck</title><path d="M11.0714 0.652832C10.991 0.585124 10.8894 0.55127 10.7667 0.55127C10.6186 0.55127 10.4916 0.610514 10.3858 0.729004L4.19688 8.36523L1.79112 6.09277C1.7488 6.04622 1.69802 6.01025 1.63877 5.98486C1.57953 5.95947 1.51817 5.94678 1.45469 5.94678C1.32351 5.94678 1.20925 5.99544 1.11192 6.09277L0.800883 6.40381C0.707784 6.49268 0.661235 6.60482 0.661235 6.74023C0.661235 6.87565 0.707784 6.98991 0.800883 7.08301L3.79698 10.0791C3.94509 10.2145 4.11224 10.2822 4.29844 10.2822C4.40424 10.2822 4.5058 10.259 4.60313 10.2124C4.70046 10.1659 4.78086 10.1003 4.84434 10.0156L11.4903 1.59863C11.5623 1.5013 11.5982 1.40186 11.5982 1.30029C11.5982 1.14372 11.5348 1.01888 11.4078 0.925781L11.0714 0.652832ZM8.6212 8.32715C8.43077 8.20866 8.2488 8.09017 8.0753 7.97168C7.99489 7.89128 7.8891 7.85107 7.75791 7.85107C7.6098 7.85107 7.4892 7.90397 7.3961 8.00977L7.10411 8.33984C7.01947 8.43717 6.97715 8.54508 6.97715 8.66357C6.97715 8.79476 7.0237 8.90902 7.1168 9.00635L8.1959 10.0791C8.33132 10.2145 8.49636 10.2822 8.69102 10.2822C8.79681 10.2822 8.89838 10.259 8.99571 10.2124C9.09304 10.1659 9.17556 10.1003 9.24327 10.0156L15.8639 1.62402C15.9358 1.53939 15.9718 1.43994 15.9718 1.32568C15.9718 1.1818 15.9125 1.05697 15.794 0.951172L15.4386 0.678223C15.3582 0.610514 15.2587 0.57666 15.1402 0.57666C14.9964 0.57666 14.8715 0.635905 14.7657 0.754395L8.6212 8.32715Z" fill="currentColor"></path></svg></span>');
					});
				}
			})
			.leaving((user) => {
				if (sender_id !== user['id'] && user['role'] === "contractor") {
					updateStatusProject(user['id'], projectId, false);
				}
			})
			.listen('UserStatusUpdated', (e) => {
				if (e.userId !== sender_id) {
					updateStatusProject(e.userId, e.projectId, e.isOnline);
				}
			});

			function updateStatusProject(userId, projectId, isOnline) {
				const statusField = jQuery('#projectstatus');
				if (statusField.length) {
					if (isOnline) {
						statusField.val("onsite");
					} else {
						statusField.val("offsite");
					}
				} else {
					console.error('Status element not found for user:', userId);
				}
			}

			function updateUserStatus(isOnline) {
				axios.post('/user-status-update', {
					userId: sender_id,
					projectId: projectId,
					isOnline: isOnline,
					senderId: sender_id,
					role: role,
					contractorId: contractorId
				});
			}
		/* end check online user status */


		// start disabled button if not write
		$('#msgForm-{{$contractor_id}} button[type="submit"]').prop('disabled', true);
		// Add an input event handler to the text input
        $('#msgText-{{$contractor_id}}').on('input', function() {
            // Check if the input field is empty
            if ($(this).val().trim() !== '') {
                // If input is not empty, enable the submit button
                $('#msgForm-{{$contractor_id}} button[type="submit"]').prop('disabled', false);
            } else {
                // If input is empty, disable the submit button
                $('#msgForm-{{$contractor_id}} button[type="submit"]').prop('disabled', true);
            }
        });
		// end disabled button if not write


		const currentUserRole = 'customer';
		// Handle form submission
		// $('#msgForm-{{$contractor_id}}').on('submit', function (e) {
			$(document).on('submit', '#msgForm-{{$contractor_id}}', function(e) {

			e.preventDefault();
			let message = $('#msgText-{{$contractor_id}}').val();
			$.post('/message-sent', {
				_token: '{{ csrf_token() }}',
				project_id: '{{$pid}}',
				contractor_id: '{{ $contractor_id }}',
				customer_id: userId,
				message: message}, (resp) => {
				// console.log(resp);
				$('#msgText-{{$contractor_id}}').val('');
				$('#msgForm-{{$contractor_id}} button[type="submit"]').prop('disabled', true);
				// Select the element with the scrollbar (e.g., the messages container)
				var messagesContainer = document.getElementById("messages-{{$contractor_id}}");
				// Set the scroll position to the bottom
				messagesContainer.scrollTop = messagesContainer.scrollHeight;
				if($('#if_no_msg').length){
					// If it exists, remove it
					$('#if_no_msg').remove();
				}
			}).catch((err) => {
				console.error(err);
			});
		});
		
		
			window.Echo.private(`chats.{{ $contractor_id }}`)
				.listen('MessageSent', (e) => {
				var contractorID = "{{ $contractor_id }}";
				// Determine if the message sender is the current user
				const isSelf = e.role === currentUserRole; // Assuming you have the current user's ID stored in currentUserId variable
				// Assign appropriate class based on sender
				const messageClass = isSelf ? 'mine' : 'self';
				if(e.customer_id == "{{Auth::id() }}" && e.contractor_id == contractorID && e.project_id == {{$pid}}){
					const statusField = jQuery(document).find('#projectstatus').val();
					if(statusField == 'onsite'){
						updateUserStatus(true);
						// console.log('out');
					$('#messages-{{$contractor_id}}').append(`<div class="msg left-msg ${messageClass}"><div class="msg-img"><img src="{{asset('${e.profile_image}')}}" alt="Admin Image" /></div><div class="msg-item"><span class="msg-time">${e.name}, ${e.msg_date}</span><div class="msg-bubble"><div class="msg-text"><p>${e.text}</p></div></div></div></div>`);
					}else{
						// console.log('out');
					$('#messages-{{$contractor_id}}').append(`<div class="msg left-msg ${messageClass}"><div class="msg-img"><img src="{{asset('${e.profile_image}')}}" alt="Admin Image" /></div><div class="msg-item"><span class="msg-time">${e.name}, ${e.msg_date}</span><div class="msg-bubble"><div class="msg-text"><p>${e.text}</p></div></div></div></div>`);
					}

					if($('#if_no_msg').length){
						// If it exists, remove it
						$('#if_no_msg').remove();
					}
					
					
					// Select the element with the scrollbar (e.g., the messages container)
					var messagesContainer = document.getElementById("messages-{{$contractor_id}}");
					// Set the scroll position to the bottom
					messagesContainer.scrollTop = messagesContainer.scrollHeight;
				}
			}).error((error) => {
				console.error(error); // Log the error for debugging
				// Handle unauthorized access error here, for example:
				if (error.message === '403 Forbidden') {
					console.error('You are not authorized to access this channel.');
					// Redirect the user to a different page or show an error message
				}
			});
			
			window.Echo.private(`chats.{{ Auth::id() }}`)
				.listen('MessageSent', (e) => {
					var currentUserID = "{{Auth::id() }}";
				// console.log(e);
				// Determine if the message sender is the current user
				const isSelf = e.role === currentUserRole; // Assuming you have the current user's ID stored in currentUserId variable
				// Assign appropriate class based on sender
				const messageClass = isSelf ? 'mine' : 'self';
				if(e.customer_id == currentUserID && e.contractor_id == "{{$contractor_id}}" && e.project_id == {{$pid}}){
					const statusField = jQuery(document).find('#projectstatus').val();
					if(statusField == 'onsite'){
						updateUserStatus(true);
						// console.log('IN1');
					$('#messages-{{$contractor_id}}').append(`<div class="msg right-msg ${messageClass}"><div class="msg-item"><span class="msg-time">${e.name}, ${e.msg_date}</span><div class="msg-bubble"><div class="msg-text"><p>${e.text}</p></div><div class="msg-status seen"><span aria-label=" Read " data-icon="msg-dblcheck" class="x1q15gih"><svg viewBox="0 0 16 11" height="11" width="16" preserveAspectRatio="xMidYMid meet" class="" fill="none"><title>msg-dblcheck</title><path d="M11.0714 0.652832C10.991 0.585124 10.8894 0.55127 10.7667 0.55127C10.6186 0.55127 10.4916 0.610514 10.3858 0.729004L4.19688 8.36523L1.79112 6.09277C1.7488 6.04622 1.69802 6.01025 1.63877 5.98486C1.57953 5.95947 1.51817 5.94678 1.45469 5.94678C1.32351 5.94678 1.20925 5.99544 1.11192 6.09277L0.800883 6.40381C0.707784 6.49268 0.661235 6.60482 0.661235 6.74023C0.661235 6.87565 0.707784 6.98991 0.800883 7.08301L3.79698 10.0791C3.94509 10.2145 4.11224 10.2822 4.29844 10.2822C4.40424 10.2822 4.5058 10.259 4.60313 10.2124C4.70046 10.1659 4.78086 10.1003 4.84434 10.0156L11.4903 1.59863C11.5623 1.5013 11.5982 1.40186 11.5982 1.30029C11.5982 1.14372 11.5348 1.01888 11.4078 0.925781L11.0714 0.652832ZM8.6212 8.32715C8.43077 8.20866 8.2488 8.09017 8.0753 7.97168C7.99489 7.89128 7.8891 7.85107 7.75791 7.85107C7.6098 7.85107 7.4892 7.90397 7.3961 8.00977L7.10411 8.33984C7.01947 8.43717 6.97715 8.54508 6.97715 8.66357C6.97715 8.79476 7.0237 8.90902 7.1168 9.00635L8.1959 10.0791C8.33132 10.2145 8.49636 10.2822 8.69102 10.2822C8.79681 10.2822 8.89838 10.259 8.99571 10.2124C9.09304 10.1659 9.17556 10.1003 9.24327 10.0156L15.8639 1.62402C15.9358 1.53939 15.9718 1.43994 15.9718 1.32568C15.9718 1.1818 15.9125 1.05697 15.794 0.951172L15.4386 0.678223C15.3582 0.610514 15.2587 0.57666 15.1402 0.57666C14.9964 0.57666 14.8715 0.635905 14.7657 0.754395L8.6212 8.32715Z" fill="currentColor"></path></svg></span></div></div></div></div>`);
					}else{
						// console.log('IN1');
					$('#messages-{{$contractor_id}}').append(`<div class="msg right-msg ${messageClass}"><div class="msg-item"><span class="msg-time">${e.name}, ${e.msg_date}</span><div class="msg-bubble"><div class="msg-text"><p>${e.text}</p></div><div class="msg-status unseen"><span aria-label=" Un Read " data-icon="msg-dblcheck" class="x1q15gih unseen">
<svg viewBox="0 0 16 11" height="11" width="16" preserveAspectRatio="xMidYMid meet" fill="none">
    <title>msg-check</title>
    <path d="M11.0714 0.652832C10.991 0.585124 10.8894 0.55127 10.7667 0.55127C10.6186 0.55127 10.4916 0.610514 10.3858 0.729004L4.19688 8.36523L1.79112 6.09277C1.7488 6.04622 1.69802 6.01025 1.63877 5.98486C1.57953 5.95947 1.51817 5.94678 1.45469 5.94678C1.32351 5.94678 1.20925 5.99544 1.11192 6.09277L0.800883 6.40381C0.707784 6.49268 0.661235 6.60482 0.661235 6.74023C0.661235 6.87565 0.707784 6.98991 0.800883 7.08301L3.79698 10.0791C3.94509 10.2145 4.11224 10.2822 4.29844 10.2822C4.40424 10.2822 4.5058 10.259 4.60313 10.2124C4.70046 10.1659 4.78086 10.1003 4.84434 10.0156L11.4903 1.59863C11.5623 1.5013 11.5982 1.40186 11.5982 1.30029C11.5982 1.14372 11.5348 1.01888 11.4078 0.925781L11.0714 0.652832Z" fill="currentColor"></path>
</svg></span></div></div></div></div>`);
					}

					if($('#if_no_msg').length){
						// If it exists, remove it
						$('#if_no_msg').remove();
					}
					
					// Select the element with the scrollbar (e.g., the messages container)
					var messagesContainer = document.getElementById("messages-{{$contractor_id}}");
					// Set the scroll position to the bottom
					messagesContainer.scrollTop = messagesContainer.scrollHeight;
				}
			}).error((error) => {
				console.error(error); // Log the error for debugging
				// Handle unauthorized access error here, for example:
				if (error.message === '403 Forbidden') {
					console.error('You are not authorized to access this channel.');
					// Redirect the user to a different page or show an error message
				}
			});
		 
	});

	// Wait for the document to fully load
	document.addEventListener("DOMContentLoaded", function() {
		// Select the element with the scrollbar (e.g., the messages container)
		var messagesContainer = document.getElementById("messages-{{$contractor_id}}");
		// Set the scroll position to the bottom
		messagesContainer.scrollTop = messagesContainer.scrollHeight;
	});
	/* start scroll down button */
	// Initially hide the back-to-top button
	$('.back-to-top').hide();

	// Variable to store the previous scroll position
	var prevScrollPos = $('.msger-chat').scrollTop();

	// Listen for scroll events on the window
	$('.msger-chat').scroll(function(){
		// Get the current scroll position
		var currentScrollPos = $(this).scrollTop();
		
		// Check if the current scroll position is greater than the previous scroll position
		if (currentScrollPos > prevScrollPos && currentScrollPos > 0){
			// If scrolling down (and not at the top), hide the back-to-top button
			$('.back-to-top').fadeOut();
		} else {
			// If scrolling up or at the top, show the back-to-top button
			$('.back-to-top').fadeIn();
		}
		
		// Update the previous scroll position
		prevScrollPos = currentScrollPos;
	});

	// Handle click event for the back-to-top button
	$('.back-to-top').click(function(){
		// Animate scrolling down by the height of the chat area
		var chatHeight = $('.msger-chat')[0].scrollHeight;
		$('.msger-chat').animate({scrollTop : chatHeight}, 800);
		return false;
	});
	/* end scroll down button */
	/* start chat sticky */
	$(window).scroll(function() {
        var headerHeight = $('.site-header').outerHeight();
        var scrollTop = $(window).scrollTop();
        var chatboatMain = $('#chatboatmain');
        
        // Check if the scroll position is below the header
        if (scrollTop > headerHeight) {
            chatboatMain.addClass('sticky');
        } else {
            chatboatMain.removeClass('sticky');
        }
    });
	/* end chat sticky */

	/* start scrolling top old message getting */
	jQuery(document).ready(function(e){
		var currentPage = 2;
		var scrollThreshold = 115; // Adjust this value as needed
		$('.msger-chat').scroll(function() {
			if ($(this).scrollTop() == 0) {
				loadMoreConversations();
			}
		});
		function loadMoreConversations() {
			$.ajax({
				url: "{{ route('contractor.load.more.conversations') }}",
				type: "POST",
				data: {
					page: currentPage,
					'contractor_id': "{{$contractor_id}}",
					'project_id': "{{$pid}}",
				},
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				beforeSend: function() {
					$('#messages-{{$contractor_id}}').prepend('<div id="msg-loader"><span class="download mb-3">Updating conversation...</span></div>');
				},
				success: function(response) {
					if (response != '') {
						$('#messages-{{$contractor_id}}').prepend(response);
						// Scroll slightly down
						var newScrollTop = $('.msger-chat').scrollTop() + scrollThreshold;
                    	$('.msger-chat').scrollTop(newScrollTop);
						currentPage++;
					}
				},
				error: function(xhr) {
					console.log(xhr.responseText);
				},
				complete: function() {
					// Hide loading message
					$('#msg-loader').remove();
				}
			});
		}
	});
	/* end scrolling top old message getting */
</script>
<style>
	#chatboatmain {
		position: sticky;
		top: 60px; /* Adjust as per your header height */
		z-index: 1000; /* Ensure it's above the header */
		padding: 20px;
	}
	div#msg-loader {
		display: grid;
		place-items: center;
		height: 100%;
	}
	span.download {
		display: inline-block;
		margin-right: 10px;
		background: #1a86d7;
		color: #fefefe;
		text-decoration: none;
		font-size: 13px;
		line-height: 24px;
		border-radius: 50px;
		-webkit-transition: all 0.3s;
		transition: all 0.3s;
		width: 200px;
		text-align: center;
	}
	
	.msg-status {
		font-size: 14px;
		color: #999;
		margin-top: 5px;
	}

	.msg-status.seen {
		color: #53bdeb;
	}
	span.x1q15gih.unseen {
		color: #999;
	}
</style>
@endsection