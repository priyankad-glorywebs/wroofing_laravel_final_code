jQuery(document).ready(function ($) {
	var logincontractor = $('#logincontractor').val();
	var customerData  = $('#customerId').val();
	var contractorData = $('#contractorId').val();

	if(logincontractor){
		window.Echo.join('status-update')
		.here((users) => {
			console.log('contractor');
			users.forEach(user => {
				if (sender_id !== user[0]['id'] && user[0]['role'] == 'web') {
					updateStatus(user[0]['id'], true);
				}	

			});
		})
		.joining((user) => {
			if (sender_id !== user[0]['id'] && user[0]['role'] == 'web') {
				updateStatus(user[0]['id'], true);
			}
		})
		.leaving((user) => {
			if (sender_id !== user[0]['id'] && user[0]['role'] == 'web') {
				updateStatus(user[0]['id'], false);
			}
			
		})
		.listen('UserStatusEvent', (e) => {
			console.log(e);
		});
	}

	//chat contractor 
	var loginuser = $('#loginuser').val();
	if(loginuser){
		window.Echo.join('status-update')
			.here((users) => {
			users.forEach(user => {
				if (sender_id !== user[0]['id'] && user[0]['role'] === 'contractor' ) {
					updateStatus(user[0]['id'], true);
				}
			});
		})
		.joining((user) => {
			if (sender_id !== user[0]['id'] && user[0]['role'] === 'contractor') {
				updateStatus(user[0]['id'], true);
			}
		})
		.leaving((user) => {
			if (sender_id !== user[0]['id'] && user[0]['role'] === 'contractor') {
				updateStatus(user[0]['id'], false);
			}
			
		})
		.listen('UserStatusEvent', (e) => {
			console.log(e);
		});
	}

	function updateStatus(userId, isOnline) {
		const statusElement = jQuery('#' + userId + '-status');
		const onlineIndicator = jQuery('#online-offline-status .online-indicator');
		const offlineIndicator = jQuery('#online-offline-status .offline-indicator');
		if (statusElement.length) {
			if (isOnline) {
				jQuery(document).find(statusElement).removeClass('offline-class');
					jQuery(document).find(statusElement).addClass('online-class');
					jQuery(document).find(statusElement).text('Online');
					jQuery(document).find(offlineIndicator).removeClass('offline-indicator');
					jQuery(document).find('#online-offline-status').find('div:first').addClass('online-indicator');
					jQuery(document).find('#online-offline-status .do_not_blink').removeClass('do_not_blink');
					jQuery(document).find('#online-offline-status').find('div:first span').addClass('blink');
				
			} else {
				jQuery(statusElement).addClass('offline-class');
				jQuery(statusElement).removeClass('online-class');
				jQuery(statusElement).text('Offline');

				jQuery(document).find(onlineIndicator).addClass('offline-indicator');
				jQuery(document).find('#online-offline-status').find('div:first').removeClass('online-indicator');
				jQuery(document).find('#online-offline-status .blink').addClass('do_not_blink');
				jQuery(document).find('#online-offline-status').find('div:first span').removeClass('blink');
			}
		}	
	}
});