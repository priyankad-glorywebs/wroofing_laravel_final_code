    @if($groupedData->count() > 0)
	@if($groupedData)
	@foreach($groupedData as $date => $mediaItems)
	{{-- <h6>{{ $date }}</h6> --}}
	<h6>{{ \Carbon\Carbon::parse($date)->format('m-d-Y') }}</h6>

	@foreach($mediaItems as $mediaItem)
	@if($mediaItem->media_type == 'image') 
	@php
	$authuser = \Auth::user()->id;
	if($mediaItem->created_by == $authuser){
		$color = ""; 
	}else{
		$color = "design-studio-with-customer";
	}
	@endphp 
	<div class="design-studio-img-items {{$color??''}} project-detail-photos-item-img">
	@if($authuser == $mediaItem->created_by??'')
	<button type="button" class="remove-img" data-media-item-id="{{ $mediaItem->id }}">X</button>
	@endif	
	{{-- <a class="lightbox" href="{{ asset('storage/project_images/'.$mediaItem->project_image)  }}"> --}}
		
			<img src="{{ asset('storage/project_images/'.$mediaItem->project_image)  }}" alt="Image" data-project-name="{{$mediaItem->project_image}}"  class="clickable-image"
			class="clickable-image"   data-type="{{$mediaItem->media_type}}" data-notes="{{$mediaItem->notes??''}}"  data-image-id="{{ $mediaItem->id }}" data-date="{{$mediaItem->date}}" data-time="{{$mediaItem->time}}"
			>
		{{-- </a> --}}
		<span class="image-upload-time">{{$mediaItem->time}}</span>
	</div>
	@elseif($mediaItem->media_type == 'video')
	@php
	$authuser = \Auth::user()->id;
	if($mediaItem->created_by == $authuser){
		$color = ""; 
	}else{
		$color = "design-studio-with-customer";
	}
	@endphp 
	<div class="design-studio-img-items {{$color??''}}  project-detail-photos-item-img">
	@php
	$authuser = \Auth::user()->id;
	@endphp 
	@if($authuser == $mediaItem->created_by??'')
		<button type="button" class="remove-img" data-media-item-id="{{ $mediaItem->id }}">X</button>
	@endif 
	{{-- <a class="image-gallery-popup" href="{{ asset('storage/project_images/'.$mediaItem->project_image) }}"> --}}
			<video width="150" height="150" controls data-project-name="{{$mediaItem->project_image}}"  data-type="{{$mediaItem->media_type}}" data-notes="{{$mediaItem->notes??''}}"  data-source="{{ asset('storage/project_images/'.$mediaItem->project_image) }}" data-image-id="{{ $mediaItem->id }}" class="clickable-image" data-date="{{$mediaItem->date}}" data-time="{{$mediaItem->time}}" >
				<source src="{{ asset('storage/project_images/'.$mediaItem->project_image) }}" type="video/mp4" 
					>
				Your browser does not support the video tag.
			</video>
		{{-- </a> --}}
		<span class="image-upload-time">{{$mediaItem->time}}</span>
	</div>
	@endif 
	@endforeach
	@endforeach
	@endif
		</div>
@else
<strong>No Data Found</strong>	
@endif

<script type="text/javascript">


// $(document).on('click', '.clickable-image', function(e) {
//     e.preventDefault();

//     mediaImageId = $(this).data('image-id');
//     let mediaUrl = $(this).attr('src');
//     let mediaType = $(this).data('type');
//     let date = $(this).data('date');
//     let time = $(this).data('time');
//     let notes = $(this).data('notes');

//     let mediaContent;
//     if (mediaType === 'video') {
//         let source = $(this).data('source');
//         mediaContent = `<video id="modal-image" controls>
//                             <source src="${source}" type="video/mp4">
//                             Your browser does not support the video tag.
//                         </video>`;
//     } else {
//         mediaContent = `<img src="${mediaUrl}" id="modal-image" alt="Image" class="img-fluid">`;
//     }

//     $('#media-display').html(mediaContent);
//     $('#date_added').text(date);
//     $('#time_added').text(time);

//     if (notes) {
//         $('#notes-container').html(`
//             <div>
//                 <p id="notes-text">${notes}</p>
//                 <button id="edit-notes" class="btn btn-secondary">Edit</button>
//             </div>
//         `);
//     } else {
//         $('#notes-container').html(`
//             <form id="notes-form">
//                 <div class="mb-3">
//                     <label for="notes" class="form-label">Add Notes:</label>
//                     <textarea class="form-control" id="notes" rows="3" placeholder="Add your notes here"></textarea>
//                 </div>
//                 <button type="submit" class="btn btn-primary">Save Notes</button>
//             </form>
//         `);
//     }
//     $('#details_page_popup').modal('show');
// });

// $(document).on('submit', '#notes-form', function(e) {
//     e.preventDefault();

//     let notes = $('#notes').val();

//     if (mediaImageId === null) {
//         alert('No image selected.');
//         return;
//     }

//     $.ajax({
//         url: "{{ route('save.notes') }}",
//         method: 'POST',
//         data: {
//             notes: notes,
//             _token: $('meta[name="csrf-token"]').attr('content'),
//             mediaImageId: mediaImageId
//         },
//         success: function(response) {
//             alert('Notes saved successfully!');
//             // Update the notes displayed in the modal
//             $('#notes-container').html(`
//                 <div>
//                     <p id="notes-text">${notes}</p>
//                     <button id="edit-notes" class="btn btn-secondary">Edit</button>
//                 </div>
//             `);
//         },
//         error: function(xhr) {
//             alert('An error occurred while saving notes.');
//         }
//     });
// });

// // Handle edit button click
// $(document).on('click', '#edit-notes', function() {
//     $('#notes-container').html(`
//         <form id="notes-form">
//             <div class="mb-3">
//                 <label for="notes" class="form-label">Update Notes:</label>
//                 <textarea class="form-control" id="notes" rows="3" placeholder="Update your notes here">${$('#notes-text').text()}</textarea>
//             </div>
//             <button type="submit" class="btn btn-primary">Save Notes</button>
//         </form>
//     `);
// });




// $(document).on('click', '.clickable-image', function(e) {
//     e.preventDefault();

//     let mediaImageId = $(this).data('image-id');
    
//     $.ajax({
//         url: "{{ route('design.studio.detailspage') }}",
//         method: 'GET',
//         data: { id: mediaImageId },
//         success: function(response) {
//             if (response.error) {
//                 alert('Error: ' + response.error);
//                 return;
//             }

//             let mediaContent;
//             if (response.media_type === 'video') {
//                 mediaContent = `<video id="modal-media" controls>
//                                     <source src="${response.media_url}" type="video/mp4">
//                                     Your browser does not support the video tag.
//                                 </video>`;
//             } else {
//                 mediaContent = `<img src="${response.media_url}" id="modal-media" alt="Image" class="img-fluid">`;
//             }

//             $('#media-display').html(mediaContent);
//             $('#date_added').text(response.date);
//             $('#time_added').text(response.time);
//             $('#imagename').text(response.project_name);
//             // alert("username filter page : " +  response.user_name );

//             $('#added_by_name').text(response.user_name);


//             if (response.notes) {
//                 $('#notes-container').html(`
//                     <div>
//                         <p id="notes-text">${response.notes}</p>
//                         <button id="edit-notes" class="btn btn-secondary">Edit</button>
//                     </div>
//                 `);
//             } else {
//                 $('#notes-container').html(`
//                     <form id="notes-form">
//                         <div class="mb-3">
//                             <label for="notes" class="form-label">Add Notes:</label>
//                             <textarea class="form-control" id="notes" rows="3" placeholder="Add your notes here"></textarea>
//                         </div>
//                         <button type="submit" class="btn btn-primary">Save Notes</button>
//                     </form>
//                 `);
//             }

//             $('#details_page_popup').modal('show');
//         },
//         error: function(xhr) {
//             alert('An error occurred while fetching media details.');
//         }



        
//     });

// $(document).on('submit', '#notes-form', function(e) {
//     e.preventDefault();

//     let notes = $('#notes').val();

//     if (!mediaImageId) {
//         alert('No media item selected.');
//         return;
//     }

//     $.ajax({
//         url: "{{ route('save.notes') }}",
//         method: 'POST',
//         data: {
//             notes: notes,
//             _token: $('meta[name="csrf-token"]').attr('content'),
//             mediaImageId: mediaImageId
//         },
//         success: function(response) {
//             $('#notes-container').html(`
//                 <div>
//                     <p id="notes-text">${notes}</p>
//                     <button id="edit-notes" class="btn btn-secondary">Edit</button>
//                 </div>
//             `);
//         },
//         error: function(xhr) {
//             alert('An error occurred while saving notes.');
//         }
//     });
// });

// });

// $(document).on('click', '#edit-notes', function() {
//     let currentNotes = $('#notes-text').text();
//     alert(currentNotes);

//     $('#notes-container').html(`
//         <form id="notes-form">
//             <div class="mb-3">
//                 <label for="notes" class="form-label">Update Notes:</label>
//                 <textarea class="form-control" id="notes" rows="3" placeholder="Update your notes here">${currentNotes}</textarea>
//             </div>
//             <button type="submit" class="btn btn-primary">Save Notes</button>
//         </form>
//     `);
// });
// let mediaImageId = null; // Variable to store the image ID

// $(document).on('click', '.clickable-image', function(e) {
//     e.preventDefault();

//     mediaImageId = $(this).data('image-id');
//     let mediaUrl = $(this).attr('src');
//     let mediaType = $(this).data('type');
//     let date = $(this).data('date');
//     let time = $(this).data('time');
//     let notes = $(this).data('notes');
//     let imagename = $(this).data('project-name');

//     let mediaContent;
//     if (mediaType === 'video') {
//         let source = $(this).data('source');
//         mediaContent = `<video id="modal-image" controls>
//                             <source src="${source}" type="video/mp4">
//                             Your browser does not support the video tag.
//                         </video>`;
//     } else {
//         mediaContent = `<img src="${mediaUrl}" id="modal-image" alt="Image" class="img-fluid">`;
//     }

//     $('#media-display').html(mediaContent);
//     $('#date_added').text(date);
//     $('#time_added').text(time);
//     $('#imagename').text(imagename);


//     if (notes) {
//         $('#notes-container').html(`
//             <div>
//                 <p id="notes-text">${notes}</p>
//                 <button id="edit-notes" class="btn btn-secondary">Edit</button>
//             </div>
//         `);
//     } else {
//         $('#notes-container').html(`
//             <form id="notes-form">
//                 <div class="mb-3">
//                     <label for="notes" class="form-label">Add Notes:</label>
//                     <textarea class="form-control" id="notes" rows="3" placeholder="Add your notes here"></textarea>
//                 </div>
//                 <button type="submit" class="btn btn-primary">Save Notes</button>
//             </form>
//         `);
//     }

//     $('#details_page_popup').modal('show');
// });

// $(document).on('submit', '#notes-form', function(e) {
//     e.preventDefault();

//     let notes = $('#notes').val();

//     if (mediaImageId === null) {
//         alert('No image selected.');
//         return;
//     }

//     $.ajax({
//         url: "{{ route('save.notes') }}",
//         method: 'POST',
//         data: {
//             notes: notes,
//             _token: $('meta[name="csrf-token"]').attr('content'),
//             mediaImageId: mediaImageId
//         },
//         success: function(response) {
//             // alert('Notes saved successfully!');
//             // Update the notes displayed in the modal
//             $('#notes').removeClass('error');
//             // $('.errors').css('border-color','red');
//             $('#notes-container').html(`
//                 <div>
//                     <p id="notes-text">${notes}</p>
//                     <button id="edit-notes" class="btn btn-secondary">Edit</button>
//                 </div>
//             `);
//         },
//         error: function(xhr) {
//             $('#notes').addClass('error');
//             $('.errors').css('border-color','red');
//             // alert('An error occurred while saving notes.');
//         }
//     });
// });

// // Handle edit button click
// $(document).on('click', '#edit-notes', function() {
//     let currentNotes = $('#notes-text').text();
//     $('#notes-container').html(`
//         <form id="notes-form">
//             <div class="mb-3">
//                 <label for="notes" class="form-label">Update Notes:</label>
//                 <textarea class="form-control" id="notes" rows="3" placeholder="Update your notes here">${currentNotes}</textarea>
//             </div>
//             <button type="submit" class="btn btn-primary">Save Notes</button>
//         </form>
//     `);
// });


// let mediaImageId = null; // Variable to store the image ID

// Handle the click event on the image or video
// $(document).on('click', '.clickable-image', function(e) {
//     e.preventDefault();

//     mediaImageId = $(this).data('image-id');
//     let mediaUrl = $(this).attr('src');
//     let mediaType = $(this).data('type');
//     let date = $(this).data('date');
//     let time = $(this).data('time');
//     let notes = $(this).data('notes');

//     let mediaContent;
//     if (mediaType === 'video') {
//         let source = $(this).data('source');
//         mediaContent = `<video id="modal-image" controls>
//                             <source src="${source}" type="video/mp4">
//                             Your browser does not support the video tag.
//                         </video>`;
//     } else {
//         mediaContent = `<img src="${mediaUrl}" id="modal-image" alt="Image" class="img-fluid">`;
//     }

//     $('#media-display').html(mediaContent);
//     $('#date_added').text(date);
//     $('#time_added').text(time);


//     if (notes) {
//         $('#notes-container').html(`
//             <div>
//                 <p id="notes-text">${notes}</p>
//                 <button id="edit-notes" class="btn btn-secondary">Edit</button>
//             </div>
//         `);
//     } else {
//         $('#notes-container').html(`
//             <form id="notes-form">
//                 <div class="mb-3">
//                     <label for="notes" class="form-label">Add Notes:</label>
//                     <textarea class="form-control" id="notes" rows="3" placeholder="Add your notes here">${notes}</textarea>
//                 </div>
//                 <button type="submit" class="btn btn-primary">Save Notes</button>
//             </form>
//         `);
//     }
//     $('#details_page_popup').modal('show');
// });

// $(document).on('submit', '#notes-form', function(e) {
//     e.preventDefault();

//     let notes = $('#notes').val();

//     if (mediaImageId === null) {
//         alert('No image selected.');
//         return;
//     }

//     $.ajax({
//         url: "{{ route('save.notes') }}",         method: 'POST',
//         data: {
//             notes: notes,
//             _token: $('meta[name="csrf-token"]').attr('content'),
//             mediaImageId: mediaImageId
//         },
//         success: function(response) {
//             alert('Notes saved successfully!');
//             $('#notes').val(''); 
//             mediaImageId = null; 
//             // $('#details_page_popup').modal('hide'); 
//         },
//         error: function(xhr) {
//             alert('An error occurred while saving notes.');
//         }
//     });
// });

// // Handle edit button click
// $(document).on('click', '#edit-notes', function() {
//     $('#notes-container').html(`
//         <form id="notes-form">
//             <div class="mb-3">
//                 <label for="notes" class="form-label">Update Notes:</label>
//                 <textarea class="form-control" id="notes" rows="3" placeholder="Update your notes here">${$('#notes-text').text()}</textarea>
//             </div>
//             <button type="submit" class="btn btn-primary">Save Notes</button>
//         </form>
//     `);
// });
// });

// 	$(document).on('click', '.clickable-image', function(e) {
//     e.preventDefault();

//     mediaImageId = $(this).data('image-id');
//     var mediaUrl = $(this).attr('src');
//     var mediaType = $(this).data('type');
//     var date = $(this).data('date');
//     var time = $(this).data('time');
//     var notes = $(this).data('notes');

//     let mediaContent;
//     if (mediaType === 'video') {
//         var source = $(this).data('source');
//         mediaContent = `<video id="modal-image" controls>
//                             <source src="${source}" type="video/mp4">
//                             Your browser does not support the video tag.
//                         </video>`;
//     } else {
//         mediaContent = `<img src="${mediaUrl}" id="modal-image" alt="Image" class="img-fluid">`;
//     }

//     $('#media-display').html(mediaContent);
//     $('#date_added').text(date);
//     $('#time_added').text(time);
//     $('#display_notes').val(notes);

//     // Show the modal
//     $('#details_page_popup').modal('show');
// });

// // Handle form submission
// $(document).on('submit', '#notes-form', function(e) {
//     e.preventDefault();

//     var notes = $('#notes').val();

//     if (mediaImageId === null) {
//         alert('No image selected.');
//         return;
//     }

//     $.ajax({
//         url: "{{ route('save.notes') }}", // Use the correct route
//         method: 'POST',
//         data: {
//             notes: notes,
//             _token: $('meta[name="csrf-token"]').attr('content'),
//             mediaImageId: mediaImageId
//         },
//         success: function(response) {
//             alert('Notes saved successfully!');
//             // $('#notes').val(''); // Clear the textarea
//             mediaImageId = null; // Reset the image ID
//         },
//         error: function(xhr) {
//             alert('An error occurred while saving notes.');
//         }
//     });
// });

  // Handle the click event on the image
//   $('.clickable-image').on('click', function(e) {
//         e.preventDefault();

//         // Store the image ID
//         mediaImageId = $(this).data('image-id');
// 		var mediaUrl = $(this).attr('src');
// 		var mediaType = $(this).data('type');
// 		var date = $(this).data('date');
// 		var time = $(this).data('time');
// 		var notes = $(this).data('notes');

		
// 		// alert(mediaType);

// 		if (mediaType === 'video') {
// 			var source = $(this).data('source');
// 			// console.log(source);
// 			// alert(source);

//             mediaContent = `<video id="modal-image"  controls>
//                                 <source src="${source}" type="video/mp4">
//                                 Your browser does not support the video tag.
//                             </video>`;
//         } else {
//             mediaContent = `<img src="${mediaUrl}" id="modal-image" alt="Image" class="img-fluid">`;

// 		}
//         // }

// 		// mediaContent = `<img src="${mediaUrl}" alt="Image" id="modal-image" class="img-fluid">`;
// 			$('#media-display').html(mediaContent);
// 			$('#date_added').text(date);
// 			$('#time_added').text(time);
//         $('#display_notes').text(notes);
// 			// Show the modal

//         $('#details_page_popup').modal('show');



// 		    // Handle form submission
// 			$('#notes-form').on('submit', function(e) {
//         e.preventDefault();
        
//         var notes = $('#notes').val();

//         if (mediaImageId === null) {
//             alert('No image selected.');
//             return;
//         }

//         $.ajax({
//             url: "{{ route('save.notes') }}", // Use the correct route
//             method: 'POST',
//             data: {
//                 notes: notes,
//                 _token: $('meta[name="csrf-token"]').attr('content'),
//                 mediaImageId: mediaImageId
//             },
//             success: function(response) {
//                 alert('Notes saved successfully!');
//                 $('#notes').val(''); // Clear the textarea
//                 mediaImageId = null; // Reset the image ID
//             },
//             error: function(xhr) {
//                 alert('An error occurred while saving notes.');
//             }
//         });
//     });
//     });

 // Define App Namespace
//  var popup = {
//     // Initializer
//     init: function() {
//       popup.popupVideo();
//     },
//     popupVideo : function() {

//     $('.video_model').magnificPopup({
//     type: 'iframe',
//     mainClass: 'mfp-fade',
//     removalDelay: 160,
//     preloader: false,
//     fixedContentPos: false,
//     gallery: {
//           enabled:true
//         }
//   });

// /* Image Popup*/ 
//  $('.gallery_container').magnificPopup({
//       delegate: 'a',
//     type: 'image',
//     mainClass: 'mfp-fade',
//     removalDelay: 160,
//     preloader: false,
//     fixedContentPos: false,
//     gallery: {
//           enabled:true
//         }
//   });

//    }
//   };
//   popup.init($);

// $('.clickable-image').on('click', function(e) {
// 	e.preventDefault();
// 	alert('Click');
// });

// $(document).ready(function() {
//     $('.clickable-image').on('click', function(e) {
//         e.preventDefault();
        
//         // Get the clicked image or video URL
//         var mediaUrl = $(this).attr('src');
		
// 		// alert(mediaUrl);
// // 		var mediaType = $(this).data('type'); // Assuming you have a data-type attribute to distinguish between image and video
// //         var description = $(this).data('description'); // Assuming you have a data-description attribute for the description
// // \        // Set the media in the modal
// //         var mediaContent = '';
// //         if (mediaType === 'video') {
// //             mediaContent = `<video width="100%" controls>
// //                                 <source src="${mediaUrl}" type="video/mp4">
// //                                 Your browser does not support the video tag.
// //                             </video>`;
// //         } else {
//             mediaContent = `<img src="${mediaUrl}" alt="Image" id="modal-image" class="img-fluid">`;
//         // }
        
// 		console.log(mediaContent);
//         $('#media-display').html(mediaContent);
//         // $('#description-text').text(description || 'No description available');
        
//         // Show the modal
//         $('#details_page_popup').modal('show');
//     });



    // Handle the click event on the image
    // $('.clickable-image').on('click', function(e) {
    //     e.preventDefault();

    //     // Store the image ID
    //     mediaImageId = $(this).data('image-id');
	// 	        var mediaUrl = $(this).attr('src');

	// 	mediaContent = `<img src="${mediaUrl}" alt="Image" id="modal-image" class="img-fluid">`;
    //     $('#media-display').html(mediaContent);


    //     // Show the modal
    //     $('#details_page_popup').modal('show');
    // });

    // // Handle form submission
    // $('#notes-form').on('submit', function(e) {
    //     e.preventDefault();
        
    //     var notes = $('#notes').val();

    //     if (mediaImageId === null) {
    //         alert('No image selected.');
    //         return;
    //     }

    //     $.ajax({
    //         url: "{{ route('save.notes') }}", // Use the correct route
    //         method: 'POST',
    //         data: {
    //             notes: notes,
    //             _token: $('meta[name="csrf-token"]').attr('content'),
    //             mediaImageId: mediaImageId
    //         },
    //         success: function(response) {
    //             alert('Notes saved successfully!');
    //             $('#notes').val(''); // Clear the textarea
    //             mediaImageId = null; // Reset the image ID
    //         },
    //         error: function(xhr) {
    //             alert('An error occurred while saving notes.');
    //         }
    //     });
    // });


    // // Handle the click event on the image
    // $('.clickable-image').on('click', function(e) {
    //     e.preventDefault();

    //     // Store the image ID
    //     mediaImageId = $(this).data('image-id');
	// 	var mediaUrl = $(this).attr('src');
		
	// 	var mediaType = $(this).data('type');

	// 	if (mediaType === 'video') {
    //         mediaContent = `<video width="100%" controls>
    //                             <source src="${mediaUrl}" type="video/mp4">
    //                             Your browser does not support the video tag.
    //                         </video>`;
    //     } else {
    //         mediaContent = `<img src="${mediaUrl}"  alt="Image" class="img-fluid">`;

	// 	}
    //     // }

	// 	mediaContent = `<img src="${mediaUrl}" alt="Image" id="modal-image" class="img-fluid">`;
	// 		$('#media-display').html(mediaContent);
    //     // Show the modal
    //     $('#details_page_popup').modal('show');
    // });

    // // Handle form submission
    // $('#notes-form').on('submit', function(e) {
    //     e.preventDefault();
        
    //     var notes = $('#notes').val();

    //     if (mediaImageId === null) {
    //         alert('No image selected.');
    //         return;
    //     }

    //     $.ajax({
    //         url: "{{ route('save.notes') }}", // Use the correct route
    //         method: 'POST',
    //         data: {
    //             notes: notes,
    //             _token: $('meta[name="csrf-token"]').attr('content'),
    //             mediaImageId: mediaImageId
    //         },
    //         success: function(response) {
    //             alert('Notes saved successfully!');
    //             $('#notes').val(''); // Clear the textarea
    //             mediaImageId = null; // Reset the image ID
    //         },
    //         error: function(xhr) {
    //             alert('An error occurred while saving notes.');
    //         }
    //     });
    // });


// $('.clickable-image').on('click', function(e) {
// 	e.preventDefault();
// 	// alert('Click');

// 	$('#details_page_popup').modal('show');
// });

	$('.remove-img').on('click', function (e) {
		e.preventDefault();
    	var project_id = $('#project_id').val();
		var file = $(this).data('media-item-id'); 
		console.log(file);
		currentButton = $(this);
        var isConfirmed = confirm('Are you sure you want to remove this file?');

            if (isConfirmed) {
			$.ajax({
		   url: "{{ route('delete.image.designstudio.contractor', ['project_id' => ':project_id', 'file' => ':file']) }}"
                .replace(':project_id', project_id)
                .replace(':file', file),

            type: 'post',
			data:{_token:'{{ csrf_token() }}'},
            success: function (response) {
			
				if(response.count === 0 || response.customer_count === 0) {
					$('#dsresetFilterButton').trigger('click');
				}
				if(response.count === 0 && response.customer_count === 0){
					// $('#designStudiotab').html("");
					$('#designStudiotab').removeClass("d-block");
					$('#designStudiotab').addClass("d-none");
					$('#dsresetFilterButton').trigger('click');
				}
				var file = $(this).closest('media-item-id'); 

				currentButton.closest('.design-studio-img-items').remove();

            },
            error: function (error) {
                console.error('Error deleting file:', error);
            }
        });
 		  }else{
				//alert("out")
			}
        });
</script>


