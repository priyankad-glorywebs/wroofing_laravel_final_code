@if($groupedData && count($groupedData) > 0)
  @foreach($groupedData as $date => $mediaItems)
    <h6 class="display_date">{{ $date }}</h6>
    @foreach($mediaItems as $mediaItem)
    @php
      if (Auth::user('user')->id == $mediaItem->created_by) {
      $color = 'design-studio-with-customer';
      } else {
      $color = "";
    }@endphp
    @if($mediaItem->media_type == 'image')
    <div class="design-studio-img-items {{$color ?? ''}} gallery_container">
    @if (Auth::user('user')->id == $mediaItem->created_by)
    <button type="button" class="remove-img" data-media-item-id="{{ $mediaItem->id }}">X</button>
  @endif
    <a class="lightbox" href="{{ asset('storage/project_images/' . $mediaItem->project_image)  }}">
    <img src="{{ asset('storage/project_images/' . $mediaItem->project_image)  }}" alt="Image">
    </a>
    <span class="image-upload-time">{{$mediaItem->time}}</span>
    </div>
  @elseif($mediaItem->media_type == 'video')
  @php
  if (Auth::user('user')->id == $mediaItem->created_by) {
  $color = 'design-studio-with-customer';
  } else {
  $color = "";
}@endphp
  <!-- <div class="video-container"> -->
  <div class="design-studio-img-items {{$color ?? ''}} video-container">
  @if (Auth::user('user')->id == $mediaItem->created_by)
    <button type="button" class="remove-img" data-media-item-id="{{ $mediaItem->id }}">X</button>
  @endif
  <a class="image-gallery-popup video_model " href="{{ asset('storage/project_images/' . $mediaItem->project_image) }}">
  <video width="150" height="150" controls>
    <source src="{{ asset('storage/project_images/' . $mediaItem->project_image) }}" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  </a>
  <span class="image-upload-time">{{$mediaItem->time}}</span>
  </div>
@endif   @endforeach
  @endforeach
@else
  <p class="p-not-found"><strong style="color:black">No Data Found</strong></p>
@endif

<script>
  // Define App Namespace
  var popup = {
    // Initializer
    init: function () {
      popup.popupVideo();
    },
    popupVideo: function () {

      $('.video_model').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false,
        gallery: {
          enabled: true
        }
      });

      /* Image Popup*/
      $('.gallery_container').magnificPopup({
        delegate: 'a',
        type: 'image',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false,
        gallery: {
          enabled: true
        }
      });

    }
  };
  popup.init($);
  // });


  $('.remove-img').on('click', function (e) {
    e.preventDefault();
    var project_id = $('#project_id').val();
    var file = $(this).data('media-item-id');
    var currentButton = $(this);
    // console.log(file);
    // var isConfirmed = confirm('Are you sure you want to remove this file?');
    // if (isConfirmed) {
      Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
      $.ajax({
        url: '/delete-image/' + project_id + '/' + file,
        type: 'post',
        data: { _token: '{{ csrf_token() }}' },
        success: function (response) {
          if (response.groupedData_count == 1 ||response.count == 0 || response.customer_count === 0 ) {
            window.location.reload();
          }
          // if(response.groupedData_count == 1){
            //   $(this).closest('.display_date').remove();
            // }
          var file = $(this).closest('media-item-id');
          // alert("File deleted");
          currentButton.closest('.design-studio-img-items').remove();


        },
        error: function (error) {
          console.error('Error deleting file:', error);
        }
      });
    } else {
      // alert("out")
    }
  });
  });
</script>