@if ($groupedData)
    @foreach ($groupedData as $date => $mediaItems)
        <h6>{{ \Carbon\Carbon::parse($date)->format('m-d-Y') }}</h6>
        @foreach ($mediaItems as $mediaItem)
            @if ($mediaItem->media_type == 'image')
                <div class="design-studio-img-items gallery_container">
                    {{-- @if (Auth::user('user')->id == $mediaItem->created_by) --}}
                    <button type="button" class="remove-img" data-media-item-id="{{ $mediaItem->id }}">X</button>
                    {{-- @endif --}}
                    <a class="lightbox" href="{{ asset('storage/' . $mediaItem->image) }}">
                        <img src="{{ asset('storage/' . $mediaItem->image) }}" alt="Image">
                    </a>
                    <span class="image-upload-time">{{ $mediaItem->time }}</span>
                </div>
            @elseif($mediaItem->media_type == 'video')
                <!-- <div class="video-container"> -->
                <div class="design-studio-img-items video-container">
                    <button type="button" class="remove-img" data-media-item-id="{{ $mediaItem->id }}">X</button>
                    <a class="image-gallery-popup video_model " href="{{ asset('storage/' . $mediaItem->image) }}">
                        <video width="150" height="150" controls>
                            <source src="{{ asset('storage/' . $mediaItem->image) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </a>
                    <span class="image-upload-time">{{ $mediaItem->time }}</span>
                </div>
            @endif
            <!-- </div> -->
        @endforeach
    @endforeach
@endif
<script type="text/javascript">
    $('.remove-img').on('click', function (e) {
        e.preventDefault();
        // var project_id = $('#project_id').val();
        var file = $(this).data('media-item-id');
        console.log(file);
        currentButton = $(this);
        var isConfirmed = confirm('Are you sure you want to remove this file ?');
        if (isConfirmed) {
            $.ajax({
                url: "{{ route('delete.image.contractor.portfolio', ['file' => ':file'])}}"
                    .replace(':file', file),
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.count == 0) {
                        window.location.reload();
                    }
                    var file = $(this).closest('media-item-id');
                    currentButton.closest('.design-studio-img-items').remove();
                },
                error: function (error) {
                    console.error('Error deleting file:', error);
                }
            });
        }
    });


    jQuery(document).ready(function ($) {
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
    });
</script>