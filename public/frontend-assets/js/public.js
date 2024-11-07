jQuery(document).ready(function () {
	// body click hide navigation 
	// $(document).find('body').on('click', function (event) {
	// 	var clickedElement = $(event.target);
	// 	var hamburgerMenu = $(this).find('.hamburger-menu');
	// 	var navbarCollapse = $(this).find('.navbar-collapse');
	// 	if (!clickedElement.closest('.navbar-collapse').length) {
	// 		if (navbarCollapse.hasClass('navbar-collapse') && navbarCollapse.hasClass('show')) {
	// 			// Check if the clicked element does not have the class 'hamburger-menu' and 'open'
	// 			if (!clickedElement.hasClass('hamburger-menu') || !clickedElement.hasClass('open')) {
	// 				$('body').removeClass('menuopen');
	// 				// Remove the "open" class from hamburger menu and "show" class from navbar collapse
	// 				hamburgerMenu.removeClass('open');
	// 				navbarCollapse.removeClass('show');
	// 			}
	// 		}
	// 	}
	// });
	// Menu hamburger
	$('.hamburger-menu').on('click', function () {
		$('body').toggleClass('menuopen');
		$('.hamburger-menu').toggleClass('open');
		$('.navbar-collapse').toggleClass('show');
		$('.navbar-overlay').toggleClass('show');
	});
	$("#editquotepopup a").click(function () {
		$("#editquotepopup").modal("hide");
		$("#sendquotepopup").modal("show");
	});
	$(".password-icon-view").click(function () {
		$(this).hide();
		$(this).closest(".form-element").find(".password-icon-hide").show();
		var input = $(this).closest(".form-element").find("input");
		if (input.attr("type") == "password") {
			input.attr("type", "text");
		} else {
			input.attr("type", "password");
		}
	});
	$(".password-icon-hide").click(function () {
		$(this).hide();
		$(this).closest(".form-element").find(".password-icon-view").show();
		var input = $(this).closest(".form-element").find("input");
		if (input.attr("type") == "password") {
			input.attr("type", "text");
		} else {
			input.attr("type", "password");
		}
	});
	$(".btn-step-1").click(function () {
		$(".step-1").hide();
		$(".step-2").show();
		$(".step-count-progress").removeClass(".current-step-1");
		$(".step-count-progress").addClass("current-step-2");
		$(".breadcrumb-wrap .breadcrumb-item a").attr("href", "javascript:void(0)");
	});
	$(".step-2 .backto-login a, .breadcrumb-wrap .breadcrumb-item a").click(function () {
		$(".step-2").hide();
		$(".step-1").show();
		$(".step-count-progress").removeClass(".current-step-2");
		$(".step-count-progress").addClass("current-step-1");
	});
	$('#uploadimage').change(function (e) {
		if(e.target.files.length != 0){
			const filename = e.target.files[0].name;
			$(this).closest(".upload-img-wrap").find(".upload-img-text").html(filename);
		}
	});
	$('#banner_image').change(function (e) {
		if(e.target.files.length != 0){
			const filename = e.target.files[0].name;
			$(this).closest(".upload-img-wrap").find(".upload-img-text").html(filename);
		}
	});
	$('#company_logo').change(function (e) {
		if(e.target.files.length != 0){
			const filename = e.target.files[0].name;
			$(this).closest(".upload-img-wrap").find(".upload-img-text").html(filename);
		}
	});
	// add document file name  on change
	$('#documents').change(function (e) {
		if(e.target.files.length != 0){
			const filename = e.target.files[0].name;
			$(this).closest(".upload-img-wrap").find(".upload-img-text").html(filename);
		}
	});
	$('#insurancedocuments').change(function (e) {
		if(e.target.files.length != 0){
			const filename = e.target.files[0].name;
			$(this).closest(".upload-img-wrap").find(".upload-img-text").html(filename);
		}
	});
	$('#mortgagedocuments').change(function (e) {
		if(e.target.files.length != 0){
			const filename = e.target.files[0].name;
			$(this).closest(".upload-img-wrap").find(".upload-img-text").html(filename);
		}
	});
	$('#contractordocuments').change(function (e) {
		if(e.target.files.length != 0){
			const filename = e.target.files[0].name;
			$(this).closest(".upload-img-wrap").find(".upload-img-text").html(filename);
		}
	});
	// Category Filter
	$('.btn-gallery-filter').click(function () {
		var category = $(this).attr('data-category');
		$('.btn-gallery-filter').removeClass('active');
		$(this).addClass('active');
		if (category == 'all') {
			$('.item').removeClass('hide');
		} else {
			$('.item').removeClass('hide').filter(':not([data-category*="' + category + '"])').addClass('hide');
		}
	});
	// Image Gallery Popup
	$('.image-gallery-popup').each(function (index) {
		$('.image-gallery-popup').magnificPopup({
			type: 'image',
			gallery: {
				enabled: true
			},
			closeOnContentClick: true,
			image: {
				verticalFit: false
			}
		});
	});
	if ($(window).width() > 767) {
		jQuery('.login-content-slider.owl-carousel').owlCarousel({
			loop: true,
			nav: false,
			responsive: {
				0: {
					items: 1
				}
			}
		});
	}
	// Number only validation
	$('#contactnumber, #zipcode, #phoneno').keypress(function (event) {
		var keycode = event.which;
		if (!(event.shiftKey == false && (keycode == 43 || keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
			event.preventDefault();
		}
	});
	// Validation JS
	$("#loginform button[type='submit']").click(function () {
		var form = $("#loginform");
		form.validate({
			errorElement: 'span',
			errorClass: 'help-block',
			rules: {
				email: {
					required: true,
					email: true
				},
				password: {
					required: true,
				},
			},
		});
	});
	// Register

	$("#register #frm_next_btn").click(function () {
		if($('#contractor').is(':checked')){
			$('#company_name_div').show();
		}else{
			$('#company_name_div').hide();
		}
	});
	$("#back_button").click(function () {
		const customerChecked = $('#customer').is(':checked');
		const contractorChecked = $('#contractor').is(':checked');
		const form = $("#register");
		form[0].reset(); // Reset the form
		form.validate().resetForm(); // Reset the validation messages
		form.find('.field-error').removeClass('field-error'); // Remove error class
		form.find('.help-block').removeClass('help-block'); // Remove help block class
		form.find('.text-danger').text(''); // Remove help block class
		// Restore the state of the radio buttons
		$('#customer').prop('checked', customerChecked);
		$('#contractor').prop('checked', contractorChecked);
	  });

	  //customer profile page validations 
	$('#regi_contact_number').on('input', function() {
		// Remove any non-digit characters
		this.value = this.value.replace(/\D/g, '');
		// Limit the input to 12 digits
		if (this.value.length > 12) {
			this.value = this.value.slice(0, 12);
		}
	});
	$('#regi_zip_code').on('input', function() {
		// Remove any non-digit characters
		this.value = this.value.replace(/\D/g, '');
		// Limit the input to 6 digits
		if (this.value.length > 6) {
			this.value = this.value.slice(0, 6);
		}
	});
	
	$.validator.addMethod("validFileExtension", function(value, element, param) {
		// param is the array of valid file extensions
		var extension = value.split('.').pop().toLowerCase();
		return $.inArray(extension, param) !== -1;
	}, "Please upload a file with a valid extension.");

	$("#register input[type='submit']").click(function () {
		const form = $("#register");
		form.validate({
			errorElement: 'span',
			errorClass: 'help-block',
			highlight: function (element) {
				$(element).addClass("help-block");
				$(element).parent().addClass("field-error");
			},
			unhighlight: function (element) {
				$(element).removeClass("help-block");
				$(element).parent().removeClass("field-error");
			},
			// Define the initial rules
			rules: {
				name: {
					required: true,
				},
				email: {
					required: true,
					email: true,
					customEmailValidation: true
				},
				password: {
					required: true,
					minlength: 6 // Ensure at least 6 characters
				},
				password_confirmation: {
					required: true,
					equalTo: "#password",
					minlength: 6 // Ensure at least 6 characters
				},
				company_name: {
					required: true,
				},
				address: {
					required: true,
				},
				profile_image: {
					required: false,  // Not required, only validate if a file is selected
					validFileExtension: ["jpg", "jpeg", "png"], // Custom method for file extension
                	fileSizeValidation: true
				},
			},
			messages: {
				profile_image: {
					validFileExtension: "Please upload a valid image file (jpg, jpeg, png).",
					fileSizeValidation: "The maximum allowed file size is 20MB"
				}
			}
		});
		$.validator.addMethod("customEmailValidation", function (value, element) {
			// Regular expression for custom email validation
			var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
			return this.optional(element) || emailRegex.test(value);
		}, "Please enter a valid email address.");
		
		// Custom file extension validation method
		$.validator.addMethod("validFileExtension", function(value, element, param) {
			if (element.files.length > 0) { // Only check if a file is uploaded
				var extension = value.split('.').pop().toLowerCase();
				return $.inArray(extension, param) !== -1;
			}
			return true; // No file uploaded, skip validation
		}, "Please upload a valid image file.");
	
		// Custom file size validation method
		$.validator.addMethod("fileSizeValidation", function(value, element) {
			const maxSize = 20 * 1024 * 1024; // 20MB in bytes
			if (element.files.length > 0) {
				var fileSize = element.files[0].size;
				return fileSize <= maxSize;
			}
			return true; // No file uploaded, skip validation
		});
	});
	// contactus
	//customer profile page validations 
	$('#phoneno').on('input', function() {
		// Remove any non-digit characters
		this.value = this.value.replace(/\D/g, '');
		// Limit the input to 12 digits
		if (this.value.length > 12) {
			this.value = this.value.slice(0, 12);
		}
	});
	$("#contactus button[type='submit']").click(function () {
		var form = $("#contactus");
		form.validate({
			errorElement: 'span',
			errorClass: 'help-block',
			rules: {
				name: {
					required: true,
				},
				email: {
					required: true,
					email: true
				},
				phoneno: {
					required: true,
					// minlength: 9,
					maxlength: 12,
				},
				address: {
					required: true,
				},
				yourcomments: {
					required: true,
				},
			},
		});
	});
	// Change Password
	$("#changepassword button[type='submit']").click(function () {
		var form = $("#changepassword");
		form.validate({
			errorElement: 'span',
			errorClass: 'help-block',
			rules: {
				cpassword: { 
					'required': true,
					minlength: 6 // Ensure at least 6 characters
				},
				mpassword: { 
					'required': true,
					minlength: 6
				},
				cfmpassword: {
					required: true,
					equalTo: "#mpassword",
					minlength: 6 // Ensure at least 6 characters
				},
			},
			messages: {
				cfmpassword: {
					equalTo: "The password confirmation does not match.",
				},
			},
		});
	});
	// Construction
	$("#construction button[type='submit']").click(function () {
		var form = $("#construction");
		form.validate({
			errorElement: 'span',
			errorClass: 'help-block',
			highlight: function (element) {
				$(element).addClass("help-block");
				$(element).parent().addClass("field-error");
			},
			unhighlight: function (element) {
				$(element).removeClass("help-block");
				$(element).parent().removeClass("field-error");
			},
			rules: {
				schedule: {
					required: true,
				},
				uploadimage: {
					required: true,
				},
			},
		});
	});
	$("#resetpasswordform button[type='submit']").click(function () {
		var form = $("#resetpasswordform");
		form.validate({
			errorElement: 'span',
			errorClass: 'help-block',
			rules: {
				password: {
					required: true,
					minlength: 6
				},
				password_confirmation: {
					required: true,
					equalTo: "#password",
					minlength: 6
				},
			},
		});
	});
	// Forgot Password
	$("#forgotpassword button[type='submit']").click(function () {
		var form = $("#forgotpassword");
		form.validate({
			errorElement: 'span',
			errorClass: 'help-block',
			rules: {
				email: {
					required: true,
					email: true
				},
			},
		});
	});
	// Add project general info
	$("#addproject button").click(function () {
		var form = $("#addproject");
		form.validate({
			errorElement: 'span',
			errorClass: 'help-block',
			highlight: function (element) {
				$(element).addClass("help-block");
				$(element).parent().addClass("field-error");
			},
			unhighlight: function (element) {
				$(element).removeClass("help-block");
				$(element).parent().removeClass("field-error");
			},
			rules: {
				// uploadimage: {
				// 	required: true,
				// },
				title: {
					required: true,
				},
				address: {
					required: true,
				},
				contact_number:{
					required: true,
                    // minlength: 9,
                    // maxlength: 14,
					// number:true,
				},customer_name:{
					required: true,
                }
				// insurancecompany: {
				// 	required: true,
				// },
				// insuranceagency: {
				// 	required: true,
				// },
				// billing: {
				// 	required: true,
				// },
				// mortgagecompany: {
				// 	required: true,
				// },
			},
			submitHandler: function (form) {
				var csrfToken = $('meta[name="csrf-token"]').attr('content');
				form.submit();
				$.ajax({
					type: "POST",
					url: "{{route('general.info.store')}}",
					// data: form.serialize(), // Serialize form data
					headers: {
						'X-CSRF-Token': csrfToken // Include the CSRF token in the headers
					},
					success: function (response) {
						// Handle success, e.g., redirect or show a success message
						//console.log(response);
					},
					error: function (xhr, status, error) {
						// Handle error
						//console.error(xhr.responseText);
					}
				});
			}
		});
	});
	// $('#contact_number').on('input', function() {
	// 	this.value = this.value.replace(/\D/g, '');
	// 	if (this.value.length > 12) {
	// 		this.value = this.value.slice(0, 12);
	// 	}
	// });
	// design studio form 
	$("#design_studio_step1 button").click(function () {
		var form = $("#design_studio_step1");
		form.validate({
			errorElement: 'span',
			errorClass: 'help-block',
			highlight: function (element) {
				$(element).addClass("help-block");
				$(element).parent().addClass("field-error");
			},
			unhighlight: function (element) {
				$(element).removeClass("help-block");
				$(element).parent().removeClass("field-error");
			},
			rules: {
				project_image: {
					required: true,
				},
				roofandgutterdesign: {
					required: true,
				},
				rooftypeandrating: {
					required: true,
				},
				guttertypeaccessories: {
					required: true,
				},
				guttertypeaccessories1: {
					required: true,
				}
			},
			submitHandler: function (form) {
				form.submit();
				$.ajax({
					type: "POST",
					url: "{{ route('design.studio.post') }}",
					data: form.serialize(), // Serialize form data
					success: function (response) {
						// Handle success, e.g., redirect or show a success message
						console.log(response);
					},
					error: function (xhr, status, error) {
						// Handle error
						console.error(xhr.responseText);
					}
				});
			}
		});
	});
	// $(document).on("click", ".btn-change-view", function () {
	// 	if ($(".contractor-sec .tab-content").hasClass("list-view")) {
	// 		$(".contractor-sec .tab-content").removeClass("list-view");
	// 		$(".contractor-sec .accordion-collapse").addClass("show");
	// 		$(this).html('<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 7.5H26.25" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M10 15H26.25" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M10 22.5H26.25" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M3.75 7.5H3.7625" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/><path d="M3.75 15H3.7625" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/><path d="M3.75 22.5H3.7625" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>');
	// 		$("button.accordion-button, .contractor-list-item .contractor-link").show();
	// 		$(".list-view-detial-item").hide();
	// 	} else {
	// 		$(".contractor-sec .accordion-collapse").removeClass("show");
	// 		$(".contractor-sec .tab-content").addClass("list-view");
	// 		$(this).html('<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.5 3.75H3.75V12.5H12.5V3.75Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M26.25 3.75H17.5V12.5H26.25V3.75Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M26.25 17.5H17.5V26.25H26.25V17.5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12.5 17.5H3.75V26.25H12.5V17.5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>');
	// 		$("button.accordion-button, .contractor-list-item .contractor-link").hide();
	// 		$(".list-view-detial-item").show();
	// 	}
	// });
	$(document).on("click", ".btn-change-view", function () {
		if ($(".contractor-sec .tab-content").hasClass("list-view")) {
			$(".contractor-sec .tab-content").removeClass("list-view");
			$(".contractor-sec .accordion-collapse").addClass("show");
			$(this).html('<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.9 13.5H4.1C2.6 13.5 2 14.14 2 15.73V19.77C2 21.36 2.6 22 4.1 22H19.9C21.4 22 22 21.36 22 19.77V15.73C22 14.14 21.4 13.5 19.9 13.5Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M19.9 2H4.1C2.6 2 2 2.64 2 4.23V8.27C2 9.86 2.6 10.5 4.1 10.5H19.9C21.4 10.5 22 9.86 22 8.27V4.23C22 2.64 21.4 2 19.9 2Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>');
			$("button.accordion-button, .contractor-list-item .contractor-link").show();
			$(".list-view-detial-item").hide();
		} else {
			$(".contractor-sec .accordion-collapse").removeClass("show");
			$(".contractor-sec .tab-content").addClass("list-view");
			$(this).html(`<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M22 8.52V3.98C22 2.57 21.36 2 19.77 2H15.73C14.14 2 13.5 2.57 13.5 3.98V8.51C13.5 9.93 14.14 10.49 15.73 10.49H19.77C21.36 10.5 22 9.93 22 8.52Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M22 19.77V15.73C22 14.14 21.36 13.5 19.77 13.5H15.73C14.14 13.5 13.5 14.14 13.5 15.73V19.77C13.5 21.36 14.14 22 15.73 22H19.77C21.36 22 22 21.36 22 19.77Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M10.5 8.52V3.98C10.5 2.57 9.86 2 8.27 2H4.23C2.64 2 2 2.57 2 3.98V8.51C2 9.93 2.64 10.49 4.23 10.49H8.27C9.86 10.5 10.5 9.93 10.5 8.52Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M10.5 19.77V15.73C10.5 14.14 9.86 13.5 8.27 13.5H4.23C2.64 13.5 2 14.14 2 15.73V19.77C2 21.36 2.64 22 4.23 22H8.27C9.86 22 10.5 21.36 10.5 19.77Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
`);
			$("button.accordion-button, .contractor-list-item .contractor-link").hide();
			$(".list-view-detial-item").show();
		}
	});
	//login form customer
	$("#loginform button[type='submit']").click(function () {
		var form = $("#loginform");
		form.validate({
			errorElement: 'span',
			errorClass: 'help-block',
			rules: {
				email: {
					required: true,
					email: true
				},
				password: {
					required: true
				}
			},
		});
	});
	//customer forgot password
	$("#forgotpassword button[type='submit']").click(function () {
		var form = $("#forgotpassword");
		form.validate({
			errorElement: 'span',
			errorClass: 'help-block',
			rules: {
				email: {
					required: true,
					email: true
				},
			},
		});
	});
	//contractor login form 
	$("#logincontractor button[type='submit']").click(function () {
		var form = $("#logincontractor");
		form.validate({
			errorElement: 'span',
			errorClass: 'help-block',
			rules: {
				email: {
					required: true,
					email: true
				},
				password: {
					required: true,
				}
			},
		});
	});
	//contractor forgot password
	$("#forgotpasswordcontractor button[type='submit']").click(function () {
		var form = $("#forgotpasswordcontractor");
		form.validate({
			errorElement: 'span',
			errorClass: 'help-block',
			rules: {
				email: {
					required: true,
					email: true
				},
			},
		});
	});
	
	//customer profile page validations 
	$('#contactnumber').on('input', function() {
		// Remove any non-digit characters
		this.value = this.value.replace(/\D/g, '');
		// Limit the input to 12 digits
		if (this.value.length > 12) {
			this.value = this.value.slice(0, 12);
		}
	});
	$('#zipcode').on('input', function() {
		// Remove any non-digit characters
		this.value = this.value.replace(/\D/g, '');
		// Limit the input to 6 digits
		if (this.value.length > 6) {
			this.value = this.value.slice(0, 6);
		}
	});
	
	$.validator.addMethod("validFileExtension", function(value, element, param) {
		// param is the array of valid file extensions
		var extension = value.split('.').pop().toLowerCase();
		return $.inArray(extension, param) !== -1;
	}, "Please upload a file with a valid extension.");
	$("#updateprofile-customerform button[type='submit']").click(function () {
		var form = $("#updateprofile-customerform");
		form.validate({
			errorElement: 'span',
			errorClass: 'help-block',
			highlight: function (element) {
				$(element).addClass("help-block");
				$(element).parent().addClass("field-error");
			},
			unhighlight: function (element) {
				$(element).removeClass("help-block");
				$(element).parent().removeClass("field-error");
			},
			rules: {
				name: {
					required: true,
				},
				customer_profile: {
					required: false,  // Not required, only validate if a file is selected
					validFileExtension: ["jpg", "jpeg", "png"], // Custom method for file extension
					fileSizeValidation: true
				},
				address: {
					required: true,
				},
			},
			messages: {
				customer_profile: {
					validFileExtension: "Please upload a valid image file (jpg, jpeg, png).",
					fileSizeValidation: "The maximum allowed file size is 20MB"
				}
			}
		});
		$.validator.addMethod("customEmailValidation", function (value, element) {
			var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
			return this.optional(element) || emailRegex.test(value);
		}, "Please enter a valid email address.");
		// Custom file extension validation method
		$.validator.addMethod("validFileExtension", function(value, element, param) {
			if (element.files.length > 0) { // Only check if a file is uploaded
				var extension = value.split('.').pop().toLowerCase();
				return $.inArray(extension, param) !== -1;
			}
			return true; // No file uploaded, skip validation
		}, "Please upload a valid image file.");

		// Custom file size validation method
		$.validator.addMethod("fileSizeValidation", function(value, element) {
			const maxSize = 20 * 1024 * 1024; // 20MB in bytes
			if (element.files.length > 0) {
				var fileSize = element.files[0].size;
				return fileSize <= maxSize;
			}
			return true; // No file uploaded, skip validation
		});
	});
	//contractor profile 
	$.validator.addMethod("validFileExtension", function(value, element, param) {
		// param is the array of valid file extensions
		var extension = value.split('.').pop().toLowerCase();
		return $.inArray(extension, param) !== -1;
	}, "Please upload a file with a valid extension.");
	$("#updateprofile-contarctorform button[type='submit']").click(function () {
		var form = $("#updateprofile-contarctorform");
		form.validate({
			errorElement: 'span',
			errorClass: 'help-block',
			highlight: function (element) {
				$(element).addClass("help-block");
				$(element).parent().addClass("field-error");
			},
			unhighlight: function (element) {
				$(element).removeClass("help-block");
				$(element).parent().removeClass("field-error");
			},
			rules: {
				name: {
					required: true,
				},
				company_name: {
					required: true,
				},
				address: {
					required: true,
				},
				customer_profile: {
					required: false,  // Not required, only validate if a file is selected
					validFileExtension: ["jpg", "jpeg", "png"], // Custom method for file extension
					fileSizeValidation: true
				},
				banner_image: {
					required: false,  // Not required, only validate if a file is selected
					validFileExtension: ["jpg", "jpeg", "png"], // Custom method for file extension
					fileSizeValidation: true
				},
				company_logo: {
					required: false,  // Not required, only validate if a file is selected
					validFileExtension: ["jpg", "jpeg", "png"], // Custom method for file extension
					fileSizeValidation: true
				},
			},
			messages: {
				customer_profile: {
					validFileExtension: "Please upload a valid image file (jpg, jpeg, png).",
					fileSizeValidation: "The maximum allowed file size is 20MB"
				},
				banner_image: {
					validFileExtension: "Please upload a valid image file (jpg, jpeg, png).",
					fileSizeValidation: "The maximum allowed file size is 20MB"
				},
				company_logo: {
					validFileExtension: "Please upload a valid image file (jpg, jpeg, png).",
					fileSizeValidation: "The maximum allowed file size is 20MB"
				}
			}
		});
		$.validator.addMethod("customEmailValidation", function (value, element) {
			// Regular expression for custom email validation
			var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
			return this.optional(element) || emailRegex.test(value);
		}, "Please enter a valid email address.");
		// Custom file extension validation method
		$.validator.addMethod("validFileExtension", function(value, element, param) {
			if (element.files.length > 0) { // Only check if a file is uploaded
				var extension = value.split('.').pop().toLowerCase();
				return $.inArray(extension, param) !== -1;
			}
			return true; // No file uploaded, skip validation
		}, "Please upload a valid image file.");

		// Custom file size validation method
		$.validator.addMethod("fileSizeValidation", function(value, element) {
			const maxSize = 20 * 1024 * 1024; // 20MB in bytes
			if (element.files.length > 0) {
				var fileSize = element.files[0].size;
				return fileSize <= maxSize;
			}
			return true; // No file uploaded, skip validation
		});
	});
});