{{--  original Blade file --}}

<div class="col-12">

{{-- for date range picker --}}
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{-- end range picker --}}   

    <div class="row" id="contractor_dashboard">

       
      
         @php
        $projectData = [];
        $projectData = App\Models\Project::all();
        @endphp
         
        @if (isset($projects) && count($projects) > 0)
            @foreach ($projects as $project)
                @php
                    $userinfo = \App\Models\User::find($project->user_id);
                    $projectImage = \App\Models\ProjectImagesData::select('project_image')->where('project_id', $project->id)->first();
                    $messageCount = \App\Models\Message::where('project_id', $project->id)
                        ->where('user_id', $userinfo->id)
                        ->where('role', 'customer')
                        ->where('is_read', 0)
                        ->orderBy('created_at', 'DESC')
                        ->count();

                        if($project->id !== null && $project->id !== ''){
                        $status = \App\Models\Quotation::where('project_id', $project->id)
                                    ->where('contractor_id',Auth::user()->id)
                                    ->orderBy('id', 'DESC')
                                    ->first();
                
                          }
                
                    $status = $status ? $status->status : null;
                @endphp
                <x-contractor-dashboard :project="$project" :userinfo="$userinfo"  :projectImage="$projectImage" :messageCount="$messageCount"  :status="$status" />
            @endforeach

            @if($projects !== NULL && $projects->count() > 0)
           <div class="col-12">
            <div class="pagination all-pagination">
                {{ $projects->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
           </div>
        @endif
        @else
         <p class="text-center">No records found.</p>
        @endif
    </div>
</div>


{{-- 
<div class="modal fade addprojectpopup quotepopup" id="addprojectpopup" data-bs-backdrop="static"
data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title" id="staticBackdropLabel">Add Project</div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>
        <form name="addProjectform" method="post">
            <div class="modal-body">
                <div class="quotepopup-wrap">
                    <div class="form-label">
                        <label for="uname">Project Name<span>*</span></label>
                    </div>

                    <div class="form-element">
                        <input type="text" name="projectname" id="projectname"
                            placeholder="Enter your Project Name">
                    </div>
                    <span style="color:red" class="error-message d-none"></span>
                    <br />
                    <div class="quotepopup-button-wrap d-flex">
                        <a class="btn-primary d-block" id="approvebtn" href="">Add</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div> --}}




@section('scripts')





<script>
    const projectData = @json($projectData);
</script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
{{-- date range picker --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

{{--end  date range picker --}}

<script type="text/javascript">
// working script starts here
$(document).ready(function () {


$.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});


// // Add projcet data 
// $('#testDatainfo').on('click', function(){
// $('.error-message').val('');
// $('#projectname').val('');
// $('#email').val('');
// $('#name').val('');
// $('#projectname-error').val('');
// $('#email-error').val('');
// $('#name-error').val('');

// $('#addprojectpopup').modal('show');

// });

$('#testDatainfo').on('click', function() {
    // Clear previous error messages and input values
    clearModalFields();
    $('#addprojectpopup').modal('show');
});

// Function to clear input fields and error messages
function clearModalFields() {
    $('.error-message').html('').addClass('d-none'); // Clear error messages
    $('#projectname').val('');
    $('#email').val('');
    $('#contact_number').val('');
    $('#name').val('');

    // Remove red borders from input fields
    $('#projectname').css("border", "");
    $('#email').css("border", "");
    $('#name').css("border", "");
    $('#contact_number').css("border", "");
}

// Handle modal close event
$('#addprojectpopup').on('hidden.bs.modal', function () {
    clearModalFields(); // Clear fields and errors when the modal is closed
});

// $('#projectname').on('keydown', function (event) {
//     if (event.keyCode === 13) {
//         event.preventDefault();
//         $('#approvebtn').click();
//     }
// });

// $('#approvebtn').on("click", function (e) {
// e.preventDefault();
// var projectname = $(document).find('#projectname').val();
// var email = $(document).find('#email').val();
// var name = $(document).find('#name').val();
// // alert(projectname);
// if (projectname == "") {
//     $('#projectname').css("border", "1px solid red");
// } else {
//     $('#projectname').css("border", "");
//     // alert(projectname);
//     $.ajax({
//         type: "POST",
//         url: "{{-- route('add.project.contractor') --}}",
//         data: { projectname: projectname,email:email,name:name },
//         success: function (response) {
//             if (response.success == true) {
//                 // $('#addproject').modal('hide');
//                 if (response.success) {
//                     // var projectId = response.data;
//                     // window.location = "{{route('add.project')}}" + "/" + btoa(projectId);
//                 }
//             } else {
//                 // $('.error-message').html(response.errors.projectname[0]).removeClass('d-none');
//             }
//         },
//         error: function (xhr, status, error) {
//             console.error(xhr.responseText);
//         }
//     });
// }
// });

$('#approvebtn').on("click", function (e) {
    e.preventDefault();
    
    var projectname = $('#projectname').val();
    var email = $('#email').val();
    var name = $('#name').val();
    var contact_number = $('#contact_number').val();
    var country_code = $('#country_code').val();
    
    $('.error-message').html('').addClass('d-none');

    let isValid = true; 

    // Validate project name
    if (projectname == "") {
        $('#projectname').css("border", "1px solid red");
        $('#projectname-error').html('Project name is required').removeClass('d-none');
        isValid = false; 
    } else {
        $('#projectname').css("border", "");
    }

    // Validate email
    if (email == "") {
        $('#email').css("border", "1px solid red");
        $('#email-error').html('Email is required').removeClass('d-none');
        isValid = false; 
    } else {
        $('#email').css("border", "");
    }



    // if(contact_number == "") {
    //     $('#contact_number').css("border", "1px solid red");
    //     $('#contact_number_error').html('Contact number is required').removeClass('d-none');
    //     isValid = false; 
    // } else {
    //     $('#contact_number').css("border", "");
    //     $('#contact_number_error').html('Contact number is required').removeClass('d-none');

        // $('#contact_number-error').html('').addClass('d-none');


        // validate contact number
        // if (!/^[0-9]{10}$/.test(contact_number)) {
        //     $('#contact_number').css("border", "1px solid red");
        //     $('#contact_number-error').html('Invalid contact number').removeClass('d-none');
        //     isValid = false; 
        // } else {
        //     $('#contact_number').css("border", "");
        // }
    // }



    if (contact_number == "") {
        $('#contact_number').css("border", "1px solid red");
        $('#contact_number_error').html('Contact number is required').removeClass('d-none');
        isValid = false; 
    // } else if (!/^[0-9]{10}$/.test(contact_number)) {  // Validate if contact number is 10 digits
    //     $('#contact_number').css("border", "1px solid red");
    //     $('#contact_number_error').html('Invalid contact number').removeClass('d-none');
    //     isValid = false; 
    } else {
        $('#contact_number').css("border", "");
        $('#contact_number_error').html('').addClass('d-none');
    }


    // Validate name
    if (name == "") {
        $('#name').css("border", "1px solid red");
        $('#name-error').html('Name is required').removeClass('d-none');
        isValid = false; 
    } else {
        $('#name').css("border", "");
    }

    if (!isValid) {
        return; 
    }


   

    $.ajax({
        type: "POST",
        url: "{{ route('add.project.contractor') }}",
        data: { projectname: projectname, email: email, name: name,contact_number:contact_number,country_code:country_code },
        success: function (response) {
            if (response.success) {
                // hide the popup
                $('#addprojectpopup').modal('hide');

                // refresh the dashboard
                fetchData();
            } else {
                // Display validation errors from the server
                $.each(response.errors, function(key, messages) {
                    $('#' + key + '-error').html(messages[0]).removeClass('d-none');
                });
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });


});

 // Input change validation for immediate feedback
$('#projectname, #email, #name').on('input', function() {
    var id = $(this).attr('id');
    var value = $(this).val();
    var errorMessageId = '#' + id + '-error';

    $(errorMessageId).html('').addClass('d-none');
    $(this).css("border", "");

    if (value == "") {
        $(this).css("border", "1px solid red");
        $(errorMessageId).html(id.charAt(0).toUpperCase() + id.slice(1) + ' is required').removeClass('d-none');
    }

    if (id === 'email' && value !== "" && !isValidEmail(value)) {
        $(this).css("border", "1px solid red");
        $(errorMessageId).html('Please enter a valid email').removeClass('d-none');
    }
});

// Email validation function
function isValidEmail(email) {
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return emailPattern.test(email);
}


$('#contact_number').on('input', function() {
    var value = $(this).val();
    var errorMessageId = '#contact_number_error';

    $(errorMessageId).html('').addClass('d-none');
    $(this).css("border", "");

    // Check if the contact number is 10 digits long
    if (value == "") {
        $(this).css("border", "1px solid red");
        $(errorMessageId).html('Contact number is required').removeClass('d-none');
    }  else {
        $(this).css("border", "");
        $(errorMessageId).html('').addClass('d-none');
    }
});


// // end add project Data



    var $titleInput = $('#title');
    var $clearButton = $('#clear-button');
    var $reportrange = $('#reportrange-dashboard');

    var title = '';
    var startDate = moment().subtract(29, 'days');
    var endDate = moment();

    function fetchData() {
        $.ajax({
            url: '{{ route("contractor.dashboard") }}',
            type: 'GET',
            data: {
                title: title,
                from_date: startDate.format('MM-DD-YYYY'),
                to_date: endDate.format('MM-DD-YYYY'),
                project_status: jQuery('#ajax_filter_dash').find('.btn-gallery-filter-dash.active').data('cate'),
            },
            success: function (data) {
                $('#contractor_dashboard').html(data.html);
                $(document).on('click', '.pagination a', function (event) {
                    event.preventDefault();
                    var url = $(this).attr('href');
                    $.get(url, function (data) {
                        $('#contractor_dashboard').html(data.html);
                        $('html, body').animate({ scrollTop: $('#contractor_dashboard').offset().top }, 'slow');
                    });
                });
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }

    $titleInput.on('input', function () {
        title = $titleInput.val();
        if (title) {
            $clearButton.show();
        } else {
            $clearButton.hide();
        }
        fetchData();
    });

    function cb(start, end) {
        startDate = start;
        endDate = end;
        $reportrange.find('span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        fetchData();
    }

    $reportrange.daterangepicker({
        startDate: startDate,
        endDate: endDate,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    $('#filter-button').on('click', function (e) {
        e.preventDefault();
        var buttonText = $('#button-text');
        if (buttonText.text() === 'Filters') {
            buttonText.text('Reset');
            $reportrange.slideDown();
        } else {
            buttonText.text('Filters');
            $reportrange.slideUp();
            title = '';
            $titleInput.val('');
            $clearButton.hide();
            startDate = moment().startOf('month');
            endDate = moment().endOf('month'); 
            $reportrange.data('daterangepicker').setStartDate(startDate);
            $reportrange.data('daterangepicker').setEndDate(endDate);
            fetchData();
        }
    });

    
    fetchData();
});
// working script


// country code script 

	
$(function () {
		const countryCode = "{{ $country_code ?? 'us' }}"; // Dynamic country code
		const phoneNumber = "{{ $phone_no ?? '' }}"; // Dynamic phone number

		// Check if intlTelInput plugin exists
		if (typeof intlTelInput !== 'undefined') {
			// Select all inputs with the name 'contact_number'
			const inputs = document.querySelectorAll("input[name=contact_number]");

			inputs.forEach(function (input) {
				// Initialize intl-tel-input
				const iti = intlTelInput(input, {
					autoHideDialCode: false,
					autoPlaceholder: "aggressive",
					initialCountry: countryCode, // Use dynamic country code
					separateDialCode: true,
					preferredCountries: ["us", "ca", "mx"],
					customPlaceholder: function (selectedCountryPlaceholder) {
						return selectedCountryPlaceholder.replace(/[0-9]/g, "X");
					},
					geoIpLookup: function (callback) {
						$.get("https://ipinfo.io", function () {}, "jsonp").always(function (resp) {
							const detectedCountryCode = resp && resp.country ? resp.country : countryCode;
							callback(detectedCountryCode);
						});
					},
					utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.0/js/utils.js"
				});

				// Set dynamic phone number value
				input.value = phoneNumber;

				// Update hidden input when country changes
				input.addEventListener("countrychange", function () {
					const selectedCountryData = iti.getSelectedCountryData();
					document.getElementById("country_code").value = selectedCountryData.iso2;
				});

				// Initialize input mask on focus, click, and country change
				$(input).on("focus click countrychange", function () {
					const placeholder = $(this).attr("placeholder") || "";
					const maskedPlaceholder = placeholder.replace(/X/g, "9");
					if (maskedPlaceholder) {
						$(this).inputmask(maskedPlaceholder, { placeholder: "X", clearMaskOnLostFocus: true });
					}
				});

				// Log international number on focus out
				$(input).on("focusout", function () {
					const intlNumber = iti.getNumber();
					console.log(intlNumber);
				});
			});
		} else {
			console.warn("intlTelInput plugin is not loaded.");
		}
	});
    </script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.0/css/intlTelInput.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.0/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.8/jquery.inputmask.bundle.min.js"></script>
    

<script src="{{ asset('frontend-assets/js/contractor/contractor_dashboard.js') }}"></script>

@endsection