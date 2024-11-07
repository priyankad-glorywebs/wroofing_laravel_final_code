@php
	$today = now()->setTimezone('Asia/Kolkata')->format('Y-m-d');
	$yesterday = now()->subDay()->setTimezone('Asia/Kolkata')->format('Y-m-d');
	$current_date = null;
	$msgData = array_reverse($message_data->toArray());
	$reversedData = array_reverse($msgData['data']);
@endphp

@if(isset($reversedData))
	@foreach($reversedData as $Message_val) 
		@php
			$date = Carbon\Carbon::parse($Message_val->created_at)->setTimezone('Asia/Kolkata');
			$msg_date = $date->format('g:ia');
		@endphp
		@php
			$date = Carbon\Carbon::parse($Message_val->created_at)->setTimezone('Asia/Kolkata');
			$msg_date = $date->format('g:ia');

			// Check if the current message's date is today, yesterday, or other
			if ($date->format('Y-m-d') == $today) {
				$date_label = 'Today';
			} elseif ($date->format('Y-m-d') == $yesterday) {
				$date_label = 'Yesterday';
			} else {
				$date_label = $date->format('F j, Y'); // Any other date format you desire
			}

			// Display the date divider only if it's a new date
			if ($date_label != $current_date) {
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
	@endforeach
@endif